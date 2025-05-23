<?php
namespace app\classes;


class NotFoundHandler{
    
    public static function handle(){
        http_response_code(404);
        header("Content-Type: text/html"); 

        $viewData = [
            'title' => 'Página não encontrada',
            'message' => 'A URL solicitada não existe.',
        ];
        extract($viewData);
        if(file_exists(VIEWS_PATH . "/not-found.php")){
            include VIEWS_PATH . "/not-found.php";
        }else{
            $html = <<<HTML
                <style>
                    *{
                        padding:0;
                        margin:0;
                        font-size: 16px;
                        font-family:"sans-serif";
                    }
                    div{
                        background: #1E1E1E;
                        color: #d1d1d1;
                        height: 100vh;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                    }
                    h1{
                        font-family: "sans-serif";
                    }
                </style>
                <div>
                    <h1>404 | PÁGINA NÃO ENCONTRADA</h1>
                </div>
            HTML;
            echo $html;
        }
    }
}