# README - Proyecto API Beneficios - Prueba técina kuantaz

## Descripción

Este proyecto es una API REST para obtener información sobre beneficios agrupados por año. La documentación OpenAPI está incluida y se puede consultar para probar los endpoints.

---

## Requisitos

- PHP >= 8.x  
- Composer  
- Laragon (opcional pero recomendado para levantar el proyecto rápido)  

---

## Levantar el proyecto con Laragon

1. **Clona el repositorio**

```bash
git clone https://tu-repositorio.git
cd nombre-del-proyecto
```

2. **Copiar .env**
- Se debe agregar al .env la siguiente variable de entorno
    - KUANTAZ_API_URL='https://run.mocky.io/v3/'

3. **Ejecutar comandos**
- Ejecutar los comandos
    - Composer install
    - php artisan key:generate

## Otros puntos
    - El archivo postman se encuentra en ./storage/Prueba Técnica Kuantaz.postman_collection.json
        - Considerar que el proyecto se levanto con laragon, de ser necesario se debe cambiar la ruta una ves levantada la colección de postman
    - Puede revisar la documentacion en la ruta ```api/documentation```
