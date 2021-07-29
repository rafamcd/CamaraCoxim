<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Noticia;
use App\Noticiacat;
use App\NoticiaImg;
use App\NoticiaVereador;
use App\Vereador;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }

    public function index()
    {
        $noticias = Noticia::orderBy('data_noticia', 'desc')->paginate(10);        
        
        return view('admin.noticias.index', [
            'noticias' => $noticias
        ]);
    }
    public function busca()
    {
        $data1 = '';
        $data2 = '';
        $data1 = date($_GET['data1']);
        $data2 = date($_GET['data2']);
        
        if(!empty($data1) && !empty($data2))
            $noticias = Noticia::where('data_noticia', '>=', $data1)->where('data_noticia','<=',$data2)->orderBy('data_noticia', 'desc')->paginate(100000);
        else 
            $noticias = Noticia::orderBy('data_noticia', 'desc')->paginate(10);
        return view('admin.noticias.index', [
            'noticias' => $noticias,
            'data1' => $data1,
            'data2' => $data2
        ]);
    }
    public function add() {
        $categorias = Noticiacat::orderBy('descricao','asc')->get();
        $vereadores = Vereador::orderBy('nome','asc')->get();
        return view('admin.noticias.add',[
            'categorias' => $categorias,
            'vereadores' => $vereadores
        ]);
    }
    public function addAction(Request $request) {
        
        $data = $request->only([
            'titulo',
            'subtitulo',  
            'data_noticia',          
            'capa',
            'creditos_capa',
            'posicao_capa',
            'texto',
            'id_noticia_categoria',
            'destaque_slider'
        ]);
        
        $validator = Validator::make($data, [
            'titulo' => [ 'required', 'string','max:300' ],
            'subtitulo' => [ 'required', 'string','max:400' ],            
            'data_noticia' => [ 'required','date' ],
            'posicao_capa' => [ 'required' ],
            'texto' => [ 'required', 'string' ],            
            'id_noticia_categoria' => [ 'required' ],            
            'destaque_slider' => [ 'required' ],            
            'capa' => 'required|image|mimes:jpeg,jpg,png'
            
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('noticias.add')
            ->withErrors($validator)
            ->withInput();
        }
        
        $titulo = $request->input('titulo');
        $subtitulo = $request->input('subtitulo');
        $data_noticia = $request->input('data_noticia');
        $creditos_capa = $request->input('creditos_capa');
        $posicao_capa = $request->input('posicao_capa');
        $texto = $request->input('texto');
        $id_noticia_categoria = $request->input('id_noticia_categoria');
        $id_usuario_criou = intval(Auth::id());   
        $data_usuario_criou = date('Y-m-d H:i:s');
        $destaque_slider = $request->input('destaque_slider');
        $status = 0; //inativo inicialmente, o usuário publica só quando ele quiser
        
        $n = new Noticia;
        $n->titulo = $titulo;
        $n->subtitulo = $subtitulo;
        $n->data_noticia = $data_noticia;
        $n->creditos_capa = $creditos_capa;
        $n->posicao_capa = $posicao_capa;
        $n->texto = $texto;
        $n->id_noticia_categoria = $id_noticia_categoria;
        $n->id_usuario_criou = $id_usuario_criou;   
        $n->data_usuario_criou = $data_usuario_criou;
        $n->destaque_slider = $destaque_slider;
        $n->status = $status; //ativo
       
        $n->save(); //preciso do id pra criar a pasta

        //redimensiona imagem
        $largura = 800;
        $altura = 600;
        
        //pegar a largura e altura da imagem original
        list($largura_original, $altura_original) = getimagesize($_FILES['capa']['tmp_name']);
        //calculo padrão para imagem ficar proporcional
        $ratio = $largura_original / $altura_original;
        if($largura / $altura > $ratio){
            $largura = $altura * $ratio;
        } else {
            $altura = $largura / $ratio;
        }        
        
        //pegando uma largura e altura pra exibir dentro de uma notícia (proporcionalidade: metade)
        $capa_largura = 0;
        $capa_altura = 0;
        $capa_largura = $largura;
        $capa_altura = $altura;
        
        //criando a nova imagem
        $imagem_final = imagecreatetruecolor($largura, $altura);
        
        if (in_array($_FILES['capa']['type'], array('image/jpeg','image/jpg','image/png'))) {
                if (in_array($_FILES['capa']['type'], array('image/jpeg','image/jpg'))) {
                    $ext = '.jpg';
                    $imagem_original = imagecreatefromjpeg($_FILES['capa']['tmp_name']);
                }
                if ($_FILES['capa']['type'] == 'image/png') {                                    
                    $ext = '.png';
                    $imagem_original = imagecreatefrompng($_FILES['capa']['tmp_name']);
                }
        }
        imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);
        //para visualizar no navegador
        //header("Content-Type: image/png");
        $nomenovaimagem = '';
        $nomenovaimagem = md5(time().rand(0,9999)).$ext;   
        
        $strCaminho = public_path('media/images/noticias').DIRECTORY_SEPARATOR . $n->id;
        
        if(!file_exists($strCaminho)) 
        { 
            mkdir ($strCaminho, 0700,true); 
            //criando diretório
            //$objProjetoDiretorio = Storage::makeDirectory($strCaminho);
            
        }       
       
        
        $strCaminhoPasta = public_path('media/images/noticias/'. $n->id);
        $strImg = $nomenovaimagem;
        $endereco = $strCaminhoPasta."/".$strImg;                                                      
        
        if(imagejpeg($imagem_final, $endereco, 100) === true){
            //echo "Imagem salva em ". $endereco; exit;
            imagedestroy($imagem_original);
            imagedestroy($imagem_final);
            $endereco = $strCaminhoPasta.'/G'.$nomenovaimagem;
            
            //move(public_path('media/images/noticias/'.$n->id), $strImg);
            //move_uploaded_file($_FILES['arquivo']['tmp_name'], $endereco);            
            //unlink($endereco);            
            
            $n->capa = $nomenovaimagem;            
            $n->capa_largura = $capa_largura;
            $n->capa_altura = $capa_altura;
            $n->save();  
            
            //pegando os vereadores selecionados
            for ($q=1; $q <= 50; $q++) {
                $check = '';
                $check = 'check'.$q;                    
                if (isset($_POST[$check])) {
                    $nv = new NoticiaVereador;
                    $nv->id_noticia = $n->id;
                    $nv->id_vereador = $q;
                    $nv->save();
                }
            }
            
        } else {
            //echo "Erro ao salvar a imagem em ". $endereco; exit;
        }          

        return redirect()->route('noticias');
    }
    public function edit($id) {
        
        $noticia = Noticia::find($id);
        $categorias = Noticiacat::orderBy('descricao','asc')->get();
        $vereadores = Vereador::orderBy('nome','asc')->get();
        $noticia_vereador = NoticiaVereador::where('id_noticia',$id)->get();        

        if($noticia) {
            return view('admin.noticias.edit',[
                'noticia' => $noticia,
                'categorias' => $categorias,
                'vereadores' => $vereadores,
                'noticia_vereador' => $noticia_vereador
            ]);
        }      
    }
    public function editAction(Request $request, $id) {
        
        $n = Noticia::find($id);

        $data = $request->only([
            'titulo',
            'subtitulo',  
            'data_noticia',          
            'capa',
            'creditos_capa',
            'posicao_capa',
            'texto',
            'id_noticia_categoria',
            'destaque_slider'
        ]);
        
        $validator = Validator::make($data, [
            'titulo' => [ 'required', 'string','max:300' ],
            'subtitulo' => [ 'required', 'string','max:400' ],            
            'data_noticia' => [ 'required','date' ],
            'posicao_capa' => [ 'required' ],
            'texto' => [ 'required', 'string' ],            
            'id_noticia_categoria' => [ 'required' ],            
            'destaque_slider' => [ 'required' ],            
            'capa' => 'image|mimes:jpeg,jpg,png'
            
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('noticias.edit',['id'=>$id])
            ->withErrors($validator)
            ->withInput();
        }
        

        $titulo = $request->input('titulo');
        $subtitulo = $request->input('subtitulo');
        $data_noticia = $request->input('data_noticia');
        $creditos_capa = $request->input('creditos_capa');
        $posicao_capa = $request->input('posicao_capa');
        $texto = $request->input('texto');
        $id_noticia_categoria = $request->input('id_noticia_categoria');
        $id_usuario_editou = intval(Auth::id());   
        $data_usuario_editou = date('Y-m-d H:i:s');
        $destaque_slider = $request->input('destaque_slider');        
        
        
        $n->titulo = $titulo;
        $n->subtitulo = $subtitulo;
        $n->data_noticia = $data_noticia;
        $n->creditos_capa = $creditos_capa;
        $n->posicao_capa = $posicao_capa;
        $n->texto = $texto;
        $n->id_noticia_categoria = $id_noticia_categoria;
        $n->id_usuario_editou = $id_usuario_editou;   
        $n->data_usuario_editou = $data_usuario_editou;
        $n->destaque_slider = $destaque_slider;
        
       
        $n->save(); 

        if (!empty($_FILES['capa']['tmp_name'])) {
            //redimensiona imagem
            $largura = 800;
            $altura = 600;
            
            //pegar a largura e altura da imagem original
            list($largura_original, $altura_original) = getimagesize($_FILES['capa']['tmp_name']);
            //calculo padrão para imagem ficar proporcional
            $ratio = $largura_original / $altura_original;
            if($largura / $altura > $ratio){
                $largura = $altura * $ratio;
            } else {
                $altura = $largura / $ratio;
            }             
            
             //pegando uma largura e altura pra exibir dentro de uma notícia (proporcionalidade: metade)
            $capa_largura = 0;
            $capa_altura = 0;
            $capa_largura = $largura;
            $capa_altura = $altura;
            
            //criando a nova imagem
            $imagem_final = imagecreatetruecolor($largura, $altura);
            
            if (in_array($_FILES['capa']['type'], array('image/jpeg','image/jpg','image/png'))) {
                    if (in_array($_FILES['capa']['type'], array('image/jpeg','image/jpg'))) {
                        $ext = '.jpg';
                        $imagem_original = imagecreatefromjpeg($_FILES['capa']['tmp_name']);
                    }
                    if ($_FILES['capa']['type'] == 'image/png') {                                    
                        $ext = '.png';
                        $imagem_original = imagecreatefrompng($_FILES['capa']['tmp_name']);
                    }
            }
            imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $largura, $altura, $largura_original, $altura_original);
            //para visualizar no navegador
            //header("Content-Type: image/png");
            $nomenovaimagem = '';
            $nomenovaimagem = md5(time().rand(0,9999)).$ext;   
            
            $strCaminho = public_path('media/images/noticias').DIRECTORY_SEPARATOR . $n->id;
            
            if(!file_exists($strCaminho)) 
            { 
                mkdir ($strCaminho, 0700,true); 
                //criando diretório
                //$objProjetoDiretorio = Storage::makeDirectory($strCaminho);
                
            }             
            
            $strCaminhoPasta = public_path('media/images/noticias/'. $n->id);
            $strImg = $nomenovaimagem;
            $endereco = $strCaminhoPasta."/".$strImg; 

            if(imagejpeg($imagem_final, $endereco, 100) === true){
                //echo "Imagem salva em ". $endereco; exit;
                imagedestroy($imagem_original);
                imagedestroy($imagem_final);
                $endereco = $strCaminhoPasta.'/G'.$nomenovaimagem;
                
                //move(public_path('media/images/noticias/'.$n->id), $strImg);
                //move_uploaded_file($_FILES['arquivo']['tmp_name'], $endereco);            
                //unlink($endereco); 

                //apagando imagem anterior
                $strCaminhoPasta2 = public_path('media/images/noticias/'. $id);
                $strImg2 = $n->capa;
                $caminhoCompleto2 = $strCaminhoPasta2."/".$strImg2;  
                unlink($caminhoCompleto2);               
                
                $n->capa = $nomenovaimagem;
                $n->capa_largura = $capa_largura;
                $n->capa_altura = $capa_altura;                
                $n->save();  
                
                //pegando os vereadores selecionados
                
                
            } else {
                //echo "Erro ao salvar a imagem em ". $endereco; exit;
            }  
        }
        //apagando os checkboxs marcados
        $nv = NoticiaVereador::where('id_noticia',$n->id);
        $nv->delete();        
        //marcando novamente
        for ($q=1; $q <= 50; $q++) {
            $check = '';
            $check = 'check'.$q;                    
            if (isset($_POST[$check])) {
                $nv = new NoticiaVereador;
                $nv->id_noticia = $n->id;
                $nv->id_vereador = $q;
                $nv->save();
            }
        }

        return redirect()->route('noticias');
              
    }
    public function del($id) {
     
        $n = Noticia::find($id);        
        $nImg = NoticiaImg::where('id_noticia', '=', $id)->get();  
        $nVereador = NoticiaVereador::where('id_noticia', '=', $id)->get();  
        
        if($n) {
            
            //deletando as imagens da notícia e depois a pasta inteira
            foreach($nImg as $img) {            
                $strCaminhoPasta = public_path('media/images/noticias/'. $id);
                $strImg = $img->imagem;
                $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
                unlink($caminhoCompleto);    
            }
            //deletando a capa
            $strCaminhoPasta = public_path('media/images/noticias/'. $id);
            $strImg = $n->capa;
            $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
            unlink($caminhoCompleto);    
            rmdir($strCaminhoPasta);  
            $nImg = NoticiaImg::where('id_noticia', '=', $id)->delete();    
            $nVereador = NoticiaVereador::where('id_noticia', '=', $id)->delete();    
            $n->delete();   
        }              

        return redirect()->route('noticias');
    }
    public function noticiasimg($id) {
        $n = Noticia::find($id);        
        $nImg = NoticiaImg::where('id_noticia', '=', $id)->paginate(12);          
        
        return view('admin.noticias.imgindex', [
            'noticia' => $n,
            'imagens' => $nImg
        ]);
    }
    public function noticiasimgadd(Request $request, $id) {
        
        
        $n = Noticia::find($id);        
        $nImg = NoticiaImg::where('id_noticia', '=', $id)->paginate(12);   
          

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
                        $strCaminhoPasta = public_path('media/images/noticias/'. $id);
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
                            
                            $n = new NoticiaImg;
                            $n->id_noticia = $id;
                            $n->imagem = $nomenovaimagem;
                            $n->save();
                            
                        } else {
                            //echo "Erro ao salvar a imagem em ". $endereco; exit;
                        }                           
                    }		                    
                }
        }
        
        return redirect()->route('noticias.noticiasimg', ['id'=>$id]);
        
    }
    public function noticiasimgdel($id) {
        $n = NoticiaImg::find($id); 
        $id_noticia = $n->id_noticia;
        if ($n) {
            //deletando a imagem escolhida
            $strCaminhoPasta = public_path('media/images/noticias/'. $n->id_noticia);
            $strImg = $n->imagem;
            $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
            unlink($caminhoCompleto); 
            $n->delete();         
        }
        return redirect()->route('noticias.noticiasimg', [
            'id' => $id_noticia
        ]);
    }
    public function mudapublicar($id) {
        $n = Noticia::find($id);
        if($n) {
            $n->status = 1 - $n->status; //trocando de 0 pra 1 ou de 1 pra zero
        }
        $n->save();
        return redirect()->route('noticias');
    }
    public function mudaslider($id) {
        $n = Noticia::find($id);
        if($n) {
            $n->destaque_slider = 1 - $n->destaque_slider; //trocando de 0 pra 1 ou de 1 pra zero
        }
        $n->save();
        return redirect()->route('noticias');        
    }
}
