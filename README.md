#### Pasos para ejecutar el proyecto ###
## Configuración ##
Es necesario crear un archivo de entorno para realizar las configuraciones globales
1. Crear en la raíz un archivo .ENV
2. Una vez creado es necesario añadir los parámetros de configuracion de base de datos. Ejemplo:
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={ruta del archivo de base de datos en caso de SQLite}
DB_USERNAME=test
DB_PASSWORD=password (si es que se cuenta con una, de lo contrario dejar en blanco)

## Composer ##
Ejecutar el comando:
composer install
Esto instalará todas las dependencias y paquetes que necesita el proyecto

## Migraciones ##
Se de arranxar con las migraciones para crear el esquema de la base de datos donse de va a trabajar.
Ejecutar el siguiente comando:
php artisan migrate

Posteriormeente se debe ejecutar los seeds, para poder cargar datos iniciales (opcional):
php artisan make:seeder DatabaseSeeder

## Ejecución ##
Finalmente, ejecutamos el proyecto con el comando:
php artisan serve

