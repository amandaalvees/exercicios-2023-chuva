<?php

$html = file_get_contents('webscrapping/origin.html');

$domDocument = new DOMDocument();
$domDocument->loadHTML($html);






?>