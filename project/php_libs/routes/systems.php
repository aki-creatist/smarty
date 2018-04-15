<?php

namespace systems;

function run($systems, $members)
{
//    $controller->test();

    switch ($systems->mode) {
        case "login":
            $systems->login();
            break;
        case "logout":
            $systems->sess->logout();
            $systems->login();
            break;
        case "update":
            $members->update();
            break;
        case "delete":
            $members->delete();
            break;
        case "list":
            $systems->index();
            break;
        case "detail":
            $systems->detail();
            break;
        case "create":
            $members->create();
            break;
        case "authenticate":
            $systems->authenticate();
            break;
        default:
            $systems->top();
    }
}