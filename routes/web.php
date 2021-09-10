<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Extras
Route::get('/contato', 'Extras\ContatoController@index')->name('contato');
Route::post('/contato', 'Extras\ContatoController@send');
Route::get('/index', 'Extras\AberturaController@index')->name('abertura');

//Dashboard
Route::get('/dashboard/{dta}', 'Dashboard\DashboardController@index')->name('dashboard');
Route::get('/simulador/{dta}', 'Dashboard\SimuladorController@index')->name('dashboard.simulador');
Route::get('/propriedade/{id}/{dta}', 'Dashboard\PropriedadesController@index')->name('dashboard.propriedade');
Route::get('/efetividade/{dta}/items', 'Dashboard\Analise_itemsController@index')->name('dashboard.items');

//Adm
Route::get('/abertura_adm', 'Adm\AberturaController@index')->name('adm.abertura');

    //Adm Items
    Route::get('/administrativo', 'Adm\AdmController@index')->name('adm');
    Route::post('/administrativo', 'Adm\AdmController@index');
    Route::get('/adicionar', 'Adm\AdmController@adicionar')->name('adm.adicionar');
    Route::get('/editar/{id}', 'Adm\AdmController@editar')->name('adm.editar');
    Route::post('/adicionar', 'Adm\AdmController@store');
    Route::post('/editar/{id}', 'Adm\AdmController@put');
    Route::delete('adm/remover/{id}', 'Adm\AdmController@destroy');

    //Adm Vinculacao
    Route::get('/vinculacao/{id}', 'Adm\VinculacaoController@index')->name('adm.vinculacao');
    Route::post('/vinculacao/{id}', 'Adm\VinculacaoController@index');
    Route::get('/vinculados/{id}', 'Adm\VinculacaoController@vinculados')->name('adm.vinculados');
    Route::post('/vinculados/{id}', 'Adm\VinculacaoController@vinculados');
    Route::post('/vinculacao_store/{id}', 'Adm\VinculacaoController@vincula')->name('adm.vinculacao_store');;
    Route::delete('vinculacao/remover/{id}', 'Adm\VinculacaoController@destroy');

    //Adm Equipes
    Route::get('/equipe', 'Adm\EquipeController@index')->name('adm.equipe');
    Route::post('/equipe', 'Adm\EquipeController@index');
    Route::get('/equipe/adicionar', 'Adm\EquipeController@adicionar')->name('adm.equipe.adicionar');
    Route::post('/equipe/adicionar', 'Adm\EquipeController@store');
    Route::get('/equipe/editar/{id}', 'Adm\EquipeController@editar')->name('adm.equipe.editar');
    Route::post('/equipe/editar/{id}', 'Adm\EquipeController@put');
    Route::delete('equipe/remover/{id}', 'Adm\EquipeController@destroy');


//Dashboard_adm

Route::get('/dashboard_adm/mosaico/{dta}', 'Dashboard_adm\GestaoMosaicoController@index')->name('gestao.mosaico');
Route::get('/abertura_gestao/{dta}', 'Dashboard_adm\GestaoAberturaController@index')->name('gestao.abertura');
Route::get('/dashboard_adm/index/{dta}', 'Dashboard_adm\Analise_rankingController@index')->name('gestao.ranking');
Route::get('/dashboard_adm/index/{dta}/items', 'Dashboard_adm\Analise_itemsController@index')->name('gestao.items');
Route::get('/prod/{dta}', 'Dashboard_adm\ProdController@index')->name('gestao.prod');


//Dashboard_adm VisaoTotal
    Route::get('/dashboard_adm/visaoTotal/{dta}', 'Dashboard_adm\visaoTotal\DashboardController@index')->name('gestao.visaoTotal');
    Route::get('/dashboard_adm/visaoTotal/simulador/{dta}', 'Dashboard_adm\visaoTotal\SimuladorController@index')->name('gestao.visaoTotal_simulador');
    Route::get('/dashboard_adm/visaoTotal/propriedade/{id}/{dta}', 'Dashboard_adm\visaoTotal\PropriedadesController@index')->name('gestao.visaoTotal_propriedade');

//At
Route::get('/atualizacao_manual/{id}', 'Atualizacao\At_manualController@atualizacao_manual')->name('at.manual');
Route::post('/atualizacao_manual/{id}', 'Atualizacao\At_manualController@put');
Route::post('/atualizacao_manual/{id}/nova_data', 'Atualizacao\At_manualController@storeNova_data');
Route::get('/atualizacao_automatica', 'Atualizacao\Importar_autController@index')->name('importar');
Route::get('/atualizacao_ext', 'Atualizacao\Atualizacao_extController@index')->name('atualizacao_abertura');
Route::get('/atualizacao_prod', 'Atualizacao\Importar_prodController@index')->name('importarProd');
Route::get('/atualizar', 'Atualizacao\Atualizar_autController@index')->name('atualizar.show');
Route::post('/atualizar', 'Atualizacao\Atualizar_autController@store');
Route::post('/atualizacao_prod', 'Atualizacao\Importar_prodController@import');
Route::post('/atualizacao_automatica', 'Atualizacao\Importar_autController@import');
Route::get('/atualizacao_success', 'Atualizacao\Atualizar_autController@at_success')->name('atualizacao_success');
Route::post('/at_manual/excluirDia/{id}', 'Atualizacao\At_manualController@delete');


//Autentica
Route::get('/adm/login', 'Autentica\AuthController@login_adm')->name('login_adm');
Route::post('/adm/login', 'Autentica\AuthController@login_validate');
Route::get('/equipe/login', 'Autentica\AuthEquipeController@login')->name('login');
Route::post('/equipe/login', 'Autentica\AuthEquipeController@login_validate');
Route::get('/registrar/{id}', 'Autentica\AuthController@registrar')->name('registrar');
Route::post('/registrar/{id}', 'Autentica\AuthController@store');
Route::get('/sair_adm', 'Autentica\AuthController@logout')->name('adm.sair');
Route::get('/sair', 'Autentica\AuthEquipeController@logout')->name('sair');

//Auth
Auth::routes();
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.update');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');


