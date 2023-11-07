<?php

require 'vendor/autoload.php';
libxml_use_internal_errors(true);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$conteudo = file_get_contents('https://proceedings.science/nmrmeeting/18nmrmeeting-2021/trabalhos?check_logged_in=1');
$documento = new DOMDocument();
$documento->loadHTML($conteudo);

$xPath = new DOMXPath($documento);
$domNodeList = $xPath->query('//*[@id="hits-container"]/div/div[1]/a/h4');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Título');

$row = 2;
foreach ($domNodeList as $elemento) {
    $sheet->setCellValue('A' . $row, $elemento->textContent);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('planilha.xlsx');
echo 'Planilha Excel criada com sucesso!';

?>