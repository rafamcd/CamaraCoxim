@extends('site.layout')

@section('content')

<div id="meio-home">

    <div id="destaques">
    <div class="mediaBox">
    <div id="loopedSlider">	
    <div class="containerMaster"> 
    <div class="container"> 
    <div class="slides">
        
        @foreach($slider as $slide)
            <div class="item">
            <a href="{{route('noticiaver',['id'=>$slide->id])}}"> 
                    
                    <img src="{{asset('media/images/noticias/'.$slide->id.'/'.$slide->capa)}}" border="0" title="{{$slide->titulo}}" alt="{{$slide->titulo}}">
                    <div class="texto">
                        <?php echo date('d/m/Y', strtotime($slide['data_noticia'])); ?><br>
                    <span class="subtexto">
                        {{$slide->titulo}}</span></div>
                </a>
            </div>
        @endforeach

           
        
        
        
    </div>
    </div>
    </div>         
    <a href="#" class="previous">anterior</a>
    <a href="#" class="next">próximo</a> 
    </div>
    </div>
    </div>
    <!--FIM DESTAQUES-->
    
    <br style="clear:both">
    <br style="clear:both">
    <div>
        
    <div id="box-noticia">
    <div id="titulos_box"><a href="{{route('noticiassite')}}" class="azulescuro">
    Notícias</a></div>
    <div id="linha-g" class="azulescuro"></div>
    
      
    <div style="background:url(/media/images/config/news.jpg)" id="bok" onclick="window.location='{{route('noticiassite')}}';">
    <div id="fundo-eventos">
    <a href="{{route('noticiassite')}}">
    Acesse todas notícias do site</a>
    </div>
    </div>
    </div>
    
    <div id="box-noticias-r">
    <div id="titulos_box"><a href="{{route('eventossite')}}" class="azulescuro">
    Eventos</a></div>
    <div id="linha-g" class="azulescuro"></div>
    
    <?php 
        $img = '';
        //$img = 'assets/images/eventos/'.$ultimacapa['id'].'/'.$ultimacapa['capa'];
        
    ?>
    <div id="box-eventos" onclick="window.location='{{route('eventossite')}}'">
    
    <div style="background:url(/media/images/config/eventos.jpg)" id="bok">
    <div id="fundo-eventos">
    <a href="{{route('eventossite')}}">
    Veja imagens dos nossos eventos</a>
    </div>
    </div>
    </div>
    </div>
        
    </div>
    
    <br style="clear:both">
    <br style="clear:both">
    <br style="clear:both">
    
    
    
    </div>
    <!--FIM MEIO HOME-->
    
    <div id="menu_index">
    <ul>
    <li><div class="icone-diario"></div>
    <a href="http://diariooficial.diariodoestadoms.com.br/" target="_blank">Diário oficial</a></li>
    <li><div class="icone-transparencia"></div><a href="{{$config->portal_transparencia}}" target="_blank">Portal da Transparência</a></li>
    <li><div class="icone-camara"></div><a href="{{$config->e_sic}}" target="_blank">e-SIC</a></li>
    <li><div class="icone-licitacoes"></div><a href="http://s2.asp.srv.br/etransparencia.cm.coxim.ms/servlet/wplicitacaoconsulta" target="_blank">Licitações</a></li>
    <li><div class="icone-pregao"></div><a href="{{route('tf',['tf'=> 'departamentos'])}}">Departamentos</a></li>
    <li><div class="icone-imprensa"></div><a href="{{route('vereadoressite')}}">Vereadores</a></li>
    <li><div class="icone-diario"></div><a href="{{route('legislacao')}}">Legislação</a></li>    
    <li><div class="icone-incentivos"></div><a href="{{route('tf',['tf'=> 'conhecacoxim'])}}">Conheça a cidade</a></li>
    <li><div class="icone-noticias"></div><a href="{{route('tf',['tf'=> 'teluteis'])}}">Telefones Úteis</a></li>
    
    </ul>
    
    </div>
    
    
    <script type="text/javascript" language="javascript">
            $(function() {
    
                $('#carousel-banner ul').carouFredSel({
                    prev: '#prev',
                    next: '#next',
                    pagination: "#pager3",
                    auto: false,
                    scroll: 1000,
                    pauseOnHover: true
                });
    
            });
            </script>
        
            
            <div id="titulos_box"><a href="#" class="azulescuro">
            VEREADORES
            </a></div>
            <div id="linha-g" class="azulescuro"></div><br style="clear:both"><br style="clear:both"> <br style="clear:both">
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
     <br style="clear:both"><br style="clear:both">
             
    <div class="section chegar">
    <div id="titulos_box"><a href="#" class="azulescuro">
    COMO CHEGAR
    </a></div>
        
    <div id="linha-g" class="azulescuro"></div>
    
    
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d945.8795918493308!2d-54.76097397077337!3d-18.505462999213602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x937e351fadc953a3%3A0xe865cfb16789b01c!2sR.+Jo%C3%A3o+Pessoa%2C+286+-+Centro%2C+Coxim+-+MS%2C+79400-000!5e0!3m2!1spt-BR!2sbr!4v1489777812770" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div> 
    
@endsection