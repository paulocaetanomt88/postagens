<?php

require_once 'app/Core/Core.php';

// Conexão com o banco de dados
require_once 'lib/Database/Connection.php';

// Controllers
require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/AdminController.php';
require_once 'app/Controller/ErroController.php'; // caso não existir a página exibe página de erro


// Models
require_once 'app/Model/Postagem.php';
require_once 'app/Model/Comentario.php';

// Componentes
require_once 'vendor/autoload.php'; // - carrega de forma automática todos os componentes da pasta vendor

$template = file_get_contents('app/Template/estrutura.html');

ob_start(); // junta o conteúdo que estiver no trecho de código abaixo e armazena na variável $saida
    $core = new Core;
    $core->start($_GET);

    $saida = ob_get_contents();
ob_end_clean(); // encerra este trecho de código

$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;

?>