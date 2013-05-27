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
    {{ form_input('persona.edad', 'number', {min:1, max: 110}) }}

Como se puede apreciar es muy sencillo crear y agregar campos con la lib form, aparte esta puede renderizar todo el formulario sin nosotros tener que hacer nada especial (Con mensajes de error si el formulario es validado).

form_input()
---------

Permite crear campos de tipo text, hidden, password, number, email, url, color, etc...

.. code-block:: html+jinja

    {{ form_input('persona.nombres') }} 
    
        <input type="text" name="persona[nombres]" id="persona_nombres" />
    
    {{ form_input('direccion') }}
    
        <input type="text" name="direccion" id="direccion" />
    
    {{ form_input('edad', 'number') }}
    
        <input type="number" name="edad" id="edad" />
    
    {{ form_input('user.color', type='color') }}
    
        <input type="color" name="user[color]" id="user_color" />
    
    {{ form_input('user.website', attrs={maxlength:120}, type='url') }}
    
        <input type="url" name="user[website]" id="user_website" />
    
    {{ form_input('user.correo', 'email') }}
    
        <input type="email" name="user[correo]" id="user_correo" />
        
    {{ form_input('clave', 'password') }}
    
        <input type="password" name="clave" id="clave" />
        
    {{ form_input('id', 'hidden') }}
    
        <input type="hidden" name="id" id="id" />
        
    {{ form_input('persona.id', 'hidden') }}

        <input type="hidden" name="persona[id]" id="persona_id" />
