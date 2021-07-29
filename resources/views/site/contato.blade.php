@extends('site.layout')

@section('content')

<div id="pagina-interna">
        <span class='tnoticias cor'>CONTATO</span><br><br><br>
        <span class=texto-fixo-novo>
                
                    Preencha os campos abaixo
                   </span>                <br/><br/>
        <div class="container-contato">  
            <form class="form-contact" method="post" tabindex="1">  
                    @csrf
               <input type="text" class="form-contact-input" name="name" placeholder="Nome" required />  
               <input type="email" class="form-contact-input" name="email" placeholder="Email" required />  
               <input type="text" class="form-contact-input" name="subject" placeholder="Assunto" />              
               <textarea class="form-contact-textarea" name="message" placeholder="Deixe uma mensagem" required></textarea>  
               <button type="submit" class="form-contact-button">Enviar</button>  
            </form>  
            
          </div>  
    </div>
@endsection