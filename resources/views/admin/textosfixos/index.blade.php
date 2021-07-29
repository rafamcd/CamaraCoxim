@extends('adminlte::page')

@section('title',' - Textos fixos do Site')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            <div style="float: left; padding-right: 20px;">
                Textos fixos
            </div>          
            
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">ID</th>
                    <th style="width: 40%;">Chave</th>                    
                    <th style="width: 15%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($textosfixos as $textofixo)
                <tr>
                    <td style="text-align: center;">{{$textofixo->id}}</td>
                    <td>{{$textofixo->chave}}</td>                    
                    <td>                        
                        @if($textofixo->chave != 'localizacao')
                            <a href="{{ route('textosfixos.edit', ['id' => $textofixo->id])}}"><i class="nav-icon fas fa-edit" style="font-size:24px; color: Darkorange; padding-right: 15px;"></i></a>                          
                        @else 
                            Editada Banco de Dados
                        @endif                                              
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$textosfixos->links()}}  
@endsection


