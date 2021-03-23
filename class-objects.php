<?php
namespace Includes\Objects;

class InputList{
    public $mf_input_option_text = null;
    public $mf_input_option_value = null;
    private $_id = null;
    public function __construct() {}
    public static function instance() {
        return new self();
    }
    public function set_values(\stdClass $data) {
        $this->mf_input_option_text = $data->mf_input_option_text;
        $this->mf_input_option_value = $data->mf_input_option_value;
        $this->_id = $data->_id;

        return $this;
    }

    public function get_id() {
        return $this->_id;
    }
}

class MetformSelect {
    public $mf_input_label = null;
    public $mf_input_name = null;
    public $mf_input_placeholder = null;
    public $mf_input_list = [];

    public function __construct(\stdClass $data) {
        foreach ($data->mf_input_list as $list) {
            $this->mf_input_list[] = InputList::instance()->set_values($list);
        }
        $this->mf_input_name = $data->mf_input_name;
        $this->mf_input_label = $data->mf_input_label;
        $this->mf_input_placeholder = $data->mf_input_placeholder;
    }

    public function get_text_by_value($value) {
        $find_index = false;
        foreach ($this->mf_input_list as $index => $list) {
            $find_index = ((int)$list->mf_input_option_value === intval($value)) ? $index : false;
            if ($find_index) break;
        }
        if (!$find_index) return 'Introuvable';
        return $this->mf_input_list[$find_index]->mf_input_option_text;

    }
}

class SchemaFileUpload {
    public static $upload_fields = [
        [
            'name' => 'Carte Identité ou Passeport',
            'slug' => 'mf-passport-file'
        ],
        [
            'name' => 'Certificat de cession',
            'slug' => 'mf-certificat-file'
        ],
        [
            'name' => 'Facture du véhicule',
            'slug' => 'mf-bill-file'
        ],
        [
            'name' => 'Carte grise du véhicule',
            'slug' => 'mf-car-registration-file'
        ]
    ];
    public function __construct() {}
    public static function instance() { return new self(); }

    /**
     * @param $slug
     * @return string|bool
     */
    public function get_name($slug) {
        $index = array_search($slug, array_column(self::$upload_fields, 'slug'));
        //if (!$index) return null;
        return self::$upload_fields[ $index ][ 'name' ];
    }

}

