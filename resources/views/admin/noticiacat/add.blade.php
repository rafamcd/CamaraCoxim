@extends('adminlte::page')

@section('title',' - Adicionar Categoria de Notícia')

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
            <h4>Adicionar Categoria de Notícia</h4>
        </div>
        <div class="card-body">
            <form method="POST" class="form-horizontal">
               
                @csrf
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Descrição</label>
                    <div class="col-sm-10">
                        <input type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" />
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