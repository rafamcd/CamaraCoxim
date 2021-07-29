@extends('adminlte::page')

@section('title',' - Editar usuário')

@section('content_header')
   
@endsection

@section('content')

    @if($errors->any())
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>            
                            
                @foreach($errors->all() as $error)
                    <i class="icon fa fa-ban"></i> {{$error}}<br/>
                @endforeach
        </div>
            
        
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Edição de Usuário</h4>
        </div>
        <div class="card-body">
            <form action="{{route('users.update', ['user' => $user->id])}}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" />
                    </div>            
                </div>
                <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" />
                        </div>            
                </div>
                <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Nova Senha</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
                        </div>            
                </div>
                <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Confirmação de Senha</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" />
                        </div>            
                </div>
                <div class="form-group row">            
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" value="Salvar" class="btn btn-success" />
                        </div>            
                </div>
            </form>
        </div>
    </div>    

@endsection


