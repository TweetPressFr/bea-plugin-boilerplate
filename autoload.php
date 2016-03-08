<?php
namespace BEA\PB;

$loader = \BEA\Autoloader::get_instance(); // @since 3.0
$loader->addNamespace( 'BEA\PB', BEA_PB_DIR . 'classes' ); // register the base directories for the namespace prefix
