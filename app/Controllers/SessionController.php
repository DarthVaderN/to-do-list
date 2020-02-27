<?php
namespace Controllers;

class SessionController extends Controller
{
    public function create($arguments, $data) {

        $validationErrors = [];

        $adminCredentials = $this->config['admin-panel'];

        if ($data['login'] !== $adminCredentials['login'] || $data['password'] !== $adminCredentials['password']) {

            $validationErrors[] = 'Login or password incorrect';
        }

        if (count($validationErrors)) {

            return $this->redirectWithErrors('/login', $validationErrors);
        }

        \Session::authorize();

        return $this->redirectWithMessage('/', 'Successfully');
    }

    public function destroy() {

        \Session::destroy();

        return $this->redirect('/');
    }
}
