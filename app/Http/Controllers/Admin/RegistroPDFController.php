<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RegistroPDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RegistroPDFController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }

    public function index($categoria)
    {
        if ($categoria == 1) $descricao = 'Regimento Interno';
        else if ($categoria == 3) $descricao = 'Atas';
        else if ($categoria == 4) $descricao = 'Códigos';
        else if ($categoria == 5) $descricao = 'Comissões';
        else if ($categoria == 6) $descricao = 'Decretos';
        else if ($categoria == 7) $descricao = 'Emendas';
        else if ($categoria == 8) $descricao = 'Est. Func Público';
        else if ($categoria == 9) $descricao = 'Lei Orgânica';
        else if ($categoria == 10) $descricao = 'Leis Complementares';
        else if ($categoria == 11) $descricao = 'Leis Ordinárias';
        else if ($categoria == 12) $descricao = 'Plano Diretor';
        else if ($categoria == 13) $descricao = 'Resoluções';
        else if ($categoria == 14) $descricao = 'Atos';
        else $descricao = 'Não existe';

        $registrosPDF = RegistroPDF::where('categoria',$categoria)->orderBy('data_documento', 'desc')->paginate(10);
        
        return view('admin.registrospdf.index', [
            'registrosPDF' => $registrosPDF,
            'categoria' => $categoria,
            'descricao' => $descricao,
            'busca' => 0
        ]);
    }
    public function insere(Request $request, $categoria) {
        $data = $request->only([
            'titulo',
            'descricao',  
            'data_documento',          
            'arquivo'
        ]);
        
        $validator = Validator::make($data, [
            'titulo' => [ 'required', 'string' ],            
            'descricao' => [ 'required', 'string' ],            
            'arquivo' => 'required|mimes:pdf'
        ]);

        if ($validator->fails()) {
            return redirect()->route('registrospdf',['categoria'=>$categoria])
            ->withErrors($validator)
            ->withInput();
        }

        $titulo = $request->input('titulo');
        $descricao = $request->input('descricao');
        $data_documento = $request->input('data_documento');        
        $usuarioLogado =  intval(Auth::id()); 
        
        $arquivo = $request->file('arquivo'); 

        $p = new RegistroPDF;
        $p->categoria = $categoria;
        $p->titulo = $titulo;
        $p->descricao = $descricao;
        $p->data_documento = $data_documento;
        $p->data_insercao = date('Y-m-d');
        $p->usuario_insercao = $usuarioLogado;        
        
        
        //arquivo 
        $fileName = time().'.'.$arquivo->extension();
        $strCaminho = public_path('media/pdf').DIRECTORY_SEPARATOR . $categoria;
        
        if(!file_exists($strCaminho)) 
        {
            //criando diretório
            $objProjetoDiretorio = Storage::makeDirectory($strCaminho);
        }
        
        //movendo o arquivo criado
        $arquivo->move($strCaminho, $fileName);
        $p->arquivo = $fileName;

        $p->save(); 


        return redirect()->route('registrospdf',['categoria'=>$categoria]);

    }
    public function busca($categoria)
    {
        if ($categoria == 1) $descricao = 'Regimento Interno';
        else if ($categoria == 3) $descricao = 'Atas';
        else if ($categoria == 4) $descricao = 'Códigos';
        else if ($categoria == 5) $descricao = 'Comissões';
        else if ($categoria == 6) $descricao = 'Decretos';
        else if ($categoria == 7) $descricao = 'Emendas';
        else if ($categoria == 8) $descricao = 'Est. Func Público';
        else if ($categoria == 9) $descricao = 'Lei Orgânica';
        else if ($categoria == 10) $descricao = 'Leis Complementares';
        else if ($categoria == 11) $descricao = 'Leis Ordinárias';
        else if ($categoria == 12) $descricao = 'Plano Diretor';
        else if ($categoria == 13) $descricao = 'Resoluções';
        else if ($categoria == 14) $descricao = 'Atos';
        else $descricao = 'Não existe';

        $data1 = '';
        $data2 = '';
        $data1 = date($_GET['data1']);
        $data2 = date($_GET['data2']);
        
        if(!empty($data1) && !empty($data2))
            $registrosPDF = RegistroPDF::where('categoria',$categoria)->where('data_documento', '>=', $data1)->where('data_documento','<=',$data2)->orderBy('data_documento', 'desc')->paginate(10);
        else 
            $registrosPDF = RegistroPDF::where('categoria',$categoria)->orderBy('data_documento', 'desc')->paginate(10);
            return view('admin.registrospdf.index', [
                'registrosPDF' => $registrosPDF,
                'categoria' => $categoria,
                'descricao' => $descricao,
                'data1' => $data1,
                'data2' => $data2,
                'busca' => 1
            ]);
    }    
    public function del($categoria,$id) {
     
        $r = RegistroPDF::find($id);       
        
        if($r) {     
            //deletando o arquivo
            $strCaminhoPasta = public_path('media/pdf/'. $categoria);
            $strFile = $r->arquivo;
            $caminhoCompleto = $strCaminhoPasta."/".$strFile;  
            unlink($caminhoCompleto);    
            $r->delete();           
        }              

        return redirect()->route('registrospdf',['categoria'=>$categoria]);
    }    
}
