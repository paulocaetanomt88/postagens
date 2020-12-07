<?php

    class PostController
    {
        public function index($params)
        {
            try
            {
                $postagem = Postagem::selecionaPostPorId($params);

                // Cria um objeto FileSystemLoader que carrega as views que estão dentro da pasta app/View
                $loader = new \Twig\Loader\FilesystemLoader('app/View');

                // cria um objeto Environmnt que carrega o loader
                $twig = new \Twig\Environment($loader);

                // chamando a view home
                $template = $twig->load('postagem.html');

                $parametros = array();
                $parametros['id'] = $postagem->id;
                $parametros['titulo'] = $postagem->titulo;
                $parametros['conteudo'] = $postagem->conteudo;
                $parametros['comentarios'] = $postagem->comentarios;

                $conteudo = $template->render($parametros);
                echo $conteudo;
            
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function addComment()
        {
            try
            {
                Comentario::inserir($_POST);

                header('Location: http://localhost/postagens/?pagina=post&id='.$_POST['id']);
            }
            catch (Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/postagens/?pagina=post&id='.$_POST['id'].'"</script>';
            }
            
        }
    }

?>