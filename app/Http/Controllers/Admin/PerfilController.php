<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class PerfilController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //pegando o ID do usuário logado
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user) {
            return view('admin.perfil.index',[
                'user' => $user
            ]);
        }
        return redirect()->route('admin');        
    }

    public function salvar(Request $request)
    {
        //Recebendo os dados
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user) {

            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ],[
                'name' => ['required','string', 'max:100'],
                'email' => ['required','string','max:100']
            ]);            

            //1. Alteração do nome
            $user->name = $data['name'];
            
            //2. Alterçaão do e-mail 
            //2.1 Primeiro, verificamos se o e-mail foi alterado
            //2.2 Segundo, verificamos se o novo e-mail já existe            
            //2.3 Terceiro, se não existir, nós alteramos
            if($user->email != $data['email']) {
                $existeEmail = User::where('email', $data['email'])->get();
                if(count($existeEmail) === 0) {
                    //só pode alterar o e-mail se o novo e-mail já não existe no banco de dados
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique',[
                        'attribute' => 'email'
                    ]));                   
                }
            }

            //3. Alteração da senha
            //3.1 Verifica se o usuário digitou alguma senha nova
            //3.2 Verifica se a senha tem no mínimo 4 caracteres
            //3.2 Verifica se a confirmação está OK
            //3.3 Altera a senha
            if(!empty($data['password'])) {
                if(strlen($data['password']) >= 4) {
                    if($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        //confirmação de senhas não bateu
                        $validator->errors()->add('password', __('validation.confirmed',[
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    //para aparecer o erro da senha
                    $validator->errors()->add('password', __('validation.min.string',[
                        'attribute' => 'password',
                        'min' => 4
                    ]));                    
                }                
            }

            if(count($validator->errors()) > 0) {                
                return redirect()->route('perfil',[
                    'user' => $loggedId
                ])->withErrors($validator);                
            }

            $user->save();

            return redirect()->route('perfil')
                ->with('aviso', '  Informações alteradas com sucesso.');
        }
        return redirect()->route('perfil');
    }
}
