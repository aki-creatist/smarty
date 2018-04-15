<?php

namespace contents;

function run($controller)
{
//    $controller->test();
    menu($controller);
}

function menu($controller)
{
    switch ($controller->mode) {
        case "modify":
            $controller->screenModify();
            break;
        case "delete":
            $controller->screenDelete();
            break;
        case "list":
            $controller->screenContents();
            break;
        default:
            $controller->screenContents();
    }
}