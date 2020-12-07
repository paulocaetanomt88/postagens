<?php

    class SobreController
    {
        public function index()
        {
            
                // Cria um objeto FileSystemLoader que carrega as views que estão dentro da pasta app/View
                $loader = new \Twig\Loader\FilesystemLoader('app/View');

                // cria um objeto Environmnt que carrega o loader
                $twig = new \Twig\Environment($loader);

                // chamando a view home
                $template = $twig->load('sobre.html');

                $parametros = array();

                $conteudo = $template->render($parametros);
                echo $conteudo;     
        }
    }

?>