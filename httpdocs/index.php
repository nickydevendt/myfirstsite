<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../vendor/autoload.php';
    session_start();

    $loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));
    $twig->addExtension(new Twig_Extension_Debug());

    ($_SERVER['REQUEST_URI']);

    switch ($_SERVER['REQUEST_URI']) {
       // $template = substr($_SERVER['REQUEST_URI'], 1);
        case '/register':
            include '../src/User/reglog.php';
            $template = 'register.html.twig';
            echo $twig->render($template, ['registerresult' => $registerresult, 'loginresult' => $loginresult, 'session' => $_SESSION]);
            break;
        case '/login':
            include '../src/User/reglog.php';
            $template = 'reglog.html.twig';
            echo $twig->render($template, ['registerresult' => $registerresult, 'session' => $_SESSION]);
            break;
        case '/workprojects':
            $template = 'workhistory.html.twig';
            echo $twig->render($template, ['session' => $_SESSION]);
            break;
        case '/about':
            $template = 'about.html.twig';
            echo $twig->render($template, ['session' => $_SESSION]);
            break;
        case '/resume':
            $template = 'resume.html.twig';
            echo $twig->render($template, ['session' => $_SESSION]);
            break;
        case '/contact':
            $template = 'contact.html.twig';
            echo $twig->render($template, ['session' => $_SESSION]);
            break;

        default: 
            $template = 'page.html.twig';
            echo $twig->render($template, ['session' => $_SESSION]);
            break;
    }

?>

