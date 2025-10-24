<?php
//CONFIG

$FILE = "C:\Users\Emiliano\Desktop\vsCode\DWES\TrabajoTareas\tareas.json";


function loadData($file)
{
    if (file_exists($file)) {

        $json = file_get_contents($file);
        $data = json_decode($json, true);

        return $data;
    }
}


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


//Guarda en JSON ,lo deja con un formato legible y elimina los simbolos especiales
function saveData($file, $data)
{
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function addTask($file, $title, $description, $due_date, $completed = false)
{

    $tasks = $file["tasks"];
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








function findTaskById($json, $id)
{


    foreach ($json["tasks"] as $i => $task) {

        if ((int)$task["id"] === (int)$id) return $i;
    }
    return -1;
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
            echo "añadir nueva tarea: \n";
            $t = writeTask();
            $new = addTask($data, $t["title"], $t["description"], $t["due_date"]);
            saveData($FILE, $data);
            echo "Tarea creada";

            break;
        case '3':
            $id = (int)readline(("ID de la tarea a editar: "));
            if (!editTask($data, $id)) {
                echo "No se encontro la tarea con ese ID.\n";
            } else {

                saveData($FILE, $data);
                echo "Tarea guardada";
            }

            break;


        case '4':
            $id = (int)readline("Introduce el ID de la tarea");

            if (completeTask($json, $id)) {
                saveData($FILE, $data);
                echo "Tarea guardada correctamente";
            } else {
                echo "No se encontro la tarea";
            }
            break;

        case '5':
            $id = (int)readline("Introduce el id de la tarea a eliminar: ");
            if (findTaskById($data, $id) === -1) {

                echo "la tarea no existe";
            
                break;
            }
            if (deleteTask($data,$id)) {
                saveData($FILE,$data);

                echo "tarea eliminada";
            }

            break;
        case '6':
            showTasks($data);
            break;
        default:

            break;
    }
} while ($op !== 0);

//addTask($data, "Hacer ejercicio", "Correr 30 minutos", "2025-10-20", false);
