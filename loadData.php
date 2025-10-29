<?php

//Funcion que cargaa el archivo y verifica si existe
function loadData($file)
{
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $data = json_decode($json, true);
        if (!is_array($data) || !isset($data['tasks']) || !is_array($data['tasks'])) {
            return ['tasks' => []];
        }
        return $data;
    }
    return ['tasks' => []];
}
