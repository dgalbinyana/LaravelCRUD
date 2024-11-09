## Laravel CRUD (Hexagonal, SOLID, DDD)

### Descripción
Este proyecto implementa una API RESTful en Laravel para la gestión de usuarios, aplicando arquitectura hexagonal, principios SOLID y DDD. Este CRUD permite realizar operaciones básicas de creación, lectura, actualización y eliminación de usuarios, además de incluir eventos como el envío de un email de bienvenida.


### Requisitos
- Laravel 11
- PHP >= 8.1
- Configuración de servidor de correo para pruebas de envío de correos de bienvenida

### Instalación
1. Clona este repositorio en tu máquina.
2. Ejecuta `composer install` para instalar las dependencias.
3. Configura el archivo `.env` con los detalles de conexión a la base de datos.
4. Ejecuta las migraciones con:
   ```bash
   php artisan migrate
   
###
### Rutas del CRUD de Usuarios
###
#### 1. Crear usuario
- **URL**: `POST /users`
- **Descripción**: Crea un nuevo usuario en el sistema. Devuelve el ID del nuevo usuario.
- **Campos requeridos**:
    - `name` (max: 255)
    - `email` (único en la base de datos)
    - `password` (min: 6, max: 255)
- **Campos opcionales**:
    - `surname` (max: 255)
- **Ejemplo de petición**:
   ```json
   {
       "name": "John",
       "surname": "Doe",
       "email": "john.doe@example.com",
       "password": "securepassword"
   }
  
###
#### 2. Obtener usuario
- **URL**: `GET /users/{id}`
- **Descripción**: Obtiene los datos de un usuario específico mediante su ID.
- **Parámetros**:
    - `{id}` (UUID del usuario)
- **Ejemplo de petición**:
   ```plaintext
   GET /users/2ded9875-c7d2-4fe5-bed2-64870da99290

###
#### 3. Actualizar usuario
- **URL**: `PUT /users/{id}`
- **Descripción**: Actualiza la información de un usuario existente. Devuelve el `id`, `name`, `email`, y `surname`.
- **Campos requeridos**:
    - `name` (max: 255)
    - `actual_password`
- **Campos opcionales**:
    - `surname` (max: 255)
    - `email` (único en la base de datos excepto para el usuario actual)
    - `new_password` (min: 6, max: 255, requerido solo si `new_password_confirmation` está presente)
    - `new_password_confirmation` (min: 6, max: 255, se requiere si `new_password` está presente)
- **Ejemplo de petición**:
   ```plaintext
   PUT /users/2ded9875-c7d2-4fe5-bed2-64870da99290
   ```
   ```json
    {
        "name": "John Updated",
        "surname": "Doe",
        "email": "john.updated@example.com",
        "actual_password": "oldpassword",
        "new_password": "newsecurepassword",
        "new_password_confirmation": "newsecurepassword"
    }

###
#### 4. Eliminar usuario
- **URL**: `DELETE /users/{id}`
- **Descripción**: Elimina un usuario específico del sistema.
- **Parámetros**:
    - `{id}` (UUID del usuario)
- **Ejemplo de petición**:
   ```plaintext
   DELETE /users/2ded9875-c7d2-4fe5-bed2-64870da99290
