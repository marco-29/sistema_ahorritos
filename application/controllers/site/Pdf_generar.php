<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

class Pdf_generar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('clientes_model');
        $this->load->model('procesos_venta_model');
        $this->load->model('contratos_model');
        $this->load->model('inmuebles_model');
    }

    public function index($identificador, $identificador_inmueble, $identificador_proceso)
    {

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador_inmueble)->row();
        $data['inmueble_row'] = $inmueble_row;

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador_inmueble)->row();

        $cliente_row = $this->clientes_model->obtener_cliente_por_identificador($identificador)->row();
        $data['cliente_row'] = $cliente_row;

        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador_inmueble)->row();
        $data['proceso_venta_row'] = $proceso_venta_row;

        $contrato_row = $this->contratos_model->obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($identificador_inmueble, $identificador_proceso, $cliente_row->identificador)->row();
        $deber_ser = json_decode($contrato_row->plan_pagos_deber_ser);
        $data['deber_ser'] = $deber_ser;
        $data['contrato_row'] = $contrato_row;

        // Cargar la vista del contrato
        $contract_content = $this->load->view('site/inmuebles/contrato', $data, TRUE);

        // Buscar el contenido de la card específica dentro de la vista
        $start_marker = '<div class="col-xl-10 col-md-10 col-sm-12 car-contrato" id="contrato" style="text-align: justify;">';
        $end_marker = '</p class="fin">';
        $start_position = strpos($contract_content, $start_marker);
        $end_position = strpos($contract_content, $end_marker, $start_position);
        $specific_card_content = substr($contract_content, $start_position, $end_position - $start_position + strlen($end_marker));

        // Buscar el contenido de la card específica dentro de la vista
        $start_marker_2 = '<table style="width: 100%;">';
        $end_marker_2 = '</table>';
        $start_position_2 = strpos($contract_content, $start_marker_2);
        $end_position_2 = strpos($contract_content, $end_marker_2, $start_position_2);
        $specific_card_content_2 = substr($contract_content, $start_position_2, $end_position_2 - $start_position_2 + strlen($end_marker_2));

        // Configuración de TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Grupo JV');
        $pdf->SetTitle('Contrato de ' . (!empty($inmueble_row->nombre) ? ucfirst(trim($inmueble_row->nombre)) : '') . ' del desarrollo ' . (!empty($desarrollo_row->nombre) ? ucfirst(trim($desarrollo_row->nombre)) : ''));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(25.4, 25.4, 25.4);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Establecer el tamaño de letra
        $pdf->SetFont('helvetica', '', 11); // El tercer parámetro es el tamaño de la letra

        // Añadir página
        $pdf->AddPage();

        // Escribir el contenido HTML con el nuevo tamaño de letra
        $pdf->writeHTML($specific_card_content, '', 0, 'C', true, 0, false, false, 0);

        if (!is_array($deber_ser)) {
            $deber_ser = array();
        }

        if ((sizeof($deber_ser) > 31) and (sizeof($deber_ser) < 50)) {
            // Añadir página
            $pdf->AddPage();
            $pdf->writeHTML('<br><br>' . $specific_card_content_2, '', 0, 'C', true, 0, false, false, 0);
        } else {
            $pdf->writeHTML('<br><br>' . $specific_card_content_2, '', 0, 'C', true, 0, false, false, 0);
        }

        // Salida del PDF
        $pdf->Output('Contrato de ' . (!empty($inmueble_row->nombre) ? ucfirst(trim($inmueble_row->nombre)) : '') . ' del desarrollo ' . (!empty($desarrollo_row->nombre) ? ucfirst(trim($desarrollo_row->nombre)) : '') . '.pdf', 'I');  // 'I' para ver en el navegador, 'D' para descargar
    }
}
