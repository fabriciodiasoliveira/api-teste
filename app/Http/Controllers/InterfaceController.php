<?php

    namespace App\Http\Controllers;

    interface InterfaceController {
        public function index();
        public function agrupar();
        public function totaisEntregas();
        public function totaisConcluidos();
        public function totaisNaoConcluidos();
        public function totaisNaoRecebidos();
    }
