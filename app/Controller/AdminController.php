<?php

    class AdminController
    {
        public function index()
        {
            
                // Cria um objeto FileSystemLoader que carrega as views que estão dentro da pasta app/View
                $loader = new \Twig\Loader\FilesystemLoader('app/View');

                // cria um objeto Environmnt que carrega o loader
                $twig = new \Twig\Environment($loader);

                // chamando a view home
                $template = $twig->load('admin.html');

                // armazena um array com todos objetos da tabela postagens
                $objPostagens = Postagem::selecionaTodos();

                // cria um vetor de parâmetros
                $parametros = array();
                // o parâmetro 'postagens' recebe o conteudo de $objPostagens
                $parametros['postagens'] = $objPostagens;

                $conteudo = $template->render($parametros);
                echo $conteudo;     
        }

        public function create() {
            // Cria um objeto FileSystemLoader que carrega as views que estão dentro da pasta app/View
            $loader = new \Twig\Loader\FilesystemLoader('app/View');

            // cria um objeto Environmnt que carrega o loader
            $twig = new \Twig\Environment($loader);

            // chamando a view home
            $template = $twig->load('create.html');

            $parametros = array();

            $conteudo = $template->render($parametros);
            echo $conteudo;     
        }

        public function insert() {
            try
            {
                Postagem::insert($_POST);

                echo '<script>alert("Publicação inserida com sucesso!");</script>';
                echo '<script>location.href="http://localhost/postagens/?pagina=admin&metodo=index"</script>';
            }
            catch (Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/postagens/?pagina=admin&metodo=create"</script>';
            }
        }

        public function editar($params) {
            $postagem = Postagem::selecionaPostPorId($params);

            // Cria um objeto FileSystemLoader que carrega as views que estão dentro da pasta app/View
            $loader = new \Twig\Loader\FilesystemLoader('app/View');

            // cria um objeto Environmnt que carrega o loader
            $twig = new \Twig\Environment($loader);

            // chamando a view home
            $template = $twig->load('editar.html');

            $parametros = array();
            $parametros['id'] = $postagem->id;
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;

            $conteudo = $template->render($parametros);
            echo $conteudo; 
        }

        public function update() {
            try
            {
                Postagem::update($_POST);
                echo '<script>alert("Publicação editada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/postagens/?pagina=admin&metodo=index"</script>';
            } 
            catch (Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="http://localhost/postagens/?pagina=admin&metodo=editar&id='.$_POST['id'].'"</script>';
            }
        }

        public function deletar($idPost) {
            try
            {
                Postagem::deletar($idPost);
                echo '<script>alert("Publicação deletada com sucesso!");</script>';
                echo '<script>location.href="http://localhost/postagens/?pagina=admin&metodo=index"</script>';
            } catch (Exception $e)
            {

            }
        }
    }

?>