<?php


function editTask(&$data)
{
    $id = (int)readline("ID de la tarea a editar: ");
    foreach ($data["tasks"] as &$task) {
        if ($task["id"] == $id) {
            echo "Nuevo título [{$task['title']}]: ";
            $title = trim(readline());
            if ($title !== "") $task["title"] = $title;

            echo "Nueva descripción [{$task['description']}]: ";
            $desc = trim(readline());
            if ($desc !== "") $task["description"] = $desc;

            echo "Nueva fecha límite [{$task['due_date']}]: ";
            $due = trim(readline());
            if ($due !== "") $task["due_date"] = $due;

            echo "Tarea actualizada.\n";
            return;
        }
    }
    echo "No se encontró la tarea.\n";
}
