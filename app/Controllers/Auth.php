<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    public function login()
    {
        helper(['form', 'url']);
        
        $data = [
            'title' => 'Login',
            'error' => session()->getFlashdata('error'),
        ];

        return view('auth/login', $data); 
    }

    public function loginProcess()
    {
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('isLoggedIn', true);
            session()->set('user', $user);

            return redirect()->to(route_to('dashboard')); 
        } else {
            return redirect()->back()->with('error', 'Credenciais inválidas. Tente novamente.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('login')); // Usando a função route_to para redirecionar
    }

    public function register()
    {
        helper(['form', 'url']);
        return view('auth/register');
    }

    public function registerProcess()
    {
        $model = new UserModel();
    
        // Regras de validação
        $validationRules = [
            'email' => 'required|valid_email|is_unique[users.email]', // Verifica se o e-mail é único
            'password' => 'required|min_length[6]', // Senha mínima de 6 caracteres
            'confirm_password' => 'required|matches[password]', // Confirmação de senha
        ];
    
        // Verificação das regras de validação
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Por favor, corrija os erros abaixo.')
                ->with('validation', $this->validator); // Passa os erros de validação para a view
        }
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Criptografa a senha
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        // Insere o usuário no banco de dados
        $model->insert([
            'email' => $email,
            'password' => $hashedPassword,
        ]);
    
        // Redireciona para o login com sucesso
        return redirect()->to(route_to('login'))->with('success', 'Usuário registrado com sucesso!');
    }
    
}
