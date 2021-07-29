<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Config;

class ContatoController extends Controller
{
    public function index() {
        
        $config = Config::first();

        return view('site.contato',
        [
            'config' => $config,
            'mensagem' => ''
        ]);
    }
    public function enviar() {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            
            $emailTo = 'rafamcd@inteco.com.br';

            $clientName = utf8_decode(trim($_POST['name']));
            $clientEmail = utf8_decode(trim($_POST['email']));
            $subject = utf8_decode(trim($_POST['subject']));
            $message = utf8_decode(trim($_POST['message']));
            $headers = "From: " . $clientName . " <" . $clientEmail . ">" . "\r\n" . "Reply-To: " . $clientEmail;
            mail($emailTo, $subject . ' (Contato pelo Site)', $message, $headers);
            
            
        }
        return redirect()->route('contato');
    }
    
}
