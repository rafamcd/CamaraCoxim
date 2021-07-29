@extends('adminlte::page')


<title>Painel Administrativo - {{$descricao}}</title>

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
        
            <div class="form-group row">  
                <h4>{{$descricao}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>[Faça upload de arquivos PDF]</small></h4>
            </div>
            @if($busca===0)
            <form method="POST" role="form" enctype="multipart/form-data">                
                @csrf                

                <div class="form-group row">            
                    <div class="col-sm-10">
                        <input type="text" name="titulo" value="{{old('titulo')}}" placeholder="Digite o Título do Documento" class="form-control @error('titulo') is-invalid @enderror" />
                    </div>            
                </div>  
                <div class="form-group row">            
                    <div class="col-sm-10">
                        <textarea name="descricao" placeholder="Digite a Descrição do Documento" class="form-control @error('descricao') is-invalid @enderror">{{old('descricao')}}</textarea>
                    </div>            
                </div>  
                <div class="form-group row">            
                    <div class="col-sm-2">
                        <input type="date" name="data_documento" class="form-control @error('data_documento') is-invalid @enderror" />
                    </div>   
                    <div class="col-sm-2">
                        <div class="btn btn-default btn-sm float-left">                                        
                            <input type="file" name="arquivo" id="arquivo" accept="application/pdf">
                        </div>
                    </div>         
                </div> 
                
                <div class="form-group row">            
                    
                    <div class="col-sm-2">
                        <input type="submit" value="Inserir" class="btn btn-primary" />
                    </div>            
                    <div class="col-sm-1">
                        <a href="{{route('admin')}}" class="btn btn-danger">Fechar</a>
                    </div>
                </div> 
            </form>  
            @endif
            @if($busca===1)
            <div class="form-group row">            
                    
                <div class="col-sm-2">
                    <a href="{{route('registrospdf',['categoria'=>$categoria])}}" class="btn btn-info">Inserir</a>                    
                </div>    
            </div>
            @endif
        </div>  
        
        <br/>
        <div class="d-flex justify-content-center">
            <form method="GET" action="{{route('registrospdfbusca', ['categoria'=>$categoria])}}">          
                @if(!empty($data1) && !empty($data2))
                    <input type="date" name="data1" id="data1" value="{{$data1}}" /> até 
                    <input type="date" name="data2" id="data2" value="{{$data2}}" />
                    <input type="submit" class="btn btn-warning" value="Filtrar" />              
                @else
                    <input type="date" name="data1" id="data1" value="" /> até 
                    <input type="date" name="data2" id="data2" value="" />
                    <input type="submit" class="btn btn-warning" value="Filtrar" />  
                @endif    
            </form>   
        </div>
    
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>                    
                    <th style="width: 40%;">Título</th>                    
                    <th style="width: 20%;">Data</th>                    
                    <th style="width: 15%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrosPDF as $r)
                <tr>
                    
                    <td>{{$r->titulo}}</td>                    
                    
                        <td>
                            <?php $data_documento = date('d/m/Y', strtotime($r->data_documento)); ?>
                            {{$data_documento}}
                        </td>       
                    
                    <td>
                        <a href="{{asset('media/pdf/'.$categoria.'/'.$r->arquivo)}}" target='_blank'><i class="nav-icon fas fa-eye" style="font-size:24px; color: Darkorange; padding-right: 15px;)"></i></a>
                        <a href="{{ route('registrospdfdeleta', ['categoria' => $r->categoria, 'id' => $r->id]) }}" onclick="return confirm('Tem certeza que deseja excluir?')"><button style="background: transparent; border: none !important; font-size: 0;"><i class="nav-icon fas fa-trash" style="font-size:24px; color: red;"></i></button></a>                                                                                    
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </div>
</div>    
{{$registrosPDF->links()}}  
@endsection



