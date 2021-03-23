<?php
namespace Includes;

use Includes\Settings\Actions;
use Includes\Settings\Services;
use Includes\Objects;

if (!defined('ABSPATH')) die('Direct access forbidden.');

\add_action('wp_logout', function () {
    session_destroy();
});
\add_action('init', function () {
    session_start();
});

$twig_env = null;
$twig_loader = null;
\add_action('wp_loaded', function () use (&$twig_loader, &$twig_env) {
    require_once get_stylesheet_directory() . '/includes/vendor/autoload.php';
    $twig_loader = new \Twig\Loader\FilesystemLoader(get_stylesheet_directory() . '/includes/templates');
    $twig_env = new \Twig\Environment($twig_loader, [
        'cache' => get_stylesheet_directory() . '/includes/templates/cache'
    ]);

});

// Metform plugin dependency
class RequestQuote
{
    public function __construct()
    {
        // Add request GET in session variable (entry_id) => {email, name etc...}
        add_action('wp_loaded', function () {
            if (isset($_GET['forward_mf_form']) && !empty($_GET['forward_mf_form'])) {
                unset($_SESSION["mf_form_forward"]);
                $entry_id = intval($_GET['forward_mf_form']);
                $form_id = intval($_GET['fid']);
                $data_entry = Services\RequestQuoteService::instance()->get_entry($entry_id);
                if (empty($data_entry)) {
                    /** Redirect in home page, if data is empty */
                    wp_redirect(home_url('/'));
                }
                $data_entry = array_merge($data_entry, ['entry_id' => $entry_id, 'form_id' => $form_id]);
                $_SESSION['mf_form_forward'] = serialize($data_entry);
            }
            // Teste code

        });

        // Entry point
        \add_action('new_entries_metform', [$this, 'new_entries_metform'], 11, 3);
    }

    public static function instance()
    {
        return new self();
    }

    /**
     * @param
     * $entry_id int
     * $data Array
     * (
         * [message] =>
         * [redirect_to] =>
         * [hide_form] => 1
         * [form_data] => Array
             * (
             * [action] => insert
             * [id] => 6267
             * [form_nonce] => 38ff6f4ffe
             * [mf-nonce] => request_quote
             * [mf-pickup] => 4
             * [mf-category-car] => 2
             * [mf-firstname] => Tiafeno
             * [mf-lastname] => Finel
             * [mf-phone] => 0322624977
             * [mf-email] => you-for@live.fr
             * )
         *
         * [form_id] => 6267
         * [entry_id] => 6418
         * [store] => Array
         * (
             * [mf-pickup] => 4
             * [mf-category-car] => 2
             * [mf-firstname] => Tiafeno
             * [mf-lastname] => Finel
             * [mf-phone] => 0322624977
             * [mf-email] => you-for@live.fr
         * )
         *
     * )
     * $settings Array()
     */
    public function new_entries_metform($entry_id, $data, $settings)
    {
        /**
         * - Affichier dans le mail le tarif pour son devis
         * - Ajouter un lien pour confimer la demande
         */
        $form_data = $data['form_data'];
        $form_id = intval($data['form_id']);

        if (isset($form_data['mf-nonce']) && $form_data['mf-nonce'] === 'request_quote') {
            $cost_ship = $this->calc_shipping($entry_id);
            // Envoyer le mail au client
            Actions\send_quote_request($entry_id, $form_id, $cost_ship);
        }

        if (isset($form_data['mf-nonce']) && $form_data['mf-nonce'] === 'confirm_request_quote') {
            // Send email to admin 
            Actions\send_reservation($data);
        }

        // Envoie de container
        if (isset($form_data['mf-nonce']) && $form_data['mf-nonce'] === 'container_ship') {
            // Send mail to admin
            Actions\send_container_ship($data, $form_id);
        }
    }

    public function calc_shipping($entry_id = 0)
    {
        $data = \get_post_meta($entry_id, 'metform_entries__form_data', true); // return array
        if (empty($data) || $data === '') return 0;
        $mf_pickup = intval($data['mf-pickup']); // country
        $mf_car_category = intval($data['mf-category-car']);

        $variation = @file_get_contents(get_stylesheet_directory() . '/includes/settings/variations.json');
        if (!$variation) return 0;
        $variation = json_decode($variation);

        $array_var = $variation->variations; // Array

        $index = array_search($mf_pickup, array_column($array_var, 'country')); // return index variation
        $costs = $array_var[$index]->costs;

        return $costs[$mf_car_category - 1];
    }
}


new RequestQuote();
