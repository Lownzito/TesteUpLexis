<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\logInRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //retorna a tela de login
    public function logIn()
    {
        if(Auth::check())
        {
            return redirect()->to('/')->with('error' , "Você já está logado");
        }
        return view('login');
    }

    //retorna a tela de cadastro
    public function registrationScreen()
    {
        if(Auth::check())
        {
            return redirect()->to('/')->with('error' , "Não é possível criar outra conta enquanto estiver logado");
        }
        return view('registration');
    }

    //efetua o login
    public function doLogin(logInRequest $request)
    {
        $request->validated();

        if(!Auth::attempt($request->only('email' , 'password')))
        {
            return redirect()->intended(route('login'))->with("error" , "Email ou senha incorretos");
        }
        else
        {
            return redirect()->intended(route('home'));
        }
    }
    //cria o usuário na db
    public function registerUser(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        if(!$user)
        {
            return redirect()->intended(route('login'))->with("error" , "Erro na criação de usuário, por favor tente novamente");
        }
        auth()->login($user);

        return redirect()->intended(route('home'));
    }

    public function doLogout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect(route('home'));
    }

}
