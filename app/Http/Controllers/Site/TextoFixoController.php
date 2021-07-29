<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TextoFixo;
use App\Config;

class TextoFixoController extends Controller
{
    public function index($tf) {
        
        $tf = TextoFixo::where('chave',$tf)->first();
        $config = Config::first();

        return view('site.textofixo',
        [
            'tf' => $tf,
            'config' => $config
        ]);
    }
    
}
