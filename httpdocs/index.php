<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
    $twig = new Twig_Environment($loader);

    switch ($_SERVER['REQUEST_URI']) {
        case '/': $template = 'page.html.twig'; break;
        default: $template = substr($_SERVER['REQUEST_URI'], 1);
    }
    echo $twig->render($template);
?>

