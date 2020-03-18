<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iccid;

class IccidController extends Controller
{

    // Viene de web.php y muestra los totales de ICCIDS
    public function IccidMain()
    {
        $agencias = Iccid::raw()->distinct('agencia');
        $estados  = Iccid::raw()->distinct('estado');

        $totales = Iccid::raw(function($collection)
        {
            return $collection->aggregate(
                [
                    ['$group' => [
                        '_id' => ['agencia'=>'$agencia', 'estado'=>'$estado'],
                        'cantidad'=> ['$sum'=>1]
                        ]
                    ],
                    ['$group' => [
                        '_id' => '$_id.agencia',
                        'estados' => [
                            '$addToSet' => [
                                'estado'=>'$_id.estado',
                                'cantidad'=>'$cantidad'
                                ]
                            ]
                        ]
                    ],
                    [
                        '$sort' => [ '_id' => 1 ]
                    ]
                ]
            );  
        });
        return view('inicio',['totales' => $totales ]
            );
        }

    // Viene de web.php y muestra la vista de revision de cajas
    public function IccidCajasRevision()
    {
        return view('CajasRevision');
        }

    // Viene de web.php y muestra el detalle de chips a revisar por caja
    public function IccidCajaDetalle($idcaja)
    {
        $chips= Iccid::select('_id','estado')
        ->where('caja','=',$idcaja)
        ->where('estado','!=','USADO')
        ->get();
        return view('CajaDetalle',['chips' => $chips, 'caja' => $idcaja]);
        }

    // Viene de API y muestra las cajas a inspeccionar con sus totales
    public function IccidDameCajasRevision()
    {

        $cajas = Iccid::raw(function($collection)
        {
            return $collection->aggregate(
                [
                    ['$match' => [
                        'caja' => [ '$regex'=> '^GEMALTO|^WCM' ],
                        ]
                    ],
                    ['$match' => [
                        'estado' => [ '$nin' =>['USADO'] ],
                        ]
                    ],
                    ['$group' => [
                        '_id' => ['caja'=>'$caja', 'estado'=>'$estado'],
                        'cantidad'=> ['$sum'=>1]
                        ]
                    ],
                    ['$group' => [
                        '_id' => '$_id.caja',
                        'estados' => [
                            '$addToSet' => [
                                'estado'=>'$_id.estado',
                                'cantidad'=>'$cantidad'
                                ]
                            ]
                        ]
                    ],
                    [
                        '$sort' => [ '_id' => 1 ]
                    ]
                ]
            );  
        });
        return $cajas;
        }

    // Viene de API y muestra los totales de ICCIDS
    public function encuentraIccid(Request $request, $iccid)
    {
        $chip= Iccid::select()
        ->where('_id','=',$iccid)
        ->get();
        return $chip;
    }

}
