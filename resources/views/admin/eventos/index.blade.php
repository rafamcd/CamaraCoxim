@extends('adminlte::page')

@section('title',' - Eventos')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            <div style="float: left; padding-right: 20px;">
                Eventos
            </div>          
            <a href="{{route('eventos.add')}}" class="btn btn-sm btn-info">Adicionar</a>
        </h4>
        <br/>
        <form method="GET" action="{{route('eventos.busca')}}">          
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
                    <th style="width: 40%;">Nome</th>                    
                    <th style="width: 20%;">Data</th>                    
                    <th style="width: 15%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventos as $evento)
                <tr>
                    <td style="text-align: center;">{{$evento->id}}</td>
                    <td>{{$evento->nome}}</td>                    
                    <td>{{date('d/m/Y', strtotime($evento->data))}}</td>                    
                    <td>
                        <a href="{{ route('eventos.edit', ['id' => $evento->id])}}"><i class="nav-icon fas fa-edit" style="font-size:24px; color: Darkorange; padding-right: 15px;"></i></a>                        
                        <a href="{{ route('eventos.eventosimg', ['id' => $evento->id])}}"><i class="nav-icon fa fa-camera-retro" style="font-size:24px; color: brown; padding-right: 15px;" ></i></a>                        
                        <a href="{{ route('eventos.del', ['id' => $evento->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')"><button style="background: transparent; border: none !important; font-size: 0;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red;"></i></button></a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$eventos->links()}}  
@endsection



