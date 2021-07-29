@extends('site.layout')

@section('content')

<div id="pagina-interna">
        <span class='tnoticias cor'>LEGISLAÇÃO</span><br/>
            <br /><br />
            <div class="texto-padrao">
                <div class=item-texto-link>
                <a href="{{route('pdf',['categoria'=>3])}}" class="btnpadrao2" style="text-decoration: none; color:#000;">
                        <div class="seta-direita">Atas</div></a>
                <a href="{{route('pdf',['categoria'=>14])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Atos</div></a>
                <a href="{{route('pdf',['categoria'=>4])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Códigos</div></a>
                <a href="{{route('pdf',['categoria'=>5])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Comissões</div></a>
                <a href="{{route('pdf',['categoria'=>6])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Decretos</div></a>
                <a href="{{route('pdf',['categoria'=>7])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Emendas</div></a>
                <a href="{{route('pdf',['categoria'=>8])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Est. Funcionário Público</div></a>
                <a href="{{route('pdf',['categoria'=>9])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Lei Orgânica</div></a>
                <a href="{{route('pdf',['categoria'=>10])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Leis Complementares</div></a>
                <a href="{{route('pdf',['categoria'=>11])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Leis Ordinárias</div></a>
                <a href="{{route('pdf',['categoria'=>12])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Plano Diretor</div></a>
                <a href="{{route('pdf',['categoria'=>13])}}" style="text-decoration: none; color:#000;">
                <div class="seta-direita">Resoluções</div></a>
                </div>
                    
                </div>                
                
</div>
    
    
                            
    
@endsection