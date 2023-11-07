<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use App\Models\Nota;
use Illuminate\Support\Facades\Log;

class NotasController extends Controller implements InterfaceController
{
    private $notas;
    public function __construct(){
        $this->notas = new Nota();
    }
    public function index()
    {
        $notas = $this->notas->getNotas();
        return response()->json($notas, 200);
    }

    public function agrupar()
    {
        $notas = $this->notas->getNotas();
        $notasCollection = collect($notas);
        $notasOrdenadas = $notasCollection->sortBy('cnpj_remete', SORT_REGULAR, true)->values();
        return response()->json($notasOrdenadas, 200);
    }
    public function totaisEntregas()
    {
        $notas = $this->notas->getNotas();
        $notasCollection = collect($notas);
        $total = $notasCollection->groupBy('cnpj_remete')->map(function ($row) {
            return $row->sum('valor');
        });

        return response()->json($total, 200);
    }
    public function totaisConcluidos()
    {
        $notas = $this->notas->getNotas();

        $notasEntregues = [];
        foreach ($notas as $row) {
            if (isset($row->dt_entrega)) {
                /**
                 * Convertendo as strings para datas legíveis pelo interpretador
                 */
                $dt_emis = str_replace("/", "-",
                    $row->dt_emis);
                $dt_emis = strtotime($dt_emis);

                $dt_entrega = str_replace("/", "-",
                    $row->dt_entrega);
                /**
                 * Convertengo as strings para datas e convertendo para dias
                 */
                $dt_entrega = strtotime($dt_entrega);
                $secs = $dt_entrega - $dt_emis;
                $days = $secs / 86400;
                /**
                 * Verificando se a diferença de dias e menor que 2
                 */
                if($days <=2){
                    $notasEntregues[] = $row;
                }
            }
        }

        $notasCollection = collect($notasEntregues);

        $notasOrdenadas = $notasCollection->sortBy('cnpj_remete', SORT_REGULAR, true)->values();
        $total = $notasOrdenadas->groupBy('cnpj_remete')->map(function ($row) {
            return $row->sum('valor');
        });

        return response()->json($total, 200);
    }
    public function totaisNaoConcluidos()
    {
        $notas = $this->notas->getNotas();

        $notasEntregues = [];
        foreach ($notas as $row) {
            $secs = 0;
            /**
             * Convertendo as strings para datas legíveis pelo interpretador
             */
            $dt_emis = str_replace("/", "-",
                $row->dt_emis);
            $dt_emis = strtotime($dt_emis);
            if(isset($row->dt_entrega)){
                $dt_entrega = str_replace("/", "-",
                    $row->dt_entrega);
                /**
                 * Convertengo as strings para datas e convertendo para dias
                 */
                $dt_entrega = strtotime($dt_entrega);
                $secs = $dt_entrega - $dt_emis;
                $days = $secs / 86400;
            }
            /**
             * Verificando se a diferença de dias e maior que 2
             */
            if($days > 2){
                $notasEntregues[] = $row;
            }
        }

        $notasCollection = collect($notasEntregues);
        $notasOrdenadas = $notasCollection->sortBy('cnpj_remete', SORT_REGULAR, true)->values();
        $total = $notasOrdenadas->groupBy('cnpj_remete')->map(function ($row) {
            return $row->sum('valor');
        });

        return response()->json($total, 200);
    }
    public function vaiReceber($id){
        $notas = $this->notas->getNotas();
        $notasEntregues = [];
        foreach ($notas as $row) {
            if (isset($row->dt_entrega)) {
                /**
                 * Convertendo as strings para datas legíveis pelo interpretador
                 */
                $dt_emis = str_replace("/", "-",
                    $row->dt_emis);
                $dt_emis = strtotime($dt_emis);

                $dt_entrega = str_replace("/", "-",
                    $row->dt_entrega);
                /**
                 * Convertengo as strings para datas e convertendo para dias
                 */
                $dt_entrega = strtotime($dt_entrega);
                $secs = $dt_entrega - $dt_emis;
                $days = $secs / 86400;
                /**
                 * Verificando se a diferença de dias e menor que 2
                 */
                if($days <=2){
                    $notasEntregues[] = $row;
                }
            }
        }
        $notasCollection = collect($notasEntregues);
        $total = $notasCollection->groupBy('cnpj_remete')->map(function ($row) {
            return $row->sum('valor');
        });
        $value = $total->get($id);
        if ($value == null){
            $value = 0;
        }
        $value =
        [
            "valor" => $value
        ];
        return response()->json($value, 200);
    }
    public function deixouDeReceber($id){
        $notas = $this->notas->getNotas();
        $notasEntregues = [];
        foreach ($notas as $row) {
            $secs = 0;
            /**
             * Convertendo as strings para datas legíveis pelo interpretador
             */
            $dt_emis = str_replace("/", "-",
                $row->dt_emis);
            $dt_emis = strtotime($dt_emis);
            if(isset($row->dt_entrega)){
                $dt_entrega = str_replace("/", "-",
                    $row->dt_entrega);
                /**
                 * Convertengo as strings para datas e convertendo para dias
                 */
                $dt_entrega = strtotime($dt_entrega);
                $secs = $dt_entrega - $dt_emis;
                $days = $secs / 86400;
            }
            /**
             * Verificando se a diferença de dias e maior que 2
             */
            if($days > 2){
                $notasEntregues[] = $row;
            }
        }
        $notasCollection = collect($notasEntregues);
        $total = $notasCollection->groupBy('cnpj_remete')->map(function ($row) {
            return $row->sum('valor');
        });
        $value =
        [
            "valor" => $total->get($id)
        ];
        return response()->json($value, 200);
    }

}
