<?php

namespace Okami\Core\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Page was not found!';
    protected $code = 404;
}