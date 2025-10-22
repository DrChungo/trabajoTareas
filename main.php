<?php
//CONFIG
$json = file_get_contents('C:\Users\Emiliano\Desktop\vsCode\DWES\TrabajoTareas\tareas.json');

$data = json_decode($json, true);



function menu()
{

    echo "\n===== GESTOR DE TAREAS =====\n";
    echo "1) Listar tareas\n";
    echo "2) Añadir tarea\n";
    echo "3) Editar tarea\n";
    echo "4) Marcar tarea como completada\n";
    echo "5) Eliminar tarea\n";
    echo "6) Guardar\n";
    echo "0) Salir\n";
}




function addTask(&$json, $title, $description, $due_date, $completed = false)
{

    $tasks = $json["tasks"];
    $newId = end($tasks)["id"] + 1;

    $newTask = [
        "id" => $newId,
        "title" => $title,
        "description" => $description,
        "due_date" => $due_date,
        "completed" => $completed
    ];

    $json["tasks"][] = $newTask;

    return $json;
}


function writeTask()
{

    echo "introduce un titulo";
    $title = readline();
    echo "introduce una descripcion";
    $description = readline();
    echo "Fecha limite";
    $due_date = readline();
    echo "Esta la tarea completada? (s/n)";
    $completed = readline();


    while ($completed !== "s" && $completed !== "n") {
        echo "Introduce 's' para sí o 'n' para no: ";
        $completed = readline();
    }

    if ($completed == "s") {
        $completed = true;
    } else {

        $completed = false;
    }

    return [
        "title" => $title,
        "description" => $description,
        "due_date" => $due_date,
        "completed" => $completed
    ];
}


//Funcion que elimina una tarea y las reorganiza
function deleteTask(&$json, $idToDelete)
{

    foreach ($json["tasks"] as $i => $task) {

        if ($task["id"] == $idToDelete) {

            unset($json["tasks"][$i]);
            $json["tasks"] = array_values($json["tasks"]);

            return true;
        }
    }

    return false;
}

function completeTask(&$json, $idToComplete)
{

    foreach ($json["tasks"] as &$task) {


        if ($task["id"] == $idToComplete) {

            $task["completed"] = true;
            return true;
        }
    }
    return false;
}

function showTasks($data)
{
    foreach ($data['tasks'] as $task) {

        $status = $task["completed"] ? "Completada" : "Pendiente";
        echo "Titulo: " . $task["title"] . " | Estado: " . $status . "\n";
    }
}


function editTask(&$json, $idToEdit)
{
    foreach ($json["tasks"] as &$task) {

        if ($task["id"] == $idToEdit) {

            $newTaskData =  writeTask();

            $task["title"] = $newTaskData["title"];
            $task["description"] = $newTaskData["description"];
            $task["due_date"] = $newTaskData["due_date"];
            $task["completed"] = $newTaskData["completed"];

            return true;
        }
    }
}


if (deleteTask($data, 2)) {
    echo "Tarea eliminada correctamente.\n";
} else {
    echo "No se encontró una tarea con ese ID.\n";
}

if (completeTask($data, 3)) {
    echo "Tarea marcada como completada.\n";
} else {
    echo "No se encontró una tarea con ese ID.\n";
}


$taskData = writeTask();
function saveData($file, $data)
{
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}





//Aqui se ejecuta el codigo con sus funciones

//Es el main
do {
    menu();
    $op = trim(readline("Elije una opcion"));

    switch ($op) {
        case '1':
            showTasks($data);
            break;
        case '2':
            showTasks($data);
            break;
        case '3':
            showTasks($data);
            break;
        case '4':
            showTasks($data);
            break;
        case '1':
            showTasks($data);
            break;

        default:
            # code...
            break;
    }
} while ($op !== 0);

//addTask($data, "Hacer ejercicio", "Correr 30 minutos", "2025-10-20", false);
file_put_contents('C:\Users\Emiliano\Desktop\vsCode\DWES\TrabajoTareas\tareas.json', json_encode($data, JSON_PRETTY_PRINT));
