<?php

class Akun_model extends Custom_model
{
    public $table                   = 'm_user_api';
    public $primary_key             = 'id';
    public $soft_deletes            = TRUE;
    public $timestamps              = TRUE;
    public $return_as               = "array";

    function __construct()
    {
        parent::__construct();
    }
    public function rules()
    {
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[32]|min_length[5]|is_unique[m_user_api.email]'
            ],
            [
                'field' => 're_email',
                'label' => 'Konfirmasi Email',
                'rules' => 'required|valid_email|max_length[32]|matches[email]'
            ]
        ];
    }
}
