FormularioDiagnostico

Requisitos

- PHP 8+
- PostgreSQL

Instalación Rápida

1. clonarr Repositorio:
    
    git clone [URL_DE_TU_REPOSITORIO]
 

2.  Base de Datos:
    - Crea una base de datos en PostgreSQL llamada "formulario".
    - Ejecuta el script `sql/database.sql` en esa base de datos.

3.  Configuración:
    - abre el archivo ".env.example" y renómbralo a `.env`.
    - Rellena tus credenciales de la base de datos en el nuevo archivo `.env`.

4.  iniciar Servidor:
    - Desde la raíz del proyecto, ejecuta en la terminal:
    
    php -S localhost:8000


5. Abrir en Navegador:
    - Ve a `http://localhost:8000`