<?php

namespace App\Controllers;

use Okami\Core\Controller;
use Okami\Core\Request;

/**
 * Class AuthController
 *
 * @author Michal Tuček <michaltk1@gmail.com>
 * @package App\Controllers
 */
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            return "Handling submitted data...";
        }
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            return "Handling submitted data...";
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}