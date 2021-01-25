<?php

use Okami\Core\App;

return function (App $app)
{
    $app->onEvent(App::EVENT_BEFORE_REQUEST, function () {
        echo '
            <div class="notification is-warning">
              Before request
            </div>
        ';
    });

    $app->onEvent(App::EVENT_AFTER_REQUEST, function () {
        echo '
            <div class="notification is-warning">
              After request
            </div>
        ';
    });
};