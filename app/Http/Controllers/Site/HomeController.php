<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Vereador;
use App\Noticia;
use App\RegistroPDF;
use App\Config;


class HomeController extends Controller
{
    public function index() {
        $config = Config::first();
        $slider = Noticia::where('status',1)
                         ->where('destaque_slider',1)
                         ->orderBy('data_noticia','desc')->take(5)->get();
        $ultima = Noticia::where('status',1)
                ->orderBy('data_noticia','desc')->take(1)->first();
                

        $vereadores = Vereador::orderBy('nome')->get();

        return view('site.home',
        [
            'config' => $config,
            'slider' => $slider,
            'vereadores' => $vereadores,
            'ultima' => $ultima
           
        ]);
    }
    
}
