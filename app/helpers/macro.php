<?php

Form::macro('dropdownbox', function($table, $id, $nome, $nomeCampo, $opcoes = array()){

    $dados = DB::table($table)
                ->select($id, $nome)
                ->orderBy($nome)
                ->get();

    $opcoesArray = [''];

    foreach($dados as $dado){

        $opcoesArray[$dado->$id] = $dado->$nome;
    }

    return Form::select($nomeCampo, $opcoesArray, null, $opcoes);
});