@extends('site.layout')

@section('content')
<div id="pagina-interna">
    <span class='tnoticias cor'>EVENTOS</span><br>
    <br/>
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
        
    <form method="GET" action="{{route('eventosbusca')}}">                    
        <div id="box-tit-desc"> 
            <span class="titnoticia">Buscar Eventos<br/> 
        Data &nbsp;&nbsp; <input type="date" name="data1" value="<?php echo $valordata1; ?>"> &nbsp;&nbsp;até&nbsp;&nbsp; 
        <input type="date" name="data2" id="data2" value="<?php echo $valordata2; ?>">
        <input type="submit" class="btnpadrao" value="Filtrar" style="width: 70px; height: 40px; padding:0; margin: 0; line-height: 40px; " /> 
        </span>
        </div>
        
    </form>   
        <hr style="width: 80%; color: #4169E1; height: 1px; background-color:#4169E1;" /><br/>
    </div>
    
<div id="box">

    @foreach($eventos as $evento)
    <div class="img-esquerda">
    <a href="{{route('eventosdetalha',['id'=>$evento->id])}}" data-lightbox="roadtrip"><img class="imgthumb-maior" src="/media/images/eventos/<?php echo $evento['id']; ?>/<?php echo $evento['capa']; ?>"></a>
    </div>
    <div id="box-tit-not-evento" class="cor"> <?php echo date('d/m/Y', strtotime($evento['data'])); ?></div>
    <div id="box-tit-desc"> 
        <span class="titnoticia-evento">
            <a href="{{route('eventosdetalha',['id'=>$evento->id])}}">
            <?php echo $evento['nome']; ?></a>
        </span>
        <div class="descricao-evento">
            <?php echo $evento['descricao']; ?>
        </div>
    </div>
    <div class="linha"></div>
    @endforeach
       
 


    {{$eventos->links()}}

</div>




</div>
@endsection