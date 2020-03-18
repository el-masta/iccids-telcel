<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Telefono;

class TelController extends Controller
{

    // Viene de web.php y muestra la vista de llamadas
    public function TelLlamadas()
    {
        return view('llamadas');
        }

    // Viene de API y muestra las cajas a inspeccionar con sus totales
    public function DameNumeroParaLlamar()
    {

      $tel = Telefono::raw(function($collection)
      {return $collection->aggregate(
            [
                  ['$match' => ['estado' => 'libre'] ],
                  ['$sample' => ['size' => 1 ] ]
            ]
         );
      });

        $tel2 = Telefono::find($tel[0]->_id);
        $tel2->estado = 'ocupado';
        $tel2->save();
        return $tel2;
        }

    // Viene de API y muestra las cajas a inspeccionar con sus totales
    public function liberaNumero($numero)
    {
         $tel = Telefono::find($numero);
         $tel->estado = 'libre';
         $tel->save();

        return $numero.' liberado';
        }

    // Viene de API y muestra las cajas a inspeccionar con sus totales
    public function ejecutaShell(Request $request)
    {
         $orden=$request->input('orden');
         $comando = shell_exec($orden);
         return 'Orden ejecutada: '.$orden;
        }

}
