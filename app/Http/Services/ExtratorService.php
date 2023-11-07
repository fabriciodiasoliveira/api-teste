<?php
 namespace App\Http\Services;

class ExtratorService
{
    public function extraiRemetentesQueReceberam($notas)
    {
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
    return $notasEntregues;
    }
    public function extraiRemetentesQueNaoReceberam($notas){
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
        return $notasEntregues;
    }
}
