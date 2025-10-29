<?php
function showTasks($data)
{
    if (!isset($data['tasks']) || !is_array($data['tasks'])) {
        echo "No hay tareas.\n";
        return;
    }

    foreach ($data['tasks'] as $task) {
        $status = !empty($task["completed"]) ? "Completada" : "Pendiente";
        echo "ID: {$task['id']} | Título: {$task['title']} | Estado: $status\n";
    }
}
