@extends('adminlte::page')

@section('title',' - Usuários')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            <div style="float: left; padding-right: 20px;">
                Usuários cadastrados
            </div>
            <a href="{{route('users.create')}}" class="btn btn-sm btn-info">Adicionar</a>
            
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">ID</th>
                    <th style="width: 40%;">Nome</th>
                    <th style="width: 40%;">E-mail</th>
                    <th style="width: 15%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td style="text-align: center;">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>                        
                        <a href="{{ route('users.edit', ['user' => $user->id])}}"><i class="nav-icon fas fa-edit" style="font-size:24px; color: Darkorange; padding-right: 15px;"></i></a>
                        @if($loggedId !== intval($user->id))
                            <form class="d-inline" method="POST" action="{{ route('users.destroy', ['user' => $user->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @method('DELETE')
                                @csrf
                                <button style="background: transparent; border: none !important; font-size: 0;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red;"></i></button>
                            </form>                        
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$users->links()}}  
@endsection


