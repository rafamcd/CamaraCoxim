@extends('adminlte::page')

@section('title',' - Imagens do evento')

@section('content_header')
    
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="form-group row"> 
        <h4>
            <div style="float: left; padding-right: 20px;">
                Imagens do Evento <br/>
            </div> 
        </h4> 
    </div>
            <form method="POST" role="form" action="{{route('eventos.eventosimgadd',['id'=>$evento->id])}}" enctype="multipart/form-data">                
                @csrf
                
                <div class="form-group row"> 
                    <label class="col-sm-2 col-form-label">Evento</label>
                    <div class="col-sm-8">
                        <input type="text" name="nome" class="form-control" id="nome" disabled value="{{$evento->nome}}" required>
                    </div>
                </div>

                <div class="form-group row"> 
                    <label class="col-sm-2 col-form-label">Adicionar Imagens</label>
                    <div class="col-sm-8">
                        <input type="file" name="arquivo[]" accept="image/*" multiple />
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
            </form>        
            
        </h4>               
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-hover">  
            <div align="center">
                <?php $q = 0; ?>
            @foreach($imagens as $img)
                <?php $q++; ?>
            <a href="{{asset('media/images/eventos/'.$img->id_evento.'/'.$img->imagem)}}" data-toggle="lightbox" data-title="Imagem {{$q}} de {{$imagens->count()}}" data-gallery="example-gallery">
                        <img class="imgthumb" src="{{asset('media/images/eventos/'.$img->id_evento.'/'.$img->imagem)}}" class="img-fluid rounded" />
                        <a href="{{ route('eventos.eventosimgdel', ['id' => $img->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')"><button style="background: transparent; border: none !important; font-size: 0; padding-right: 40px;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red;"></i></button></a>                        
                </a>                    
                
            @endforeach
            </div>                     
        </table>        
    </div>
</div>    
{{$imagens->links()}}  
@endsection



