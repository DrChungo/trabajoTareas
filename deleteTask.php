<?php

//funcion que elimina la tarea y las reorganiza
function deleteTask(&$data)
{
    $id = (int)readline("ID de la tarea a eliminar: ");
    foreach ($data["tasks"] as $i => $task) {
        if ($task["id"] == $id) {
            unset($data["tasks"][$i]);
            $data["tasks"] = array_values($data["tasks"]);
            
            // Reasigna los IDs secuencialmente
            foreach ($data["tasks"] as $index => &$t) {
                $t["id"] = $index + 1;
            }

            echo "Tarea eliminada y IDs reorganizadas.\n";
            return;
        }
    }
    echo "No se encontró la tarea.\n";
}
