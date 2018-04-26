<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once '../vendor/autoload.php';
    session_start();

    $loader = new Twig_Loader_Filesystem(__DIR__.'/../src/templates');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));
    $twig->addExtension(new Twig_Extension_Debug());

    ($_SERVER['REQUEST_URI']);

    switch ($_SERVER['REQUEST_URI']) {
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
                include '../src/resume/resume.php';
                $template = 'resume.html.twig';
                echo $twig->render($template, ['session' => $_SESSION, 'showData' => getResume(), 'post' => $_POST, 'root' => dirname(__DIR__,1) . '/generatedpdf/']);
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
                echo $twig->render($template, ['session' => $_SESSION, 'users' => getAllUsers(), 'visitors' => getAllVisitors(), 'myVisitors' => getMyVisitors(), checkAdminLog()]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/userpanel':
            try {
                include '../src/User/userpanel.php';
                include 'panel.js';
                $template = 'userpanel.html.twig';
                echo $twig->render($template, ['session' => $_SESSION, 'currentUser' => getCurrentUser(), 'myVisitors' => getMyVisitors(), 'checkLogin' => checkLogin()]);
            }catch(Exception $e) {
                $template = 'error.html.twig';
                echo $twig->render($template, ['error' => $e]);
            }
            break;
        case '/updateuser':
            include 'panel.php';
            break;

        case '/updatevisitor':
            include 'panel.php';
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
            break;
    }

