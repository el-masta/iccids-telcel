<?php

// ICCIDS
Route::get('/', 'IccidController@IccidMain' );
Route::get('/cajas-revision', 'IccidController@IccidCajasRevision' );
Route::get('/caja-detalle/{idcaja}', 'IccidController@IccidCajaDetalle' );

//TELEFONOS
Route::get('/llamadas', 'TelController@TelLlamadas' );

