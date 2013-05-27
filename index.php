<?php

require_once __DIR__ . '/vendor/autoload.php';

use K2\Twig\Extension\Form;
use Symfony\Component\PropertyAccess\PropertyAccessor;

require './Twig/Extension/Form.php';

$loader = new Twig_Loader_Filesystem(__DIR__);

$twig = new Twig_Environment($loader, array(
    'debug' => true,
    'charset' => 'UTF-8',
    'strict_variables' => true,
        //'cache' => __DIR__ . '/cache/',
        ));

$twig->addExtension(new Form(new PropertyAccessor()));

$twig->display('index.twig', array(
    'persona' => array(
        'edad' => 24
    ),
));
