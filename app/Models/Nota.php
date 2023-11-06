<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Nota extends Model
{
    use HasFactory;
    function getNotas(){
        $response = Http::get('http://homologacao3.azapfy.com.br/api/ps/notas');
        $objeto = json_decode($response);
        return $objeto;
    }
}
