@extends('site.layout')

@section('content')

<div id="pagina-interna">
    <span class='tnoticias cor'>NOTÍCIAS</span><br/>
        <br /><br /><br/>
        
<div align="center">
            <?php 
            
            if (isset($_GET['data1']) && !$_GET['data1'] != '0000-00-00') {
                $valordata1 = $_GET['data1'];
                    }  else  {
                        $valordata1 = '1900-01-01';
                    }
            if (isset($_GET['data2']) && !$_GET['data2'] != '0000-00-00') {
                $valordata2 = $_GET['data2'];
                    }  else  {
                        $valordata2 = date('Y-m-d');
                    }
                
            ?>
            
            <form method="GET" action="{{route('noticiasbusca')}}">                    
                <div id="box-tit-desc"> 
                    <span class="titnoticia">Buscar Notícias<br/> 
                Data &nbsp;&nbsp; <input type="date" name="data1" value="<?php echo $valordata1; ?>"> &nbsp;&nbsp;até&nbsp;&nbsp; 
                <input type="date" name="data2" id="data2" value="<?php echo $valordata2; ?>">
                <input type="submit" class="btnpadrao" value="Filtrar" style="width: 70px; height: 40px; padding:0; margin: 0; line-height: 40px; " /> 
                </span>
                </div>
                
            </form>    
            <hr style="width: 80%; color: #4169E1; height: 1px; background-color:#4169E1;" /><br/>
        </div>        
        


        

            <?php foreach($noticias as $noticia): ?>
            
              
            <div style="padding-left: 20px;">
                <div id="box-tit-not-evento" class="cor"> 
                    <a href="{{route('noticiaver',['id'=>$noticia->id])}}" style="text-decoration: none; color: #000; font-size: 14px;">
                        <?php echo date('d/m/Y', strtotime($noticia['data_noticia'])); ?>
                    </a>
                </div>
                <div class="descricao-evento">
                    <span class="titnoticia-evento2">
                        <a href="{{route('noticiaver',['id'=>$noticia->id])}}">
                        <?php echo $noticia['titulo']; ?></a>
                    </span>                
                </div>                
            </div>
            <div class="linha"></div> 
            
            <?php endforeach; ?>
            
            {{$noticias->links()}}   

        <br style="clear:both"> 
        
    
        
</div>

                    

@endsection