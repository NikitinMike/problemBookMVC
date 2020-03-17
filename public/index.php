<?php

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';

//Application initialisation/entry point. 
if (isset($_GET['action']))
{
    // router 
    switch ($_GET['action'])
    {
        
        case 'post':
            print "POST";
            $controller_name = 'BlogController';
            $action = 'postAction';
            break;
        
        case 'addpost':
            print "addpost";
            $controller_name = 'BlogController';
            $action = 'addAction';
            break;
        
        case 'addpostsubmitted':
            print "addpostsubmitted ";
            $controller_name = 'BlogController';
            $action = 'addpostsubmittedAction';
            break;
        
        case 'setorder':
            $GLOBALS['page'] = 0;
            $order = "";
            if( $_COOKIE["order"] === $_GET['order']) 
                $order = $_COOKIE["order"] . ' desc ';
            else
                $order = $_GET['order'];
            setcookie("order" ,$order);
            $GLOBALS['order'] = $order;
            $controller_name = 'BlogController';
            $action = 'indexAction';
            break;
        
        case 'login':
            $controller_name = 'IndexController';
            $action = 'loginAction';
            break;
        
        case 'loginsubmitted':
            $controller_name = 'IndexController';
            $action = 'loginsubmittedAction';
            break;
        
        case 'logout':
            $controller_name = 'IndexController';
            $action = 'logoutAction';
            break;

    }
} else {
    $GLOBALS['page'] = (isset($_GET['page']))? $_GET['page'] : 0;
    $GLOBALS['order'] = $_COOKIE["order"];
    $controller_name = 'BlogController';
    $action = 'indexAction';
}
require '../Application/Controller/' . $controller_name . '.php';

require '../Application/Model/BlogManager.php';
require '../Application/Model/UserManager.php';
require '../Application/View/Init.php';
$blogManager = new BlogManager($appConfig);
$userManager = new UserManager($appConfig);
$controller = new $controller_name($blogManager, $userManager);
$controller->{$action}($_REQUEST);
