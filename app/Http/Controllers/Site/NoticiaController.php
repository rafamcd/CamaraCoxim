<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Config;
use App\Noticia;
use App\NoticiaImg;

class NoticiaController extends Controller
{
    public function index() {
        
        $config = Config::first();
        $noticias = Noticia::where('status',1)->orderBy('data_noticia','desc')->paginate(10);
        
        return view('site.noticias',
        [
            'config' => $config,
            'noticias' =>$noticias
        ]);
    }
    public function ver($id) {
        
        $config = Config::first();
        $noticia = Noticia::find($id);
        $imagensNoticia = Noticia::join('noticia_imagens','noticia.id','=','noticia_imagens.id_noticia')                                    
                                    ->where('noticia.id',$id)
                                    ->orderBy('noticia.id','asc')
                                    ->get();
        $noticiascategoria = Noticia::where('status',1)->where('id','<>',$id)->where('id_noticia_categoria','=',$noticia->id_noticia_categoria)->orderBy('data_noticia','desc')->get();
        $created = Noticia::join('users','noticia.id_usuario_criou','=','users.id')
                        ->where('noticia.id',$id)->first();
        $editaded = Noticia::join('users','noticia.id_usuario_editou','=','users.id')
                        ->where('noticia.id',$id)->first();

        $usuario_criou = [];
        $usuario_editou = [];
        if($created)       
            $usuario_criou['nome'] = $created->name;
        if($editaded)       
            $usuario_editou['nome'] = $editaded->name;

        if($noticia) {
            return view('site.noticia',
                [
                    'config' => $config,
                    'noticia' =>$noticia,                    
                    'imagens' => $imagensNoticia,
                    'noticiascategoria' => $noticiascategoria,
                    'usuario_criou' => $usuario_criou,
                    'usuario_editou' => $usuario_editou
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
            $noticias = Noticia::where('status',1)->where('data_noticia', '>=', $data1)->where('data_noticia','<=',$data2)->orderBy('data_noticia', 'desc')->paginate(100000);
        else 
            $noticias = Noticia::where('status',1)->orderBy('data_noticia','desc')->paginate(10);
            return view('site.noticias', [
                
                'noticias' => $noticias,                
                'data1' => $data1,
                'data2' => $data2,
                'busca' => 1,
                'config' => $config
            ]);
    }
    
    public function buscar(Request $request) {
        $palavra = $request->input('palavra');
        $config = Config::first();
        if ($palavra) {
            $noticias = Noticia::where('status',1)->where('titulo','like','%'.$palavra.'%')->get();
            if($noticias) {
                return view('site.noticiasbusca', [
                    'noticias' => $noticias,                                    
                    'config' => $config
                ]);
            } 
        }
        return redirect()->route('site');
    }
    
}
