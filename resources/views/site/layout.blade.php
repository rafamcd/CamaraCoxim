<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<head>
<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);     
?>     



<title>{{$config->site_title}}</title>
<meta http-equiv="pragma" content="no-cache" />
<meta name="description" content="" />	
<meta name="keywords" content="<p>site para câmaras, criar site câmara municipal</p>" />
<meta name="distribution" content="global" />
<meta name="author" content="www.inteco.com.br">
<meta name="language" content="pt-br">

<link rel="stylesheet" href="{{asset('assets/css/template2/styles.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/template2/destaque.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/template2/pagina.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/template2/popup.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/template2/ajaxtabs.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/template2/lightbox.css')}}" type="text/css" />
<link rel="shortcut icon" href="{{asset('assets/favicons/brasao.png')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/template2/jquery.fancybox-1.3.4.css')}}" media="screen" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Armata' rel='stylesheet' type='text/css'>
<!--abas ajax-->
<script type="text/javascript" src="{{asset('assets/js/template2/ajaxtabs.js')}}"></script>
 <script src="{{asset('assets/js/template2/jquery.min.js')}}"></script>


<!--destaque Meio inicial -->
<script type="text/javascript" src="{{asset('assets/js/template2/scripts.js')}}"></script>
<!--fim -->



<!--banner popup -->
<script type="text/javascript" lang="javascript" src="{{asset('assets/js/template2/popup.js')}}"></script>



<!--lightbox -->
<script type="text/javascript" src="{{asset('assets/js/template2/jquery-1.4.4.min.js')}}"></script>	
<script type="text/javascript" src="{{asset('assets/js/template2/jquery.mousewheel-3.0.4.pack.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/template2/jquery.fancybox-1.3.4.pack.js')}}"></script>

<!--menu oculto -->
<script type="text/javascript">

$(window).scroll(function() {

    if ($(this).scrollTop()>200)
     {
        $('.menu_oc').fadeIn();
     }
    else
     {
      $('.menu_oc').fadeOut();
     }
});
</script>

<script type="text/javascript">
$(document).ready(function() {
$("a#tip4").click(function() {
	$.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'title'			: this.title,
			'width'		: 680,
			'height'		: 495,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			   	 'wmode'		: 'transparent',
				'allowfullscreen'	: 'true'
			}
		});

	return false;
});

			});
</script>

<style type="text/css">
body{
margin:0px;

}

