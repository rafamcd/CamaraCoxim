<?php

Route::get('/', 'Site\HomeController@index')->name('site');

//Site
Route::get('tf/{tf}/', 'Site\TextoFixoController@index')->name('tf');
Route::get('legislacao', 'Site\LegislacaoController@index')->name('legislacao');
Route::get('vereadores', 'Site\VereadorController@index')->name('vereadoressite');
Route::get('vereadores/{id}', 'Site\VereadorController@detalha')->name('vereadoresdetalhar');
Route::get('noticias', 'Site\NoticiaController@index')->name('noticiassite');
Route::get('noticia/{id}', 'Site\NoticiaController@ver')->name('noticiaver');
Route::get('noticiasbusca', 'Site\NoticiaController@busca')->name('noticiasbusca');
Route::post('buscar', 'Site\NoticiaController@buscar')->name('buscar');
Route::get('eventos', 'Site\EventoController@index')->name('eventossite');
Route::get('eventosbusca', 'Site\EventoController@busca')->name('eventosbusca');
Route::get('eventos/{id}', 'Site\EventoController@detalha')->name('eventosdetalha');

//RegistrosPDF dentro do site
Route::get('pdf/{categoria}','Site\RegistroPDFController@index')->name('pdf');    
Route::get('pdfbusca/{categoria}','Site\RegistroPDFController@busca')->name('pdfbusca');   

//Contato
Route::get('contato', 'Site\ContatoController@index')->name('contato');
Route::post('contato', 'Site\ContatoController@enviar')->name('enviarcontato');

