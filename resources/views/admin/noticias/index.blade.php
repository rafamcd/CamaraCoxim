@extends('adminlte::page')

@section('title',' - Notícias')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            <div style="float: left; padding-right: 20px;">
                Notícias
            </div>          
            <a href="{{route('noticias.add')}}" class="btn btn-sm btn-info">Adicionar</a>
        </h4>
        <br/>
        <form method="GET" action="{{route('noticias.busca')}}">          
            @if(!empty($data1) && !empty($data2))
                <input type="date" name="data1" id="data1" value="{{$data1}}" /> até 
                <input type="date" name="data2" id="data2" value="{{$data2}}" />
                <input type="submit" class="btn btn-warning" value="Filtrar" />              
            @else
                <input type="date" name="data1" id="data1" value="" /> até 
                <input type="date" name="data2" id="data2" value="" />
                <input type="submit" class="btn btn-warning" value="Filtrar" />  
            @endif         
          
        </form> 
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">ID</th>
                    <th style="width: 10%;">Data</th> 
                    <th style="width: 50%;">Título</th>                                                           
                    <th style="width: 20%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticias as $noticia)
                <tr>
                    <td style="text-align: center;">{{$noticia->id}}</td>
                    <td>{{date('d/m/Y', strtotime($noticia->data_noticia))}}</td>  
                    <td>{{$noticia->titulo}}</td>                                                          
                    <td>
                        <a href="{{ route('noticias.edit', ['id' => $noticia->id])}}"><i class="nav-icon fas fa-edit" style="font-size:24px; color: Darkorange; padding-right: 15px;"></i></a>                        
                        <a href="{{ route('noticias.noticiasimg', ['id' => $noticia->id])}}"><i class="nav-icon fa fa-camera-retro" style="font-size:24px; color: brown; padding-right: 15px;" ></i></a>                        
                        <a href="{{ route('noticias.del', ['id' => $noticia->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')"><button style="background: transparent; border: none !important; font-size: 0;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red; padding-right: 15px;""></i></button></a>                        
                        @if($noticia->status===1)
                            <a href="{{ route('noticias.mudapublicar', ['id' => $noticia->id])}}"><i class="nav-icon fa fa-check" style="font-size:24px; color: green; padding-right: 15px;" ></i></a>                        
                        @else
                        <a href="{{ route('noticias.mudapublicar', ['id' => $noticia->id])}}"><i class="nav-icon fa fa-check" style="font-size:24px; color: red; padding-right: 15px;" ></i></a>                        
                        @endif
                        @if($noticia->destaque_slider===1)
                            <a href="{{ route('noticias.mudaslider', ['id' => $noticia->id])}}"><i class="nav-icon fa fa-image" style="font-size:24px; color: green;" ></i></a>                        
                        @else
                            <a href="{{ route('noticias.mudaslider', ['id' => $noticia->id])}}"><i class="nav-icon fa fa-image" style="font-size:24px; color: red;" ></i></a>                        
                        @endif                       
                        
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$noticias->links()}}  
@endsection



