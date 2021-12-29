<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Controller;
use App\Core\Application;

class SiteController extends Controller
{

    public function home()
    {
        $params = [
            'title' => 'Alan Hernandez'
        ];

        return $this->render('home', $params);
    }

    public function index()
    {
        return $this->render('index');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        
    }
}