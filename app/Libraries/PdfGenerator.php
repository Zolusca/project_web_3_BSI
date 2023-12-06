<?php

namespace App\Libraries;
use Dompdf\Dompdf;
class PdfGenerator
{
    private Dompdf $dompdf;
    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    public function createPdfAndSentToClient($dataParser, $namaFile, $layoutHtml){
        $this->dompdf->setPaper('A4','landscape');
        $this->dompdf->loadHtml(view($layoutHtml,$dataParser));
        $this->dompdf->render();
        $this->dompdf->stream($namaFile.".pdf");
    }

    public function createPdfAndSaveLocal($dataParser,$noInvoice, $layoutHtml){
        $path = FCPATH."/fake_invoice/".$noInvoice.'.pdf';
        $this->dompdf->setPaper('A4','landscape');
        $this->dompdf->loadHtml(view($layoutHtml,$dataParser));
        $this->dompdf->render();
        $output = $this->dompdf->output();
        file_put_contents($path,$output);
    }
}