<?php

namespace app\requests;
use app\requests\RequestValidation;

class LoginRequest extends RequestValidation{

    public function __construct(){
        parent::__construct();
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