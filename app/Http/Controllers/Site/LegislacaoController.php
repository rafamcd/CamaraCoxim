<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Config;

class LegislacaoController extends Controller
{
    public function index() {
        
        $config = Config::first();

        return view('site.legislacao',
        [
            'config' => $config
        ]);
    }
    
}
