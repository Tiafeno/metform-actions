<?php
namespace Includes\Settings\Services;

if ( !defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class RequestQuoteService {
    public function __construct(){}

    public static function instance() {
        return new self();
    }

    /**
     * Array
        (
            [mf-pickup] => value-3
            [mf-category-car] => value-1
            [mf-firstname] => Tiafeno
            [mf-lastname] => Finel
            [mf-phone] => 0322624977
            [mf-email] => tiafenofnel@gmail.com
        )
     * return array
     */
    public function get_entry($entry_id = 0) {
        $data = \get_post_meta($entry_id, 'metform_entries__form_data', true);
        return $data;
    }

    public function get_form($form_id) {
        $map_data = \MetForm\Core\Entries\Action::instance()->get_fields($form_id);
        return $map_data;
    }

    /**
     * @param $entry_id integer
     * @return array|mixed
     */
    public function get_file_entry($entry_id) {
        /**
         * @return Array( 'slug_name' => ['file' => string, 'url' => string, type => 'image/png', error, status => 1], ...)
         */
        $file_entry = get_post_meta( intval($entry_id), 'metform_entries__file_upload', true );
        return (empty($file_entry)) ? [] : $file_entry;
    }
}