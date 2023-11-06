<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Nota;
use Illuminate\Support\Facades\Log;

class NotasController extends Controller
{
    private $notas;
    public function __construct(){
        $this->notas = new Nota();
    }
    public function index()
    {
        $notas = $this->notas->getNotas();
        return response()->json($notas);
    }

    public function agrupar()
    {
        $notas = $this->notas->getNotas();
        $notasCollection = collect($notas);
        $notasOrdenadas = $notasCollection->sortBy('cnpj_remete', SORT_REGULAR, true)->values();
        return response()->json($notasOrdenadas);
    }
    public function totais()
    {
        $notas = $this->notas->getNotas();
        $notasCollection = collect($notas);
        $notasOrdenadas = $notasCollection->sortBy('cnpj_remete', SORT_REGULAR, true)->values();
        $total = $notasOrdenadas->groupBy('cnpj_remete')->map(function ($row) {
            return $row->sum('valor');
        });

        return response()->json($total);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
