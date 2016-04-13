<?php
namespace BEA\PB;

/**
 * Import Autoloader form bea/autoloader
 */
use BEA\Autoloader;

/**
 * Register all the folders to look for loading our classes
 */
$loader = Autoloader::get_instance();
$loader->addNamespace( 'BEA\PB', BEA_PB_DIR . 'classes' ); // register the base directories for the namespace prefix
