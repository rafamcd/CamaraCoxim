<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Config;
use App\Vereador;
use App\Noticia;
use App\NoticiaVereador;

class VereadorController extends Controller
{
    public function index() {
        
        $config = Config::first();
        $vereadores = Vereador::orderBy('nome')->get();

        return view('site.vereadores',
        [
            'config' => $config,
            'vereadores' =>$vereadores
        ]);
    }
    public function detalha($id) {
        
        $config = Config::first();
        $vereador = Vereador::find($id);
        
        $q = NoticiaVereador::selectRaw('id_vereador, count(noticia_vereador.id) as c')
                                    ->join('noticia','noticia_vereador.id_noticia','=','noticia.id')                                    
                                    ->where('noticia.status', '=', 1)
                                    ->where('noticia_vereador.id_vereador','=',$id)
                                    ->groupBy('id_vereador')->first();

        $qtdnoticiasvereador = 0;
        $noticiasVereador =array();
        if($q) {
            $qtdnoticiasvereador = $q['c'];

            $noticiasVereador = Noticia::join('noticia_vereador','noticia.id','=','noticia_vereador.id_noticia')
                                        ->where('noticia.status',1)
                                        ->where('noticia_vereador.id_vereador',$id)
                                        ->orderBy('data_noticia','desc')
                                        ->take(10)
                                        ->get();
        }
        

        if($vereador) {
            return view('site.vereador',
                [
                    'config' => $config,
                    'vereador' =>$vereador,
                    'qtdnoticiasvereador' => $qtdnoticiasvereador,
                    'noticiasvereador' => $noticiasVereador
                ]);
        }

        
    }
    
}
