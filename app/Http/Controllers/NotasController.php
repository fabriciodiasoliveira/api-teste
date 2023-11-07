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
        return response()->json($notasOrdenadas);
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
            if ($row->status == 'COMPROVADO') {
                $dt_emis = str_replace("/", "-",
                    $row->dt_emis);
                $dt_emis = strtotime($dt_emis);

                $dt_entrega = str_replace("/", "-",
                    $row->dt_entrega);
                if($dt_entrega != null){
                    $dt_entrega = strtotime($dt_entrega);
                }

                $secs = $dt_entrega - $dt_emis;
                $days = $secs / 86400;
                if($days >=2){
                    $notasEntregues[] = $row;
                }
            }
            Log::info($row->nome_remete);
            Log::info($row->status);
            Log::info($row->dt_emis);
            if(isset($row->dt_entrega)){
                Log::info($row->dt_entrega);
            }
            Log::info($dt_entrega);
            Log::info($row->valor);
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
            if ($row->status == 'ABERTO') {
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
    public function totaisNaoRecebidos(){

    }
}
