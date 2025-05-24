<?php
namespace app\controllers\api;

use app\classes\Session;
use app\core\Controller;
use app\services\AuthSessionService;
use app\services\usuarios\UsuariosService;

class UsuariosController extends Controller{
    

    public function __construct(AuthSessionService $session)
    {
       
    }
    
    public function index(){
        $users = (new UsuariosService())->all();
        
        echo <<<HTML
            <table class="table table-hover" id="tabela">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="esc">Telefone</th>
                        <th class="esc">Email</th>
                        <th class="esc">Nivel</th>
                        <th class="esc">Cadastrado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach($users as $user){
            extract(json_decode(json_encode($user), true));
            
            $created_at = date('d/m/Y', strtotime(($created_at)));
            $icone = $ativo === "Sim" ? "fa-check-square":"fa-square-o";
            $titulo_link = $ativo === "Sim" ? "Inativar":"Ativar";
            $classe_ativo = $ativo === "Sim" ? "#c4c4c4":"";

            echo <<<HTML

                    <tr class="{$classe_ativo}">
                        <td>{$nome}</td>
                        <td>{$telefone}</td>
                        <td>{$email}</td>
                        <td>{$nivel}</td>
                        <td>{$created_at}</td>
                        <td>
                            <big>
                                <a href="#" onclick="editar()" title="Editar dados">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                            </big>
                            <li class="dropdown head-dpdn2 cursor-pointer" style="display: inline-block;">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <big>
                                        <i class="fa fa-trash-o text-danger"></i>
                                    </big>
                                </a>
                                <ul class="dropdown-menu" style="margin-left:-230px">
                                    <li>
                                        <div>
                                            <p>
                                                Confirmar exclusão? 
                                                <a href="#" onclick='excluir("{$id}")'>
                                                    <span class="text-danger">Sim</span>
                                                </a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                             <big>
                                <a href="#" onclick="mostrar()" title="Mostrar dados">
                                    <i class="fa fa-info-circle text-primary"></i>
                                </a>
                            </big>
                             <big>
                                <a href="#" onclick='ativar("{$id}")' title="{$titulo_link}">
                                    <i class="fa {$icone} text-success"></i>
                                </a>
                            </big>
                             <big>
                                <a href="#" onclick='permissoes("{$id}")' title="Definir permissões">
                                    <i class="fa fa-lock" style="color: blue; margin-left:3px"></i>
                                </a>
                            </big>
                        </td>
                    </tr>
                HTML;

        }

        echo <<<HTML
            </tbody>
            </table>
        HTML;

        return;
    }

    public function activateUser(){
        

    }

}