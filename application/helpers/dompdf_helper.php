<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dompdf_helper
 *
 * @author Parimal
 */
function pdf_create($html, $filename = '', $stream = TRUE, $set_paper = '') {
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);

    if ($set_paper != '') {
        $dompdf->set_paper(array(0, 0, 900, 841), 'portrait');
    } else {

        $dompdf->set_paper("a4", "portrait");
    }
    $dompdf->render();
    if ($stream) {

        $dompdf->stream($filename . ".pdf", array("Attachment" => false));
    } else {
        return $dompdf->output();
    }
}
function pdf_download($html, $filename = '', $stream = TRUE, $set_paper = '') {
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);

    if ($set_paper != '') {
        $dompdf->set_paper(array(0, 0, 900, 841), 'portrait');
    } else {

        $dompdf->set_paper("a4", "portrait");
    }
    $dompdf->render();
    if ($stream) {

        $dompdf->stream($filename . ".pdf", array("Attachment" => true));
    } else {
        return $dompdf->output();
    }
}
function server_pdf_create($html, $filename = '', $stream = TRUE, $set_paper = '') {
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);

    if ($set_paper != '') {
        $dompdf->set_paper(array(0, 0, 900, 841), 'portrait');
    } else {

        $dompdf->set_paper("a4", "portrait");
    }
    $dompdf->load_html($html);
    $dompdf->render();
    $pdf = $dompdf->output();
    $file_location = "uploads/hotel_pdf/hotel_quotation.pdf";
    file_put_contents($file_location, $pdf);
}
