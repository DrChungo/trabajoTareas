<?php


// funcion que crea una tarea y valida si hay ya tareas creadas
function createTask(&$data)
{
    echo "Título: ";
    $title = readline();
    echo "Descripción: ";
    $description = readline();

    // Validar fecha
    do {
        echo "Fecha límite (YYYY-MM-DD): ";
        $due_date = trim(readline());
        $fecha_valida = preg_match('/^\d{4}-\d{2}-\d{2}$/', $due_date) && strtotime($due_date) !== false;
        if (!$fecha_valida) {
            echo "Fecha no válida. Usa el formato YYYY-MM-DD.\n";
        }
    } while (!$fecha_valida);

    $tasks = $data["tasks"];
    $newId = empty($tasks) ? 1 : (end($tasks)["id"] + 1);

    $data["tasks"][] = [
        "id" => $newId,
        "title" => $title,
        "description" => $description,
        "due_date" => $due_date,
        "completed" => false
    ];

    echo "Tarea creada.\n";
}
