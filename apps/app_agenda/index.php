<?php 
// Desativa toda exibição de erros
//error_reporting(0); 
// Exibe todos os erros PHP (see changelog)
error_reporting(E_ALL);  

require 'vendor/autoload.php';

use Elboletaire\Crawler\Crawler;

try {
	$crawler = new Crawler('https://agendasorocaba.com.br/', 3, true);
	print_r($crawler->crawl());
} catch (Exception $e) {
	die($e->getMessage());
}

  
