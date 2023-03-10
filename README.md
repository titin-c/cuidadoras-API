# cuidadoras-API

## Table of Contents
1. [API](#api)
2. [Plugin](#plugin)
3. [Theme](#theme)
4. [Installation](#installation)
5. [Integration (elementor PRO)](#integration)

### API
***
##### Conexión POST
Creación del Custom Post Type: aiudocarerjob

```
https://cuidadoras.aiudo.es/wp-json/api/v1/insertar_ofeta
```
Body
```
{
    "post_title": "Oferta",
    "post_content": "Lunes de 10:30 a 11:30 y de 21:00 a 22:00, Martes de 10:30 a 11:30 y de 21:00 a 22:00, Miércoles de 10:30 a 11:30 y de 21:00 a 22:00, Jueves de 10:30 a 11:30 y de 21:00 a 22:00 y Viernes de 10:30 a 11:30 y de 21:00 a 22:00.",
    "acj_job_country": "España",
    "acj_job_community": "Cataluña",
    "acj_tax_provincia" : "Barcelona",
    "acj_tax_tipo" : "Interna fin de semana",
    "acj_att_salary" : "1200",
    "acj_att_week_hours": "40",
    "acj_desc_user_attributes": "<ul><li>Sufrió un ictus.</li><li>Toma tranquimacin para dormir.</li><li>Movilidad reducida.</li><li>Hemiplegia.</li><li>Afasia.</li><li>A veces se pone nerviosa debido a la afasia ya que puede costar que se le entienda.</li><li>Actualmente solo camina con el fisioterapeuta.</li></ul>",
    "acj_desc_carer_attributes": "<h4>Rango de edad</h4><ul><li>22 - 63 años.</li></ul><h4>Imprescindible</h4><ul><li>Experiencia.</li><li>Documentación en regla.</li><li>Referencias de antiguos empleos.</li></ul>",
    "acj_desc_job_tasks": "<ul><li>Cambios de pañal siempre que hagan falta</li><li>Apoyo en la vestimenta</li><li>Movilizaciones de la cama al sillón y al revés</li><li>Asistencia en el aseo y la ducha (en cama)</li></ul>",
    "acj_job_id": "01",
    "acj_job_is_weekend_job": true,
    "acj_job_posted_date": "2022-12-01"
}
```
![conexión API](assets/chrome-capture-2023-2-13-4.png)

##### Conexión GET
Obtención del listado Custom Post Type: aiudocarerjob

```
https://cuidadoras.aiudo.es/wp-json/api/v1/obtener_oferta
```
Query Paginación
**Por defecto:** *'posts_per_page' => 10*

...*?page=2*
```

https://cuidadoras.aiudo.es/wp-json/api/v1/obtener_oferta?page=2
```
Respuesta:
```
[
    {
        "ID": 5391,
        "post_title": "Oferta-29",
        "acj_job_title": "Nocturna en Barcelona",
        "post_content": "Lunes de 10:30 a 11:30 y de 21:00 a 22:00, Martes de 10:30 a 11:30 y de 21:00 a 22:00, Miércoles de 10:30 a 11:30 y de 21:00 a 22:00, Jueves de 10:30 a 11:30 y de 21:00 a 22:00 y Viernes de 10:30 a 11:30 y de 21:00 a 22:00.",
        "acj_att_salary": "1200",
        "acj_att_week_hours": "40",
        "acj_desc_carer_attributes": "<h4>Rango de edad</h4><ul><li>22 - 63 años.</li></ul><h4>Imprescindible</h4><ul><li>Experiencia.</li><li>Documentación en regla.</li><li>Referencias de antiguos empleos.</li></ul>",
        "acj_desc_user_attributes": "<ul><li>Sufrió un ictus.</li><li>Toma tranquimacin para dormir.</li><li>Movilidad reducida.</li><li>Hemiplegia.</li><li>Afasia.</li><li>A veces se pone nerviosa debido a la afasia ya que puede costar que se le entienda.</li><li>Actualmente solo camina con el fisioterapeuta.</li></ul>",
        "acj_desc_job_tasks": "<ul><li>Cambios de pañal siempre que hagan falta</li><li>Apoyo en la vestimenta</li><li>Movilizaciones de la cama al sillón y al revés</li><li>Asistencia en el aseo y la ducha (en cama)</li></ul>",
        "acj_job_id": "29",
        "acj_job_country": "España",
        "acj_job_community": "Cataluña",
        "acj_job_is_weekend_job": "",
        "acj_job_posted_date": "2022-12-01",
        "acj_tax_provincia": "Barcelona",
        "acj_tax_tipo": "Nocturna"
    },
    {
        "ID": 5390,
        "post_title": "Oferta-28",
        "acj_job_title": "Nocturna en Madrid",
        "post_content": "Lunes de 10:30 a 11:30 y de 21:00 a 22:00, Martes de 10:30 a 11:30 y de 21:00 a 22:00, Miércoles de 10:30 a 11:30 y de 21:00 a 22:00, Jueves de 10:30 a 11:30 y de 21:00 a 22:00 y Viernes de 10:30 a 11:30 y de 21:00 a 22:00.",
        "acj_att_salary": "1200",
        "acj_att_week_hours": "40",
        "acj_desc_carer_attributes": "<h4>Rango de edad</h4><ul><li>22 - 63 años.</li></ul><h4>Imprescindible</h4><ul><li>Experiencia.</li><li>Documentación en regla.</li><li>Referencias de antiguos empleos.</li></ul>",
        "acj_desc_user_attributes": "<ul><li>Sufrió un ictus.</li><li>Toma tranquimacin para dormir.</li><li>Movilidad reducida.</li><li>Hemiplegia.</li><li>Afasia.</li><li>A veces se pone nerviosa debido a la afasia ya que puede costar que se le entienda.</li><li>Actualmente solo camina con el fisioterapeuta.</li></ul>",
        "acj_desc_job_tasks": "<ul><li>Cambios de pañal siempre que hagan falta</li><li>Apoyo en la vestimenta</li><li>Movilizaciones de la cama al sillón y al revés</li><li>Asistencia en el aseo y la ducha (en cama)</li></ul>",
        "acj_job_id": "28",
        "acj_job_country": "España",
        "acj_job_community": "Comunidad de Madrid",
        "acj_job_is_weekend_job": "",
        "acj_job_posted_date": "2022-12-01",
        "acj_tax_provincia": "Madrid",
        "acj_tax_tipo": "Nocturna"
    },
    {
        "ID": 5389,
        "post_title": "Oferta-27",
        "acj_job_title": "Externa en Madrid",
        "post_content": "Lunes de 10:30 a 11:30 y de 21:00 a 22:00, Martes de 10:30 a 11:30 y de 21:00 a 22:00, Miércoles de 10:30 a 11:30 y de 21:00 a 22:00, Jueves de 10:30 a 11:30 y de 21:00 a 22:00 y Viernes de 10:30 a 11:30 y de 21:00 a 22:00.",
        "acj_att_salary": "1200",
        "acj_att_week_hours": "40",
        "acj_desc_carer_attributes": "<h4>Rango de edad</h4><ul><li>22 - 63 años.</li></ul><h4>Imprescindible</h4><ul><li>Experiencia.</li><li>Documentación en regla.</li><li>Referencias de antiguos empleos.</li></ul>",
        "acj_desc_user_attributes": "<ul><li>Sufrió un ictus.</li><li>Toma tranquimacin para dormir.</li><li>Movilidad reducida.</li><li>Hemiplegia.</li><li>Afasia.</li><li>A veces se pone nerviosa debido a la afasia ya que puede costar que se le entienda.</li><li>Actualmente solo camina con el fisioterapeuta.</li></ul>",
        "acj_desc_job_tasks": "<ul><li>Cambios de pañal siempre que hagan falta</li><li>Apoyo en la vestimenta</li><li>Movilizaciones de la cama al sillón y al revés</li><li>Asistencia en el aseo y la ducha (en cama)</li></ul>",
        "acj_job_id": "27",
        "acj_job_country": "España",
        "acj_job_community": "Comunidad de Madrid",
        "acj_job_is_weekend_job": "",
        "acj_job_posted_date": "2022-12-01",
        "acj_tax_provincia": "Madrid",
        "acj_tax_tipo": "Externa"
    },
    ...
```
## Plugin
***
Lista de archivos:
* **aiudo_carer_job.php**: custom post type *"aiudocarerjob"*
* **taxonomy-provincias.php**: custom taxonomy *"provincias"*
* **taxonomy-tipo.php**: custom taxonomy *"taxonomy-tipo"*
* **function.php**: archivo con funciones de apoyo.

![conexión API](assets/chrome-capture-2023-2-13-1.png)
![conexión API](assets/chrome-capture-2023-2-13-2.png)
![conexión API](assets/chrome-capture-2023-2-13-3.png)
x

## Theme
***
Una vez creado el child Theme (en nuestro caso del *Elementor Theme*):
* Subir los archivos de la plantilla: *carer-job.php* y la carpeta *template-parts* a la carpeta del child-theme creado.

*Esta plantilla se encuentra actualmente desactivada porque utilizamos las plantillas de elementor pro.*


## Installation
***
Para instalar:

* subir carpeta *aiudo-carer-job* a la carpeta *plugins* de  *wp-content*.
* activar plugin.
* aparecera en el menú admin.

## Integration

**post_title:** concatena *post_title* + *acj_job_id* 
Ejemplo: Oferta-13 (Se utiliza como identificador visual de las ofertas de empleo para las cuidadoras, ya que muchas muy parecidas.)

**post_content:** Contenido del post... Normalmente la descripción horaria.

**post_status:** *publish*

**post_author:** 1 (Admin)

**post_type:** aiudoCarerJob

**page_template:** carer-job.php (plantilla porsiaca... de momento usamos elementor)

#### tax_input:
&nbsp;&nbsp; **provincias** recoge el nombre de la provincia de *acj_tax_provincia*
&nbsp;&nbsp; **tipo-empleo** recoge el nombre de la provincia de *acj_tax_tipo*

#### meta_input:
&nbsp;&nbsp; **acj_job_title** Concatena *acj_tax_tipo* + "en" +  *acj_tax_provincia* para crear el título visual del front (ojo: distinto de post_title que se utiliza como id visual)
Ejemplo: Interna en Salamanca.

&nbsp;&nbsp; **acj_att_salary** Salario mensual 
Ejemplo: 1200

&nbsp;&nbsp; **acj_att_week_hours** Horas semanales
Ejemplo: 40

&nbsp;&nbsp; **acj_desc_carer_attributes** Atributos del cuidador (Permite html)

&nbsp;&nbsp; **acj_desc_user_attributes** Atributos del usuario (Permite html)

&nbsp;&nbsp; **acj_desc_job_tasks** Tareas del empleo (Permite html)
Ejemplo: Interna

&nbsp;&nbsp; **acj_tax_provincia** Provincia del empleo para enviarsela al *tax_input* y al *acj_job_title*
Ejemplo: Salamanca

&nbsp;&nbsp; **acj_tax_tipo** tipo de empleo para enviarsela al *tax_input* y al *acj_job_title*

&nbsp;&nbsp; **acj_job_id** id única del empleo distinta del ID de wordpress para enviarsela a *post_title* y poder identificar el empleo.
Ejemplo: 23

&nbsp;&nbsp; **acj_job_country** País
Ejemplo: España

&nbsp;&nbsp; **acj_job_community** Comunidad autónoma
Ejemplo: Comunidad Valenciana

&nbsp;&nbsp; **acj_job_is_weekend_job** *true* o *false*

&nbsp;&nbsp; **acj_job_posted_date** Fecha de creación
Ejemplo: 2022-12-01




