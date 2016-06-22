<?php

require_once '../vendor/autoload.php';

$Dir = new \alphayax\utils\file_system\Directory( '../src');
$Files = $Dir->getFilesByExtension( 'php', true);

print_r( $Files);
