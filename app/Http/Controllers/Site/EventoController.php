<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Config;
use App\Evento;
use App\EventoImg;

class EventoController extends Controller
{
    public function index() {
        
        $config = Config::first();
        $eventos = Evento::orderBy('data','desc')->paginate(10);
        
        return view('site.eventos',
        [
            'config' => $config,
            'eventos' =>$eventos
        ]);
    }
    public function detalha($id) {
        
        $config = Config::first();
        $evento = Evento::find($id);
        $imagensEvento = Evento::join('evento_imgs','evento.id','=','evento_imgs.id_evento')                                    
                                    ->where('evento.id',$id)
                                    ->orderBy('data','desc')
                                    ->get();

        if($evento) {
            return view('site.evento',
                [
                    'config' => $config,
                    'evento' =>$evento,                    
                    'imagens' => $imagensEvento
                ]);
        }       
    }

    public function busca()
    { 
        
        $data1 = '';
        $data2 = '';
        $data1 = $_GET['data1'];
        $data2 = $_GET['data2'];
        
        $config = Config::first();
        
        if(!empty($data1) && !empty($data2))
            $eventos = Evento::where('data', '>=', $data1)->where('data','<=',$data2)->orderBy('data', 'desc')->paginate(100000);
        else 
            $eventos = Evento::orderBy('data','desc')->paginate(10);
            return view('site.eventos', [
                
                'eventos' => $eventos,                
                'data1' => $data1,
                'data2' => $data2,
                'busca' => 1,
                'config' => $config
            ]);
    }  
    
}
