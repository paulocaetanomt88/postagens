<?php

    class HomeController
    {
        public function index()
        {
            try
            {
                $colecaoDePostagens = Postagem::selecionaTodos();

                // Cria um objeto FileSystemLoader que carrega as views que estão dentro da pasta app/View
                $loader = new \Twig\Loader\FilesystemLoader('app/View');

                // cria um objeto Environmnt que carrega o loader
                $twig = new \Twig\Environment($loader);

                // chamando a view home
                $template = $twig->load('home.html');

                $parametros = array();
                $parametros['postagens'] = $colecaoDePostagens;

                $conteudo = $template->render($parametros);
                echo $conteudo;
            
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }

?>