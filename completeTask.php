<?php
function completeTask(&$data)
{
    $id = (int)readline("ID de la tarea a marcar completada: ");
    foreach ($data["tasks"] as &$task) {
        if ($task["id"] == $id) {
            $task["completed"] = true;
            echo "Tarea marcada como completada.\n";
            return;
        }
    }
    echo "No se encontró la tarea.\n";
}
