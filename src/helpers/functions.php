<?php

/** Carrega um recurso
 * @param string $resource - recurso a ser carregado
 * @return string
 */
function asset(string $resource): string {
    return rtrim(ASSETS_PATH, '/') . '/' . ltrim($resource, '/');
}

/** Carrega um componente na view
 * @param string $componentName - o nome do component a ser carregado
 * @param array $componentData - o dados a serem impressos no componente
 */
function component(string $componentName, array $componentData = []): void{
        
    if(str_contains($componentName, ".")){
        $componentName = str_replace(".", "\\", $componentName);
    }

    extract($componentData);
    include_once COMPONENTS_PATH . $componentName . ".php";

}

/**
 * Define uma flash message
 * @param string $key - a chave da flash message
 * @param string $message - a mensagem da flash message
 * @param string $type (danger | primary | success | warning) - o tipo da flash message
 * @return void
 */
function setFlash(string $key, string $message, string $type = "danger"){

    if(empty($_SESSION[$key])){

        $_SESSION[$key] = [
            'message' => $message,
            'type' => $type,
        ];

    }
}

/**
 * Pega uma flash message
 * @param string $key - a chave da flash message
 * @return void
 */



function getFlash($key){

    if(!empty($_SESSION[$key])){

        $flash = $_SESSION[$key];

        unset($_SESSION[$key]);

        $message = $flash['message'];
        $type = $flash['type'];

        $message = htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8');
        $type = htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8');
        
        // Define CSS e JS apenas na primeira vez
        static $assetsLoaded = false;

        $styles = '';
        $scripts = '';

        if (!$assetsLoaded) {
            $assetsLoaded = true;

            $styles = <<<STYLE
                <style>
                    .alert {
                        width: auto;
                        height: auto;
                        padding: 15px 10px;
                        display: flex;
                        border-radius: 10px;
                        align-items: center;
                        justify-content: space-between;
                        font-size: 16px;
                        font-family: sans-serif;
                        margin-bottom: 10px;
                    }

                    .alert.alert-danger {
                        background: #f8d7da;
                        color: #7f4159;
                    }

                    .alert.alert-success {
                        background: #d4ecdb;
                        color: #32643c;
                    }

                    .alert.alert-primary {
                        background: #cde5fe;
                        color: #8f6941;
                    }

                    .alert.alert-warning {
                        background: #fef3cc;
                        color: #8f6941;
                    }

                    .btn-close-alert::before {
                        content: "X";
                    }

                    .btn-close-alert {
                        display: block;
                        cursor: pointer;
                        background-color: transparent;
                        outline: none;
                        border: 1px solid transparent;
                        padding: 5px 10px;
                        border-radius: 4px;
                        transition: all 0.4s ease;
                    }

                    .btn-close-alert:hover {
                        background: #ccc;
                    }
                </style>
            STYLE;

            $scripts = <<<SCRIPT
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.querySelectorAll('.btn-close-alert').forEach(function (btn) {
                            btn.addEventListener('click', function () {
                                const alert = this.closest('.alert')
                                if(alert) { alert.remove() };
                                const container = document.querySelector(".alert-container");
                                if(container && container.children.length < 3){
                                    container.remove()
                                }
                            });
                        });
                    });
                </script>
            SCRIPT;
        }

        $html = <<<HTML
            {$styles}
            <span class="alert alert-{$type}">
                <span>{$message}</span>
                <span class="btn-close-alert"></span>
            </span>
            {$scripts}
        HTML;

        return $html;
    }

}

/**
 * Redireciona o usuário para um link interno do site
 * @param string $to - url de destino
 * @return void
 */
function redirect(string | null $to = null): void{
    header("location: " . BASE_URL . $to);
    die;
}

/**
 * Define uma rota a ser seguida
 * @param string $route
 */
function route(string $route){
    if(str_contains($route, ".")){
        $route = str_replace(".", "/", $route);
    }
    return BASE_URL . $route;
}