<?php

use Illuminate\Http\Request;

// ICCIDS
Route::get('/iccids/encontrar/{iccid}', 'IccidController@encuentraIccid' );
Route::get('/cajas-revision', 'IccidController@IccidDameCajasRevision' );

//TELEFONOS
Route::get('/damenumero', 'TelController@DameNumeroParaLlamar' );
Route::get('/liberanumero/{numero}', 'TelController@liberaNumero' );
Route::post('/shell', 'TelController@ejecutaShell' );