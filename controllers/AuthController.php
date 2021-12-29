<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Request;
use App\Core\Session;
use App\Core\Response;
use App\Core\Controller;
use Progsmile\Validator\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $errors = [];
        return $this->render('auth/login', ['errors' => $errors]);
    }

    public function loginPost(Request $request, Response $response, Session $session)
    {

        $req = $request->getBody();
        $validations = Validator::make($req, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$validations->passes()) {
            return $this->render('auth/login', ['errors' => $validations]);
        }

        $user = User::where('email', '=', $req['email'])->first();

        if (!$user) {
            $session->setFlash('error', 'User does not exist with this email');
            $response->redirect('/login');
            return;
        }

        if (!password_verify($req['password'], $user->password)) {
            $session->setFlash('error', 'Password is incorrect');
            $response->redirect('/login');
            return;
        }
        
        $this->auth($user);
        $session->setFlash('success', 'You Auth successfully');
        $response->redirect('/');
        return;
    }

    public function registerPost(Request $request)
    {
        $req = $request->getBody();

        $validation = Validator::make($req, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password',
        ]);

        if ($validation->passes()) {
            $user = User::create([
                'first_name' => $req['first_name'],
                'last_name' => $req['last_name'],
                'email' => $req['email'],
                'password' => password_hash($req['password'], PASSWORD_BCRYPT),
            ]);
            $this->session->setFlash('success', 'Thanks for registering');
            $this->redirect('/');
            return;
        }

        return $this->render('auth/register', [
            'errors' => $validation,
        ]);
    }

    public function register(Request $request)
    {
        $validation = [];
        return $this->render('auth/register', [
            'errors' => $validation,
        ]);
    }

}
