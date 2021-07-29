@extends('adminlte::page')

@section('title',' - Editar Evento')

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
            <h4>Editar Evento</h4>
        </div>
        <div class="card-body">
            <form method="POST" role="form" enctype="multipart/form-data">                
                @csrf
                <div class="box-body">

                    <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Nome do Evento</label>
                        <div class="col-sm-10">
                            <input type="text" name="nome" value="{{$evento->nome}}" placeholder="Digite o Nome do evento" class="form-control @error('nome') is-invalid @enderror" />
                        </div>            
                    </div>  
                    <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Data</label>
                        <div class="col-sm-3">
                            <input type="date" name="data" value="{{$evento->data}}"  class="form-control @error('data') is-invalid @enderror" />
                        </div>            
                    </div>    
                    <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Local</label>
                        <div class="col-sm-5">
                            <input type="text" name="local" value="{{$evento->local}}"  class="form-control @error('local') is-invalid @enderror" />
                        </div>            
                    </div>                 
    
                    <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Alterar Capa</label>
                        <div class="col-sm-10">
                            <div class="btn btn-default btn-sm float-left">                                        
                                <input type="file" name="capa" id="capa" accept="image/*">
                            </div>
                        </div>            
                    </div>  
                    <div class="form-group row">            
                        <label class="col-sm-2 col-form-label">Descrição do Evento</label>
                        <div class="col-sm-10">
                            <textarea name="descricao" class="form-control bodyfield">{{$evento->descricao}}</textarea>                            
                        </div>            
                    </div> 
                    
                    <div class="form-group row">            
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-2">
                            <input type="submit" value="Salvar" class="btn btn-primary" />
                        </div>            
                        <div class="col-sm-1">
                            <a href="{{route('eventos')}}" class="btn btn-danger">Fechar</a>
                        </div>
                    </div> 
                            
                </div>
            </form>                  
        </div>
    </div>   


    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js'></script>

    <script>
        tinymce.init({
            selector: 'textarea.bodyfield',   
            height:300,
            menubar:false,
            plugins:['link','table','image','autoresize','lists'],
            toolbar:'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist',
            content_css: [
                '{{asset('assets/css/content.css')}}'
            ],
            images_upload_url:'{{route('imageupload')}}',
            images_upload_credentials:true,
            convert_urls:false
        });
        </script>    
@endsection