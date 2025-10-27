<?php defined('BASEPATH') or exit('No direct script access allowed');

class Facturacion extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('facturas_model');
        $this->load->model('pagos_model');
        $this->load->model('rel_inmuebles_model');
        $this->load->model('inmuebles_model');
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Facturación';
        $data['pagina_subtitulo'] = 'Registro de Facturación';
        $data['pagina_menu_facturacion'] = true;

        $data['controlador'] = 'site/facturacion';
        $data['ir_a'] = 'site/inicio';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/facturacion/index";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/facturacion/index', $data);
    }

    public function obtener_tabla_index()
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $facturas_list = $this->facturas_model->obtener_facturas();

        $data = [];

        foreach ($facturas_list->result() as $factura_key => $factura_value) {

            $opciones = '<a href="javascript:subir_archivos(\'' . $factura_value->identificador . '\', \'' . $factura_value->desarrollo . '\', \'' . $factura_value->inmueble . '\', \'' . $factura_value->pago_identificador . '\', \'' . $factura_value->concepto . '\', \'' . $factura_value->cliente_nombre . '\',\'' . $factura_value->monto . '\',\'' . $factura_value->rfc . '\',\'' . $factura_value->codigo_postal . '\',\'' . $factura_value->regimen_fiscal . '\',\'' . $factura_value->uso_cfdi . '\');">Subir archivos</a>' . '|' .
                '<a href="' . site_url('site/facturacion/eliminar/' . $factura_value->identificador) . '">Eliminar</a>';

            if ((isset($factura_value->archivo_pdf) and !empty($factura_value->archivo_pdf)) and (isset($factura_value->archivo_xml) and !empty($factura_value->archivo_xml)) and (isset($factura_value->archivo_zip) and !empty($factura_value->archivo_zip))) {

                $tipo_extension = pathinfo($factura_value->archivo_pdf, PATHINFO_EXTENSION);
                $tipo_extension_2 = pathinfo($factura_value->archivo_xml, PATHINFO_EXTENSION);
                $tipo_extension_3 = pathinfo($factura_value->archivo_zip, PATHINFO_EXTENSION);

                if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                    $tipo_extension = 'archivo';
                } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension = 'imagen';
                }

                if (in_array($tipo_extension_2, array('pdf', 'doc', 'docx', 'xls', 'xml'))) {
                    $tipo_extension_2 = 'archivo';
                } elseif (in_array($tipo_extension_2, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension_2 = 'imagen';
                }

                if (in_array($tipo_extension_3, array('zip'))) {
                    $tipo_extension_3 = 'zip';
                } elseif (in_array($tipo_extension_3, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension_3 = 'imagen';
                }

                $opciones_archivo = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/facturacion/' . $factura_value->identificador . '/' . $factura_value->archivo_pdf) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Archivo PDF</a>' . '|' . '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/facturacion/' . $factura_value->identificador . '/' . $factura_value->archivo_xml) . '\',\'' . $tipo_extension_2 . '\');"><i class="fa fa-file-o"></i>&nbsp;Archivo XML</a>' . '|' . '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/facturacion/' . $factura_value->identificador . '/' . $factura_value->archivo_zip) . '\',\'' . $tipo_extension_3 . '\',\'' . $factura_value->cliente_nombre . '\');"><i class="fa ft-download"></i>&nbsp;Carpeta ZIP</a>';
            } else if (isset($factura_value->archivo_pdf) and !empty($factura_value->archivo_pdf)) {
                $tipo_extension = pathinfo($factura_value->archivo_pdf, PATHINFO_EXTENSION);

                if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                    $tipo_extension = 'archivo';
                } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension = 'imagen';
                }

                $opciones_archivo = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/facturacion/' . $factura_value->identificador . '/' . $factura_value->archivo_pdf) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Archivo PDF</a>' . '|' . 'N/A' . '|' . 'N/A';
            } else if (isset($factura_value->archivo_xml) and !empty($factura_value->archivo_xml)) {
                $tipo_extension_2 = pathinfo($factura_value->archivo_xml, PATHINFO_EXTENSION);

                if (in_array($tipo_extension_2, array('pdf', 'doc', 'docx', 'xls', 'xml'))) {
                    $tipo_extension_2 = 'archivo';
                } elseif (in_array($tipo_extension_2, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension_2 = 'imagen';
                }

                $opciones_archivo = 'N/A' . '|' . '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/facturacion/' . $factura_value->identificador . '/' . $factura_value->archivo_xml) . '\',\'' . $tipo_extension_2 . '\');"><i class="fa fa-file-o"></i>&nbsp;Archivo XML</a>' . '|' . 'N/A';
            } else if (isset($factura_value->archivo_zip) and !empty($factura_value->archivo_zip)) {
                $tipo_extension_3 = pathinfo($factura_value->archivo_zip, PATHINFO_EXTENSION);

                if (in_array($tipo_extension_3, array('zip'))) {
                    $tipo_extension_3 = 'zip';
                } elseif (in_array($tipo_extension_3, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension_3 = 'imagen';
                }

                $opciones_archivo = 'N/A' . '|' . 'N/A' . '|' . '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/facturacion/' . $factura_value->identificador . '/' . $factura_value->archivo_xml) . '\',\'' . $tipo_extension_3 . '\',\'' . $factura_value->cliente_nombre . '\');"><i class="fa ft-download"></i>&nbsp;Carpeta ZIP</a>';
            } else {

                $opciones_archivo = 'N/A';
            }

            $data[] = array(
                'id' => $factura_key + 1,
                'identificador' => !empty($factura_value->identificador) ? $factura_value->identificador : '',
                'desarrollo' => !empty($factura_value->desarrollo) ? ucfirst($factura_value->desarrollo) : '',
                'nombre_inmueble' => !empty($factura_value->inmueble) ? ucfirst($factura_value->inmueble) : '',
                'pago_identificador' => !empty($factura_value->pago_identificador) ? $factura_value->pago_identificador : '',
                'concepto' => !empty($factura_value->concepto) ? $factura_value->concepto : '',
                'cliente_nombre' => !empty($factura_value->cliente_nombre) ? ucwords($factura_value->cliente_nombre) : '',
                'rfc' => !empty($factura_value->rfc) ? mb_strtoupper($factura_value->rfc) : '',
                'codigo_postal' => !empty($factura_value->codigo_postal) ? mb_strtoupper($factura_value->codigo_postal) : '',
                'regimen_fiscal' => !empty($factura_value->regimen_fiscal) ? mb_strtoupper($factura_value->regimen_fiscal) : '',
                'uso_cfdi' => !empty($factura_value->uso_cfdi) ? mb_strtoupper($factura_value->uso_cfdi) : '',
                'monto' => !empty($factura_value->monto) ? $factura_value->monto : '',
                'archivos' => $opciones_archivo,
                'estatus_factura' => !empty($factura_value->estatus_factura) ? ucfirst($factura_value->estatus_factura) : '',
                'fecha_registro' => !empty($factura_value->fecha_registro) ? date('Y/m/d', strtotime($factura_value->fecha_registro)) : '',
                'fecha_actualizacion' => !empty($factura_value->fecha_actualizacion) ? date('Y/m/d', strtotime($factura_value->fecha_actualizacion)) : '',
                'opciones' => $opciones,
            );
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $facturas_list->num_rows(),
            'recordsFiltered' => $facturas_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

    public function cargar_archivos()
    {
        $identificador = $this->input->post('factura_identificador');

        $factura_row = $this->facturas_model->obtener_factura_por_identificador($identificador)->row();

        $data['controlador'] = 'site/facturacion';
        $data['ir_a'] = 'site/inicio';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/facturacion/index";

        if ($factura_row) {
            if ($factura_row->archivo_pdf != null) {
                if (isset($_FILES) && $_FILES['archivo']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls|xml|zip';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('archivo')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        if ($factura_row->archivo_pdf and $factura_row->archivo_pdf != "") {
                            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/facturacion/' . $factura_row->identificador . "/" . $factura_row->archivo_pdf);
                            unlink($archivo_a_borrar);
                        }
                        $data_imagen = $this->upload->data();
                        $archivo = $data_imagen['file_name'];
                    }
                } else {
                    $archivo = $factura_row->archivo_pdf;
                }

                $data_1 = array(
                    'archivo_pdf' => $archivo,
                );

                if (!$this->facturas_model->actualizar_factura_por_identificador($factura_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.1)', $data['controlador']);
                }
            } else {
                if (isset($_FILES) && $_FILES['archivo']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls|xml|zip';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('archivo')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        $data_imagen = $this->upload->data();
                        $archivo = $data_imagen['file_name'];
                    }
                } else {
                    $archivo = null;
                }

                $data_1 = array(
                    'archivo_pdf' => $archivo,
                );

                if (!$this->facturas_model->actualizar_factura_por_identificador($factura_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.2)', $data['controlador']);
                }
            }
            if ($factura_row->archivo_xml != null) {
                if (isset($_FILES) && $_FILES['archivo_2']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls|xml|zip';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('archivo_2')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        if ($factura_row->archivo_xml and $factura_row->archivo_xml != "") {
                            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/facturacion/' . $factura_row->identificador . "/" . $factura_row->archivo_xml);
                            unlink($archivo_a_borrar);
                        }
                        $data_imagen = $this->upload->data();
                        $archivo_2 = $data_imagen['file_name'];
                    }
                } else {
                    $archivo_2 = $factura_row->archivo_xml;
                }

                $data_1 = array(
                    'archivo_xml' => $archivo_2,
                );

                if (!$this->facturas_model->actualizar_factura_por_identificador($factura_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.1)', $data['controlador']);
                }
            } else {
                if (isset($_FILES) && $_FILES['archivo_2']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls|xml|zip';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('archivo_2')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        $data_imagen = $this->upload->data();
                        $archivo_2 = $data_imagen['file_name'];
                    }
                } else {
                    $archivo_2 = null;
                }

                $data_1 = array(
                    'archivo_xml' => $archivo_2,
                );

                if (!$this->facturas_model->actualizar_factura_por_identificador($factura_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.2)', $data['controlador']);
                }
            }
            if (isset($_FILES) && $_FILES['carpeta']['error'] == '0') {
                $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->identificador;
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls|xml|zip';
                $config['max_size'] = (1024 * 50);
                $config['encrypt_name']  = true;
                $config['remove_spaces'] = true;
                if (!is_dir($config['upload_path'])) {
                    $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('carpeta')) {
                    $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                } else {
                    $data_imagen = $this->upload->data();
                    $carpeta = $data_imagen['file_name'];
                }
            } else {
                $carpeta = null;
            }

            $data_1 = array(
                'archivo_zip' => $carpeta,
            );

            if (!$this->facturas_model->actualizar_factura_por_identificador($factura_row->identificador, $data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.2)', $data['controlador']);
            }
        } else {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.3) identificador: ' . $identificador, $data['controlador']);
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El archivo ha sido cargado con exito.', $data['controlador']);
    }

    public function agregar()
    {
        $fecha_registro = date("Y-m-d H:i:s");

        $key_1 = "facturas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
        $identificador_1 = hash("crc32b", $key_1);

        $data_1 = array(
            'identificador' => $identificador_1,
            'concepto' => null,
            'cliente_nombre' => null,
            'rfc' => null,
            'codigo_postal' => null,
            'regimen_fiscal' => null,
            'uso_cfdi' => null,
            'monto' => 0,
            'estatus_factura' => 'solicitud de factura',
            'fecha_registro' => $fecha_registro,
            'fecha_actualizacion' => $fecha_registro,
        );

        if (!$data_1) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor intentelo mas tarde. (1)', 'site/facturacion');
        }

        if (!$this->facturas_model->insertar_factura($data_1)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor intentelo mas tarde. (2)', 'site/facturacion');
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'Se ha agregado la factura con exitó.', 'site/facturacion');
    }

    public function eliminar($identificador = null)
    {
        $factura_row = $this->facturas_model->obtener_factura_por_identificador($identificador)->row();

        if (!$factura_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor intentelo mas tarde. (1)', 'site/facturacion');
        }

        if (!$this->facturas_model->eliminar_factura_por_identificador($factura_row->identificador)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor intentelo mas tarde. (2)', 'site/facturacion');
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'Se ha eliminado la factura con exitó.', 'site/facturacion');
    }


    public function actualizar()
    {
        $identificador = $this->input->post('identificador');
        $columna = $this->input->post('columna'); // Índice de la columna
        $nuevoValor = $this->input->post('nuevoValor');

        if ($columna == 'pago_identificador') {
            $inmueble_identificador = $this->pagos_model->obtener_inmueble_identificador_por_pago_identificador($nuevoValor)->row();
            $nombre_inmueble = $this->inmuebles_model->obtener_inmueble_por_identificador($inmueble_identificador->inmueble_identificador)->row();
            $desarrollo_identificador = $this->rel_inmuebles_model->obtener_desarrollo_identificador_por_inmueble_hijo_iedntificador($inmueble_identificador->inmueble_identificador)->row();
            $nombre_desarrollo = $this->inmuebles_model->obtener_desarrollo_por_identificador($desarrollo_identificador->inmueble_nodo_identificador)->row();

            $data_1 = array(
                $columna => $nuevoValor,
                'inmueble_identificador' => $inmueble_identificador->inmueble_identificador,  
                'desarrollo' => $nombre_desarrollo->nombre,
                'inmueble' => $nombre_inmueble->nombre,
                'concepto' => $inmueble_identificador->concepto,
                'fecha_actualizacion' => date('Y-m-d')
            );

            $data_2 = array(
                'estatus_pago' => 'cobrado'
            );

            $this->pagos_model->actualizar_pago_por_identificador($nuevoValor, $data_2);
        } else {

            $data_1 = array(
                $columna => $nuevoValor,
                'fecha_actualizacion' => date('Y-m-d')
            );
        }

        // Llama a tu modelo para actualizar el dato en la base de datos
        $this->facturas_model->actualizar_factura_por_identificador($identificador, $data_1);

        // Devuelve una respuesta (puede ser JSON o lo que necesites)
        echo json_encode(array('status' => 'success', 'message' => 'Dato actualizado'));
    }

    public function obtener_opciones_select_regimen_fiscal()
    {
        echo json_encode(select_regimen_fiscal());
        exit();
    }

    public function obtener_opciones_select_regimen_fiscal_moral()
    {
        echo json_encode(select_regimen_fiscal_moral());
        exit();
    }

    public function obtener_opciones_select_uso_cfdi()
    {
        echo json_encode(select_uso_cfdi());
        exit();
    }

    public function obtener_opciones_select_uso_cfdi_moral()
    {
        echo json_encode(select_uso_cfdi_moral());
        exit();
    }

    public function obtener_opciones_select_estatus_factura()
    {
        echo json_encode(select_estatus_factura());
        exit();
    }

    public function obtener_opciones_select_pago_identificador()
    {
        $pagos_list = $this->pagos_model->obtener_pagos();

        $data = [];
        foreach ($pagos_list->result() as $pago) {
            $data[] = array(
                'nombre' => $pago->identificador,
                'valor' => $pago->identificador
            );
        }

        echo json_encode($data);
        exit();
    }
}