.menu_oc {background: #14417d}
#menu{background: #14417d}
nav ul li a {color:#ffffff;}
#boxtopo{background: #14417d}
#boxtopo a{color:#ffffff;}
#rodape_cima {background: #e4e4e4; }
#rodape_baixo {background: #14417d;}
.cor{color:#14417D;}
</style>



</head>
<body>

<div id="submenu">
<div id="submenu-centro">

    <?php 
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');    
    ?>
    
    
<div id="data"><?php echo 'Coxim-MS, '.strftime('%d de %B de %Y', strtotime('today'));  ?></div>

        <?php
         $url = "http://api.hgbrasil.com/weather?woeid=457088&format=json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);

        $dadostemp = json_decode($result, true);

        

        ?>
        
        <div id="data"><?php echo $dadostemp['results']['temp']; ?>&deg;C | <?php echo utf8_encode($dadostemp['results']['description']); ?></div>  
 
 
 
</div>
</div>


<div id="topo">
<div id="topo-centro">
    
<div id="logo"><a href="/"><img src="{{asset('media/images/config/2ff9065486227f88eadb3e4fa144a2d6.jpg')}}" width="630" height="129" border="0" /></a></div>

<div class="dir" style=" width:350px;">
<div id="sociais">
  <ul>
    <li class="">
        <a href="http://www.facebook.com/camaradecoxim" title="Curtir Facebook" target="_blank" class="tooltip"><img src="{{asset('media/images/template2/facebook.png')}}" width="35" height="33" alt="Facebook" border="0"></a>
        
    </li>
    <li class="">
	<a href="" title="Siga-nos no Twitter" target="_blank" class="tooltip"><img src="{{asset('media/images/template2/twitter.png')}}" width="35" height="33" alt="Twitter" border="0"></a>
    </li>
    <li class="">
	<a href="" title="Nosso canal no Youtube" target="_blank" class="tooltip"><img src="{{asset('media/images/template2/youtube.png')}}" width="35" height="33" alt="Youtube" border="0"></a>
    </li>    
    <li class="">
	<a href="{{route('contato')}}" title="Fale Conosco"  class="tooltip"><img src="{{asset('media/images/template2/email.png')}}" width="35" height="33" alt="Fale conosco" border="0"></a>
    </li>
      <li class="">
	<a href="{{route('admin')}}" target="_blank" title="Área Restrita"  class="tooltip" style="opacity:0.70 !important;"><img src="{{asset('media/images/template2/icon-imprenssa.png')}}" width="35" height="33" alt="Fale conosco" border="0"></a>
    </li>
  </ul>
</div>

<div id="buscar">
<div class="busca_bg">
<form action="{{route('buscar')}}" method="post" name="formlog" target="_top">
    @csrf
<input name="palavra" id="palavra" maxlength="250" type="text" class="busca" placeholder="O que deseja buscar?" >
<input class="botao" type="submit" value="" style="cursor:pointer">
</form>
</div>
</div>
</div>

</div>
</div>

<!--INÍCIO MENU-->
<div id="menu">
<nav>
		<ul>
                    <li><a href="/">P&aacute;gina inicial</a></li>
                    <li class="drop">
			<a href="#">Câmara</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{route('tf',['tf'=> 'departamentos'])}}">Departamentos</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'institucional'])}}">Institucional</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'localizacao'])}}">Localização</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'missao'])}}">Missão, Visão e Valores</a></li>  
                                    <li><a href="{{route('pdf',['categoria'=>1])}}">Regimento Interno</a></li>
                                    <li><a href="{{route('eventossite')}}">Eventos</a></li>                                    
                                    <li><a href="{{route('noticiassite')}}">Notícias</a></li>
                                </ul>
                                </div>
                            </div>
                    </li>
                    <li class="drop">
			<a href="#">Vereadores</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{route('vereadoressite')}}">Vereadores</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'comissoes'])}}">Comissões</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'mesadiretora'])}}">Mesa Diretora</a></li>                                    
                                </ul>
                                </div>
                            </div>
                    </li>
                    <li class="drop">
			<a href="#">Legislação</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{route('pdf',['categoria'=>3])}}">Atas</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>14])}}">Atos</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>4])}}">Códigos</a></li>                                
                                    <li><a href="{{route('pdf',['categoria'=>5])}}">Comissões</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>6])}}">Decretos</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>7])}}">Emendas</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>8])}}">Est. Funcionário Público</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>9])}}">Lei Orgânica</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>10])}}">Leis Complementares</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>11])}}">Leis Ordinárias</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>12])}}">Plano Diretor</a></li>
                                    <li><a href="{{route('pdf',['categoria'=>13])}}">Resoluções</a></li>                                    
                                </ul>
                                </div>
                            </div>
                    </li>
                    <li class="drop">
			<a href="#">Transparência</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{$config->portal_transparencia}}" target="_blank">Portal da Transparência</a></li>
                                    <li><a href="http://s2.asp.srv.br/etransparencia.cm.coxim.ms/servlet/wplicitacaoconsulta" target="_blank">Publicações</a></li>                                    
                                </ul>
                                </div>
                            </div>
                    </li>
            <li><a href="http://diariooficial.diariodoestadoms.com.br/" target="_blank">Diário Oficial</a></li>    
            <li><a href="{{route('contato')}}">Fale Conosco</a></li>    
 </ul>
