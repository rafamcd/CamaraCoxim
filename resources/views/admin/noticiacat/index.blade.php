@extends('adminlte::page')

@section('title',' - Categoria de Notícias')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            <div style="float: left; padding-right: 20px;">
                Categoria de Notícias
            </div>          
            <a href="{{route('noticiascat.add')}}" class="btn btn-sm btn-info">Adicionar</a>
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">ID</th>
                    <th style="width: 40%;">Descrição</th>                    
                    <th style="width: 15%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticiacat as $nc)
                <tr>
                    <td style="text-align: center;">{{$nc->id}}</td>
                    <td>{{$nc->descricao}}</td>                    
                    <td>
                        <a href="{{ route('noticiascat.edit', ['id' => $nc->id])}}"><i class="nav-icon fas fa-edit" style="font-size:24px; color: Darkorange; padding-right: 15px;"></i></a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$noticiacat->links()}}  
@endsection


