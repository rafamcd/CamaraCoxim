@extends('adminlte::page')

@section('title',' - Imagens da Notícia')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="form-group row"> 
        <h4>
            <div style="float: left; padding-right: 20px;">
                Imagens da Notícia &nbsp;&nbsp;&nbsp; <small>[ Adicione imagens da notícia (exceto a capa)  ]</small>
            </div> 
        </h4> 
    </div>
            <form method="POST" role="form" action="{{route('noticias.noticiasimgadd',['id'=>$noticia->id])}}" enctype="multipart/form-data">                
                @csrf

                <div class="form-group row"> 
                    <div class="col-md-3">
                        <label>ID</label>
                        <input type="number" name="id" class="form-control" disabled value="{{$noticia->id}}">
                    </div>
                    <div class="col-md-3">
                        <label for="data_noticia">Data</label>
                        <input type="date" name="data_noticia" class="form-control" id="data_noticia" value="{{$noticia->data_noticia}}" disabled>
                    </div>
                </div>

                <div class="form-group row">                     
                    <div class="col-sm-12">
                        <input type="text" name="titulo" class="form-control" id="titulo" disabled value="{{$noticia->titulo}}" required>
                    </div>
                </div>

                <div class="form-group row"> 
                    
                    <div class="col-sm-8">
                        <input type="file" name="arquivo[]" accept="image/*" multiple />
                    </div>
                </div>
                
                <div class="form-group row">            
                    
                    <div class="col-sm-2">
                        <input type="submit" value="Salvar" class="btn btn-primary" />
                    </div>            
                    <div class="col-sm-1">
                        <a href="{{route('noticias')}}" class="btn btn-danger">Fechar</a>
                    </div>
                </div> 
            </form>        
            
                      
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-hover">  
            <div align="center">
                <?php $q = 0; ?>
            @foreach($imagens as $img)
                <?php $q++; ?>
            <a href="{{asset('media/images/noticias/'.$img->id_noticia.'/'.$img->imagem)}}" data-toggle="lightbox" data-title="Imagem {{$q}} de {{$imagens->count()}}" data-gallery="example-gallery">
                        <img class="imgthumb" src="{{asset('media/images/noticias/'.$img->id_noticia.'/'.$img->imagem)}}" class="img-fluid rounded" />
                        <a href="{{ route('noticias.noticiasimgdel', ['id' => $img->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')"><button style="background: transparent; border: none !important; font-size: 0; padding-right: 40px;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red;"></i></button></a>                        
                </a>                    
                
            @endforeach
            </div>                     
        </table>        
    </div>
</div>    
{{$imagens->links()}}  
@endsection



