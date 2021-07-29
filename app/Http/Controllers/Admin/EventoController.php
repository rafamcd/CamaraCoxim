<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Evento;
use App\EventoImg;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }

    public function index()
    {
        $eventos = Evento::orderBy('data', 'desc')->paginate(10);
        
        return view('admin.eventos.index', [
            'eventos' => $eventos
        ]);
    }
    public function busca()
    {
        $data1 = '';
        $data2 = '';
        $data1 = date($_GET['data1']);
        $data2 = date($_GET['data2']);
        
        if(!empty($data1) && !empty($data2))
            $eventos = Evento::where('data', '>=', $data1)->where('data','<=',$data2)->paginate(10);
        else 
            $eventos = Evento::orderBy('data', 'desc')->paginate(10);
        return view('admin.eventos.index', [
            'eventos' => $eventos,
            'data1' => $data1,
            'data2' => $data2
        ]);
    }
    public function add() {
        return view('admin.eventos.add');
    }
    public function addAction(Request $request) {
        
        $data = $request->only([
            'nome',
            'data',  
            'local',          
            'capa',
            'descricao'
        ]);
        
        $validator = Validator::make($data, [
            'nome' => [ 'required', 'string' ],
            'local' => [ 'required', 'string' ],
            'descricao' => [ 'required', 'string' ],
            'data' => [ 'required','date' ],
            'capa' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('eventos.add')
            ->withErrors($validator)
            ->withInput();
        }
        
        $nome = $request->input('nome');
        $data = $request->input('data');
        $local = $request->input('local');
        $descricao = $request->input('descricao');
        $usuarioLogado =  intval(Auth::id());        
        
        $imagem = $request->file('capa');      
       
        $e = new Evento;
        $e->nome = $nome;
        $e->data = $data;
        $e->local = $local;
        $e->descricao = $descricao;
        $e->id_usuario_insercao = $usuarioLogado;
        
        //imagem 
        $imageName = time().'.'.$imagem->extension();

        $e->save(); //preciso do id pra criar a pasta

        //salvando as imagens
        $strCaminho = public_path('media/images/eventos').DIRECTORY_SEPARATOR . $e->id;
        if(!file_exists($strCaminho)) 
        {
            //criando diretório
            $objProjetoDiretorio = Storage::makeDirectory($strCaminho);
        }
        //movendo a imagem criada
        $imagem->move(public_path('media/images/eventos/'.$e->id), $imageName);
        $e->capa = $imageName;
        $e->save();

        return redirect()->route('eventos');
    }
    public function edit($id) {
        
        $e = Evento::find($id);

        if($e)  {
            return view('admin.eventos.edit',[
                'evento' => $e
            ]);
        } else {
            return redirect()->route('eventos');
        }        
    }
    public function editAction(Request $request, $id) {
        
        $e = Evento::find($id);

            if($e) {
                $data = $request->only([
                    'nome',
                    'data',  
                    'local',                              
                    'descricao'
                ]);
                
                $validator = Validator::make($data, [
                    'nome' => [ 'required', 'string' ],
                    'local' => [ 'required', 'string' ],
                    'descricao' => [ 'required', 'string' ],
                    'data' => [ 'required','date' ]                    
                ]);
                
                if ($validator->fails()) {
                    return redirect()->route('eventos.edit')
                    ->withErrors($validator)
                    ->withInput();
                }
                
                $nome = $request->input('nome');
                $data = $request->input('data');
                $local = $request->input('local');
                $descricao = $request->input('descricao');
                $usuarioLogado =  intval(Auth::id());  
                $imagem = $request->file('capa');     
            
                $e->nome = $nome;
                $e->data = $data;
                $e->local = $local;
                $e->descricao = $descricao;
                $e->id_usuario_insercao = $usuarioLogado;
                
                if(!empty($imagem)) {
                    //apagando imagem anterior
                    $strCaminhoPasta = public_path('media/images/eventos/'. $id);
                    $strImg = $e->capa;
                    $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
                    unlink($caminhoCompleto);    

                    //imagem enviada
                    $imageName = time().'.'.$imagem->extension();    
            
                    //salvando as imagens
                    $strCaminho = public_path('media/images/eventos').DIRECTORY_SEPARATOR . $e->id;
                    if(!file_exists($strCaminho)) 
                    {
                        //criando diretório
                        $objProjetoDiretorio = Storage::makeDirectory($strCaminho);
                    }
                    //movendo a imagem criada
                    $imagem->move(public_path('media/images/eventos/'.$e->id), $imageName);
                    $e->capa = $imageName;
                }
                
                $e->save();
          }        

        return redirect()->route('eventos');
              
    }
    public function del($id) {
     
        $e = Evento::find($id);        
        $eImg = EventoImg::where('id_evento', '=', $id)->get();  
        
        if($e) {
            
            //deletando as imagens do evento e depois a pasta inteira
            foreach($eImg as $img) {            
                $strCaminhoPasta = public_path('media/images/eventos/'. $id);
                $strImg = $img->imagem;
                $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
                unlink($caminhoCompleto);    
            }
            //deletando a capa
            $strCaminhoPasta = public_path('media/images/eventos/'. $id);
            $strImg = $e->capa;
            $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
            unlink($caminhoCompleto);    
            rmdir($strCaminhoPasta);  
            $eImg = EventoImg::where('id_evento', '=', $id)->delete();    
            $e->delete();   
        }              

        return redirect()->route('eventos');
    }
    public function eventosimg($id) {
        $e = Evento::find($id);        
        $eImg = EventoImg::where('id_evento', '=', $id)->paginate(12);          
        
        return view('admin.eventos.imgindex', [
            'evento' => $e,
            'imagens' => $eImg
        ]);
    }
    public function eventosimgadd(Request $request, $id) {
        
        
        $e = Evento::find($id);        
        $eImg = EventoImg::where('id_evento', '=', $id)->paginate(12);   
          

        if (isset($_FILES['arquivo']) && !empty($_FILES['arquivo'])){
            
            if (count($_FILES['arquivo']['tmp_name']) > 0 && !empty($_FILES['arquivo']['tmp_name'][0])){
                    
                    for ($q=0; $q < count($_FILES['arquivo']['tmp_name']); $q++){
                            
                        //redimensiona imagem
                        $largura = 800;
                        $altura = 600;
                        
                        //pegar a largura e altura da imagem original
                        list($largura_original, $altura_original) = getimagesize($_FILES['arquivo']['tmp_name'][$q]);
                        //calculo padrão para imagem ficar proporcional
                        $ratio = $largura_original / $altura_original;
                        if($largura / $altura > $ratio){
                            $largura = $altura * $ratio;
                        } else {
                            $altura = $largura / $ratio;
                        }                        
                        
                        //criando a nova imagem
                        $imagem_final = imagecreatetruecolor($largura, $altura);
                        
                        if (in_array($_FILES['arquivo']['type'][$q], array('image/jpeg','image/jpg','image/png'))) {
                                if (in_array($_FILES['arquivo']['type'][$q], array('image/jpeg','image/jpg'))) {
                                    $ext = '.jpg';
                                    $imagem_original = imagecreatefromjpeg($_FILES['arquivo']['tmp_name'][$q]);
                                }
                                if ($_FILES['arquivo']['type'][$q] == 'image/png') {                                    
                                    $ext = '.png';
                                    $imagem_original = imagecreatefrompng($_FILES['arquivo']['tmp_name'][$q]);
                                }
                        }
                        imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);
                        //para visualizar no navegador
                        //header("Content-Type: image/png");
                        $nomenovaimagem = '';
                        $nomenovaimagem = md5(time().rand(0,9999)).$ext;    
                        $strCaminhoPasta = public_path('media/images/eventos/'. $id);
                        $strImg = $nomenovaimagem;
                        $endereco = $strCaminhoPasta."/".$strImg;                                                      
                        
                        if(imagejpeg($imagem_final, $endereco, 100) === true){
                            //echo "Imagem salva em ". $endereco; exit;
                            imagedestroy($imagem_original);
                            imagedestroy($imagem_final);
                            $endereco = $strCaminhoPasta.'/G'.$nomenovaimagem;
                            
                            //$imagem->move(public_path('media/images/eventos/'.$e->id), $imageName);
                            move_uploaded_file($_FILES['arquivo']['tmp_name'][$q], $endereco);
                            unlink($endereco);
                            
                            $e = new EventoImg;
                            $e->id_evento = $id;
                            $e->imagem = $nomenovaimagem;
                            $e->save();
                            
                        } else {
                            //echo "Erro ao salvar a imagem em ". $endereco; exit;
                        }                           
                    }		                    
                }
        }
        
        return redirect()->route('eventos.eventosimg', ['id'=>$id]);
        
    }
    public function eventosimgdel($id) {
        $e = EventoImg::find($id); 
        $id_evento = $e->id_evento;
        if ($e) {
            //deletando a imagem escolhida
            $strCaminhoPasta = public_path('media/images/eventos/'. $e->id_evento);
            $strImg = $e->imagem;
            $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
            unlink($caminhoCompleto); 
            $e->delete();         
        }
        return redirect()->route('eventos.eventosimg', [
            'id' => $id_evento
        ]);
    }
}
