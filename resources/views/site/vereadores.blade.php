@extends('site.layout')

@section('content')

<div id="pagina-interna">
    
        <span class='tnoticias cor'>VEREADORES</span><br/>
            <br /><br /><br/>
            
        <div class="vereadores">  
                
                @foreach($vereadores as $vereador)

                <div id="box-vereador" onclick="window.location='{{route('vereadoresdetalhar',['id'=>$vereador->id])}}'">
                <div style="background:url(/media/images/vereadores/{{$vereador->id}}/{{$vereador->imagem}}) no-repeat;" id="bok-vereador">
                <div id="fundo-vereador">
                <a href="{{route('vereadoresdetalhar',['id'=>$vereador->id])}}">
                        <?php 
                        $nome = $vereador->nome;

                        $temp = explode(" ",$nome);

                        $nomeNovo = $temp[0] . " " . $temp[count($temp)-1];
                        echo $nomeNovo;
                        ?>
                </a>
                </div>
                </div>
                </div>

                @endforeach
            
        
         
     </div> <!--vereadores-->
    </div>
    <br style="clear:both">
    
    
                            
    
@endsection