@extends('adminlte::page')

@section('title',' - Adicionar Vereador')

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
            <h4>Adicionar Vereador</h4>
        </div>
        <div class="card-body">
            <form method="POST" role="form" enctype="multipart/form-data">                
                @csrf
                <div class="box-body">

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" name="nome" value="{{old('nome')}}" placeholder="Digite o Nome do vereador" class="form-control @error('nome') is-invalid @enderror" />
                    </div>            
                </div>  
                
                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Data de Nascimento</label>
                    <div class="col-sm-3">
                        <input type="date" name="data_nascimento" value="{{old('data_nascimento')}}"  class="form-control @error('data_nascimento') is-invalid @enderror" />
                    </div>            
                </div>  

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Partido</label>
                    <div class="col-sm-2">
                        <input type="text" name="partido" value="{{old('partido')}}"  class="form-control @error('partido') is-invalid @enderror" />
                    </div>            
                </div>  

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Quantidade de Votos</label>
                    <div class="col-sm-2">
                        <input type="number" name="qtd_votos" value="{{old('qtd_votos')}}"  class="form-control @error('qtd_votos') is-invalid @enderror" />
                    </div>            
                </div>  

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10">
                        <div class="btn btn-default btn-sm float-left">                                        
                            <input type="file" name="imagem" id="imagem" accept="image/*">
                        </div>
                    </div>            
                </div>  

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label">Descrição do Vereador</label>
                    <div class="col-sm-10">
                        <textarea name="texto" class="form-control bodyfield">{{old('texto')}}</textarea>                            
                    </div>            
                </div> 

                <div class="form-group row">            
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-2">
                        <input type="submit" value="Salvar" class="btn btn-primary" />
                    </div>            
                    <div class="col-sm-1">
                        <a href="{{route('vereadores')}}" class="btn btn-danger">Fechar</a>
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