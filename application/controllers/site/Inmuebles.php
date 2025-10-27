<?php defined('BASEPATH') or exit('No direct script access allowed');

class Inmuebles extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('archivos_model');
        $this->load->model('contratos_model');
        $this->load->model('inmuebles_model');
        $this->load->model('rel_inmuebles_model');
        $this->load->model('procesos_venta_model');
        $this->load->model('pagos_model');
        $this->load->model('clientes_model');
        $this->load->model('logs_model');
        $this->load->model('notas_model');
        $this->load->model('facturas_model');
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Inmuebles';
        $data['pagina_subtitulo'] = 'Registro de inmuebles';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/inmuebles/index";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/inmuebles/index', $data);
    }

    public function obtener_tabla_index()
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $inmueble_list = $this->inmuebles_model->obtener_inmueble_y_desarrollo();

        $data = [];
        $cont = 1;

        foreach ($inmueble_list->result() as $inmuebles_row) {

            $opciones = '';

            if ($inmuebles_row->tipo_inmueble != "desarrollo") {
                $opciones .= '<a href="' . site_url('site/inmuebles/notas/' . $inmuebles_row->identificador) . '">Ver detalles</a>';
                if (in_array($inmuebles_row->estatus_inmueble, array('disponible', 'apartado'))) {
                    $opciones .= '&nbsp;|&nbsp;';
                    $opciones .= '<a href="' . site_url('site/procesos_venta/agregar/' . $inmuebles_row->identificador) . '">Proceso venta</a>';
                }
            }

            if ($inmuebles_row->tipo_inmueble == "desarrollo") {
                $opciones .= '<a href="' . site_url('site/desarrollos/ver/' . $inmuebles_row->identificador) . '">Ver detalles</a>';
            }

            $data[] = array(
                'id' => $cont,
                'identificador' => $inmuebles_row->identificador,
                'desarrollo' => mb_strtoupper($inmuebles_row->desarrollo_nombre),
                'nombre' => mb_strtoupper($inmuebles_row->nombre),
                'tipo_inmueble' => ucwords($inmuebles_row->tipo_inmueble),
                'precio' => !empty($inmuebles_row->precio) ? $inmuebles_row->precio : '0',
                'etapa' => $inmuebles_row->etapa,
                'estatus_inmueble' => ucwords($inmuebles_row->estatus_inmueble),
                'modalidad' => ucwords($inmuebles_row->modalidad),
                'prototipo' => mb_strtoupper($inmuebles_row->prototipo),
                'tamanho_construccion' => !empty($inmuebles_row->tamanho_construccion) ? $inmuebles_row->tamanho_construccion : '0',
                'tamanho_terraza' => !empty($inmuebles_row->tamanho_terraza) ? $inmuebles_row->tamanho_terraza : '0',
                'tamanho_total' => !empty($inmuebles_row->tamanho_total) ? $inmuebles_row->tamanho_total : '0',
                'opciones' => $opciones,
            );

            $cont++;
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $inmueble_list->num_rows(),
            'recordsFiltered' => $inmueble_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

    public function notas($identificador, $desarrollo_identificador = null)
    {
        $data['pagina_titulo'] = 'Notas';
        $data['pagina_subtitulo'] = 'Notas del inmueble';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/inmuebles/notas/' . $identificador;
        $data['ir_a'] = 'site/inmuebles/editar/' . $identificador;
        if (!empty($desarrollo_identificador)) {
        } else {
            $data['regresar_a'] = 'site/desarrollos';
        }
        $controlador_js = "site/inmuebles/notas";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();
        $data['desarrollo_row'] = $desarrollo_row;

        if ($desarrollo_row) {
            $data['regresar_a'] = 'site/desarrollos/notas/' . $desarrollo_row->inmueble_nodo_identificador;
        }

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if (!$inmueble_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        $data['inmueble_row'] = $inmueble_row;

        $notas_list = $this->notas_model->obtener_notas_por_origen_identificador_y_detalles($inmueble_row->identificador)->result();

        $data['notas_list'] = $notas_list;

        $this->construir_site_ui('site/inmuebles/notas', $data);
    }

    public function guardar_nota()
    {
        $identificador = $this->input->post('identificador');

        $data['controlador'] = 'site/inmuebles/notas/' . $identificador;
        $data['ir_a'] = 'site/inmuebles/notas/' . $identificador;

        if ($this->input->post('nota') != '') {

            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            $data_1 = array(
                'identificador' => $identificador_1,
                'usuario_identificador' => $this->session->userdata('user_identificador'),
                'origen_modulo' => 'inmuebles',
                'origen_identificador' => $identificador,
                'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
                'fecha_registro' => $fecha_registro
            );

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
            }

            if (!$this->notas_model->insertar_nota($data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'La nota ha sido agregada con éxito.', $data['controlador']);
        }

        $this->construir_site_ui('site/inmuebles/notas', $data);
    }

    public function agregar()
    {
        $data['pagina_titulo'] = 'Agregar inmueble';
        $data['pagina_subtitulo'] = 'Nuevo inmueble';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/agregar';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/agregar';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $desarrollos_list = $this->inmuebles_model->obtener_desarrollos()->result();

        $data['desarrollos_list'] = $desarrollos_list;

        $this->form_validation->set_rules('desarrollo', 'desarrollo', 'trim|required|max_length[240]');
        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|max_length[240]');
        $this->form_validation->set_rules('precio', 'precio', 'trim');
        $this->form_validation->set_rules('tipo_inmueble', 'tipo de inmueble', 'trim');

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/inmuebles/agregar', $data);
        } else {

            $this->session->set_flashdata('desarrollo', $this->input->post('desarrollo'));
            $this->session->set_flashdata('nombre', $this->input->post('nombre'));
            $this->session->set_flashdata('precio', $this->input->post('precio'));
            $this->session->set_flashdata('tipo_inmueble', $this->input->post('tipo_inmueble'));

            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "inmueble-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            $data_1 = array(
                'identificador' => $identificador_1,

                'nombre' => !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
                'tipo_inmueble' => !empty($this->input->post('tipo_inmueble')) ? $this->input->post('tipo_inmueble') : null,
                'precio' => !empty($this->input->post('precio')) ? $this->input->post('precio') : null,
                'etapa' => '1',
                'modalidad' => 'venta',
                'estatus_inmueble' => 'disponible',
                'estatus' => 'activo',

                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_registro,
            );

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
            }

            $key_2 = "desarrollo-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_2 = hash("crc32b", $key_2);

            $data_2 = array(
                'identificador' => $identificador_2,

                'inmueble_nodo_identificador' => !empty($this->input->post('desarrollo')) ? mb_strtolower($this->input->post('desarrollo')) : null,
                'inmueble_hijo_identificador' => $identificador_1,

                'fecha_registro' => $fecha_registro,
            );

            if (!$data_2) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
            }

            //Querys
            if (!$this->inmuebles_model->insertar_inmueble($data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
            }

            if (!$this->rel_inmuebles_model->insertar_rel_inmueble($data_2)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'El inmueble ' . $this->input->post('nombre') . ' ha sido agregado con éxito.', $data['regresar_a']);

            $this->construir_site_ui('site/inmuebles/agregar', $data);
        }
    }

    public function plan_pagos($identificador = null)
    {
        if ($this->input->post()) {
            $identificador = $this->input->post('identificador');
        }

        $data['pagina_titulo'] = 'Plan de pagos del inmueble';
        $data['pagina_subtitulo'] = 'Detalles del plan de pagos';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/inmuebles/plan_pagos/' . $identificador;
        $data['regresar_a'] = 'site/desarrollos/plan_pagos';
        $controlador_js = "site/inmuebles/plan_pagos";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        if (empty($identificador)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();
        $data['desarrollo_row'] = $desarrollo_row;

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if (!$inmueble_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
        }

        $data['inmueble_row'] = $inmueble_row;

        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador)->row();

        $pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($identificador);
        if ($proceso_venta_row) {

            $cliente_row = $this->clientes_model->obtener_cliente_por_identificador($proceso_venta_row->cliente_identificador)->row();

            if ($cliente_row) {
                $data['cliente_row'] = $cliente_row;

                $contrato_row = $this->contratos_model->obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($inmueble_row->identificador, $proceso_venta_row->identificador, $cliente_row->identificador)->row();

                if ($contrato_row) {
                    $data['deber_ser'] = json_decode($contrato_row->plan_pagos_deber_ser);
                    $data['ser'] = json_decode($contrato_row->plan_pagos_ser);
                    $data['contrato_row'] = $contrato_row;
                } else {
                    //$this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');
                    $contrato_row = "";
                    $data['deber_ser'] = $contrato_row;
                    $data['ser'] = $contrato_row;
                }
            } else {
                $this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');
            }
        } else {
            $this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');

            $contrato_row = "";
            $data['deber_ser'] = $contrato_row;
            $data['ser'] = $contrato_row;
        }

        $this->construir_site_ui('site/inmuebles/plan_pagos', $data);
    }

    public function obtener_procesos_venta_por_inmueble_identificador($identificador)
    {
        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador)->row();

        $pagos_list = $this->pagos_model->obtener_pagos_por_cobrar_por_inmueble_identificador($proceso_venta_row->identificador)->result();

        $total_tabla = 0;
        $por_validar = 0;
        $por_cobrar = 0;
        $vencido = 0;
        foreach ($pagos_list as $pago_row) {
            $total_tabla = $total_tabla + $pago_row->monto;
            if ($pago_row->estatus_pago === 'por validar') {
                $por_validar = $por_validar + $pago_row->monto;
            }
            if ($pago_row->estatus_pago === 'por cobrar') {
                $por_cobrar = $por_cobrar + $pago_row->monto;
            }
            if ($pago_row->estatus_pago === 'vencido') {
                $vencido = $vencido + $pago_row->monto;
            }
        }

        $data = array(
            'identificador' => $proceso_venta_row->identificador,
            'inmuebles_nodo_nombre' => mb_strtoupper($proceso_venta_row->inmuebles_nodo_nombre),
            'inmueble' => ucfirst($proceso_venta_row->inmuebles_tipo_inmueble . ' ' . $proceso_venta_row->inmuebles_nombre),
            'inmuebles_tamanho_total' => $proceso_venta_row->inmuebles_tamanho_total,
            'precio_lista' => number_format($proceso_venta_row->precio_lista, 2),
            'inmuebles_etapa' => $proceso_venta_row->inmuebles_etapa,
            'precio_venta' => number_format($proceso_venta_row->precio_venta, 2),
            'total_tabla' => number_format($total_tabla, 2),
            'pagado' => number_format($proceso_venta_row->pagado, 2),
            'por_validar' => number_format($por_validar, 2),
            'por_cobrar' => number_format($por_cobrar, 2),
            'vencido' => number_format($vencido, 2),
            'no_pagos' => $proceso_venta_row->no_pagos_concretados . '/' . $proceso_venta_row->no_pagos,
            'frecuencia' => ucwords($proceso_venta_row->frecuencia),
            'fecha_inicio' => date('Y/m/d', strtotime($proceso_venta_row->fecha_inicio)),
        );

        echo json_encode($data);
    }

    public function obtener_tabla_ver_proceso_venta($identificador)
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($identificador);


        foreach ($pagos_list->result() as $pago_key => $pago_value) {


            $opciones = '<a id="archivo" href="javascript:subir_comprobante_pago(\'' . $pago_value->identificador . '\');">Cargar comprobante de pago</a>';
            $opciones .= ' | ';
            $opciones .= '<a id="archivo" href="javascript:subir_comprobante_pago_expediente(\'' . $pago_value->identificador . '\');">Cargar comprobante de pago para expediente</a>';
            $opciones .= ' | ';
            $opciones .= '<a id="eliminar" href="javascript:eliminar_pago(\'' . $pago_value->identificador . '\');">Eliminar</a>';

            if (isset($pago_value->archivo_comprobante_pago) and !empty($pago_value->archivo_comprobante_pago)) {

                $tipo_extension = pathinfo($pago_value->archivo_comprobante_pago, PATHINFO_EXTENSION);

                if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                    $tipo_extension = 'archivo';
                } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension = 'imagen';
                }

                $opciones_archivo = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $pago_value->identificador . '/' . $pago_value->archivo_comprobante_pago) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Ver comprobante</a>';
            } else {

                $opciones_archivo = 'N/A';
            }

            if (isset($pago_value->archivo_comprobante_pago_expediente) and !empty($pago_value->archivo_comprobante_pago_expediente)) {

                $tipo_extension = pathinfo($pago_value->archivo_comprobante_pago_expediente, PATHINFO_EXTENSION);

                if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                    $tipo_extension = 'archivo';
                } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                    $tipo_extension = 'imagen';
                }

                $opciones_archivo_expediente = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $pago_value->identificador . '/' . $pago_value->archivo_comprobante_pago_expediente) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Ver comprobante</a>';
            } else {

                $opciones_archivo_expediente = 'N/A';
            }

            $data[] = array(
                'id' => $pago_key + 1,
                'identificador' => $pago_value->identificador,
                'fecha_programada' => (!empty($pago_value->fecha_programada) ? date('Y/m/d', strtotime($pago_value->fecha_programada)) : ''),
                'fecha_pago' => (!empty($pago_value->fecha_pago) ? date('Y/m/d', strtotime($pago_value->fecha_pago)) : ''),
                'concepto' => $pago_value->concepto,
                'monto' => $pago_value->monto,
                'archivo_comprobante_pago' => $opciones_archivo,
                'archivo_comprobante_pago_expediente' => $opciones_archivo_expediente,
                'estatus_pago' => ucfirst($pago_value->estatus_pago),
                'estatus' => ucfirst($pago_value->estatus),
                'fecha_registro' => date('Y/m/d', strtotime($pago_value->fecha_registro)),
                'fecha_actualizacion' => date('Y/m/d', strtotime($pago_value->fecha_actualizacion)),
                'opciones' => $opciones,
            );
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $pagos_list->num_rows(),
            'recordsFiltered' => $pagos_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

    public function cargar_comprobante_pago()
    {
        $identificador = $this->input->post('pago_identificador');

        $pago_row = $this->pagos_model->obtener_pago_por_identificador($identificador)->row();

        $data['controlador'] = 'site/inmuebles/plan_pagos/' . $pago_row->inmueble_identificador;
        $data['regresar_a'] = 'site/inmuebles/plan_pagos';

        if ($pago_row) {
            if ($pago_row->estatus_pago == 'cobrado') {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No puede subir comprobante de pago si el pago ya esta cobrado', $data['controlador']);
            }
            if ($pago_row->archivo_comprobante_pago != null) {
                if (isset($_FILES) && $_FILES['comprobante']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/procesos_venta/' . $pago_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('comprobante')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        if ($pago_row->archivo_comprobante_pago and $pago_row->archivo_comprobante_pago != "") {
                            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/procesos_venta/' . $pago_row->identificador . "/" . $pago_row->archivo_comprobante_pago);
                            unlink($archivo_a_borrar);
                        }
                        $data_imagen = $this->upload->data();
                        $archivo = $data_imagen['file_name'];
                    }
                } else {
                    $archivo = $pago_row->archivo_comprobante_pago;
                }

                $data_1 = array(
                    'archivo_comprobante_pago' => $archivo,
                );

                if (!$this->pagos_model->actualizar_pago_por_identificador($pago_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.1)', $data['controlador']);
                }
            } else {
                if (isset($_FILES) && $_FILES['comprobante']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/procesos_venta/' . $pago_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('comprobante')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        $data_imagen = $this->upload->data();
                        $archivo = $data_imagen['file_name'];
                    }
                } else {
                    $archivo = null;
                }

                $data_1 = array(
                    'archivo_comprobante_pago' => $archivo,
                    'estatus_pago' => 'por validar'
                );

                if (!$this->pagos_model->actualizar_pago_por_identificador($pago_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.2)', $data['controlador']);
                }
            }
        } else {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.3) identificador: ' . $identificador, $data['controlador']);
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El comprobante de pago ha sido cargado con exito.', $data['controlador']);
    }

    public function cargar_comprobante_pago_expediente()
    {
        $identificador = $this->input->post('pago_identificador_expediente');

        $pago_row = $this->pagos_model->obtener_pago_por_identificador($identificador)->row();

        $data['controlador'] = 'site/inmuebles/plan_pagos/' . $pago_row->inmueble_identificador;
        $data['regresar_a'] = 'site/inmuebles/plan_pagos';

        if ($pago_row) {
            if ($pago_row->estatus_pago == 'cobrado') {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No puede subir comprobante de pago para factura si el pago ya esta cobrado', $data['controlador']);
            }
            if ($pago_row->archivo_comprobante_pago_expediente != null) {
                if (isset($_FILES) && $_FILES['comprobante']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/procesos_venta/' . $pago_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('comprobante')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        if ($pago_row->archivo_comprobante_pago_expediente and $pago_row->archivo_comprobante_pago_expediente != "") {
                            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/procesos_venta/' . $pago_row->identificador . "/" . $pago_row->archivo_comprobante_pago_expediente);
                            unlink($archivo_a_borrar);
                        }
                        $data_imagen = $this->upload->data();
                        $archivo = $data_imagen['file_name'];
                    }
                } else {
                    $archivo = $pago_row->archivo_comprobante_pago_expediente;
                }

                $data_1 = array(
                    'archivo_comprobante_pago_expediente' => $archivo,
                );

                if (!$this->pagos_model->actualizar_pago_por_identificador($pago_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.1)', $data['controlador']);
                }
            } else {
                if (isset($_FILES) && $_FILES['comprobante']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/procesos_venta/' . $pago_row->identificador;
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls';
                    $config['max_size'] = (1024 * 50);
                    $config['encrypt_name']  = true;
                    $config['remove_spaces'] = true;
                    if (!is_dir($config['upload_path'])) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['controlador']));
                    }
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('comprobante')) {
                        $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['controlador']));
                    } else {
                        $data_imagen = $this->upload->data();
                        $archivo = $data_imagen['file_name'];
                    }
                } else {
                    $archivo = null;
                }

                $data_1 = array(
                    'archivo_comprobante_pago_expediente' => $archivo,
                    'estatus_pago' => 'por validar'
                );

                if (!$this->pagos_model->actualizar_pago_por_identificador($pago_row->identificador, $data_1)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.2)', $data['controlador']);
                }
            }
        } else {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.3) identificador: ' . $identificador, $data['controlador']);
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El comprobante de pago para expediente ha sido cargado con exito.', $data['controlador']);
    }

    public function actualizar_dato_pago()
    {
        $identificador = $this->input->post('identificador');
        $columna = $this->input->post('columna'); // Índice de la columna
        $nuevoValor = $this->input->post('nuevoValor');

        $data_1 = array(
            $columna => $nuevoValor
        );

        // Llama a tu modelo para actualizar el dato en la base de datos
        $this->pagos_model->actualizar_pago_por_identificador($identificador, $data_1);

        $pago_row = $this->pagos_model->obtener_pago_por_identificador($identificador)->row();

        $proceso_venta_row = $this->procesos_venta_model->obtener_proceso_venta_por_identificador($pago_row->proceso_venta_identificador)->row();

        $cliente_row = $this->procesos_venta_model->obtener_datos_cliente_para_facturacion_por_identificador($proceso_venta_row->cliente_identificador)->row();

        $pagos_list = $this->pagos_model->obtener_pagos_concretados_por_inmueble_identificador($pago_row->inmueble_identificador)->result();

        $apartado_row = $this->pagos_model->obtener_apartado_por_inmueble_identificador($pago_row->inmueble_identificador)->row();

        $enganche_row = $this->pagos_model->obtener_enganche_por_inmueble_identificador($pago_row->inmueble_identificador)->row();

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($pago_row->inmueble_identificador)->row();

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($inmueble_row->identificador)->row();

        $pagado = 0;
        $no_pagos_concretados = 0;

        foreach ($pagos_list as $pago_key => $pago_value) {
            if ($pago_value->estatus_pago === 'cobrado') {
                $pagado = $pagado + $pago_value->monto;
                $no_pagos_concretados = $no_pagos_concretados + 1;
            }
        }

        $data_2 = array(
            'pagado' => $pagado,
            'apartado' => $apartado_row->monto,
            'enganche' => $enganche_row->monto,
            'no_pagos_concretados' => $no_pagos_concretados
        );

        $this->procesos_venta_model->actualizar_proceso_venta_por_identificador($pago_row->proceso_venta_identificador, $data_2);

        $factura_row = $this->facturas_model->obtener_factura_por_pago_identificador_concepto($identificador, $pago_row->concepto)->row();

        if (!$factura_row) {
            if ($nuevoValor === 'cobrado') {
                $fecha_registro = date("Y-m-d H:i:s");

                $key_3 = "factura-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $identificador_3 = hash("crc32b", $key_3);

                $data_3 = array(
                    'identificador' => !empty($identificador_3) ? $identificador_3 : null,
                    'pago_identificador' => !empty($identificador) ? $identificador : null,
                    'desarrollo' => !empty($desarrollo_row->nombre) ? $desarrollo_row->nombre : null,
                    'inmueble_identificador' => !empty($inmueble_row->identificador) ? $inmueble_row->identificador : null,
                    'inmueble' => !empty($inmueble_row->nombre) ? $inmueble_row->nombre : null,
                    'concepto' => !empty($pago_row->concepto) ? $pago_row->concepto : null,
                    'cliente_nombre' => !empty($cliente_row->nombre) || !empty($cliente_row->apellido_paterno) || !empty($cliente_row->apellido_materno) ? trim($cliente_row->nombre . ' ' . $cliente_row->apellido_paterno . ' ' . $cliente_row->apellido_materno) : null,
                    'rfc' => !empty($cliente_row->rfc) ? $cliente_row->rfc : null,
                    'codigo_postal' => !empty($cliente_row->codigo_postal) ? $cliente_row->codigo_postal : null,
                    'regimen_fiscal' => !empty($cliente_row->regimen_fiscal) ? $cliente_row->regimen_fiscal : null,
                    'uso_cfdi' => !empty($cliente_row->uso_cfdi) ? $cliente_row->uso_cfdi : null,
                    'monto' => !empty($pago_row->monto) ? $pago_row->monto : null,
                    'estatus_factura' => 'solicitud de complemento de pago',
                    'fecha_registro' => !empty($fecha_registro) ? $fecha_registro : null,
                    'fecha_actualizacion' => !empty($fecha_registro) ? $fecha_registro : null,
                );

                $this->facturas_model->insertar_factura($data_3);
            }
        }

        // Devuelve una respuesta (puede ser JSON o lo que necesites)
        echo json_encode(array('status' => 'success', 'message' => 'Dato actualizado'));
    }

    public function agregar_pago()
    {
        // Iniciar la transacción
        $this->db->trans_start();

        try {
            $proceso_venta_identificador = $this->input->post('proceso_venta_identificador');

            if (!$proceso_venta_identificador) {
                throw new Exception('No se pudo encontrar el proceso de venta especificado. (1)');
            }

            $proceso_venta_row = $this->procesos_venta_model->obtener_proceso_venta_por_identificador($proceso_venta_identificador)->row();

            if (!$proceso_venta_row) {
                throw new Exception('No se pudo encontrar el proceso de venta especificado. (2)');
            }

            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "pago-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            $data_1 = array(
                'identificador' => $identificador_1,
                'proceso_venta_identificador' => $proceso_venta_row->identificador,
                'inmueble_identificador' => $proceso_venta_row->inmueble_identificador,
                'fecha_programada' => null,
                'fecha_pago' => null,
                'concepto' => 'Nuevo pago',
                'monto' => 0,
                'metodo_pago' => null,
                'estatus_pago' => 'por cobrar',
                'estatus' => 'activo',
                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_registro,
            );


            if (!$data_1) {
                throw new Exception('No se pudo actualizar los datos. (3)');
            }

            // Insertar el pago
            if (!$this->pagos_model->insertar_pago($data_1)) {
                throw new Exception('No se pudo insertar el pago. (4)');
            }

            $data_2 = array(
                'no_pagos' => $proceso_venta_row->no_pagos + 1
            );

            if (!$data_2) {
                throw new Exception('No se pudo actualizar los datos. (5)');
            }

            // Actualizar el proceso de venta
            if (!$this->procesos_venta_model->actualizar_proceso_venta_por_identificador($proceso_venta_row->identificador, $data_2)) {
                throw new Exception('No se pudo actualizar el proceso de venta. (6)');
            }

            // Confirmar la transacción si todo va bien
            $this->db->trans_commit();

            // Configurar un mensaje de éxito
            $response['success'] = true;
            $response['mensaje'] = 'El pago se agregó correctamente.';
        } catch (Exception $e) {
            // En caso de error, realizar un rollback y manejar el error
            $this->db->trans_rollback();
            $response['success'] = false;
            $response['error'] = 'Se produjo un error: ' . $e->getMessage();
        }

        // Devolver la respuesta como JSON
        echo json_encode($response);
    }

    public function guardar_tabla_deber_ser($identificador)
    {

        $data['pagina_titulo'] = 'Plan de pagos del inmueble';
        $data['pagina_subtitulo'] = 'Detalles del plan de pagos';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/inmuebles/plan_pagos/' . $identificador;
        $data['regresar_a'] = 'site/inmuebles/plan_pagos';
        $controlador_js = "site/inmuebles/plan_pagos";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($identificador)->result();

        $data_1 = array(
            'plan_pagos_deber_ser' => json_encode($pagos_list)
        );

        if (!$data_1) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
        }

        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador)->row();

        $contrato_row = $this->contratos_model->obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($proceso_venta_row->inmueble_identificador, $proceso_venta_row->identificador, $proceso_venta_row->cliente_identificador)->row();

        if ($contrato_row) {
            $this->contratos_model->actualizar_contrato_por_identificador($contrato_row->identificador, $data_1);

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'La tabla para contrato se ha guardado con éxito.', $data['controlador']);
        } else {
            // $this->mensaje_del_sistema('MENSAJE_INFO', 'Para poder guardar esta version de la tabla es necesario iniciar el <a href="../contrato/' . $proceso_venta_row->inmueble_identificador . '"><sapn class="white"><u>contrato</u></span></a>.',
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Para poder guardar esta version de la tabla es necesario iniciar el contrato.',
            $data['controlador']);
        }
    }

    public function guardar_tabla_ser($identificador)
    {

        $data['pagina_titulo'] = 'Plan de pagos del inmueble';
        $data['pagina_subtitulo'] = 'Detalles del plan de pagos';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/inmuebles/plan_pagos/' . $identificador;
        $data['regresar_a'] = 'site/inmuebles/plan_pagos';
        $controlador_js = "site/inmuebles/plan_pagos";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($identificador)->result();

        $data_1 = array(
            'plan_pagos_ser' => json_encode($pagos_list)
        );

        if (!$data_1) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
        }

        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador)->row();

        $contrato_row = $this->contratos_model->obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($proceso_venta_row->inmueble_identificador, $proceso_venta_row->identificador, $proceso_venta_row->cliente_identificador)->row();

        if ($contrato_row) {
            $this->contratos_model->actualizar_contrato_por_identificador($contrato_row->identificador, $data_1);

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'La tabla para escritura se ha guardado con éxito.', $data['controlador']);
        } else {
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Para poder guardar esta version de la tabla es necesario iniciar el <a href="../contrato/' . $proceso_venta_row->inmueble_identificador . '"><sapn class="white"><u>contrato</u></span></a>.', $data['controlador']);
        }
    }

    public function eliminar_pago()
    {
        // Iniciar la transacción
        $this->db->trans_start();

        try {
            if (!$this->input->post('pago_identificador')) {
                throw new Exception('No se pudo encontrar el pago especificado. (1)');
            }

            $pago_row = $this->pagos_model->obtener_pago_por_identificador($this->input->post('pago_identificador'))->row();

            if (!$pago_row) {
                throw new Exception('No se pudo encontrar el pago especificado. (2)');
            }

            $proceso_venta_row = $this->procesos_venta_model->obtener_proceso_venta_por_identificador($pago_row->proceso_venta_identificador)->row();

            if (!$proceso_venta_row) {
                throw new Exception('No se pudo encontrar el proceso de venta relacionado. (3)');
            }

            if (!$this->pagos_model->eliminar_pago_por_identificador($pago_row->identificador)) {
                throw new Exception('No se pudo eliminar el pago. (4)');
            }

            $pagos_list = $this->pagos_model->obtener_pagos_concretados_por_inmueble_identificador($pago_row->inmueble_identificador)->result();

            if (!$pagos_list) {
                throw new Exception('No se pudo calcular el total del proceso de venta. (5)');
            }

            $pagado = 0;
            $no_pagos_concretados = 0;

            foreach ($pagos_list as $pago_key => $pago_value) {
                if ($pago_value->estatus_pago != 'por cobrar') {
                    $pagado = $pagado + $pago_value->monto;
                    $no_pagos_concretados = $no_pagos_concretados + 1;
                }
            }

            $data_2 = array(
                'pagado' => $pagado,
                'no_pagos_concretados' => $no_pagos_concretados,
                'no_pagos' => $proceso_venta_row->no_pagos - 1
            );

            if (!$this->procesos_venta_model->actualizar_proceso_venta_por_identificador($proceso_venta_row->identificador, $data_2)) {
                throw new Exception('No se pudo actualizar el proceso de venta. (6)');
            }

            // Confirmar la transacción si todo va bien
            $this->db->trans_commit();

            // Configurar un mensaje de éxito
            $response['success'] = true;
            $response['mensaje'] = 'El pago se eliminó correctamente.';
        } catch (Exception $e) {
            // En caso de error, realizar un rollback y configurar un mensaje de error
            $this->db->trans_rollback();
            $response['success'] = false;
            $response['error'] = 'Se produjo un error: ' . $e->getMessage();
        }

        // Devolver la respuesta como JSON
        echo json_encode($response);
    }

    public function obtener_opciones_select_estatus_pago()
    {
        echo json_encode(select_estatus_pago());
        exit();
    }

    public function obtener_opciones_select_estatus_factura()
    {
        echo json_encode(select_estatus_factura());
        exit();
    }

    public function editar_inmueble($inmueble_hijo_identificador)
    {
        $data['pagina_titulo'] = 'Editar inmueble';
        $data['pagina_subtitulo'] = 'Inmueble';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/Editar_inmueble/' . $inmueble_hijo_identificador;
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/editar_inmueble';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $inmueble_row = $this->inmuebles_model->obtener_inmuebles_hijos_por_identificador($inmueble_hijo_identificador)->row();

        $data['inmueble_row'] = $inmueble_row;

        $this->construir_site_ui('site/inmuebles/editar_inmueble', $data);
    }

    public function datos_cliente()
    {
        $data['pagina_titulo'] = 'Datos del cliente';
        $data['pagina_subtitulo'] = 'Datos del cliente';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/datos_cliente';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/datos_cliente';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/inmuebles/datos_cliente', $data);
    }

    public function datos_inmueble()
    {
        $data['pagina_titulo'] = 'Datos del inmueble';
        $data['pagina_subtitulo'] = 'Datos del inmueble';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/datos_inmueble/';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/datos_inmueble';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/inmuebles/datos_inmueble', $data);
    }

    public function contrato($identificador = null)
    {

        $data['pagina_titulo'] = 'Contrato';
        $data['pagina_subtitulo'] = 'Detalles del contrato';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/inmuebles/contrato/' . $identificador;
        $data['regresar_a'] = 'site/desarrollos/contrato';
        $controlador_js = "site/inmuebles/contrato";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        // Datos cliente
        $this->form_validation->set_rules('nombre', 'nombre del cliente', 'trim|required|max_length[240]');
        $this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|max_length[240]');
        $this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|max_length[240]');
        $this->form_validation->set_rules('nombre_representante_legal', 'nombre representante legal', 'trim|max_length[240]');
        $this->form_validation->set_rules('apellido_representante_legal', 'apellido representante legal', 'trim|max_length[240]');
        $this->form_validation->set_rules('fecha_nacimiento', 'fecha de nacimiento', 'trim');
        $this->form_validation->set_rules('estado_civil', 'estado civil', 'trim');
        $this->form_validation->set_rules('curp', 'CURP', 'trim|max_length[18]');
        $this->form_validation->set_rules('ine', 'INE', 'trim|max_length[50]');
        $this->form_validation->set_rules('rfc', 'RFC', 'trim|max_length[20]');
        $this->form_validation->set_rules('domicilio_fiscal', 'domicilio fiscal', 'trim|max_length[240]');
        $this->form_validation->set_rules('correo_electronico', 'correo electrónico', 'trim|valid_email|max_length[240]');

        // Datos inmueble
        $this->form_validation->set_rules('inmueble_nombre', 'nombre del inmueble', 'trim|max_length[240]');
        $this->form_validation->set_rules('inmueble_tamanho_construccion', 'tamaño de construcción número', 'trim');
        $this->form_validation->set_rules('inmueble_tamanho_terraza', 'tamaño de terraza número', 'trim');
        $this->form_validation->set_rules('inmueble_tamanho_total', 'tamaño total número', 'trim');

        // Datos proceso de venta
        $this->form_validation->set_rules('proceso_venta_precio_venta', 'precio de venta', 'trim');

        //Daros de contrato
        $this->form_validation->set_rules('contrato_inmueble_nombre_letra', 'nombre del inmueble para contrato', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_proceso_venta_precio_venta_letra', 'precio de venta(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_tamanho_construccion_letra', 'tamaño de construccion(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_tamanho_terraza_letra', 'tamaño de terraza(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_tamanho_total_letra', 'tamño total(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_cajon_estacionamiento_numero', 'cajon de estacionamiento con numero', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_cajon_estacionamiento_letra', 'cajon de estacionamiento con letra', 'trim');
        $this->form_validation->set_rules('contrato_cliente_fecha_nacimiento_letra', 'fecha de nacimiento con letra', 'trim');
        $this->form_validation->set_rules('contrato_fecha_contrato', 'fecha de contrato', 'trim');

        //notas
        $this->form_validation->set_rules('nota', 'Nota', 'trim');

        $contrato_list = $this->contratos_model->obtener_contratos()->result();

        $data['contrato_list'] = $contrato_list;

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();
        $data['desarrollo_row'] = $desarrollo_row;

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if ($inmueble_row) {
            $data['inmueble_row'] = $inmueble_row;

            $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($inmueble_row->identificador)->row();

            if ($proceso_venta_row) {
                $data['proceso_venta_row'] = $proceso_venta_row;

                $pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($inmueble_row->identificador)->result();

                $data['pagos_list'] = $pagos_list;

                $cliente_row = $this->clientes_model->obtener_cliente_por_identificador($proceso_venta_row->cliente_identificador)->row();

                if ($cliente_row) {
                    $data['cliente_row'] = $cliente_row;

                    $contrato_row = $this->contratos_model->obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($inmueble_row->identificador, $proceso_venta_row->identificador, $cliente_row->identificador)->row();

                    if ($contrato_row) {
                        $data['deber_ser'] = json_decode($contrato_row->plan_pagos_deber_ser);
                        $data['contrato_row'] = $contrato_row;
                    } else {
                        //$this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');
                        $contrato_row = "";
                        $data['deber_ser'] = $contrato_row;
                        $data['contrato_row'] = $contrato_row;
                    }
                } else {
                    $this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');

                    $cliente_row = "";
                    $data['cliente_row'] = $cliente_row;

                    $contrato_row = "";
                    $data['deber_ser'] = $contrato_row;
                    $data['contrato_row'] = $contrato_row;
                }
            } else {
                $this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');
                $proceso_venta_row = "";
                $data['proceso_venta_row'] = $proceso_venta_row;

                $pagos_list = "";
                $data['pagos_list'] = $pagos_list;

                $cliente_row = "";
                $data['cliente_row'] = $cliente_row;

                $contrato_row = "";
                $data['deber_ser'] = $contrato_row;
                $data['contrato_row'] = $contrato_row;
            }
        } else {
            $this->mensaje_del_sistema('MENSAJE_ERROR', mostrar_mensaje_error_solicitud(), $data['regresar_a']);
        }

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/inmuebles/contrato', $data);
        } else {

            // Datos cliente
            $this->session->set_flashdata('nombre', $this->input->post('nombre'));
            $this->session->set_flashdata('apellido_paterno', $this->input->post('apellido_paterno'));
            $this->session->set_flashdata('apellido_materno', $this->input->post('apellido_materno'));
            $this->session->set_flashdata('nombre_representante_legal', $this->input->post('nombre_representante_legal'));
            $this->session->set_flashdata('apellido_representante_legal', $this->input->post('apellido_representante_legal'));
            $this->session->set_flashdata('fecha_nacimiento', $this->input->post('fecha_nacimiento'));
            $this->session->set_flashdata('estado_civil', $this->input->post('estado_civil'));
            $this->session->set_flashdata('curp', $this->input->post('curp'));
            $this->session->set_flashdata('ine', $this->input->post('ine'));
            $this->session->set_flashdata('rfc', $this->input->post('rfc'));
            $this->session->set_flashdata('domicilio_fiscal', $this->input->post('domicilio_fiscal'));
            $this->session->set_flashdata('correo_electronico', $this->input->post('correo_electronico'));

            // Datos inmueble
            $this->session->set_flashdata('inmueble_nombre', $this->input->post('inmueble_nombre'));
            $this->session->set_flashdata('inmueble_tamanho_construccion', $this->input->post('inmueble_tamanho_construccion'));
            $this->session->set_flashdata('inmueble_tamanho_terraza', $this->input->post('inmueble_tamanho_terraza'));
            $this->session->set_flashdata('inmueble_tamanho_total', $this->input->post('inmueble_tamanho_total'));

            // Datos proceso de venta
            $this->session->set_flashdata('proceso_venta_precio_venta', $this->input->post('proceso_venta_precio_venta'));

            //Datos de contrato
            $this->session->set_flashdata('contrato_inmueble_nombre_letra', $this->input->post('contrato_inmueble_nombre_letra'));
            $this->session->set_flashdata('contrato_proceso_venta_precio_venta_letra', $this->input->post('contrato_proceso_venta_precio_venta_letra'));
            $this->session->set_flashdata('contrato_inmueble_tamanho_construccion_letra', $this->input->post('contrato_inmueble_tamanho_construccion_letra'));
            $this->session->set_flashdata('contrato_inmueble_tamanho_terraza_letra', $this->input->post('contrato_inmueble_tamanho_terraza_letra'));
            $this->session->set_flashdata('contrato_inmueble_tamanho_total_letra', $this->input->post('contrato_inmueble_tamanho_total_letra'));
            $this->session->set_flashdata('contrato_inmueble_cajon_estacionamiento_numero', $this->input->post('contrato_inmueble_cajon_estacionamiento_numero'));
            $this->session->set_flashdata('contrato_inmueble_cajon_estacionamiento_letra', $this->input->post('contrato_inmueble_cajon_estacionamiento_letra'));
            $this->session->set_flashdata('contrato_cliente_fecha_nacimiento_letra', $this->input->post('contrato_cliente_fecha_nacimiento_letra'));
            $this->session->set_flashdata('contrato_fecha_contrato', $this->input->post('contrato_fecha_contrato'));

            //notas
            $this->session->set_flashdata('nota', $this->input->post('nota'));

            $data_1 = array(
                'nombre'                            => !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
                'apellido_paterno'                  => !empty($this->input->post('apellido_paterno')) ? mb_strtolower($this->input->post('apellido_paterno')) : null,
                'apellido_materno'                  => !empty($this->input->post('apellido_materno')) ? mb_strtolower($this->input->post('apellido_materno')) : null,
                'nombre_representante_legal'        => !empty($this->input->post('nombre_representante_legal')) ? mb_strtolower($this->input->post('nombre_representante_legal')) : null,
                'apellido_representante_legal'      => !empty($this->input->post('apellido_representante_legal')) ? mb_strtolower($this->input->post('apellido_representante_legal')) : null,
                'fecha_nacimiento'                  => (!empty($this->input->post('fecha_nacimiento'))) ? strval(date('Y-m-d', strtotime($this->input->post('fecha_nacimiento')))) : null,
                'estado_civil'                      => !empty($this->input->post('estado_civil')) ? $this->input->post('estado_civil') : null,
                'curp'                              => !empty($this->input->post('curp')) ? mb_strtolower($this->input->post('curp')) : null,
                'ine'                               => !empty($this->input->post('ine')) ? $this->input->post('ine') : null,
                'rfc'                               => !empty($this->input->post('rfc')) ? mb_strtolower($this->input->post('rfc')) : null,
                'domicilio_fiscal'                  => !empty($this->input->post('domicilio_fiscal')) ? mb_strtolower($this->input->post('domicilio_fiscal')) : null,
                'correo_electronico'                => !empty($this->input->post('correo_electronico')) ? mb_strtolower($this->input->post('correo_electronico')) : null,
                'fecha_actualizacion'               => date('Y-m-d H:i:s'),
            );

            $data_2 = array(
                'nombre'                            => !empty($this->input->post('inmueble_nombre')) ? mb_strtolower($this->input->post('inmueble_nombre')) : null,
                'tamanho_construccion'              => !empty($this->input->post('inmueble_tamanho_construccion')) ? $this->input->post('inmueble_tamanho_construccion') : null,
                'tamanho_terraza'                   => !empty($this->input->post('inmueble_tamanho_terraza')) ? $this->input->post('inmueble_tamanho_terraza') : null,
                'tamanho_total'                     => !empty($this->input->post('inmueble_tamanho_total')) ? $this->input->post('inmueble_tamanho_total') : null,
                'fecha_actualizacion'               => date('Y-m-d H:i:s'),
            );

            $data_3 = array(
                'precio_venta'                      => !empty($this->input->post('proceso_venta_precio_venta')) ? $this->input->post('proceso_venta_precio_venta') : null,
                'fecha_actualizacion'               => date('Y-m-d H:i:s'),
            );

            $data_4 = array(
                'inmueble_nombre_letra'                             => !empty($this->input->post('contrato_inmueble_nombre_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_nombre_letra')) : null,
                'proceso_venta_precio_venta_letra'                  => !empty($this->input->post('contrato_proceso_venta_precio_venta_letra')) ? mb_strtolower($this->input->post('contrato_proceso_venta_precio_venta_letra')) : null,
                'inmueble_tamanho_construccion_letra'               => !empty($this->input->post('contrato_inmueble_tamanho_construccion_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_tamanho_construccion_letra')) : null,
                'inmueble_tamanho_terraza_letra'                    => !empty($this->input->post('contrato_inmueble_tamanho_terraza_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_tamanho_terraza_letra')) : null,
                'inmueble_tamanho_total_letra'                      => !empty($this->input->post('contrato_inmueble_tamanho_total_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_tamanho_total_letra')) : null,
                'inmueble_cajon_estacionamiento_numero'             => !empty($this->input->post('contrato_inmueble_cajon_estacionamiento_numero')) ? mb_strtolower($this->input->post('contrato_inmueble_cajon_estacionamiento_numero')) : null,
                'inmueble_cajon_estacionamiento_letra'              => !empty($this->input->post('contrato_inmueble_cajon_estacionamiento_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_cajon_estacionamiento_letra')) : null,
                'cliente_fecha_nacimiento_letra'              => !empty($this->input->post('contrato_cliente_fecha_nacimiento_letra')) ? mb_strtolower($this->input->post('contrato_cliente_fecha_nacimiento_letra')) : null,
                'fecha_contrato'                                    => (!empty($this->input->post('contrato_fecha_contrato'))) ? strval(date('Y-m-d', strtotime($this->input->post('contrato_fecha_contrato')))) : null,
                'fecha_actualizacion'                               => date('Y-m-d H:i:s'),
            );

            if (!$contrato_row) {
                $fecha_registro = date("Y-m-d H:i:s");

                $key_1 = "contrato-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $identificador_1 = hash("crc32b", $key_1);

                // Add individual key-value pairs to $data_4
                $data_4['identificador'] = $identificador_1;
                $data_4['inmueble_identificador'] = !empty($inmueble_row->identificador) ? $inmueble_row->identificador : null;
                $data_4['proceso_venta_identificador'] = !empty($proceso_venta_row->identificador) ? $proceso_venta_row->identificador : null;
                $data_4['cliente_identificador'] = !empty($cliente_row->identificador) ? $cliente_row->identificador : null;
                $data_4['fecha_registro'] = date('Y-m-d H:i:s');



                if ($this->input->post('nota') != '') {

                    $key_5 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                    $identificador_5 = hash("crc32b", $key_5);

                    $data_5 = array(
                        'identificador' => $identificador_5,
                        'usuario_identificador' => $this->session->userdata('user_identificador'),
                        'origen_modulo' => 'contratos',
                        'origen_identificador' => $identificador_1,
                        'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
                        'fecha_registro' => $fecha_registro
                    );

                    if (!$data_5) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
                    }

                    if (!$this->notas_model->insertar_nota($data_5)) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
                    }
                }
            }

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
            }

            if (!$data_2) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
            }

            if (!$data_3) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (3)', $data['regresar_a']);
            }

            if (!$data_4) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4)', $data['regresar_a']);
            }

            if (!$this->clientes_model->actualizar_cliente_por_identificador($cliente_row->identificador, $data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (5)', $data['controlador']);
            }

            if (!$this->inmuebles_model->actualizar_inmueble_por_identificador($inmueble_row->identificador, $data_2)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (6)', $data['controlador']);
            }

            if (!$this->procesos_venta_model->actualizar_proceso_venta_por_identificador($proceso_venta_row->identificador, $data_3)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (7)', $data['controlador']);
            }

            if (!$contrato_row) {
                if (!$this->contratos_model->insertar_contrato($data_4)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (8)', $data['controlador']);
                }
            } else {
                if (!$this->contratos_model->actualizar_contrato_por_identificador($contrato_row->identificador, $data_4)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (9)', $data['controlador']);
                }

                if ($this->input->post('nota') != '') {

                    $key_5 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                    $identificador_5 = hash("crc32b", $key_5);

                    $data_5 = array(
                        'identificador' => $identificador_5,
                        'usuario_identificador' => $this->session->userdata('user_identificador'),
                        'origen_modulo' => 'contratos',
                        'origen_identificador' => $contrato_row->identificador,
                        'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
                        'fecha_registro' => $fecha_registro
                    );

                    if (!$data_5) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
                    }

                    if (!$this->notas_model->insertar_nota($data_5)) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
                    }
                }
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'Los datos han sido editados con éxito.', $data['controlador']);

            $this->construir_site_ui('site/inmuebles/contrato', $data);
        }
    }

    public function contrato_portamar($identificador = null)
    {
        $data['pagina_titulo'] = 'Contrato Portamar';
        $data['pagina_subtitulo'] = 'Detalles del contrato';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/inmuebles/contrato_portamar/'. $identificador;
        $data['regresar_a'] = 'site/desarrollos/contrato_portamar';
        $controlador_js = "site/inmuebles/contrato_portamar";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        // Datos cliente
        $this->form_validation->set_rules('nombre', 'nombre del cliente', 'trim|required|max_length[240]');
        $this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|max_length[240]');
        $this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|max_length[240]');
        $this->form_validation->set_rules('nombre_representante_legal', 'nombre representante legal', 'trim|max_length[240]');
        $this->form_validation->set_rules('apellido_representante_legal', 'apellido representante legal', 'trim|max_length[240]');
        $this->form_validation->set_rules('fecha_nacimiento', 'fecha de nacimiento', 'trim');
        $this->form_validation->set_rules('estado_civil', 'estado civil', 'trim');
        $this->form_validation->set_rules('curp', 'CURP', 'trim|max_length[18]');
        $this->form_validation->set_rules('ine', 'INE', 'trim|max_length[50]');
        $this->form_validation->set_rules('rfc', 'RFC', 'trim|max_length[20]');
        $this->form_validation->set_rules('domicilio_fiscal', 'domicilio fiscal', 'trim|max_length[240]');
        $this->form_validation->set_rules('correo_electronico', 'correo electrónico', 'trim|valid_email|max_length[240]');

        // Datos inmueble
        $this->form_validation->set_rules('inmueble_nombre', 'nombre del inmueble', 'trim|max_length[240]');
        $this->form_validation->set_rules('inmueble_tamanho_construccion', 'tamaño de construcción número', 'trim');
        $this->form_validation->set_rules('inmueble_tamanho_terraza', 'tamaño de terraza número', 'trim');
        $this->form_validation->set_rules('inmueble_tamanho_total', 'tamaño total número', 'trim');

        // Datos proceso de venta
        $this->form_validation->set_rules('proceso_venta_precio_venta', 'precio de venta', 'trim');

        //Daros de contrato
        $this->form_validation->set_rules('contrato_inmueble_nombre_letra', 'nombre del inmueble para contrato', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_proceso_venta_precio_venta_letra', 'precio de venta(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_tamanho_construccion_letra', 'tamaño de construccion(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_tamanho_terraza_letra', 'tamaño de terraza(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_tamanho_total_letra', 'tamño total(letra)', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_cajon_estacionamiento_numero', 'cajon de estacionamiento con numero', 'trim|max_length[240]');
        $this->form_validation->set_rules('contrato_inmueble_cajon_estacionamiento_letra', 'cajon de estacionamiento con letra', 'trim');
        $this->form_validation->set_rules('contrato_cliente_fecha_nacimiento_letra', 'fecha de nacimiento con letra', 'trim');
        $this->form_validation->set_rules('contrato_cliente_nacionalidad', 'Nacionalidad', 'trim');
        $this->form_validation->set_rules('contrato_fecha_contrato', 'fecha de contrato', 'trim');

        //notas
        $this->form_validation->set_rules('nota', 'Nota', 'trim');

        $contrato_list = $this->contratos_model->obtener_contratos()->result();

        $data['contrato_list'] = $contrato_list;

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();
        $data['desarrollo_row'] = $desarrollo_row;

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if ($inmueble_row) {
            $data['inmueble_row'] = $inmueble_row;

            $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($inmueble_row->identificador)->row();

            if ($proceso_venta_row) {
                $data['proceso_venta_row'] = $proceso_venta_row;

                $pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($inmueble_row->identificador)->result();

                $data['pagos_list'] = $pagos_list;

                $cliente_row = $this->clientes_model->obtener_cliente_por_identificador($proceso_venta_row->cliente_identificador)->row();

                if ($cliente_row) {
                    $data['cliente_row'] = $cliente_row;

                    $contrato_row = $this->contratos_model->obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($inmueble_row->identificador, $proceso_venta_row->identificador, $cliente_row->identificador)->row();

                    if ($contrato_row) {
                        $data['deber_ser'] = json_decode($contrato_row->plan_pagos_deber_ser);
                        $data['contrato_row'] = $contrato_row;
                    } else {
                        //$this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');
                        $contrato_row = "";
                        $data['deber_ser'] = $contrato_row;
                        $data['contrato_row'] = $contrato_row;
                    }
                } else {
                    $this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');

                    $cliente_row = "";
                    $data['cliente_row'] = $cliente_row;

                    $contrato_row = "";
                    $data['deber_ser'] = $contrato_row;
                    $data['contrato_row'] = $contrato_row;
                }
            } else {
                $this->session->set_flashdata('MENSAJE_INFO', 'Para poder completar la información es necesario iniciar un proceso de venta.');
                $proceso_venta_row = "";
                $data['proceso_venta_row'] = $proceso_venta_row;

                $pagos_list = "";
                $data['pagos_list'] = $pagos_list;

                $cliente_row = "";
                $data['cliente_row'] = $cliente_row;

                $contrato_row = "";
                $data['deber_ser'] = $contrato_row;
                $data['contrato_row'] = $contrato_row;
            }
        } else {
            $this->mensaje_del_sistema('MENSAJE_ERROR', mostrar_mensaje_error_solicitud(), $data['regresar_a']);
        }

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/inmuebles/contrato_portamar', $data);
        } else {

            // Datos cliente
            $this->session->set_flashdata('nombre', $this->input->post('nombre'));
            $this->session->set_flashdata('apellido_paterno', $this->input->post('apellido_paterno'));
            $this->session->set_flashdata('apellido_materno', $this->input->post('apellido_materno'));
            $this->session->set_flashdata('nombre_representante_legal', $this->input->post('nombre_representante_legal'));
            $this->session->set_flashdata('apellido_representante_legal', $this->input->post('apellido_representante_legal'));
            $this->session->set_flashdata('fecha_nacimiento', $this->input->post('fecha_nacimiento'));
            $this->session->set_flashdata('estado_civil', $this->input->post('estado_civil'));
            $this->session->set_flashdata('curp', $this->input->post('curp'));
            $this->session->set_flashdata('ine', $this->input->post('ine'));
            $this->session->set_flashdata('rfc', $this->input->post('rfc'));
            $this->session->set_flashdata('domicilio_fiscal', $this->input->post('domicilio_fiscal'));
            $this->session->set_flashdata('correo_electronico', $this->input->post('correo_electronico'));

            // Datos inmueble
            $this->session->set_flashdata('inmueble_nombre', $this->input->post('inmueble_nombre'));
            $this->session->set_flashdata('inmueble_tamanho_construccion', $this->input->post('inmueble_tamanho_construccion'));
            $this->session->set_flashdata('inmueble_tamanho_terraza', $this->input->post('inmueble_tamanho_terraza'));
            $this->session->set_flashdata('inmueble_tamanho_total', $this->input->post('inmueble_tamanho_total'));

            // Datos proceso de venta
            $this->session->set_flashdata('proceso_venta_precio_venta', $this->input->post('proceso_venta_precio_venta'));

            //Datos de contrato
            $this->session->set_flashdata('contrato_inmueble_nombre_letra', $this->input->post('contrato_inmueble_nombre_letra'));
            $this->session->set_flashdata('contrato_proceso_venta_precio_venta_letra', $this->input->post('contrato_proceso_venta_precio_venta_letra'));
            $this->session->set_flashdata('contrato_inmueble_tamanho_construccion_letra', $this->input->post('contrato_inmueble_tamanho_construccion_letra'));
            $this->session->set_flashdata('contrato_inmueble_tamanho_terraza_letra', $this->input->post('contrato_inmueble_tamanho_terraza_letra'));
            $this->session->set_flashdata('contrato_inmueble_tamanho_total_letra', $this->input->post('contrato_inmueble_tamanho_total_letra'));
            $this->session->set_flashdata('contrato_inmueble_cajon_estacionamiento_numero', $this->input->post('contrato_inmueble_cajon_estacionamiento_numero'));
            $this->session->set_flashdata('contrato_inmueble_cajon_estacionamiento_letra', $this->input->post('contrato_inmueble_cajon_estacionamiento_letra'));
            $this->session->set_flashdata('contrato_cliente_fecha_nacimiento_letra', $this->input->post('contrato_cliente_fecha_nacimiento_letra'));
            $this->session->set_flashdata('contrato_fecha_contrato', $this->input->post('contrato_fecha_contrato'));

            //notas
            $this->session->set_flashdata('nota', $this->input->post('nota'));

            $data_1 = array(
                'nombre'                            => !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
                'apellido_paterno'                  => !empty($this->input->post('apellido_paterno')) ? mb_strtolower($this->input->post('apellido_paterno')) : null,
                'apellido_materno'                  => !empty($this->input->post('apellido_materno')) ? mb_strtolower($this->input->post('apellido_materno')) : null,
                'nombre_representante_legal'        => !empty($this->input->post('nombre_representante_legal')) ? mb_strtolower($this->input->post('nombre_representante_legal')) : null,
                'apellido_representante_legal'      => !empty($this->input->post('apellido_representante_legal')) ? mb_strtolower($this->input->post('apellido_representante_legal')) : null,
                'fecha_nacimiento'                  => (!empty($this->input->post('fecha_nacimiento'))) ? strval(date('Y-m-d', strtotime($this->input->post('fecha_nacimiento')))) : null,
                'estado_civil'                      => !empty($this->input->post('estado_civil')) ? $this->input->post('estado_civil') : null,
                'curp'                              => !empty($this->input->post('curp')) ? mb_strtolower($this->input->post('curp')) : null,
                'ine'                               => !empty($this->input->post('ine')) ? $this->input->post('ine') : null,
                'rfc'                               => !empty($this->input->post('rfc')) ? mb_strtolower($this->input->post('rfc')) : null,
                'domicilio_fiscal'                  => !empty($this->input->post('domicilio_fiscal')) ? mb_strtolower($this->input->post('domicilio_fiscal')) : null,
                'correo_electronico'                => !empty($this->input->post('correo_electronico')) ? mb_strtolower($this->input->post('correo_electronico')) : null,
                'fecha_actualizacion'               => date('Y-m-d H:i:s'),
            );

            $data_2 = array(
                'nombre'                            => !empty($this->input->post('inmueble_nombre')) ? mb_strtolower($this->input->post('inmueble_nombre')) : null,
                'tamanho_construccion'              => !empty($this->input->post('inmueble_tamanho_construccion')) ? $this->input->post('inmueble_tamanho_construccion') : null,
                'tamanho_terraza'                   => !empty($this->input->post('inmueble_tamanho_terraza')) ? $this->input->post('inmueble_tamanho_terraza') : null,
                'tamanho_total'                     => !empty($this->input->post('inmueble_tamanho_total')) ? $this->input->post('inmueble_tamanho_total') : null,
                'fecha_actualizacion'               => date('Y-m-d H:i:s'),
            );

            $data_3 = array(
                'precio_venta'                      => !empty($this->input->post('proceso_venta_precio_venta')) ? $this->input->post('proceso_venta_precio_venta') : null,
                'fecha_actualizacion'               => date('Y-m-d H:i:s'),
            );

            $data_4 = array(
                'inmueble_nombre_letra'                             => !empty($this->input->post('contrato_inmueble_nombre_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_nombre_letra')) : null,
                'proceso_venta_precio_venta_letra'                  => !empty($this->input->post('contrato_proceso_venta_precio_venta_letra')) ? mb_strtolower($this->input->post('contrato_proceso_venta_precio_venta_letra')) : null,
                'inmueble_tamanho_construccion_letra'               => !empty($this->input->post('contrato_inmueble_tamanho_construccion_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_tamanho_construccion_letra')) : null,
                'inmueble_tamanho_terraza_letra'                    => !empty($this->input->post('contrato_inmueble_tamanho_terraza_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_tamanho_terraza_letra')) : null,
                'inmueble_tamanho_total_letra'                      => !empty($this->input->post('contrato_inmueble_tamanho_total_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_tamanho_total_letra')) : null,
                'inmueble_cajon_estacionamiento_numero'             => !empty($this->input->post('contrato_inmueble_cajon_estacionamiento_numero')) ? mb_strtolower($this->input->post('contrato_inmueble_cajon_estacionamiento_numero')) : null,
                'inmueble_cajon_estacionamiento_letra'              => !empty($this->input->post('contrato_inmueble_cajon_estacionamiento_letra')) ? mb_strtolower($this->input->post('contrato_inmueble_cajon_estacionamiento_letra')) : null,
                'cliente_fecha_nacimiento_letra'              => !empty($this->input->post('contrato_cliente_fecha_nacimiento_letra')) ? mb_strtolower($this->input->post('contrato_cliente_fecha_nacimiento_letra')) : null,
                'cliente_nacionalidad'              => !empty($this->input->post('contrato_cliente_nacionalidad')) ? mb_strtolower($this->input->post('contrato_cliente_nacionalidad')) : null,
                'fecha_contrato'                                    => (!empty($this->input->post('contrato_fecha_contrato'))) ? strval(date('Y-m-d', strtotime($this->input->post('contrato_fecha_contrato')))) : null,
                'fecha_actualizacion'                               => date('Y-m-d H:i:s'),
            );

            if (!$contrato_row) {
                $fecha_registro = date("Y-m-d H:i:s");

                $key_1 = "contrato-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $identificador_1 = hash("crc32b", $key_1);

                // Add individual key-value pairs to $data_4
                $data_4['identificador'] = $identificador_1;
                $data_4['inmueble_identificador'] = !empty($inmueble_row->identificador) ? $inmueble_row->identificador : null;
                $data_4['proceso_venta_identificador'] = !empty($proceso_venta_row->identificador) ? $proceso_venta_row->identificador : null;
                $data_4['cliente_identificador'] = !empty($cliente_row->identificador) ? $cliente_row->identificador : null;
                $data_4['fecha_registro'] = date('Y-m-d H:i:s');



                if ($this->input->post('nota') != '') {

                    $key_5 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                    $identificador_5 = hash("crc32b", $key_5);

                    $data_5 = array(
                        'identificador' => $identificador_5,
                        'usuario_identificador' => $this->session->userdata('user_identificador'),
                        'origen_modulo' => 'contratos',
                        'origen_identificador' => $identificador_1,
                        'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
                        'fecha_registro' => $fecha_registro
                    );

                    if (!$data_5) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
                    }

                    if (!$this->notas_model->insertar_nota($data_5)) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
                    }
                }
            }

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
            }

            if (!$data_2) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
            }

            if (!$data_3) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (3)', $data['regresar_a']);
            }

            if (!$data_4) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4)', $data['regresar_a']);
            }

            if (!$this->clientes_model->actualizar_cliente_por_identificador($cliente_row->identificador, $data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (5)', $data['controlador']);
            }

            if (!$this->inmuebles_model->actualizar_inmueble_por_identificador($inmueble_row->identificador, $data_2)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (6)', $data['controlador']);
            }

            if (!$this->procesos_venta_model->actualizar_proceso_venta_por_identificador($proceso_venta_row->identificador, $data_3)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (7)', $data['controlador']);
            }

            if (!$contrato_row) {
                if (!$this->contratos_model->insertar_contrato($data_4)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (8)', $data['controlador']);
                }
            } else {
                if (!$this->contratos_model->actualizar_contrato_por_identificador($contrato_row->identificador, $data_4)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (9)', $data['controlador']);
                }

                if ($this->input->post('nota') != '') {

                    $key_5 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                    $identificador_5 = hash("crc32b", $key_5);

                    $data_5 = array(
                        'identificador' => $identificador_5,
                        'usuario_identificador' => $this->session->userdata('user_identificador'),
                        'origen_modulo' => 'contratos',
                        'origen_identificador' => $contrato_row->identificador,
                        'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
                        'fecha_registro' => $fecha_registro
                    );

                    if (!$data_5) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
                    }

                    if (!$this->notas_model->insertar_nota($data_5)) {
                        $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
                    }
                }
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'Los datos han sido editados con éxito.', $data['controlador']);

            $this->construir_site_ui('site/inmuebles/contrato_portamar', $data);
        }
              
    }

    public function facturas()
    {
        $data['pagina_titulo'] = 'Facturas';
        $data['pagina_subtitulo'] = 'Facturas';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/facturas/';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/facturas';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/inmuebles/facturas', $data);
    }

    public function documentos($identificador = null)
    {
        $data['pagina_titulo'] = 'Documentos';
        $data['pagina_subtitulo'] = 'Documentos';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/documentos/' . $identificador;
        $data['regresar_a'] = 'site/inmuebles/notas/' . $identificador;
        $controlador_js = 'site/inmuebles/documentos';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();
        $data['desarrollo_row'] = $desarrollo_row;

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if (!$inmueble_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        $data['inmueble_row'] = $inmueble_row;

        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($inmueble_row->identificador)->row();

        if (!$proceso_venta_row) {
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Es necesario iniciar un proceso de venta para poder subir documentos.', $data['regresar_a']);
        }

        $data['proceso_venta_row'] = $proceso_venta_row;

        $archvios_list = $this->archivos_model->obtener_archivos_proceso_venta('procesos_venta', $proceso_venta_row->identificador)->result();

        foreach ($archvios_list as $archvio_key => $archvio_value) {
            if ($archvio_value->etapa === 'contrato') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $contrato_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $contrato_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $contrato_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $contrato_ine = $archvio_value;
                }
                if ($archvio_value->tipo === 'contrato firmado') {
                    $contrato_contrato = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 1') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_1_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_1_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_1_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_1_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 2') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_2_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_2_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_2_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_2_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 3') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_3_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_3_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_3_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_3_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 4') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_4_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_4_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_4_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_4_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 5') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_5_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_5_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_5_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_5_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 6') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_6_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_6_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_6_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_6_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 7') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_7_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_7_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_7_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_7_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 8') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_8_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_8_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_8_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_8_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 9') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_9_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_9_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_9_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_9_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'actualización 10') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $actualizacion_10_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $actualizacion_10_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $actualizacion_10_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $actualizacion_10_ine = $archvio_value;
                }
            } elseif ($archvio_value->etapa === 'escrituración') {
                if ($archvio_value->tipo === 'comprobante de domicilio') {
                    $escrituracion_comprobante_domicilio = $archvio_value;
                }
                if ($archvio_value->tipo === 'constancia de situación fiscal') {
                    $escrituracion_constancia_ituacion_fiscal = $archvio_value;
                }
                if ($archvio_value->tipo === 'curp') {
                    $escrituracion_curp = $archvio_value;
                }
                if ($archvio_value->tipo === 'ine') {
                    $escrituracion_ine = $archvio_value;
                }
                if ($archvio_value->tipo === 'escritura') {
                    $escrituracion_escritura = $archvio_value;
                }
            }
        }

        $data['archvios_list'] = $archvios_list;

        $data['contrato_comprobante_domicilio'] = $contrato_comprobante_domicilio;
        $data['contrato_constancia_ituacion_fiscal'] = $contrato_constancia_ituacion_fiscal;
        $data['contrato_curp'] = $contrato_curp;
        $data['contrato_ine'] = $contrato_ine;
        $data['contrato_contrato'] = $contrato_contrato;

        $data['actualizacion_1_comprobante_domicilio'] = $actualizacion_1_comprobante_domicilio;
        $data['actualizacion_1_constancia_ituacion_fiscal'] = $actualizacion_1_constancia_ituacion_fiscal;
        $data['actualizacion_1_curp'] = $actualizacion_1_curp;
        $data['actualizacion_1_ine'] = $actualizacion_1_ine;

        $data['actualizacion_2_comprobante_domicilio'] = $actualizacion_2_comprobante_domicilio;
        $data['actualizacion_2_constancia_ituacion_fiscal'] = $actualizacion_2_constancia_ituacion_fiscal;
        $data['actualizacion_2_curp'] = $actualizacion_2_curp;
        $data['actualizacion_2_ine'] = $actualizacion_2_ine;

        $data['actualizacion_3_comprobante_domicilio'] = $actualizacion_3_comprobante_domicilio;
        $data['actualizacion_3_constancia_ituacion_fiscal'] = $actualizacion_3_constancia_ituacion_fiscal;
        $data['actualizacion_3_curp'] = $actualizacion_3_curp;
        $data['actualizacion_3_ine'] = $actualizacion_3_ine;

        $data['actualizacion_4_comprobante_domicilio'] = $actualizacion_4_comprobante_domicilio;
        $data['actualizacion_4_constancia_ituacion_fiscal'] = $actualizacion_4_constancia_ituacion_fiscal;
        $data['actualizacion_4_curp'] = $actualizacion_4_curp;
        $data['actualizacion_4_ine'] = $actualizacion_4_ine;

        $data['actualizacion_5_comprobante_domicilio'] = $actualizacion_5_comprobante_domicilio;
        $data['actualizacion_5_constancia_ituacion_fiscal'] = $actualizacion_5_constancia_ituacion_fiscal;
        $data['actualizacion_5_curp'] = $actualizacion_5_curp;
        $data['actualizacion_5_ine'] = $actualizacion_5_ine;

        $data['actualizacion_6_comprobante_domicilio'] = $actualizacion_6_comprobante_domicilio;
        $data['actualizacion_6_constancia_ituacion_fiscal'] = $actualizacion_6_constancia_ituacion_fiscal;
        $data['actualizacion_6_curp'] = $actualizacion_6_curp;
        $data['actualizacion_6_ine'] = $actualizacion_6_ine;

        $data['actualizacion_7_comprobante_domicilio'] = $actualizacion_7_comprobante_domicilio;
        $data['actualizacion_7_constancia_ituacion_fiscal'] = $actualizacion_7_constancia_ituacion_fiscal;
        $data['actualizacion_7_curp'] = $actualizacion_7_curp;
        $data['actualizacion_7_ine'] = $actualizacion_7_ine;

        $data['actualizacion_8_comprobante_domicilio'] = $actualizacion_8_comprobante_domicilio;
        $data['actualizacion_8_constancia_ituacion_fiscal'] = $actualizacion_8_constancia_ituacion_fiscal;
        $data['actualizacion_8_curp'] = $actualizacion_8_curp;
        $data['actualizacion_8_ine'] = $actualizacion_8_ine;

        $data['actualizacion_9_comprobante_domicilio'] = $actualizacion_9_comprobante_domicilio;
        $data['actualizacion_9_constancia_ituacion_fiscal'] = $actualizacion_9_constancia_ituacion_fiscal;
        $data['actualizacion_9_curp'] = $actualizacion_9_curp;
        $data['actualizacion_9_ine'] = $actualizacion_9_ine;

        $data['actualizacion_10_comprobante_domicilio'] = $actualizacion_10_comprobante_domicilio;
        $data['actualizacion_10_constancia_ituacion_fiscal'] = $actualizacion_10_constancia_ituacion_fiscal;
        $data['actualizacion_10_curp'] = $actualizacion_10_curp;
        $data['actualizacion_10_ine'] = $actualizacion_10_ine;

        $data['escrituracion_comprobante_domicilio'] = $escrituracion_comprobante_domicilio;
        $data['escrituracion_constancia_ituacion_fiscal'] = $escrituracion_constancia_ituacion_fiscal;
        $data['escrituracion_curp'] = $escrituracion_curp;
        $data['escrituracion_ine'] = $escrituracion_ine;
        $data['escrituracion_escritura'] = $escrituracion_escritura;

        $this->construir_site_ui('site/inmuebles/documentos', $data);
    }

    function cargar_documento_proceso_venta($identificador = null)
    {
        $this->form_validation->set_rules('etapa', 'etapa', 'trim|required');
        $this->form_validation->set_rules('tipo', 'tipo', 'trim|required');

        $data['controlador'] = 'site/inmuebles/cargar_documento_proceso_venta/' . $identificador;
        $data['regresar_a'] = 'site/inmuebles/documentos/' . $identificador;

        $this->session->set_flashdata('etapa', $this->input->post('etapa'));
        $this->session->set_flashdata('tipo', $this->input->post('tipo'));

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if (!$inmueble_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($inmueble_row->identificador)->row();

        if (!$proceso_venta_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
        }

        if (!$this->input->post()) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (3)', $data['regresar_a']);
        }

        $tipo = $this->input->post('tipo');
        $etapa = $this->input->post('etapa');

        if ($tipo === 'escritura') {
            $etapa = 'escrituración';
        } elseif ($tipo === 'contrato firmado') {
            $etapa = 'contrato';
        }

        $this->session->set_flashdata('etapa', $etapa);

        $archivo_validacion_row = $this->archivos_model->obtener_archivo_por_origen_tipo_etapa('procesos_venta', $proceso_venta_row->identificador, $tipo, $etapa)->row();

        if ($archivo_validacion_row) {
            if ($archivo_validacion_row->estatus_validacion === 'si') {
                $this->mensaje_del_sistema('MENSAJE_INFO', 'Un archivo validado no puede ser modificado.', $data['regresar_a']);
            }

            if (isset($_FILES) && $_FILES['archivo']['error'] == '0') {
                $config['upload_path']   = './almacenamiento/archivos/procesos_venta/' . $proceso_venta_row->identificador;
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                $config['allowed_types'] = 'JPG|JPEG|jpg|png|jpeg|pdf|doc|docx|xls';
                $config['max_size'] = (1024 * 50);
                $config['encrypt_name']  = true;
                $config['remove_spaces'] = true;
                if (!is_dir($config['upload_path'])) {
                    $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['regresar_a']));
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('archivo')) {
                    $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['regresar_a']));
                } else {
                    if ($archivo_validacion_row->archivo and $archivo_validacion_row->archivo != "") {
                        $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/procesos_venta/' . $proceso_venta_row->identificador . "/" . $archivo_validacion_row->archivo);
                        unlink($archivo_a_borrar);
                    }
                    $data_imagen = $this->upload->data();
                    $archivo = $data_imagen['file_name'];
                }
            } else {
                $archivo = $archivo_validacion_row->archivo;
            }

            $data_1 = array(
                'archivo' => $archivo,
                'fecha_actualizacion' => date("Y-m-d H:i:s"),
            );

            if (!$this->archivos_model->actualizar_archivo_por_identificador($archivo_validacion_row->identificador, $data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.1)', $data['regresar_a']);
            }
        } else {
            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "archivos-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            if (isset($_FILES) && $_FILES['archivo']['error'] == '0') {
                $config['upload_path']   = './almacenamiento/archivos/procesos_venta/' . $proceso_venta_row->identificador;
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls';
                $config['max_size'] = (1024 * 50);
                $config['encrypt_name']  = true;
                $config['remove_spaces'] = true;
                if (!is_dir($config['upload_path'])) {
                    $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no está disponible.", site_url($data['regresar_a']));
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('archivo')) {
                    $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Error: ' . $this->upload->display_errors()), site_url($data['regresar_a']));
                } else {
                    $data_imagen = $this->upload->data();
                    $archivo = $data_imagen['file_name'];
                }
            } else {
                $archivo = null;
            }

            $data_1 = array(
                'identificador' => $identificador_1,
                'modulo_origen' => 'procesos_venta',
                'identificador_origen' => $proceso_venta_row->identificador,
                'archivo' => $archivo,
                'tipo' => $tipo,
                'etapa' => $etapa,
                'estatus_validacion' => 'no',
                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_registro,
            );

            if (!$this->archivos_model->insertar_archivo($data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4.2)', $data['regresar_a']);
            }
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El archivo de ' . $etapa . ', ' . $tipo . ' ha sido cargado con exito.', $data['regresar_a']);
    }

    public function cambiar_estatus_validacion_archivo($archivo_identificador, $inmueble_identificador)
    {
        $data['controlador'] = 'site/inmuebles/cargar_documento_proceso_venta/' . $archivo_identificador . '/' . $inmueble_identificador;
        $data['regresar_a'] = 'site/inmuebles/documentos/' . $inmueble_identificador;

        $archivo_validacion_row = $this->archivos_model->obtener_archivo_por_identificador($archivo_identificador)->row();

        if (!$archivo_validacion_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        if ($archivo_validacion_row->estatus_validacion === 'si') {
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Un archivo validado no puede ser modificado.', $data['regresar_a']);
        }

        $data_1 = array(
            'estatus_validacion' => 'si',
            'fecha_actualizacion' => date("Y-m-d H:i:s"),
        );

        if (!$this->archivos_model->actualizar_archivo_por_identificador($archivo_validacion_row->identificador, $data_1)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El archivo ha sido validado y su estado ha sido actualizado. Esta acción no puede ser modificada.', $data['regresar_a']);
    }

    public function eliminar_archivo($archivo_identificador, $inmueble_identificador)
    {
        $data['controlador'] = 'site/inmuebles/cargar_documento_proceso_venta/' . $archivo_identificador . '/' . $inmueble_identificador;
        $data['regresar_a'] = 'site/inmuebles/documentos/' . $inmueble_identificador;

        $archivo_validacion_row = $this->archivos_model->obtener_archivo_por_identificador($archivo_identificador)->row();

        if (!$archivo_validacion_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        if ($archivo_validacion_row->estatus_validacion === 'si') {
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Un archivo validado no puede ser modificado.', $data['regresar_a']);
        }

        if ($archivo_validacion_row->archivo and $archivo_validacion_row->archivo != "") {
            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/procesos_venta/' . $archivo_validacion_row->identificador_origen . "/" . $archivo_validacion_row->archivo);
            unlink($archivo_a_borrar);
        }

        if (!$this->archivos_model->eliminar_archivo_por_identificador($archivo_validacion_row->identificador)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El archivo ha sido validado y su estado ha sido actualizado. Esta acción es irreversible y no puede ser modificada.', $data['regresar_a']);
    }

    public function otros()
    {
        $data['pagina_titulo'] = 'Otros';
        $data['pagina_subtitulo'] = 'Otros';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/otros/';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/otros';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/inmuebles/otros', $data);
    }

    public function cargar_archivo($identificador)
    {
        $data['controlador'] = 'site/inmuebles/cargar_archivo/' . $identificador;
        $data['regresar_a'] = 'site/inmuebles/documentos/' . $identificador;
        $controlador_js = 'site/inmuebles/cargar_archivo';

        if (isset($_FILES) && $_FILES['cargar_archivo']['error'] == '0') {

            $config['upload_path']   = './almacenamiento/archivos/' . $identificador;

            if (!is_dir($config['upload_path'])) {
                //$this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no existe", site_url($data['regresar_a']));
                mkdir($config['upload_path'], 0777, TRUE);
            }

            $config['allowed_types'] = '*';
            $config['max_size'] = 1024 * 1500;
            //$config['overwrite']     = true;
            //$config['encrypt_name']  = true;
            $config['remove_spaces'] = true;

            if (!is_dir($config['upload_path'])) {
                $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no existe", site_url($data['regresar_a']));
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('cargar_archivo')) {

                $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Archivo de expediente ' . $this->upload->display_errors()), site_url($data['regresar_a']));
            } else {

                $data_imagen = $this->upload->data();
                $cargar_archivo = $data_imagen['file_name'];
            }
        } else {
            $cargar_archivo = null;
        }

        $this->mensaje_del_sistema("MENSAJE_EXITO", trim('El archivo ' . $cargar_archivo . ' se ha cargado con éxito.'), site_url($data['regresar_a']));
    }

    public function facturacion($identificador)
    {
        $data['pagina_titulo'] = 'Facturación';
        $data['pagina_subtitulo'] = 'Facturación';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/inmuebles/facturacion/';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/inmuebles/facturacion';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();
        $data['desarrollo_row'] = $desarrollo_row;

        $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();
        if ($inmueble_row) {
            $data['inmueble_row'] = $inmueble_row;

            $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador)->row();
            if ($proceso_venta_row) {
                $data['proceso_venta_row'] = $proceso_venta_row;

                $identificador_cliente = $proceso_venta_row->cliente_identificador;
                $cliente_row = $this->procesos_venta_model->obtener_datos_cliente_para_facturacion_por_identificador($identificador_cliente)->row();

                $data['cliente_row'] = $cliente_row;
            }
        }

        $this->construir_site_ui('site/inmuebles/facturacion', $data);
    }

    public function obtener_datos_cliente_para_facturacion_por_identificador($identificador)
    {
        $proceso_venta_row = $this->procesos_venta_model->obtener_procesos_venta_por_inmueble_identificador($identificador)->row();
        $identificador_cliente = $proceso_venta_row->cliente_identificador;

        $cliente_row = $this->procesos_venta_model->obtener_datos_cliente_para_facturacion_por_identificador($identificador_cliente)->row();

        $data = array(
            'identificador' => $cliente_row->identificador,
            'nombre' => mb_strtoupper($cliente_row->nombre . ' ' . $cliente_row->apellido_paterno),
            'rfc' => ucfirst($cliente_row->rfc)
        );

        echo json_encode($data);
    }

    public function obtener_tabla_ver_facturacion($identificador)
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $facturas_list = $this->facturas_model->obtener_tabla_ver_facturacion($identificador);

        $data = [];

        foreach ($facturas_list->result() as $factura_key => $factura_value) {

            $opciones = '<a href="javascript:subir_archivos(\'' . $factura_value->identificador . '\', \'' . $factura_value->desarrollo . '\', \'' . $factura_value->inmueble . '\', \'' . $factura_value->pago_identificador . '\', \'' . $factura_value->concepto . '\', \'' . $factura_value->cliente_nombre . '\',\'' . $factura_value->monto . '\');">Subir archivos</a>' . '|' .
                '<a href="' . site_url('site/facturacion/eliminar/' . $factura_value->identificador) . '">Eliminar</a>';

            if ((isset($factura_value->archivo_pdf) and !empty($factura_value->archivo_pdf)) or (isset($factura_value->archivo_xml) and !empty($factura_value->archivo_xml)) or (isset($factura_value->archivo_zip) and !empty($factura_value->archivo_zip))) {

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

    public function actualizar_dato_factura()
    {
        $identificador = $this->input->post('identificador');
        $columna = $this->input->post('columna'); // Índice de la columna
        $nuevoValor = $this->input->post('nuevoValor');

        $data_1 = array(
            $columna => $nuevoValor
        );

        // Llama a tu modelo para actualizar el dato en la base de datos
        if ($columna === 'concepto') {
            $this->pagos_model->actualizar_pago_por_identificador($identificador, $data_1);
        } else {
            $this->clientes_model->actualizar_cliente_por_identificador($identificador, $data_1);
        }

        $pago_row = $this->pagos_model->obtener_pago_por_identificador($identificador)->row();

        $pagos_list = $this->pagos_model->obtener_pagos_concretados_por_inmueble_identificador($pago_row->inmueble_identificador)->result();

        $apartado_row = $this->pagos_model->obtener_apartado_por_inmueble_identificador($pago_row->inmueble_identificador)->row();

        $enganche_row = $this->pagos_model->obtener_enganche_por_inmueble_identificador($pago_row->inmueble_identificador)->row();

        $pagado = 0;
        $no_pagos_concretados = 0;

        foreach ($pagos_list as $pago_key => $pago_value) {
            if ($pago_value->estatus_pago === 'cobrado') {
                $pagado = $pagado + $pago_value->monto;
                $no_pagos_concretados = $no_pagos_concretados + 1;
            }
        }

        $data_2 = array(
            'pagado' => $pagado,
            'apartado' => $apartado_row->monto,
            'enganche' => $enganche_row->monto,
            'no_pagos_concretados' => $no_pagos_concretados
        );

        $this->procesos_venta_model->actualizar_proceso_venta_por_identificador($pago_row->proceso_venta_identificador, $data_2);

        if ($columna == 'estatus_factura') {

            $data_3 = array(
                'estatus_factura' => $nuevoValor
            );

            $this->facturas_model->actualizar_factura_por_identificador($identificador, $data_3);
        }

        // Devuelve una respuesta (puede ser JSON o lo que necesites)
        echo json_encode(array('status' => 'success', 'message' => 'Dato actualizado'));
    }

    public function cargar_archivos()
    {
        $identificador = $this->input->post('factura_identificador');

        $factura_row = $this->facturas_model->obtener_factura_por_identificador($identificador)->row();

        $data['controlador'] = 'site/inmuebles/facturacion/' . $factura_row->inmueble_identificador;
        $data['ir_a'] = 'site/inicio';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/facturacion/index";

        if ($factura_row) {
            if ($factura_row->archivo_pdf != null) {
                if (isset($_FILES) && $_FILES['archivo']['error'] == '0') {
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador;
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
                            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador . "/" . $factura_row->archivo_pdf);
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
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador;
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
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador;
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
                            $archivo_a_borrar = str_replace(APPPATH, '', 'almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador . "/" . $factura_row->archivo_xml);
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
                    $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador;
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
                $config['upload_path']   = './almacenamiento/archivos/facturacion/' . $factura_row->inmueble_identificador;
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
}
