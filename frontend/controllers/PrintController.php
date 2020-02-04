<?php
namespace frontend\controllers;
 
use yii\web\Controller
 
class Print extends Controller
{
   public function actionPdf($id) {
         
        $content = $this->renderPartial('index');
        
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, 
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'options' => ['title' => 'Laporan Harian']
             
        ]);
        return $pdf->render();
    }
}
 
?>