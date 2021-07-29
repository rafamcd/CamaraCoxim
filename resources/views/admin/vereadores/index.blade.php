@extends('adminlte::page')

@section('title',' - Vereadores')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            <div style="float: left; padding-right: 20px;">
                Vereadores
            </div>          
            <a href="{{route('vereadores.add')}}" class="btn btn-sm btn-info">Adicionar</a>
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">ID</th>
                    <th style="width: 40%;">Nome</th>                    
                    <th style="width: 15%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vereadores as $vereador)
                <tr>
                    <td style="text-align: center;">{{$vereador->id}}</td>
                    <td>{{$vereador->nome}}</td>                    
                    <td>
                        <a href="{{ route('vereadores.edit', ['id' => $vereador->id])}}"><i class="nav-icon fas fa-edit" style="font-size:24px; color: Darkorange; padding-right: 15px;"></i></a>                        
                        <a href="{{ route('vereadores.del', ['id' => $vereador->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')"><button style="background: transparent; border: none !important; font-size: 0;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red;"></i></button></a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$vereadores->links()}}  
@endsection


