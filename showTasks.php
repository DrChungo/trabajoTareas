<?php
function showTasks($data)
{

    foreach ($data['tasks'] as $task) {
        $status = !empty($task["completed"]) ? "Completada" : "Pendiente";
        echo "ID: {$task['id']} | Título: {$task['title']} | Estado: $status\n";
    }
}
