<?php
namespace Controllers;

class LoginController extends Controller
{
    public function show() {

        return $this->view('login/user-login');
    }
}
