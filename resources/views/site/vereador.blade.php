@extends('site.layout')

@section('content')

<?php
               
                   if (!empty($vereador['data_nascimento']) && $vereador['data_nascimento'] != '0000-00-00') {
                   $data_nascimento = date('d/m/Y', strtotime($vereador['data_nascimento'])); } else { $data_nascimento='Não informada.';
                   }
                   if (!empty($vereador['partido']))  {
                       $partido = $vereador['partido'];
                   } else {
                       $partido = 'Não informado.';
                   }
                        
                   if (!empty($vereador['qtd_votos']) && $vereador['qtd_votos'] > 0) {
                       $qtd_votos = $vereador['qtd_votos'];
                   } else {
                       $qtd_votos = 'Não informado.';
                   }
                       
?>

<div id="pagina-interna">
    <span class='tnoticias cor'>VEREADORES</span><br/>
        <br /><br /><br/>
        
                    <div class="imagem_vereador">
                    <a href="/media/images/vereadores/<?php echo $vereador['id']; ?>/<?php echo $vereador['imagem']; ?>" data-lightbox="Imagem<?php echo $vereador['id']; ?>" data-title="<?php echo $vereador['nome'].' '. $vereador['sobrenome']; ?>"><img src="/media/images/vereadores/<?php echo $vereador['id']; ?>/<?php echo $vereador['imagem']; ?>" /></a>  
                    </div>                     
                    <div class="dados_vereador">
                        <span ><strong>Nome:</strong> <?php echo $vereador['nome']; ?><br/>
                        <strong>Data Nascimento:</strong> <?php echo $data_nascimento; ?><br/>
                        <strong>Partido:</strong> <?php echo $partido; ?><br/>
                        <strong>Quantidade de votos:</strong> <?php echo $qtd_votos; ?><br/></span>
                        
                        <p align="justify">
                        <div class="dados_vereador_texto"> <span style="line-height:30px; font-size: 16px; text-align:justify" class="texto"><?php echo $vereador['texto']; ?></span></div>
                        </p>
                        
                        <?php if (count($noticiasvereador) > 0): ?>
        

        <div class="tnoticias2 cor">
                <?php if ($qtdnoticiasvereador > 1): ?>
                    Veja abaixo as notícias relacionadas ao vereador (<?php echo $qtdnoticiasvereador; ?> notícias recentes)
                <?php else: ?>
                    Veja abaixo as notícias relacionadas ao vereador (<?php echo $qtdnoticiasvereador; ?> notícia recente)
                <?php endif; ?>
        </div><br style="clear:both">
        <?php if ($noticiasvereador[0] == '1'): ?>
            
            <div style="padding-left: 20px;">
                <div id="box-tit-not-evento2" class="cor"> 
                <a href="{{route('noticiaver',['id'=>$noticiasvereador->id_noticia])}}" style="text-decoration: none; color: #000; font-size: 14px;">
                        <?php echo date('d/m/Y', strtotime($noticiasvereador['data_noticia'])); ?>
                    </a>
                </div>
                
                    <span class="titnoticia-evento2">
                        <a href="{{route('noticiaver',['id'=>$noticiasvereador->id_noticia])}}">
                        <?php echo $noticiasvereador['titulo']; ?></a>
                    </span>                
                
            </div>
            <div class="linha"></div>            
            
            <?php else: ?>
            
            <?php foreach($noticiasvereador as $noticiavereador): ?>
            
              
            <div style="padding-left: 20px;">
                <div id="box-tit-not-evento2" class="cor"> 
                    <a href="{{route('noticiaver',['id'=>$noticiavereador->id_noticia])}}" style="text-decoration: none; color: #000; font-size: 14px;">
                        <?php echo date('d/m/Y', strtotime($noticiavereador['data_noticia'])); ?>
                    </a>
                </div>
                
                    <span class="titnoticia-evento2">
                        <a href="{{route('noticiaver',['id'=>$noticiavereador->id_noticia])}}">
                        <?php echo $noticiavereador['titulo']; ?></a>
                    </span>                
                
            </div>
            <div class="linha"></div> 
            
            <?php endforeach; ?>
            
            <?php endif; ?>

        <br style="clear:both"> 
        
    <?php endif; ?>
        
        
        
                        
                    </div>
        
        
        
        
</div>

                        

    
@endsection