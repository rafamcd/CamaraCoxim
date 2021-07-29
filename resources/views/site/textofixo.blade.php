@extends('site.layout')

@section('content')

<div id="pagina-interna">
<span class='tnoticias cor'>
        @if($tf->chave==='departamentos')        
                DEPARTAMENTOS
                
        @endif

        @if($tf->chave==='institucional')        
                INSTITUCIONAL
        @endif

        @if($tf->chave==='localizacao')        
                LOCALIZAÇÃO        
        @endif

        @if($tf->chave==='missao')
                MISSÃO, VISÃO E VALORES
        @endif

        @if($tf->chave==='comissoes')
                COMISSÕES
        @endif

        @if($tf->chave==='mesadiretora')
                MESA DIRETORA
        @endif

        @if($tf->chave==='conhecacoxim')
                CONHEÇA COXIM
        @endif
        
        @if($tf->chave==='teluteis')
                TELEFONES ÚTEIS
        @endif
</span><br/>
        <br /><br />
        <div class="texto-padrao">
            
                <span class=texto-fixo-novo>
                        {!!$tf->texto!!}
                </span>
            
        </div>
</div>
@endsection