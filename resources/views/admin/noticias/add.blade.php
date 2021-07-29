@extends('adminlte::page')

@section('title',' - Adicionar Notícia')

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
            <h4>Adicionar Notícia</h4>
        </div>
        <div class="card-body">
            <form method="POST" role="form" enctype="multipart/form-data">                
                @csrf
                <div class="box-body">

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="titulo" value="{{old('titulo')}}" placeholder="Digite o Título da notícia" class="form-control @error('titulo') is-invalid @enderror" autofocus />
                    </div>            
                </div>  
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Subtítulo</label>
                    <div class="col-sm-10">
                        <input type="text" name="subtitulo" value="{{old('subtitulo')}}" placeholder="Digite o Subtítulo da notícia" class="form-control @error('subtitulo') is-invalid @enderror" />
                    </div>            
                </div>  
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Imagem de Capa</label>
                    <div class="col-sm-4">
                        <div class="btn btn-default btn-sm float-left">                                        
                            <input type="file" name="capa" id="capa" accept="image/*">
                        </div>
                    </div>     
                    <label class="col-sm-1 col-form-label">Créditos</label>
                    <div class="col-sm-5">
                        <input type="text" name="creditos_capa" value="{{old('creditos_capa')}}"  class="form-control @error('creditos_capa') is-invalid @enderror" />
                    </div>         
                </div>    
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Data</label>
                    <div class="col-sm-3">
                        <input type="date" name="data_noticia" value="{{old('data_noticia')}}"  class="form-control @error('data_noticia') is-invalid @enderror" />
                    </div>  
                    <div class="col-sm-1">
                        <label class="col-sm-2 col-form-label"></label>
                    </div>
                    <label class="col-sm-1 col-form-label">Categoria</label>
                    <div class="col-sm-4">
                        <select name="id_noticia_categoria" class="form-control @error('id_noticia_categoria') is-invalid @enderror">  
                        @foreach($categorias as $categoria)
                        <option value="{{$categoria['id']}}">{{$categoria['descricao']}}</option>
                        @endforeach
                        </select>
                    </div>                                
                </div>   
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Foto principal</label>
                    <div class="col-sm-3">
                        <select name="posicao_capa" class="form-control">                               
                            <option value="2">Imagem na Esquerda</option>
                            <option value="3" selected>Imagem na Direita</option>
                        </select>
                    </div>  
                    <div class="col-sm-1">
                        <label class="col-sm-2 col-form-label"></label>
                    </div>
                    <label class="col-sm-1 col-form-label">Slide</label>
                    <div class="col-sm-2">
                        <select name="destaque_slider" class="form-control">   
                            <option value="0">Não</option>
                            <option value="1" selected>Sim</option>
                        </select>
                    </div>                                
                </div>   
               
                <div class="form-group row">            
                    
                        <textarea name="texto" class="form-control bodyfieldnot">{{old('texto')}}</textarea>                            
                    
                </div> 
                <div class="form-group row"> 
                    <div class="col-md-12" style="margin-top: 15px !important;"><strong>Deseja vincular a notícia para algum vereador?</strong></div>
                        @foreach($vereadores as $vereador)
                            <div class="col-md-4" style="margin-top: 15px !important;">
                                <label><input type="checkbox" name="check<?php echo $vereador['id']; ?>"> {{$vereador['nome']}}</label><br/>
                            </div>
                        @endforeach
                        
                </div> 
                
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-2">
                        <input type="submit" value="Salvar" class="btn btn-primary" />
                    </div>            
                    <div class="col-sm-1">
                        <a href="{{route('noticias')}}" class="btn btn-danger">Fechar</a>
                    </div>
                </div> 
                            
                </div>
            </form>                  
        </div>
    </div>   


    <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js'></script>

    <script>
        tinymce.init({
            selector: 'textarea.bodyfieldnot',   
            height:"800",
            width:"100%",
            menubar:false,
            plugins:['link','table','image','lists'],
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