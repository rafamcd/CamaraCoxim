@extends('site.layout')

@section('content')
<div id="pagina-interna">
    <div id="box-tit-not-evento" class="cor"><?php echo $evento['nome']; ?></div><br>
    <div id="box-tit-not-evento" class="cor"><?php echo date('d/m/Y', strtotime($evento['data'])); ?></div><br>
       
        <div class="texto-materias">
            <?php echo $evento['descricao']; ?><br/>
        </div>        
        
<div id="box">
    <div align="center">
    <?php foreach($imagens as $imagem): ?>
        <a href="/media/images/eventos/<?php echo $imagem['id_evento']; ?>/<?php echo $imagem['imagem']; ?>" data-lightbox="roadtrip" style="text-decoration:none;">
            <img class="imgthumb" src="/media/images/eventos/<?php echo $imagem['id_evento']; ?>/<?php echo $imagem['imagem']; ?>">
        </a>
        
        
        <?php endforeach; ?>
    </div>
</div>
</div>
<script type="text/javascript" src="/assets/js/template2/jquery-1.9.1.min.js"></script>
@endsection