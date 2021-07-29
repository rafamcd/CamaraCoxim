<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vereador;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class VereadorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }

    public function index()
    {
        $vereadores = Vereador::orderBy('nome', 'asc')->paginate(10);
        
        return view('admin.vereadores.index', [
            'vereadores' => $vereadores
        ]);
    }
    public function add() {
        return view('admin.vereadores.add');
    }
    public function addAction(Request $request) {
        
        $data = $request->only([
            'nome',
            'data_nascimento',            
            'imagem'
        ]);
        
        $validator = Validator::make($data, [
            'nome' => [ 'required', 'string' ],
            'data_nascimento' => [ 'required','date' ],
            'imagem' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('vereadores.add')
            ->withErrors($validator)
            ->withInput();
        }
        
        $nome = $request->input('nome');
        $data_nascimento = $request->input('data_nascimento');
        $partido = $request->input('partido');
        $qtd_votos = $request->input('qtd_votos');
        $texto = $request->input('texto');
        $imagem = $request->file('imagem');
        
       

        $v = new Vereador;
        $v->nome = $nome;
        $v->data_nascimento = $data_nascimento;
        $v->partido = $partido;
        $v->qtd_votos = $qtd_votos;
        $v->texto = $texto;
        
        //imagem 
        $imageName = time().'.'.$imagem->extension();

        $v->save(); //preciso do id pra criar a pasta

        //salvando as imagens
        $strCaminho = public_path('media/images/vereadores').DIRECTORY_SEPARATOR . $v->id;
        if(!file_exists($strCaminho)) 
        {
            //criando diretório
            $objProjetoDiretorio = Storage::makeDirectory($strCaminho);
        }
        //movendo a imagem criada
        $imagem->move(public_path('media/images/vereadores/'.$v->id), $imageName);
        $v->imagem = $imageName;
        $v->save();

        return redirect()->route('vereadores');
    }
    public function edit($id) {
        
        $v = Vereador::find($id);

        if($v)  {
            return view('admin.vereadores.edit',[
                'vereador' => $v
            ]);
        } else {
            return redirect()->route('vereadores');
        }        
    }
    public function editAction(Request $request, $id) {
        
        $v = Vereador::find($id);

            if($v) {
                $data = $request->only([
                    'nome',
                    'data_nascimento',            
                    'imagem'
                ]);
                
                $validator = Validator::make($data, [
                    'nome' => [ 'required', 'string' ],
                    'data_nascimento' => [ 'required','date' ]                    
                ]);
                
                if ($validator->fails()) {
                    return redirect()->route('vereadores.edit')
                    ->withErrors($validator)
                    ->withInput();
                }
                
                $nome = $request->input('nome');
                $data_nascimento = $request->input('data_nascimento');
                $partido = $request->input('partido');
                $qtd_votos = $request->input('qtd_votos');
                $texto = $request->input('texto');
                $imagem = $request->file('imagem');
            
                $v->nome = $nome;
                $v->data_nascimento = $data_nascimento;
                $v->partido = $partido;
                $v->qtd_votos = $qtd_votos;
                $v->texto = $texto;
                
                if(!empty($imagem)) {
                    //apagando imagem anterior
                    $strCaminhoPasta = public_path('media/images/vereadores/'. $id);
                    $strImg = $v->imagem;
                    $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
                    unlink($caminhoCompleto);    

                    //imagem enviada
                    $imageName = time().'.'.$imagem->extension();    
            
                    //salvando as imagens
                    $strCaminho = public_path('media/images/vereadores').DIRECTORY_SEPARATOR . $v->id;
                    if(!file_exists($strCaminho)) 
                    {
                        //criando diretório
                        $objProjetoDiretorio = Storage::makeDirectory($strCaminho);
                    }
                    //movendo a imagem criada
                    $imagem->move(public_path('media/images/vereadores/'.$v->id), $imageName);
                    $v->imagem = $imageName;
                }
                
                $v->save();
          }        

        return redirect()->route('vereadores');
              
    }
    public function del($id) {
     
        $v = Vereador::find($id);

        if($v) {
            //deletando a pasta que contem essa imagem
            $strCaminhoPasta = public_path('media/images/vereadores/'. $id);
            $strImg = $v->imagem;
            $caminhoCompleto = $strCaminhoPasta."/".$strImg;  
            unlink($caminhoCompleto);    
            rmdir($strCaminhoPasta);     
        }

        $v->delete();       

        return redirect()->route('vereadores');
    }
}
