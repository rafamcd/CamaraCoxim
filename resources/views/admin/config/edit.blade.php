@extends('adminlte::page')

@section('title',' - Editar Configurações')

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
    
    @if(session('aviso'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>            
            {{session('aviso')}}<br/>                        
    </div>        
    
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Edição de Configurações Gerais do Site</h4>
        </div>
        <div class="card-body">
            <form action="{{route('config.salvar', ['id' => $config->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título do site</label>
                    <div class="col-sm-10">
                        <input type="text" name="site_title" value="{{$config['site_title']}}" class="form-control @error('titulo') is-invalid @enderror" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <figure class="figure">
                            
                        <img src="{{asset('media/images/config/'.$config->banner)}}" class="img-thumbnail" />
                                <figcaption class="figure-caption text-center">Imagem do Banner</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-4">
                        <label for="banner">Trocar Banner</label>                                  
                        <div class="btn btn-default btn-sm float-left">                                        
                                <input type="file" name="banner" id="banner">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <figure class="figure">
                            
                        <img src="{{asset('media/images/config/'.$config->logo)}}" class="img-thumbnail" />
                                <figcaption class="figure-caption text-center">Imagem da Logo</figcaption>
                        </figure>
                    </div>
                    <div class="col-sm-3">
                        <label for="logo">Trocar Logo</label>                                  
                        <div class="btn btn-default btn-sm float-left">                                        
                                <input type="file" name="logo" id="logo">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Transparência</label>
                    <div class="col-sm-10">
                        <input type="text" name="portal_transparencia" value="{{$config['portal_transparencia']}}" class="form-control @error('portal_transparencia') is-invalid @enderror" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">e-SIC</label>
                    <div class="col-sm-10">
                        <input type="text" name="e_sic" value="{{$config['e_sic']}}" class="form-control @error('e_sic') is-invalid @enderror" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telefone</label>
                    <div class="col-sm-3">
                        <input type="text" name="telefone" value="{{$config['telefone']}}" class="form-control @error('telefone') is-invalid @enderror" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Horário de func.</label>
                    <div class="col-sm-10">
                        <input type="text" name="horario_atendimento" value="{{$config['horario_atendimento']}}" class="form-control @error('horario_atendimento') is-invalid @enderror" />
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Rua</label>
                    <div class="col-sm-10">
                        <input type="text" name="endereco_rua" value="{{$config['endereco_rua']}}" class="form-control @error('endereco_rua') is-invalid @enderror" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bairro</label>
                    <div class="col-sm-3">
                        <input type="text" name="endereco_bairro" value="{{$config['endereco_bairro']}}" class="form-control @error('endereco_bairro') is-invalid @enderror" />
                    </div>
                    <label class="col-sm-1 col-form-label">CEP</label>
                    <div class="col-sm-2">
                        <input type="text" name="endereco_cep" value="{{$config['endereco_cep']}}" class="form-control @error('endereco_cep') is-invalid @enderror" />
                    </div>                    
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cidade</label>
                    <div class="col-sm-3">
                        <input type="text" name="endereco_cidade" value="{{$config['endereco_cidade']}}" class="form-control @error('endereco_cidade') is-invalid @enderror" />
                    </div>
                    <label class="col-sm-1 col-form-label">Estado</label>
                    <div class="col-sm-1">
                        <input type="text" name="endereco_estado" value="{{$config['endereco_estado']}}" class="form-control @error('endereco_estado') is-invalid @enderror" />
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
        </div>
    </div>    
@endsection


