<?php

namespace App\Controllers;

use App\Models\ContactForm;
use Okami\Core\App;
use Okami\Core\Controller;
use Okami\Core\Request;
use Okami\Core\Response;

/**
 * Class SiteController
 *
 * @author Michal Tuček <michaltk1@gmail.com>
 * @package Okami\Controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "TuMiSoft"
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()) {
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->sent()) {
                App::$app->session->setFlash('success', 'Thanks for contacting us!');
                $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}