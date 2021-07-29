@extends('adminlte::page')

@section('title',' - Editar Texto Fixo')

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
            <h4>Edição de Texto Fixo</h4>
        </div>
        <div class="card-body">
            <form action="{{route('textosfixos.salvar', ['id' => $textofixo->id])}}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf
                     
                <div class="form-group row">       
                        
                        <div class="col-sm-12">
                            <textarea name="texto" class="form-control bodyfield">{{$textofixo->texto}}</textarea>                            
                        </div>            
                </div>                
                <div class="form-group row">            
                        
                        <div class="col-sm-2">
                            <input type="submit" value="Salvar" class="btn btn-success" />
                        </div> 
                        <div class="col-sm-1">
                            <a href="{{route('textosfixos')}}" class="btn btn-danger">Fechar</a>
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


