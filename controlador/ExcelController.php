<?php
include_once '../modelo/Excel.php';
require_once('../vendor/autoload.php');
include_once '../modelo/Historial.php';
$historial = new Historial();
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
$excel = new Excel();
if($_POST['funcion1']=='reporte_excel'){
    $matanza ='reporte_productos.Csv';
    $id=$_POST['id'];
    $matanza1="reporte_matanza-".$id.".Csv";
    $excel->reporte_excel($id);
    $descripcion='Ha creado el CSV para la tropa: '.$excel->objetos[0]->numtropas;
    $historial->crear_historial($descripcion,7,3,$id);
    foreach ($excel->objetos as $objeto) {
        $json[]=array(
            'garron'=>$objeto->garron,
            'peso'=>$objeto->peso,
            'ano'=>$objeto->ano,
            'destino'=>$objeto->destino,
            'numtropas'=>$objeto->numtropas,
            'fechacsv'=>$objeto->fechacsv,
            'numespecie'=>$objeto->numespecie,
            'codigocsv'=>$objeto->codigocsv,
            'camara'=>$objeto->camara,
            'despiece'=>$objeto->despiece,
            'destinocsv'=>$objeto->destinocsv,
        );
    }
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Reporte de Matanza');
    
    foreach ($json as $key => $garron) {
    $celda=(int)$key+1;
    $sheet->setCellValue('A'.$celda,$garron['numtropas']);
    $sheet->setCellValue('B'.$celda,$garron['numespecie']);
    $sheet->setCellValue('C'.$celda,$garron['fechacsv']);
    $sheet->setCellValue('D'.$celda,$garron['ano']);
    $sheet->setCellValue('E'.$celda,$garron['codigocsv']);
    $sheet->setCellValue('F'.$celda,$garron['despiece']);
    $sheet->setCellValue('G'.$celda,$garron['garron']);
    $sheet->setCellValue('H'.$celda,$garron['peso']);
    $sheet->setCellValue('I'.$celda,$garron['camara']);
    $sheet->setCellValue('J'.$celda,$garron['destinocsv']);
    $sheet->setCellValue('K'.$celda,"");
    $sheet->setCellValue('L'.$celda,"");
    $sheet->setCellValue('M'.$celda,"");
   

    }
    foreach (range ('A','M') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    $writer = IOFactory::createWriter($spreadsheet,'Csv');
    $writer->save('../csv/'.$matanza1);
}

?>