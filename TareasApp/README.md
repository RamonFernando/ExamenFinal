# TareasApp - Sistema de Gestión de Tareas

Aplicación de consola en PHP para la gestión de tareas personales. Permite crear, visualizar, actualizar, eliminar y marcar tareas como completadas.

## Requisitos

- PHP 7.4 o superior
- Windows, Linux o macOS

## Instalación

1. Descarga o clona el proyecto
2. Asegúrate de tener PHP instalado
3. No se requieren dependencias adicionales

## Cómo usar la consola

### Windows

1. Abre el símbolo del sistema (CMD) o PowerShell:
   - Presiona `Win + R`, escribe `cmd` y presiona Enter
   - O busca "Símbolo del sistema" en el menú de inicio

2. Navega al directorio del proyecto:
   ```
   cd ruta\al\proyecto\Tareas_App
   ```

3. Verifica que PHP esté instalado:
   ```
   php -v
   ```

4. Ejecuta la aplicación:
   ```
   php gestor.php
   ```

### Linux / macOS

1. Abre la terminal:
   - Linux: `Ctrl + Alt + T` o busca "Terminal"
   - macOS: `Cmd + Espacio`, escribe "Terminal" y presiona Enter

2. Navega al directorio del proyecto:
   ```
   cd ruta/al/proyecto/Tareas_App
   ```

3. Verifica que PHP esté instalado:
   ```
   php -v
   ```

4. Ejecuta la aplicación:
   ```
   php gestor.php
   ```

## Uso

Ejecutar la aplicación:

```
php gestor.php
```

### Menú de opciones

```
=====================================
Bienvenido a la lista de tareas: 

Menu de Tareas:
1. Crear Tarea
2. Mostrar Tareas
3. Actualizar Tarea
4. Eliminar Tarea
5. Marcar Tarea Completada
0. Salir
=====================================
```

### Funcionalidades

**1. Crear Tarea**
- Título (obligatorio)
- Descripción (opcional, por defecto "Unknown")
- Fecha en formato YYYY-MM-DD (opcional, por defecto fecha actual)
- Estado se establece automáticamente como "Pendiente"

**2. Mostrar Tareas**
- Muestra todas las tareas con ID, título, descripción, estado y fecha

**3. Actualizar Tarea**
- Seleccionar tarea por ID
- Actualizar título, descripción o fecha (dejar vacío para mantener)
- El estado no se puede cambiar desde aquí

**4. Eliminar Tarea**
- Seleccionar tarea por ID
- Elimina la tarea seleccionada

**5. Marcar Tarea Completada**
- Seleccionar tarea por ID
- Muestra información completa de la tarea
- Si está pendiente, la marca como completada
- Si ya está completada, muestra mensaje informativo

## Estructura del Proyecto

```
Tareas_App/
├── gestor.php
├── GlobalUsing.php
├── src/
│   ├── App/app.php
│   ├── Controllers/
│   │   ├── Create.php
│   │   ├── Update.php
│   │   ├── Delete.php
│   │   ├── Ready.php
│   │   └── CheckTask.php
│   ├── Models/Task.php
│   ├── Services/
│   │   ├── LoadJson.php
│   │   └── SaveJson.php
│   ├── Helpers/Helpers.php
│   ├── Views/Views.php
│   └── Data/task.json
```

## Formato de Datos

Las tareas se almacenan en `src/Data/task.json`:

```json
[
    {
        "id": 1,
        "titulo": "Ejemplo de tarea",
        "descripcion": "Descripción",
        "fecha": "2024-12-31",
        "completada": false
    }
]
```

## Notas

- El archivo `task.json` se crea automáticamente si no existe
- Las tareas sin título no se cargan desde el JSON
- El ID se genera automáticamente
- Aplicación de consola (CLI), no web
