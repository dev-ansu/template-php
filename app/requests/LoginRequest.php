<?php

namespace app\requests;
use app\requests\Request;

class LoginRequest extends Request{

    public function __construct(){
        parent::__construct($this);
    }

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email' => 'required|notNull',
            'senha' => 'required|notNull',
        ];
    }

    public function messages(){
        return [
            'email.notNull' => "O campo e-mail não pode ser vazio.",
            'email.required' => "O campo de e-mail é obrigatório.",
            'senha.required' => "O campo de senha é obrigatório.",
            'senha.notNull' => "O campo de senha não pode ser vazio.",
        ];
    }

}