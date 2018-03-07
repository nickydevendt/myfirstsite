<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));
    $twig->addExtension(new Twig_Extension_Debug());

    //var_dump($_SERVER['REQUEST_URI']);

    switch ($_SERVER['REQUEST_URI']) {
        //$template = substr($_SERVER['REQUEST_URI'], 1);
        case '/register':
            include '../src/User/register.php';
            $template = 'register.html.twig';
            echo $twig->render($template, ['piemel' => $piemel]);
            break;
        case '/login':
            $template = 'reglog.html.twig';
            echo $twig->render($template);
            break;
        default: 
            $template = 'page.html.twig';
            echo $twig->render($template);
            break;
    }

?>

