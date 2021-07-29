<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RegistroPDF;
use Illuminate\Support\Facades\Storage;
use App\Config;

class RegistroPDFController extends Controller
{
    public function index($categoria)
    {
        if ($categoria == 1) $descricao = 'REGIMENTO INTERNO';
        else if ($categoria == 3) $descricao = 'ATAS';
        else if ($categoria == 4) $descricao = 'CÓDIGOS';
        else if ($categoria == 5) $descricao = 'COMISSÕES';
        else if ($categoria == 6) $descricao = 'DECRETOS';
        else if ($categoria == 7) $descricao = 'EMENDAS';
        else if ($categoria == 8) $descricao = 'EST. FUNC. PÚBLICO';
        else if ($categoria == 9) $descricao = 'LEI ORGÂNICA';
        else if ($categoria == 10) $descricao = 'LEIS COMPLEMENTARES';
        else if ($categoria == 11) $descricao = 'LEIS ORDINÁRIAS';
        else if ($categoria == 12) $descricao = 'PLANO DIRETOR';
        else if ($categoria == 13) $descricao = 'RESOLUÇÕES';
        else if ($categoria == 14) $descricao = 'ATOS';
        else $descricao = 'NÃO EXISTE';

        $registrosPDF = RegistroPDF::where('categoria',$categoria)->orderBy('data_documento', 'desc')->paginate(10);
        $config = Config::first();
        
        return view('site.pdf', [
            'registrosPDF' => $registrosPDF,
            'categoria' => $categoria,
            'descricao' => $descricao,
            'busca' => 0,
            'config' => $config
        ]);
    }
    
    public function busca($categoria)
    {
        
        if ($categoria == 1) $descricao = 'REGIMENTO INTERNO';
        else if ($categoria == 3) $descricao = 'ATAS';
        else if ($categoria == 4) $descricao = 'CÓDIGOS';
        else if ($categoria == 5) $descricao = 'COMISSÕES';
        else if ($categoria == 6) $descricao = 'DECRETOS';
        else if ($categoria == 7) $descricao = 'EMENDAS';
        else if ($categoria == 8) $descricao = 'EST. FUNC. PÚBLICO';
        else if ($categoria == 9) $descricao = 'LEI ORGÂNICA';
        else if ($categoria == 10) $descricao = 'LEIS COMPLEMENTARES';
        else if ($categoria == 11) $descricao = 'LEIS ORDINÁRIAS';
        else if ($categoria == 12) $descricao = 'PLANO DIRETOR';
        else if ($categoria == 13) $descricao = 'RESOLUÇÕES';
        else if ($categoria == 14) $descricao = 'ATOS';
        else $descricao = 'NÃO EXISTE';

        $data1 = '';
        $data2 = '';
        $data1 = $_GET['data1'];
        $data2 = $_GET['data2'];
        
        $config = Config::first();
        
        if(!empty($data1) && !empty($data2))
            $registrosPDF = RegistroPDF::where('categoria',$categoria)->where('data_documento', '>=', $data1)->where('data_documento','<=',$data2)->orderBy('data_documento', 'desc')->paginate(100000);
        else 
            $registrosPDF = RegistroPDF::where('categoria',$categoria)->orderBy('data_documento', 'desc')->paginate(10);
            return view('site.pdf', [
                'registrosPDF' => $registrosPDF,
                'categoria' => $categoria,
                'descricao' => $descricao,
                'data1' => $data1,
                'data2' => $data2,
                'busca' => 1,
                'config' => $config
            ]);
    }        
}
