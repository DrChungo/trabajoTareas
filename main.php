<?php
require_once "loadData.php";
require_once "saveData.php";
require_once "showTasks.php";
require_once "createTask.php";
require_once "editTask.php";
require_once "completeTask.php";
require_once "deleteTask.php";
require_once "menu.php";

$FILE = __DIR__ . "/tareas.json";

do {
    $data = loadData($FILE);
    menu();
    $op = trim(readline("Elije una opción (0-5): "));

    switch ($op) {
        case '1':
            showTasks($data);
            break;
        case '2':
            createTask($data);
            saveData($FILE, $data);
            break;
        case '3':
            showTasks($data);
            editTask($data);
            saveData($FILE, $data);
            break;
        case '4':
            showTasks($data);
            completeTask($data);
            saveData($FILE, $data);
            break;
        case '5':
            showTasks($data);
            deleteTask($data);
            saveData($FILE, $data);
            break;
        case '0':
            echo "Saliendo...\n";
            break;
        default:
            echo "Opción no válida.\n";
            break;
    }
} while ($op !== '0');


