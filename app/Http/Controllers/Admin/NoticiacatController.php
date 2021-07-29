<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Noticiacat;

class NoticiacatController extends Controller
{
    public function __construct() {
        $this->middleware('auth');        
    }
    public function index()
    {
        $noticiacat = Noticiacat::paginate(10);
        
        return view('admin.noticiacat.index', [
            'noticiacat' => $noticiacat
        ]);
    }
    public function add() {
        return view('admin.noticiacat.add');
    }
    public function addAction(Request $request) {
        $request->validate([
            'descricao' => [ 'required', 'string' ]
        ]);
        
        $descricao = $request->input('descricao');

        $nc = new Noticiacat;
        $nc->descricao = $descricao;
        $nc->save();

        return redirect()->route('noticiascat');
    }
    public function edit($id) {
        
        $nc = Noticiacat::find($id);

        if($nc)  {
            return view('admin.noticiacat.edit',[
                'noticiacat' => $nc
            ]);
        } else {
            return redirect()->route('noticiascat');
        }        
    }
    public function editAction(Request $request, $id) {
        
        $request->validate([
            'descricao' => [ 'required', 'string' ]
        ]);

        $descricao = $request->input('descricao');         
     
        $nc = Noticiacat::find($id);
        $nc->descricao = $descricao;
        $nc->save();

        return redirect()->route('noticiascat');
              
    }
}
