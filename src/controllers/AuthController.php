<?php

namespace App\Controllers;

use App\Models\User;
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
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                return 'Success';
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }
}