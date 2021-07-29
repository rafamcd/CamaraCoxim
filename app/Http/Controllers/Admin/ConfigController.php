<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Config;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }
    public function index()
    {
        $config = Config::where('id','>','0')->first();

        if($config) {
            return view('admin.config.edit', [
                'config' => $config
            ]);
        } 

        return redirect()->route('config');
    }
    public function edit($id)
    {
        
        
    }
    public function salvar(Request $request) {
        
        $data = $request->only([
            'id',
            'site_title',
            'portal_transparencia',
            'e_sic',
            'horario_atendimento',
            'endereco_rua',
            'endereco_bairro',
            'endereco_cep',
            'endereco_cidade',
            'endereco_estado',
            'telefone'            
        ]);
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('config')
            ->withErrors($validator);
        }
        Config::where('id', $data['id'])->update([
            'site_title' => $data['site_title'],
            'portal_transparencia' => $data['portal_transparencia'],
            'e_sic' => $data['e_sic'],
            'horario_atendimento' => $data['horario_atendimento'],
            'endereco_rua' => $data['endereco_rua'],
            'endereco_bairro' => $data['endereco_bairro'],
            'endereco_cep' => $data['endereco_cep'],
            'endereco_cidade' => $data['endereco_cidade'],
            'endereco_estado' => $data['endereco_estado'],
            'telefone' => $data['telefone']
        ]);       

        if (!empty($_FILES['banner']['tmp_name'])) {
            $banner = $_FILES['banner'];           
            
            if (in_array($banner['type'], array('image/jpeg','image/jpg','image/png'))) {
                if (in_array($banner['type'], array('image/jpeg','image/jpg'))) {
                        $ext = '.jpg'; 
                    }
                    if ($banner['type'] == 'image/png') {
                        $ext = '.png';
                    }
                    $md5imagem = md5(time().rand(0,9999)).$ext;  
                    $strCaminhoPasta = public_path('media/images/config/');
                    $strImg = $md5imagem;
                    $endereco = $strCaminhoPasta."/".$strImg;                 
                    
                    move_uploaded_file($banner['tmp_name'], $endereco);                                        
                    Config::where('id', $data['id'])->update([
                        
                        'banner' => $strImg
                    ]);                   
                }
        }
        if (!empty($_FILES['logo']['tmp_name'])) {
            $logo = $_FILES['logo'];           
            
            if (in_array($logo['type'], array('image/jpeg','image/jpg','image/png'))) {
                if (in_array($logo['type'], array('image/jpeg','image/jpg'))) {
                        $ext = '.jpg'; 
                    }
                    if ($logo['type'] == 'image/png') {
                        $ext = '.png';
                    }
                    $md5imagem = md5(time().rand(0,9999)).$ext;  
                    $strCaminhoPasta = public_path('media/images/config/');
                    $strImg = $md5imagem;
                    $endereco = $strCaminhoPasta."/".$strImg;                 
                    
                    move_uploaded_file($logo['tmp_name'], $endereco);                                        
                    Config::where('id', $data['id'])->update([
                        
                        'logo' => $strImg
                    ]);                   
                }
        }        

        return redirect()->route('config')
        ->with('aviso', '  Informações salvas com sucesso.');
        
              
    }
    protected function validator($data) {
        return Validator::make($data, [
            'site_title' => ['required','string','max:100'],
            'portal_transparencia' => ['string','max:100'],
            'e_sic' => ['string','max:100'],
            'horario_atendimento' => ['required','string','max:100'],
            'endereco_rua' => ['required','string','max:100'],
            'endereco_bairro' => ['required','string','max:100'],
            'endereco_cep' => ['required','string','max:100'],
            'endereco_cidade' => ['required','string','max:100'],
            'endereco_estado' => ['required','string','max:100'],
            'telefone' => ['required','string','max:100']            
        ]);
    }
}
