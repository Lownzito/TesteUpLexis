<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carro;

class AdminController extends Controller
{
    public function adminPage()
    {
        if(Auth::user()->isAdmin)
        {
            $cars = Carro::all();
            return view('adminPanel', ['cars' => $cars]);
        }
        else
        {
            return redirect()->to('/')->with('error', 'Você não tem acesso a esta página');
        }
    }

    public function deleteFromDB(Request $request)
    {
        if(Auth::user()->isAdmin)
        {   
            Carro::where(['id' => $request->input('car_id')])->delete();

            return redirect()->to('/admin')->with('success', 'Carro removido com sucesso');
        }
        else
        {
            return redirect()->to('/')->with('error', 'Você não tem acesso a esta função');
        }
    }
}
