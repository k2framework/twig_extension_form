Extension Twig Form
============

Estensión que permite crear campos de formularios usando twig. Podemos crear inputs de texto, contraseñas, campos ocultos, radios, checboxes, selects, textareas, number, etc.

Instalación
----------

la instalación es mediante composer, agregar el paquete al composer.json del proyecto:

.. code-block:: json

    {
        "require" : {
            "k2/calendar": "dev-master"
        }
    }
                      
                        
Ejecutar el comando:

::

    composer install

Luego de descargar el proyecto agregar la extensión a Twig


.. code-block:: php

    use K2\Twig\Extension\Form;
    use Symfony\Component\PropertyAccess\PropertyAccessor;
    
    require_once './vendor/autoload.php';
    
    //carga de twig
    
    $loader = new \Twig_Loader_Filesystem(__DIR__);
    $twig = new \Twig_Environment($loader, array(
        'debug' => true,
        'cache' => __DIR__ . '/cache/',
            ));
    
    //agregamos la extensión
    
    $twig->addExtension(new Form(new PropertyAccessor()));
    
    //  ........
    
Con esto ya tenemos la extensión cargada y podemos usar las funciones en twig.

Formularios
----------

Para la creación de formularios disponemos de varias funciones Twig:

    * **form_input(name, type = 'text', attrs = array(), value = null)**
    * **form_label(name, text, attrs = array())**
    * **form_textarea(name, attrs = array(), value = null)**
    * **form_check(name, value, attrs = array(), check = false)**
    * **form_radio(name, value, attrs = array(), check = false)**
    * **form_select(name, array options, attrs = array(), value = null)**
    * **form_choice(name, array options, multiple = true, attrs = array(), value = null)**
    * **form_options(array options, column, key = 'id')**

Estás funciones permiten crear de manera simple los elementos comunes presentes en cualquier formulario html.

Creando un Formulario
---------------------

Veamos con un ejemplo como crear un formulario con tres campos, nombres, apellidos y edad:

.. code-block:: html+jinja

    {{ form_label('persona.nombres', 'Nombres') }}
    {{ form_input('persona.nombres') }} {# si no especificamos el tipo de campo, lo crea type="text" #}
    
    {{ form_label('persona.apellidos', 'Apellidos') }}
    {{ form_input('persona.apellidos', 'text') }}
    
    {{ form_label('persona.edad', 'Edad') }}
    {{ form_input('persona.edad', 'number', {min:1, max: 110}, 18) }} {# por defecto muestra 18 en la edad #}

Como se puede apreciar es muy sencillo crear y agregar campos con la lib form, aparte esta puede renderizar todo el formulario sin nosotros tener que hacer nada especial (Con mensajes de error si el formulario es validado).

form_input()
---------

Permite crear campos de tipo text, hidden, password, number, email, url, color, etc...

Los atributos que acepta son:

    * **field**: nombre del input (genera name y id, convierte los puntos para el name en notación de array y para el id los separa con _).
    * **type**: tipo del input por defecto es type=text.
    * **attrs**: un arreglo twig con los atributos para el input (class, style, required, disabled, ...)
    * **value**: valor inicial para el elemento, por defecto null.

.. code-block:: html+jinja

    {{ form_input('persona.nombres') }}    
    <!-- <input type="text" name="persona[nombres]" id="persona_nombres" /> -->
    
    {{ form_input('direccion') }}    
    <!-- <input type="text" name="direccion" id="direccion" /> -->
    
    {{ form_input('edad', 'number') }}    
    <!-- <input type="number" name="edad" id="edad" /> -->
    
    {{ form_input('user.color', type='color') }}    
    <!-- <input type="color" name="user[color]" id="user_color" /> -->
    
    {{ form_input('user.website', attrs={maxlength:120}, type='url') }}    
    <!-- <input type="url" name="user[website]" id="user_website" /> -->
    
    {{ form_input('user.correo', 'email') }}    
    <!-- <input type="email" name="user[correo]" id="user_correo" /> -->
        
    {{ form_input('clave', 'password') }}    
    <!-- <input type="password" name="clave" id="clave" /> -->
        
    {{ form_input('id', 'hidden', value="23") }}    
    <!-- <input type="hidden" name="id" id="id" value="23" /> -->
        
    {{ form_input('persona.id', 'hidden') }}
    <!-- <input type="hidden" name="persona[id]" id="persona_id" /> -->


form_label()
---------

Permite crear etiquetas label para los campos

Los atributos que acepta son:

    * **field**: nombre del input (genera atributo for, convierte los puntos en _).
    * **text:** texto a mostrar en el label.
    * **attrs**: un arreglo twig con los atributos para el input (class, style, ...)

.. code-block:: html+jinja

    {{ form_label('persona.nombres', 'Nombres') }}    
    <!-- <label for="persona_nombres">Nombres</label> -->
    
    {{ form_label('nombres', 'Nombres') }}    
    <!-- <label for="nombres">Nombres</label> -->
    
    {{ form_label('u.edad', 'Edad del Infante', {class:'form-label'}) }}    
    <!-- <label for="u_edad" class="form-label">Edad del Infante</label> -->
    

form_textarea()
---------

Permite crear campos textarea

Los atributos que acepta son:

    * **field**: nombre del input (genera name y id, convierte los puntos para el name en notación de array y para el id los separa con _).
    * **attrs**: un arreglo twig con los atributos para el input (class, style, required, disabled, ...)
    * **value**: valor inicial para el elemento, por defecto null.

.. code-block:: html+jinja

    {{ form_textarea('persona.nombres') }}    
    <!-- <textarea name="persona[nombres]" id="persona_nombres"></textarea> -->
    
    {{ form_input('direccion', value = objeto.campo) }}    
    <!-- <textarea name="direccion" id="direccion" >valor del campo</textarea> -->
    
form_radio()
---------

Permite crear campos de tipo radio

Los atributos que acepta son:

    * **field**: nombre del input (genera name y id, convierte los puntos para el name en notación de array y para el id los separa con _).
    * **value**: valor para el radio
    * **attrs**: un arreglo twig con los atributos para el input (class, style, required, disabled, ...)
    * **check**: indica si el campo aparecerá seleccionado o no.

.. code-block:: html+jinja

    {{ form_radio('persona.adulto', 1, check = true) }}    
    <!-- <input type="radio" name="persona[adulto]" id="persona_adulto" value="1" checked="checked" /> -->
    
    {{ form_radio('acepta_terminos', 'Si') }}    
    <!-- <input type="radio" name="direccion" id="direccion" value="Si" /> -->
    
    {{ form_radio('acepta_terminos', 'No') }}    
    <!-- <input type="radio" name="direccion" id="direccion" value="No" /> -->
    
    
form_checkbox()
---------

Cumple exactamente la misma función que form_radio, solo que genere inputs de tipo checkbox

form_select()
---------

Permite crear campos de tipo radio

Los atributos que acepta son:

    * **field:** nombre del input (genera name y id, convierte los puntos para el name en notación de array y para el id los separa con _).
    * **options:** arreglo con pares clave valor, donde la clave será el value de las opcionesy el valor el Texto a mostrar en las mismas.
    * **attrs:** un arreglo twig con los atributos para el input (class, style, required, disabled, ...)
    * **value:** valor inicial para el elemento, por defecto null.
    * **empty:** texto a mostrar inicialmente, por defecto es - seleccione -

.. code-block:: html+jinja

    {% set sexos = { 1 : 'Hombre' , 2 : 'Mujer' } %}

    {{ form_select('persona.sexo', sexos) }}    
    <!-- <select name="persona[sexo]" id="persona_sexo">
            <option>- Seleccione -</option>
            <option value="1" >Hombre</option>
            <option value="2" >Mujer</option>
         </select> -->

    {{ form_select('sexo', sexos, value=2) }}    
    <!-- <select name="sexo" id="sexo">
            <option>- Seleccione -</option>
            <option value="1" >Hombre</option>
            <option value="2" selected="selected" >Mujer</option>
         </select> -->
         
Ahora lo haremos con un array que viene de un php

.. code-block:: php

    <?php

    $estatus = array(
        1 => "Activo",
        2 => "Inactivo",
        3 => "Removido",
    );
    
    echo $twig->render("form.twig", array('estatus' => $status));

.. code-block:: html+jinja

    {{ form_select('persona.status', status) }}  
    
    <!-- <select name="persona[status]" id="persona_status">
            <option>- Seleccione -</option>
            <option value="1" >Activo</option>
            <option value="2" >Inactivo</option>
            <option value="3" >Removido</option>
         </select> -->
    
