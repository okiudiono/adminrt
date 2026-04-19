<?php

class Developer_model extends CI_Model
{
    private $_table = "satudata.m_user_api";

    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[32]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[32]'
            ],
            [
                'field' => 'message',
                'label' => 'Message',
                'rules' => 'required'
            ],
        ];
    }
}