</nav>
</div>
<div>
<div class="menu_oc">
<nav>
		<ul>
                    <li><a href="/">P&aacute;gina inicial</a></li>
                    <li class="drop">
			<a href="#">Câmara</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{route('tf',['tf'=> 'departamentos'])}}">Departamentos</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'institucional'])}}">Institucional</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'localizacao'])}}">Localização</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'missao'])}}">Missão, Visão e Valores</a></li> 
                                    <li><a href="{{route('pdf',['categoria'=>1])}}">Regimento Interno</a></li>
                                    <li><a href="{{route('eventossite')}}">Eventos</a></li>
                                    <li><a href="{{route('noticiassite')}}">Notícias</a></li>
                                </ul>
                                </div>
                            </div>
                    </li>
                    <li class="drop">
			<a href="#">Vereadores</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{route('vereadoressite')}}">Vereadores</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'comissoes'])}}">Comissões</a></li>
                                    <li><a href="{{route('tf',['tf'=> 'mesadiretora'])}}">Mesa Diretora</a></li>                                    
                                </ul>
                                </div>
                            </div>
                    </li>
                    <li class="drop">
			<a href="#">Legislação</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>                
                        <li><a href="{{route('pdf',['categoria'=>3])}}">Atas</a></li>
                        <li><a href="{{route('pdf',['categoria'=>14])}}">Atos</a></li>
                        <li><a href="{{route('pdf',['categoria'=>4])}}">Códigos</a></li>                                
                        <li><a href="{{route('pdf',['categoria'=>5])}}">Comissões</a></li>
                        <li><a href="{{route('pdf',['categoria'=>6])}}">Decretos</a></li>
                        <li><a href="{{route('pdf',['categoria'=>7])}}">Emendas</a></li>
                        <li><a href="{{route('pdf',['categoria'=>8])}}">Est. Funcionário Público</a></li>
                        <li><a href="{{route('pdf',['categoria'=>9])}}">Lei Orgânica</a></li>
                        <li><a href="{{route('pdf',['categoria'=>10])}}">Leis Complementares</a></li>
                        <li><a href="{{route('pdf',['categoria'=>11])}}">Leis Ordinárias</a></li>
                        <li><a href="{{route('pdf',['categoria'=>12])}}">Plano Diretor</a></li>
                        <li><a href="{{route('pdf',['categoria'=>13])}}">Resoluções</a></li>                                                                         
                    </ul>
                                </div>
                            </div>
                    </li>
                    <li class="drop">
			<a href="#">Transparência</a>
                            <div class="dropdownContain">
				<div class="dropOut">
				<div class="triangle"></div>
				<ul>
                                    <li><a href="{{$config->portal_transparencia}}" target="_blank">Portal da Transparência</a></li>
                                    <li><a href="http://s2.asp.srv.br/etransparencia.cm.coxim.ms/servlet/wplicitacaoconsulta" target="_blank">Publicações</a></li>                                    
                                </ul>
                                </div>
                            </div>
                    </li>
            <li><a href="http://diariooficial.diariodoestadoms.com.br/" target="_blank">Diário Oficial</a></li>    
            <li><a href="{{route('contato')}}">Fale Conosco</a></li>    
 </ul>
</nav>
</div>
</div>
									   
<!--coberturas inicial -->
<script type="text/javascript" language="javascript" src="{{asset('assets/js/template2/jquery.carouFredSel-5.2.3-packed.js')}}"></script>

<script type="text/javascript" language="javascript">
		$(function() {

			$('#carousel-topo ul').carouFredSel({
				prev: '#prev',
				next: '#next',
				pagination: "#pager",
				auto: true,
				scroll: 1000,
				pauseOnHover: true
			});

		});
		</script>

<script type="text/javascript" src="{{asset('assets/js/template2/loopedslider.js')}}"></script>
<script type="text/javascript">
		$(function(){
				$('#loopedSlider').loopedSlider(
				{
					autoStart:5000, //tempo de delay
					restart:1, //tempo para reiniciar o loop no evento de click do botao
					slidespeed:500 //tempo de efeito do slide
				});
		});	
	</script> 
<div id="meio">

    <div style="clear:both"></div>
    @yield('content')
   <div style="clear:both"></div>

<br style="clear:both"><br style="clear:both">
</div>
<br style="clear:both" />
<div id="rodape">
<div id="rodape_baixo">
<div id="rodape_dentro">

<div id="copyright">
{{$config->endereco_rua}}  -  {{$config->endereco_bairro}}  -  
{{$config->endereco_cidade}} / {{$config->endereco_estado}} - {{$config->endereco_cep}} <br/> 
Tel: {{$config->telefone}} - Email: contato@camaracoxim.ms.gov.br <br/>
Atendimento de Segunda a Sexta - {{$config->horario_atendimento}}
</div>


</div>
</div>

</div>
<script type="text/javascript" src="{{asset('assets/js/template2/lightbox.js')}}"></script>  
</body>
 </html>
