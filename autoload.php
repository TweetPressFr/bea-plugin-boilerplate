<?php
namespace BEA\PB;

$loader = \BEA\Autoloader::get_instance();
// register the base directories for the namespace prefix
$loader->addNamespace( 'BEA\PB', BEA_PB_DIR . 'classes' );
