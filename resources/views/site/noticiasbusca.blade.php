@extends('site.layout')

@section('content')

<div id="pagina-interna">
    <span class='tnoticias cor'>NOTÍCIAS FILTRADAS PELA BUSCA</span><br/>
        <br /><br /><br/>
        
        <?php foreach($noticias as $noticia): ?>
            
              
        <div style="padding-left: 20px;">
            <div id="box-tit-not-evento" class="cor"> 
            <a href="{{route('noticiaver',['id'=>$noticia['id']])}}" style="text-decoration: none; color: #000; font-size: 14px;">
                    <?php echo date('d/m/Y', strtotime($noticia['data_noticia'])); ?>
                </a>
            </div>
            <div class="descricao-evento">
                <span class="titnoticia-evento2">
                    <a href="{{route('noticiaver',['id'=>$noticia['id']])}}">
                    <?php echo $noticia['titulo']; ?></a>
                </span>                
            </div>                
        </div>
        <div class="linha"></div> 
        
        <?php endforeach; ?>

                    

@endsection