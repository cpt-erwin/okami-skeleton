<?php

use Okami\Core\App;

return function (App $app)
{
    $app->onEvent(App::EVENT_BEFORE_REQUEST, function () {
        echo "Before request";
    });

    $app->onEvent(App::EVENT_AFTER_REQUEST, function () {
        echo "After request";
    });
};