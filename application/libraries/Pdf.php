<?php defined('BASEPATH') OR exit('No direct script access allowed');

// require 'config/autoload.php';
require_once APPPATH . 'config/autoload.php';


class Pdf {

    function createPDF($html, $filename='', $download=TRUE, $paper='letter', $orientation='portrait'){
        
        $dompdf = new Dompdf\Dompdf(array('enable_remote' => true));
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();

        if($download) {
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        } else {
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
        }
    }

}
