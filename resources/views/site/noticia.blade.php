@extends('site.layout')

@section('content')

<div id="pagina-interna">

        <span id="box-tit-not2" class="azul"><?php echo date('d/m/Y', strtotime($noticia['data_noticia'])); ?></span><br/>
        <span class="tnoticias2 cor"><?php echo $noticia['titulo']; ?></span><br style="clear:both" />
        <?php if(trim($noticia['subtitulo']) != '') ?>
        <span class="postagemsubtitulo azul"><?php echo $noticia['subtitulo']; ?></span><br style="clear:both" />
        <?php if(trim($usuario_criou['nome']) != '') ?>
        <span class="postagemautor azul">Por:&nbsp;<?php echo $usuario_criou['nome']; ?></span><br style="clear:both" />
        
        
        <div id="separa"></div>
        <div id="separa"></div> 
        <div id="separa"></div> 
        
        
        <div align='left'>
            
            <?php if($noticia['posicao_capa'] == 2): ?>
                <div class="alignleft">
            <?php else: ?>    
                <div class="alignright">
            <?php endif; ?>
            
                <?php $img = "/media/images/noticias/".$noticia['id']."/".$noticia['capa'];?>
                    
                <?php 
                    
                    $largura_final = $noticia['capa_largura']/2;
                    $altura_final = $noticia['capa_altura']/2;
                ?>
                    <a href="<?php echo $img; ?>" data-lightbox="roadtrip" style="text-decoration:none;">
                        <img class="imgthumb-noticia" src="<?php echo $img; ?>"  width="<?php echo $largura_final; ?>" height="<?php echo $altura_final; ?>" >
                    </a>
                    <Br style=" clear:both" />
                    <?php if(strlen($noticia['creditos_capa']) > 0): ?>
                    <div style=" width:<?php echo $largura_final+6; ?>px; background:#eee; padding:3px; height:30px; line-height: 30px; margin-top:0px " align='center'>
                        <span class="legendaa" style="text-align: center;" align="center"> <strong><?php echo $noticia['creditos_capa']; ?></strong></span>
                    </div>
                    <?php endif; ?>
            </div>
            
            
            <div align='justify' style="margin-top:-37px; line-height: 20px;">
                
                <span class=texto-materias>
                    <?php echo $noticia['texto']; ?>
                </span></div>
            
            
            </div>
        
    <br>
    <br><div class="linha"></div>
    
    
                <div id="box-mais">
                <div class="tnoticias2 cor">
    
                Mais imagens</div>
                        <?php foreach($imagens as $imagem): ?>
                            <?php $img = '/media/images/noticias/'.$imagem['id_noticia'].'/'.$imagem['imagem']; ?>
                            <a href="<?php echo $img; ?>" data-lightbox="roadtrip" style="text-decoration:none;">
                                <img class="imgthumb" src="<?php echo $img; ?>">
                            </a>
                        <?php endforeach; ?>
    
                <br style="clear:both">
                </div>
        
        <br>
        <br><div class="linha"></div>
        
        
            <div class="tnoticias2 cor">
    
        Compartilhar</div>
        <br style="clear:both">
      <ul>
        <li class="">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticiaver',['id'=>$noticia->id])}}" target="_blank" title="Compartilhar no Facebook" target="_blank" class="tooltip"><img src="/media/images/template2/facebook2.png" width="35" height="33" alt="Facebook" border="0"></a>
            &nbsp;&nbsp;<a href="https://api.whatsapp.com/send?text=<?php echo $noticia['titulo'].' '; ?> {{route('noticiaver',['id'=>$noticia->id])}}" target="_blank" title="Compartilhar no WhatsApp" target="_blank" class="tooltip"><img src="/media/images/template2/whats.png" width="35" height="33" alt="WhatsApp" border="0"></a>
        </li>
        
      </ul>
        <br style="clear:both">
    <br><div class="linha"></div>        
    
            <div class="tnoticias2 cor">
            Veja mais notícias dessa categoria</div><br style="clear:both">
                
                <?php foreach($noticiascategoria as $noticiacategoria): ?>
                  
                <div style="padding-left: 20px;">
                    <div id="box-tit-not-evento" class="cor"> 
                        <a href="{{route('noticiaver',['id'=>$noticiacategoria->id])}}" style="text-decoration: none; color: #000; font-size: 14px;">
                            <?php echo date('d/m/Y', strtotime($noticiacategoria['data_noticia'])); ?>
                        </a>
                    </div>
                    <div class="descricao-evento">
                        <span class="titnoticia-evento2">
                            <a href="{{route('noticiaver',['id'=>$noticiacategoria->id])}}">
                            <?php echo $noticiacategoria['titulo']; ?></a>
                        </span>                
                    </div>                
                </div>
                <div class="linha"></div> 
                
                <?php endforeach; ?>
                
                
    
            <br style="clear:both"> 
            
        
    </div>
    
    <script type="text/javascript" src="/assets/js/template2/jquery-1.9.1.min.js"></script>    

@endsection