//Grupo de rotas quando acessar o painel
Route::prefix('painel')->group(function() {
    Route::get('/','Admin\HomeController@index')->name('admin');
    
    //Login
    Route::get('login','Admin\Auth\LoginController@index')->name('login');
    Route::post('login','Admin\Auth\LoginController@authenticate');
    Route::post('logout','Admin\Auth\LoginController@logout')->name('logout');

    //Registro de Novo Usuário
    Route::get('register','Admin\Auth\RegisterController@index')->name('register');
    Route::post('register','Admin\Auth\RegisterController@register');

    //Usuários
    Route::resource('users','Admin\UserController');

    //Perfil de Usuário
    Route::get('perfil','Admin\PerfilController@index')->name('perfil');
    Route::put('perfilsalvar','Admin\PerfilController@salvar')->name('perfil.salvar');
    
    //Textos fixos ----------------------------------------------------------------------------
    Route::get('textosfixos','Admin\TextoFixoController@index')->name('textosfixos');
    Route::get('textosfixosedit/{id}','Admin\TextoFixoController@edit')->name('textosfixos.edit');
    Route::put('textosfixossalvar/{id}','Admin\TextoFixoController@salvar')->name('textosfixos.salvar');
    //----------------------------------------------------------------------------------------    
    
    //Categoria de Notícias ------------------------------------------------------------------
    Route::get('noticiacat','Admin\NoticiacatController@index')->name('noticiascat');
    //adicao
    Route::get('noticiacatadd','Admin\NoticiacatController@add')->name('noticiascat.add'); //Tela de adição 
    Route::post('noticiacatadd','Admin\NoticiacatController@addAction'); //Ação de adição
    //edicao
    Route::get('noticiacat/{id}','Admin\NoticiacatController@edit')->name('noticiascat.edit');
    Route::post('noticiacat/{id}','Admin\NoticiacatController@editAction');
    //----------------------------------------------------------------------------------------

    //Vereadores ----------------------------------------------------------------------------
    Route::get('vereadores','Admin\VereadorController@index')->name('vereadores');
    //adicao
    Route::get('vereadoresadd','Admin\VereadorController@add')->name('vereadores.add'); //Tela de adição 
    Route::post('vereadoresadd','Admin\VereadorController@addAction'); //Ação de adição
    //edicao
    Route::get('vereadoresedit/{id}','Admin\VereadorController@edit')->name('vereadores.edit');
    Route::post('vereadoresedit/{id}','Admin\VereadorController@editAction');
    //exclusão
    Route::get('vereadoresdelete/{id}','Admin\VereadorController@del')->name('vereadores.del'); //Ação de deletar
    //----------------------------------------------------------------------------------------

    //Eventos --------------------------------------------------------------------------------
    Route::get('eventos','Admin\EventoController@index')->name('eventos');
    Route::get('eventosbusca','Admin\EventoController@busca')->name('eventos.busca');
    Route::get('eventosimg/{id}','Admin\EventoController@eventosimg')->name('eventos.eventosimg');
    Route::post('eventosimg/{id}','Admin\EventoController@eventosimgadd')->name('eventos.eventosimgadd');
    Route::get('eventosimgdel/{id}','Admin\EventoController@eventosimgdel')->name('eventos.eventosimgdel');
    //adicao
    Route::get('eventosadd','Admin\EventoController@add')->name('eventos.add'); //Tela de adição 
    Route::post('eventosadd','Admin\EventoController@addAction'); //Ação de adição
    //edicao
    Route::get('eventosedit/{id}','Admin\EventoController@edit')->name('eventos.edit');
    Route::post('eventosedit/{id}','Admin\EventoController@editAction');
    //exclusão
    Route::get('eventosdelete/{id}','Admin\EventoController@del')->name('eventos.del'); //Ação de deletar
    //----------------------------------------------------------------------------------------

    //Configurações gerais do site -----------------------------------------------------------
    Route::get('config','Admin\ConfigController@index')->name('config');
    Route::put('configsalvar','Admin\ConfigController@salvar')->name('config.salvar');
    //----------------------------------------------------------------------------------------

    //Registros PDF --------------------------------------------------------------------------
    Route::get('registrospdf/{categoria}','Admin\RegistroPDFController@index')->name('registrospdf'); //Tela 
    Route::post('registrospdf/{categoria}','Admin\RegistroPDFController@insere')->name('registrospdfinsere'); //Tela busca
    Route::get('registrospdfbusca/{categoria}','Admin\RegistroPDFController@busca')->name('registrospdfbusca'); //Tela busca    
    Route::get('registrospdfdeleta/{categoria}/{id}','Admin\RegistroPDFController@del')->name('registrospdfdeleta'); //Tela busca    
    //----------------------------------------------------------------------------------------

    //Notícias --------------------------------------------------------------------------------
    Route::get('noticias','Admin\NoticiaController@index')->name('noticias');
    Route::get('noticiasbusca','Admin\NoticiaController@busca')->name('noticias.busca');
    Route::get('noticiasimg/{id}','Admin\NoticiaController@noticiasimg')->name('noticias.noticiasimg');
    Route::post('noticiasimg/{id}','Admin\NoticiaController@noticiasimgadd')->name('noticias.noticiasimgadd');
    Route::get('noticiasimgdel/{id}','Admin\NoticiaController@noticiasimgdel')->name('noticias.noticiasimgdel');
    //adicao
    Route::get('noticiasadd','Admin\NoticiaController@add')->name('noticias.add'); //Tela de adição 
    Route::post('noticiasadd','Admin\NoticiaController@addAction'); //Ação de adição
    //edicao
    Route::get('noticiasedit/{id}','Admin\NoticiaController@edit')->name('noticias.edit');
    Route::post('noticiasedit/{id}','Admin\NoticiaController@editAction');
    //exclusão
    Route::get('noticiasdelete/{id}','Admin\NoticiaController@del')->name('noticias.del'); //Ação de deletar
    //muda status publicação e slider
    Route::get('mudapublicar/{id}','Admin\NoticiaController@mudapublicar')->name('noticias.mudapublicar');
    Route::get('mudaslider/{id}','Admin\NoticiaController@mudaslider')->name('noticias.mudaslider');
    

    //----------------------------------------------------------------------------------------
    
});