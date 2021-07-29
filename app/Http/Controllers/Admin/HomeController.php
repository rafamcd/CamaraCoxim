<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vereador;
use App\Noticia;
use App\User;
use App\NoticiaVereador;
use App\RegistroPDF;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(Request $request) {

        $noticiasCount = 0;
        $vereadoresCount = 0;
        $pdfsCount = 0;
        $usersCount = 0;

        //definindo padrão de 30 caso não tenha sido enviado nada
        $intervalo = intval($request->input('intervalo', 1000000));
        //caso o usuário tente colocar mais que 180 vai voltar pra 6 meses
        if ($intervalo > 180) {
            $intervalo = 1000000;
        }
        $dataIntervalo = date('Y-m-d H:i:s', strtotime('-'.$intervalo.' days'));

        //Contagem de Noticias
        $noticiasCount = Noticia::where('data_noticia','>=',$dataIntervalo)->where('status',1)->count();

        //Contagem de Vereadores
        $vereadoresCount = Vereador::count();

        //Contagem de PDFs
        $pdfsCount = RegistroPDF::count();

        //Contagem de Usuários
        $usersCount = User::count();

        //Contagem para o PagePie
        $pagePie = [];
        //criei cores aleatórias pra cada pagina do site.. mas se tiver 100 paginas tem q colocar 100 cores abaixo
        $coresPie = [
            '#CCCCCC',
            '#FF0000',
            '#0000FF',
            '#EEC900',
            '#FFDAB9',
            '#8B7D6B',
            '#6495ED',
            '#4682B4',
            '#00CED1',
            '#00FA9A',
            '#00FF00',
            '#6B8E23',
            '#BDB76B',
            '#BC8F8F',
            '#BA55D3',
            '#FA8072',
            '#F0E68C',
            '#FFFACD'
        ];
        $coresUtilizadas = [];
        $contador = 0;
        
        $noticiasVereadores = NoticiaVereador::selectRaw('id_vereador, count(noticia_vereador.id) as c')
                                    ->join('noticia','noticia_vereador.id_noticia','=','noticia.id')
                                    ->where('noticia.data_noticia','>=',$dataIntervalo)
                                    ->where('noticia.status', '=', 1)
                                    ->groupBy('id_vereador')->get();
        foreach($noticiasVereadores as $n) {
            $nomeVereador = Vereador::find($n->id_vereador);
            if ($nomeVereador) {
                $pagePie[ $nomeVereador->nome ] = intval($n['c']);
                $coresUtilizadas[ $nomeVereador->nome ] = $coresPie[$contador];
                $contador++;
            }            
        }        
        
        $pageLabels = json_encode( array_keys($pagePie) );
        $pageValues = json_encode( array_values($pagePie) );
        $colorsPie = json_encode( array_values($coresUtilizadas) );
        
        return view('admin.home',[
            'noticiasCount' => $noticiasCount,
            'vereadoresCount' => $vereadoresCount,
            'pdfsCount' => $pdfsCount,
            'usersCount' => $usersCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'colorsPie' => $colorsPie,
            'dataIntervalo' => $intervalo
        ]);        
    }
}
