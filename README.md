=====INSTALACION=====

Decarga todos los archivos y añadelos a una carpeta todo junto.Ademas de tener descargado php en tu PC . Abre una terminal dentro de la carpeta , haciendo click derecho dentro de la carpeta y abrir en terminal.
A continuacion ejecuta el comando "php main.php" para ejecutar el programa.
Una vez echo esto te aparecera un menu con las instrucciones.

====EXPLICACION DE LA APLICACION ======

Aplicacion que sirve para listarte tus tareas pendientes.

Cada tarea tiene los siguentes datos: Titulo , Descripcion, fecha a entregar/completar y si esta completada.

Puedes realizar las siguentes funciones:

-Listar tareas: te muesta las tareas en la lista, aunque esten completadas o no.

-Añadir tarea: Te añade una tarea y te la pone por defecto en no completada. Ademas te pide los datos mencionadoas enteriormente.

-Editar tarea: edita una tarea ya creada. esta no te pide si la quieres completar.

-Marcar completada: Maraca como completada pero no la elimina.

-Eliminar tarea: Elimina una tarea del todo.

Ademas las tareas se guardan en un JSON con la sigiente estructura:

{
    "tasks": [
        {
            "id": 1,
            "title": "llamar a yago",
            "description": "Echo de menos a yaguete (lo amo)",
            "due_date": "2025-11-07",
          "completed": false
        }
    ]
}
