<?php

namespace members;

function run($controller)
{
//    $controller->test();
    menu($controller);
}


function menu($controller)
{
    switch ($controller->mode) {
        case "login":
            $controller->login();
            break;
        case "create":
            $controller->create();
            break;
        case "update":
            $controller->update();
            break;
        case "delete":
            $controller->delete();
            break;
        case "authenticate":
            $controller->authenticate();
            break;
        case "logout":
            $controller->sess->logout();
            $controller->login();
            break;
        default:
            $controller->top();
    }
}