<?php

namespace App\Controllers;

use App\Models\LoginForm;
use App\Models\User;
use Okami\Core\App;
use Okami\Core\Middlewares\AuthMiddleware;
use Okami\Core\Response;
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
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                exit;
            }
        }
        $this->setLayout('main');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                App::$app->session->setFlash('success', 'Successfully registered!');
                $response->redirect('/');
                exit;
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        $this->setLayout('main');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        App::$app->logout();
        $response->redirect('/');
    }

    public function profile(Request $request, Response $response)
    {
        return $this->render('profile');
    }
}