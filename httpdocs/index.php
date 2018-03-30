<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../vendor/autoload.php';
    session_start();

    //$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
    //above $loader is loading into public directory so needed to customize the path towards a non public directory where templates are loaded. see the loader below with custom path to folder templates!

    $loader = new Twig_Loader_Filesystem('/home/nicky/sites/projects/sensi/nicky/src/templates');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));
    $twig->addExtension(new Twig_Extension_Debug());

    ($_SERVER['REQUEST_URI']);

    switch ($_SERVER['REQUEST_URI']) {
       // $template = substr($_SERVER['REQUEST_URI'], 1);
        case '/login':
            try {
                include '../src/User/reglog.php';
                $template = 'reglog.html.twig';
                echo $twig->render($template, ['session' => $_SESSION]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/workprojects':
            try {
                $template = 'workhistory.html.twig';
                echo $twig->render($template, ['session' => $_SESSION]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/about':
            try {
                $template = 'about.html.twig';
                echo $twig->render($template, ['session' => $_SESSION]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/resume':
            try {
                $template = 'resume.html.twig';
                echo $twig->render($template, ['session' => $_SESSION]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/contact':
            try {
                include '../src/Contact/contact.php';
                $template = 'contact.html.twig';
                echo $twig->render($template, ['session' => $_SESSION]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/adminpanel':
            try {
                include '../src/Admin/function.php';
                $template = 'adminpanel.html.twig';
                echo $twig->render($template, ['session' => $_SESSION, 'users' => getAllUsers(), 'visitors' => getAllVisitors(), 'myVisitors' => getMyVisitors(), checkLogin()]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/userpanel':
            try {
                include '../src/User/userpanel.php';
                $template = 'userpanel.html.twig';
                echo $twig->render($template, ['session' => $_SESSION, 'currentUser' => getCurrentUser(), 'myVisitors' => getMyVisitors(), 'checkLogin' => checkLogin()]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;

        case '/error':
            try {
                $template = 'error.html.twig';
                echo $twig->render($template, ['session' => $_SESSION]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;

        case '/':
            try {
                include '../src/User/reglog.php';
                include '../src/Homepage/home.php';
                $template = 'page.html.twig';
                echo $twig->render($template, ['session' => $_SESSION, 'visitor' => $visitor, 'user' => $userData, 'companys' => getCompanys(), 'projects' => getProjects()]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;

        default:
            try {
                $template = 'error.html.twig';
                echo $twig->render($template);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;    }

