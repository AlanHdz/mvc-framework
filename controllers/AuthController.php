<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {

    }

    public function register(Request $request)
    {
        $user = new User;
        if ($request->isPost()) {
            
            $user->loadData($request->getBody());

            if ($user->validate() && $user->register()) {
                return 'Success';
            }

            return $this->render('auth/register', [
                'model' => $user
            ]);
        }

        return $this->render('auth/register', [
            'model' => $user
        ]);
    }

}
