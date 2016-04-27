<?php
// Get the Autoloader
// ------------------
require_once __DIR__ . '/../vendor/autoload.php';

// Get DB configuration
// --------------------
require_once __DIR__ . '/config_db.php';

// Get the Templates
// -----------------
$myTemplatesPath = __DIR__ . '/../templates';

// Setup Twig
// ----------
$loader = new Twig_Loader_Filesystem($myTemplatesPath);
$twig = new Twig_Environment($loader);

// Setup Silex
// ------------
$app = new Silex\Application();

// Register Silex with Session
// ---------------------------
$app->register(new Silex\Provider\SessionServiceProvider());

// Register Twig with Silex
// ------------------------
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $myTemplatesPath
));
