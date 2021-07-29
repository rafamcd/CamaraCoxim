<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TextoFixo;
use Illuminate\Support\Facades\Validator;

class TextoFixoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }
    public function index()
    {
        $textosfixos = TextoFixo::paginate(10);
        
        return view('admin.textosfixos.index', [
            'textosfixos' => $textosfixos
        ]);
    }
    public function edit($id)
    {
        
        $textofixo = TextoFixo::find($id);

        if($textofixo) {
            return view('admin.textosfixos.edit', [
                'textofixo' => $textofixo
            ]);
        } 

        return redirect()->route('textosfixos');
    }
    public function salvar(Request $request, $id) {
        
        $request->validate([
            'texto' => [ 'required', 'string' ]
        ]);

        $texto = $request->input('texto');         
     
        $t = TextoFixo::find($id);
        $t->texto = $texto;
        $t->save();

        return redirect()->route('textosfixos');
              
    }
}
