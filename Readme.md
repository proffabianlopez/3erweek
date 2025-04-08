### Pasos Iniciales

Clonar el proyecto
Crear una rama que se llame dev_work_nonbrealumno

### Resumen de la semana:

En esta semana, empezamos a ver archivos planos y algunos de los diferentes tipos.
Hablamos de los que tienen una estructura separada por algun campo y los que son de ancho fijo.
En clase se mostro un muy simple algoritmo sobre una encuesta de quién ganara algo.

El día jueves recibieron por mail un link que dura 7 días el mismo, en el caso de no tenerlo, pedir el mismo a un compañero con el fin de mantener un mayor vínculo o al docente. (Cabe aclarar el que mismo fue enviado a todos los contactos que han enviado su correo y han solicitado acceso al algún repositorio a la fecha y hora de envío, pudiendo no estar todos incluidos).

En clase se mostro un ejemplo de real de un archivo en cual esta en un formato diferente al conocido y se pido como primer tarea.

Exportar el archivo Biblio el cual contiene un formato como se indica a continuación:
con un ejemplo de contenido de cada campo

array(11) {
[0]=> string(5) "13477"
[1]=> string(15) "R 60(03) ENC T1"
[2]=> string(39) "ENCICLOPEDIA DE LA CIENCIA Y DE LA TEC."
[3]=> string(0) "" [4]=> string(0) ""
[5]=> string(7) "CIENCIA"
[6]=> string(5) "DANAE"
[7]=> string(0) ""
[8]=> string(3) "S/E"
[9]=> string(0) ""
[10]=> string(0) ""
}
El indice del array indica el campo por ejemplo el indice 0 es un codigo interno numerico que posee un libro dentro de la biblioteca.

Una vez que hayan podido exportar los datos, se piden trabajar el archivo de datos, dejando el origina con el nombre BIBLIO.TXT
Y generar otro archivo que se llame datos.txt y dejarlo dentro de la carpeta ./Data del repositorio.

El archivo datos.txt deberán colocar como separador de campo el | y deberán eliminar las comillas ", entre otras cosas.

En el repositorio tienen 2 ejemplos que se mostraron en clase de como seria un front en donde el usuario selecciona un criterio y escribe un texto, para luego el programa pueda realizar la búsqueda de acuerdo a lo solicitado.

Si llegan a este punto , y les arroja resultados ya es un buen comienzo.

### Actividad para desarrollar con mayor atención

Se pide normalizar el archivo origen que es datos.txt

Para ello deberán crear un script por cada archivo que se generara para luego en otra etapa realizar la normalización completa. Lo único por ahora sera crear 3 archivos que nos permitiran luegos usarlos de pivote.

Los archivos a generar son:

- Autores.Dat
- Generos.Dat
- Edutoriales.Dat

Para generar estos, se deberá leer el archivo origen datos.txt y guardar en cada uno de los mencionados un unico valor sin que que se repita.

La estructura de cada archivo de los solicitados tiene esta apariencia

- Id
- | separador de campo
- Detalle

En donde Id es un autonumerador que no se podrá repetir dentro del mismo archivo y detalle es el nombre que corresponda.

Ejemplo:

Autores.Dat
1|CORTAZAR JULIO
2|SIN DATOS --- (EN EL CASO DE QUE EN LA COLUMNA QUE CORRESPONDE A ESE DATOS SEA NULA)

Estos script no son para correr por entorno visual, se recomienda que sean corridos por la terminal, ingresando a la imagen del container.

Con esos 3 archivos finaliza esta actividad por el momento.
