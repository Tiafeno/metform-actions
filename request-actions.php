<?php
namespace Includes\Settings\Actions;

if ( !defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

use Includes;
use Includes\Settings\Services;
use Includes\Objects;
use function wp_mail;
use function add_action;
use function add_filter;

// Le mail doit contenir un <DOCTYPE>, head, body...
$content_type = function() { return 'text/html'; };
add_filter( 'wp_mail_content_type', $content_type );

// Debug wordpress mail function 
add_action('wp_mail_failed', function($wp_error) {
    $fn = __DIR__ . '/mail.log'; // say you've got a mail.log file in your server root
    $fp = fopen($fn, 'a');
    fputs($fp, "Mailer Error: " . $wp_error->get_error_message() .", Error code:" .$wp_error->get_error_code() ."\n");
    fclose($fp);
}, 10, 1);


/**
 * Envoyer à l'administrateur le demande d'envoie de conteneur
 *
 * @param $form_id int
 * @param $data Array()
 * @return mixed
 */
function send_container_ship($form_id, $data) {
    global $twig_env;
    $entry_id = intval($data['entry_id']);
    $to = MAIL_RESPONSABLE;
    $body = $twig_env->render('container_ship.html', [
        'logo' => home_url('/wp-content/themes/blo/includes/settings/logo/logo.png'),
        'data' =>  is_array($data['store']) ? $data['store'] : []
    ]);
    $subject = "N*{$data['entry_id']} - Nouvelle demande d'envoie de conteneur";
    return wp_mail($to, $subject, $body);
}

/**
 * Envoyer un demande de devis avec le devis au client,
 *
 * @param $entry_id
 * @param $form_id
 * @param $cost
 * @return mixed
 */
function send_quote_request($entry_id, $form_id, $cost) {
    global $twig_env;
    $data_entry = Services\RequestQuoteService::instance()->get_entry($entry_id);
    $form_data = Services\RequestQuoteService::instance()->get_form($form_id);
    // Form data
    $pickup = $form_data['mf-pickup']; // return object
    $country = &$pickup;
    $country_metform = new Objects\MetformSelect($country);

    $category_car = $form_data['mf-category-car'];
    $cc_metform = new Objects\MetformSelect($category_car);

    $forward_link = \add_query_arg( 
        [
            'forward_mf_form' => $entry_id,
            'fid' => $form_id // Issue
        ], \get_the_permalink( RESERVATION_PAGE_ID )
    );
    $forward_link = \esc_url( $forward_link );
    //$from = "no-reply@falicrea.net";
    $to = $data_entry['mf-email'];
    $body = $twig_env->render('demande_devis.html', [
        'logo' => home_url('/wp-content/themes/blo/includes/settings/logo/logo.png'),
        'link' => $forward_link,
        'cost' => $cost,
        'qty'  => '01',
        'country' => $country_metform->get_text_by_value($data_entry['mf-pickup']),
        'category_car' => $cc_metform->get_text_by_value($data_entry['mf-category-car'])
    ]);
    $subject = "N*{$entry_id} - Nouvelle demande de devis";
    return wp_mail($to, $subject, $body);
}

/**
 * Envoyer une reservation à l'administrateur
 *
 * @param $data_send array(form_data => [...], form_id => ?, entry_id => ?, store => [...], redirect_to => ?)
 * @return false
 */
function send_reservation($data_send) {
    if (empty($data_send)) return false;
    global $twig_env;
    $render = [];

    $request_demande_entry = unserialize($_SESSION['mf_form_forward']);
    //$form_id = (int)$data_send['form_id'];
    $current_entry_id = (int)$data_send['entry_id'];

    //$current_form_data = Services\RequestQuoteService::instance()->get_form($form_id);
    $current_data_entry = Services\RequestQuoteService::instance()->get_entry($current_entry_id);

    // Get files
    $entry_files = Services\RequestQuoteService::instance()->get_file_entry($current_entry_id);
    $schemaFileUploadClass = new Objects\SchemaFileUpload(); 
    if (!empty($entry_files)) {
        $render['files'] = [];
        foreach ($entry_files as $slug => $entry) {
            if ( ! (int)$entry['status']) continue;
            $name = $schemaFileUploadClass->get_name($slug);
            $render['files'][$slug] = [
                'slug' => $slug,
                'name' => $name,
                'url' => isset($entry['url']) ? $entry['url'] : null
            ];
        }
    }

    // Informations
    $render['info'] = [
        'mark' => $current_data_entry['mf-marque'],
        'model' => $current_data_entry['mf-model'],
        'chassi' => $current_data_entry['mf-chassi'],
        'year' => $current_data_entry['mf-year'],
        'size' => $current_data_entry['mf-size'],
        'weight' => $current_data_entry['mf-weight'],
    ];

    // Shipping destination
    $render['recipient_firstname'] = $current_data_entry['mf-recipient-firstname'];
    $render['recipient_lastname'] = $current_data_entry['mf-recipient-lastname'];
    $render['recipient_email'] = $current_data_entry['mf-recipient-email'];
    $render['recipient_telephone'] = $current_data_entry['mf-recipient-telephone'];

    // Donnee de demande
    $demande_entry_id = $request_demande_entry['entry_id'];
    $cost = Includes\RequestQuote::instance()->calc_shipping( intval($demande_entry_id) );

    // General information
    $render['lastname'] =  $request_demande_entry['mf-lastname'];
    $render['firstname'] =  $request_demande_entry['mf-firstname'];
    $render['phone'] =  $request_demande_entry['mf-phone'];
    $render['email'] =  $request_demande_entry['mf-email'];

    // Form data
    $demande_form_id = $request_demande_entry['form_id'];

    $form_data = Services\RequestQuoteService::instance()->get_form($demande_form_id);
    $pickup = $form_data['mf-pickup']; // return object
    $country_metform = new Objects\MetformSelect($pickup);

    $category_car = $form_data['mf-category-car'];
    $cc_metform = new Objects\MetformSelect($category_car);


    $render = array_merge($render, [
        'logo' => home_url('/wp-content/themes/blo/includes/settings/logo/logo.png'),
        'cost' => $cost,
        'qty'  => '01',
        'country' => $country_metform->get_text_by_value($request_demande_entry['mf-pickup']),
        'category_car' => $cc_metform->get_text_by_value($request_demande_entry['mf-category-car'])
    ]);
    $to = 'contact@falicrea.net'; // TODO: Change this address after
    $body = $twig_env->render('reservation.html', $render);
    $subject = "N*{$current_entry_id} - Nouvelle demande d'envoie de véhicule à Madagascar";

    unset($_SESSION["mf_form_forward"]);

    print_r($render);
    return wp_mail($to, $subject, $body);
}



