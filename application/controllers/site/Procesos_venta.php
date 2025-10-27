<?php defined('BASEPATH') or exit('No direct script access allowed');

class Procesos_venta extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('clientes_model');
        $this->load->model('inmuebles_model');
        $this->load->model('pagos_model');
        $this->load->model('pagos_caja_model');
        $this->load->model('procesos_venta_model');
        $this->load->model('notas_model');
        $this->load->model('facturas_model');
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Procesos de venta';
        $data['pagina_subtitulo'] = 'Registro de procesos de venta';
        $data['pagina_menu_facturacion'] = true;

        $data['controlador'] = 'site/procesos_venta/index';
        $data['regresar_a'] = 'site/inmuebles';
        $controlador_js = 'site/procesos_venta/index';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/procesos_venta/index', $data);
    }

    public function obtener_tabla_index()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));

        $procesos_venta_list = $this->procesos_venta_model->obtener_tabla_index();

        $data = [];
        $count = 1;

        foreach ($procesos_venta_list->result() as $proceso_venta_key => $proceso_venta_row) {

            $opciones = '<a href="' . site_url('site/inmuebles/plan_pagos/' . $proceso_venta_row->inmueble_identificador) . '">Detalles</a>';

            $data[] = array(
                'id' => $count,
                'identificador' => $proceso_venta_row->identificador,
                'inmuebles_nodo_nombre' => ucwords($proceso_venta_row->inmuebles_nodo_nombre),
                'inmuebles_nombre' => $proceso_venta_row->inmuebles_nombre,
                'inmuebles_tamanho_total' => $proceso_venta_row->inmuebles_tamanho_total,
                'precio_lista' => number_format($proceso_venta_row->precio_lista, 2),
                'precio_venta' => number_format($proceso_venta_row->precio_venta, 2),
                'apartado' => number_format($proceso_venta_row->apartado, 2),
                'enganche' => number_format($proceso_venta_row->enganche, 2),
                'pagado' => number_format($proceso_venta_row->pagado, 2),
                'no_pagos' => $proceso_venta_row->no_pagos_concretados . '/' . $proceso_venta_row->no_pagos,
                'frecuencia' => ucfirst($proceso_venta_row->frecuencia),
                'fecha_inicio' => date('Y/m/d', strtotime($proceso_venta_row->fecha_inicio)),
                'estatus_procesos' => ucfirst($proceso_venta_row->estatus_procesos),
                'estatus' => ucfirst($proceso_venta_row->estatus),
                'fecha_registro' => date('Y/m/d', strtotime($proceso_venta_row->fecha_registro)),
                'fecha_actualizacion' => date('Y/m/d', strtotime($proceso_venta_row->fecha_actualizacion)),
                'opciones' => $opciones
            );

            $count++;
        }

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $procesos_venta_list->num_rows(),
            "recordsFiltered" => $procesos_venta_list->num_rows(),
            "data" => $data
        );

        echo json_encode($result);
        exit();
    }

    public function agregar($identificador = null)
    {
        if ($this->input->post()) {
            $identificador = $this->input->post('identificador');
        }

        $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($identificador)->row();

        $data['pagina_titulo'] = 'Procesos de venta';
        $data['pagina_subtitulo'] = 'Registro de procesos de venta';
        $data['pagina_menu_procesos_venta'] = true;

        $data['controlador'] = 'site/procesos_venta/agregar';
        $data['regresar_a'] = 'site/desarrollos';
        if ($desarrollo_row) {
            $data['ir_a'] = 'site/desarrollos/ver/' . $desarrollo_row->identificador;
        } else {
            $data['ir_a'] = 'site/desarrollos/ver/' . $identificador;
        }
        $controlador_js = 'site/procesos_venta/agregar';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->form_validation->set_rules('identificador', 'inmueble', 'trim|required');
        $this->form_validation->set_rules('cliente_identificador', 'cliente', 'trim|required');
        $this->form_validation->set_rules('pago_caja', 'pago de caja', 'trim');
        $this->form_validation->set_rules('precio_venta', 'precio de venta', 'trim|required');
        $this->form_validation->set_rules('apartado', 'apartado', 'trim');
        $this->form_validation->set_rules('enganche', 'enganche', 'trim');
        $this->form_validation->set_rules('saldo', 'saldo', 'trim|required');
        $this->form_validation->set_rules('no_pagos', 'numero de pagos', 'trim|required');
        $this->form_validation->set_rules('cantidad_pago', 'Cantidad por pago', 'trim|required');
        $this->form_validation->set_rules('frecuencia', 'frecuencia', 'trim|required');
        $this->form_validation->set_rules('dia_pago', 'dia de pago', 'trim|required');
        $this->form_validation->set_rules('fecha_inicio', 'fecha de inicio', 'trim|required');

        //notas
        $this->form_validation->set_rules('nota', 'Nota', 'trim');

        $data['identificador'] = $identificador;

        $clientes_list = $this->clientes_model->obtener_opciones_select_clientes()->result();

        if (!$clientes_list) {
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Por favor registre un cliente para poder iniciar un proceso de venta, haga clic <a class="white" href="' . site_url('site/clientes/agregar') . '"><u>aquí</u></a>.', $data['regresar_a']);
        }

        $data['clientes_list'] = $clientes_list;

        $inmuebles_list = $this->inmuebles_model->obtener_inmueble_por_identificador_sin_proceso_venta()->result();

        if (!$inmuebles_list) {
            $this->mensaje_del_sistema('MENSAJE_INFO', 'Por favor registre un desarrollo para poder iniciar un proceso de venta, haga clic <a class="white" href="' . site_url('site/desarrollos/agregar') . '"><u>aquí</u></a>.', $data['regresar_a']);
        }

        $data['inmuebles_list'] = $inmuebles_list;

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/procesos_venta/agregar', $data);
        } else {

            $this->session->set_flashdata('identificador', $this->input->post('identificador'));
            $this->session->set_flashdata('cliente_identificador', $this->input->post('cliente_identificador'));
            $this->session->set_flashdata('pago_caja', $this->input->post('pago_caja'));
            $this->session->set_flashdata('precio_venta', $this->input->post('precio_venta'));
            $this->session->set_flashdata('apartado', $this->input->post('apartado'));
            $this->session->set_flashdata('enganche', $this->input->post('enganche'));
            $this->session->set_flashdata('saldo', $this->input->post('saldo'));
            $this->session->set_flashdata('no_pagos', $this->input->post('no_pagos'));
            $this->session->set_flashdata('cantidad_pago', $this->input->post('cantidad_pago'));
            $this->session->set_flashdata('frecuencia', $this->input->post('frecuencia'));
            $this->session->set_flashdata('dia_pago', $this->input->post('dia_pago'));
            $this->session->set_flashdata('fecha_inicio', $this->input->post('fecha_inicio'));

            //notas
            $this->session->set_flashdata('nota', $this->input->post('nota'));

            $this->db->trans_begin();

            try {

                $inmueble_identificador = $this->input->post('identificador');

                $data['ir_a'] = 'site/inmuebles/plan_pagos/' . $inmueble_identificador;

                if (empty($inmueble_identificador)) {
                    throw new Exception('Por favor verifique que todos los datos sean correctos. (1)');
                }

                $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($inmueble_identificador)->row();

                if (!$inmueble_row) {
                    throw new Exception('No fue posible encontrar el inmueble para iniciar un proceso de venta. (2)');
                }

                $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($inmueble_row->identificador)->row();

                if ($desarrollo_row) {
                    $data['regresar_a'] = 'site/desarrollos/ver/' . $desarrollo_row->identificador;
                }


                $no_pagos = $this->input->post('no_pagos');
                if (($this->input->post('apartado') != 0)) {
                    $no_pagos = $no_pagos + 1;
                }
                if (($this->input->post('enganche') != 0)) {
                    $no_pagos = $no_pagos + 1;
                }

                $fecha_registro = date("Y-m-d H:i:s");

                // Paso 1

                $key_1 = "proceso_venta-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $identificador_1 = hash("crc32b", $key_1);

                $data_1 = array(
                    'identificador' => $identificador_1,
                    'inmueble_identificador' => $inmueble_row->identificador,
                    'cliente_identificador' => trim($this->input->post('cliente_identificador')),
                    'precio_lista' => !empty($inmueble_row->precio) ? $inmueble_row->precio : null,
                    'precio_venta' => trim($this->input->post('precio_venta')),
                    'apartado' => trim($this->input->post('apartado')),
                    'enganche' => trim($this->input->post('enganche')),
                    'pagado' => 0,
                    'no_pagos' => trim($no_pagos),
                    'no_pagos_concretados' => 0,
                    'dia_pago' => trim($this->input->post('dia_pago')),
                    'frecuencia' => trim($this->input->post('frecuencia')),
                    'fecha_inicio' => trim($this->input->post('fecha_inicio')),
                    'estatus' => 'activo',
                    'fecha_registro' => $fecha_registro,
                    'fecha_actualizacion' => $fecha_registro,
                );

                if (!$data_1) {
                    throw new Exception('Ha ocurrido un error, por favor inténtalo más tarde. (3)');
                }

                if (!$this->procesos_venta_model->insertar_proceso_venta($data_1)) {
                    throw new Exception('No fue posible procesar su solicitud en este momento, por favor intentelo más tarde. (4)');
                }

                // Paso 2

                $key_2 = "pagos-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $data_2 = array();
                $count = 1;

                $fechas_pago_list = $this->calular_fechas($this->input->post('no_pagos'), $this->input->post('frecuencia'), $this->input->post('dia_pago'), $this->input->post('fecha_inicio'));

                if (($this->input->post('apartado') != 0)) {
                    $identificador_2 = hash("crc32b", $key_2 . "-" . $count . "-apartado");

                    $data_2[] = array(
                        'identificador' => $identificador_2,
                        'proceso_venta_identificador' => $identificador_1,
                        'inmueble_identificador' => $inmueble_row->identificador,
                        'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                        'fecha_pago' => null,
                        'concepto' => 'Apartado',
                        'monto' => trim($this->input->post('apartado')),
                        'saldo' => trim($this->input->post('saldo')),
                        'cantidad_pago' => trim($this->input->post('apartado')),
                        'metodo_pago' => null,
                        'estatus_pago' => 'por cobrar',
                        'estatus' => 'activo',
                        'fecha_registro' => $fecha_registro,
                        'fecha_actualizacion' => $fecha_registro,
                    );
                }

                if (($this->input->post('enganche') != 0)) {
                    $identificador_2 = hash("crc32b", $key_2 . "-" . $count . "-enganche");

                    $data_2[] = array(
                        'identificador' => $identificador_2,
                        'proceso_venta_identificador' => $identificador_1,
                        'inmueble_identificador' => $inmueble_row->identificador,
                        'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                        'fecha_pago' => null,
                        'concepto' => 'Enganche',
                        'monto' => trim($this->input->post('enganche')),
                        'saldo' => trim($this->input->post('saldo')),
                        'cantidad_pago' => trim($this->input->post('enganche')),
                        'metodo_pago' => null,
                        'estatus_pago' => 'por cobrar',
                        'estatus' => 'activo',
                        'fecha_registro' => $fecha_registro,
                        'fecha_actualizacion' => $fecha_registro,
                    );
                }

                $cantidad_acomulada = ($this->input->post('apartado') + $this->input->post('enganche'));
                $resta = 0;

                while ($count <= $this->input->post('no_pagos')) {

                    $identificador_2 = hash("crc32b", $key_2 . "-" . $count);

                    $cantidad_pago = $this->input->post('cantidad_pago');

                    if ($count == $this->input->post('no_pagos')) {
                        if (($cantidad_acomulada + $cantidad_pago) > $this->input->post('precio_venta')) {
                            $resta = ($cantidad_acomulada + $cantidad_pago) - $this->input->post('precio_venta');
                        } else {
                            $resta = $this->input->post('precio_venta') - ($cantidad_acomulada + $cantidad_pago);
                        }

                        if ($count == $this->input->post('no_pagos')) {
                            if (($cantidad_acomulada + $cantidad_pago) > $this->input->post('precio_venta')) {
                                $cantidad_pago = $cantidad_pago - $resta;
                            } else {
                                $cantidad_pago = $cantidad_pago + $resta;
                            }
                        }
                    }

                    // $suma = 0;
                    // $resta = 0;
                    // $contador = 0;
                    // $cantidad_pago = 0;
                    // foreach ($pagos_list->result() as $pago_value) {
                    //     $suma = $suma + $pago_value->monto;
                    // }

                    // if ($suma > $proceso_venta_row->precio_venta) {
                    //     $resta = $suma - $proceso_venta_row->precio_venta;
                    // } else {
                    //     $resta = $proceso_venta_row->precio_venta - $suma;
                    // }

                    // foreach ($pagos_list->result() as $key => $pago_value) {
                    //     if ($key + 1 == $proceso_venta_row->no_pagos) {
                    //         $contador = $pago_value->id;
                    //         if ($suma > $proceso_venta_row->precio_venta) {
                    //             $monto_justo = $pago_value->monto - $resta;
                    //         } else {
                    //             $monto_justo = $pago_value->monto + $resta;
                    //         }
                    //         $data_2 = array(
                    //             'monto' => $monto_justo,
                    //             'cantidad_pago' => $monto_justo
                    //         );

                    //         $this->pagos_model->actualizar_ultimo_pago_por_identificador($identificador, $data_2, $contador);
                    //     }
                    // }

                    $data_2[] = array(
                        'identificador' => $identificador_2,
                        'proceso_venta_identificador' => $identificador_1,
                        'inmueble_identificador' => $inmueble_row->identificador,
                        'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                        'fecha_pago' => null,
                        'concepto' => 'Pago ' . $count,
                        'monto' => trim($cantidad_pago),
                        'saldo' => trim($this->input->post('saldo')),
                        'cantidad_pago' => trim($cantidad_pago),
                        'metodo_pago' => null,
                        'estatus_pago' => 'por cobrar',
                        'estatus' => 'activo',
                        'fecha_registro' => $fecha_registro,
                        'fecha_actualizacion' => $fecha_registro,
                    );

                    $cantidad_acomulada = $cantidad_acomulada + $this->input->post('cantidad_pago');

                    $count++;
                }

                if (!$data_2) {
                    throw new Exception('Ha ocurrido un error, por favor inténtalo más tarde. (5)');
                }

                if (!$this->pagos_model->insertar_matriz_pagos($data_2)) {
                    throw new Exception('No fue posible procesar su solicitud en este momento, por favor intentelo más tarde. (6)');
                }

                // Paso 3

                $data_3 = array(
                    'estatus_inmueble' => 'proceso',
                    'fecha_actualizacion' => $fecha_registro,
                );

                if (!$data_3) {
                    throw new Exception('Ha ocurrido un error, por favor inténtalo más tarde. (7)');
                }

                if (!$this->inmuebles_model->actualizar_inmueble_por_identificador($inmueble_row->identificador, $data_3)) {
                    throw new Exception('No fue posible procesar su solicitud en este momento, por favor intentelo más tarde. (8)');
                }

                $identificador_4 = hash("crc32b", $key_2 . "-" . "pago_caja");

                $data_4 = array(
                    'identificador' => $identificador_4,
                    'proceso_venta_identificador' => $identificador_1,
                    'inmueble_identificador' => $inmueble_row->identificador,
                    'fecha_programada' => !empty($fechas_pago_list[0]) ? $fechas_pago_list[0] : null,
                    'fecha_pago' => $fecha_registro,
                    'concepto' => 'Pago de caja ' . ucfirst($inmueble_row->nombre) . ' ' . ucfirst($desarrollo_row->nombre),
                    'monto' => trim($this->input->post('pago_caja')),
                    'metodo_pago' => 'efectivo',
                    'estatus_pago' => 'por cobrar',
                    'estatus' => 'activo',
                    'fecha_registro' => $fecha_registro,
                    'fecha_actualizacion' => $fecha_registro,
                );

                if (!$data_4) {
                    throw new Exception('Ha ocurrido un error, por favor inténtalo más tarde. (9)');
                }

                if (!$this->pagos_caja_model->insertar_pago_caja($data_4)) {
                    throw new Exception('No fue posible procesar su solicitud en este momento, por favor intentelo más tarde. (10)');
                }

                // Paso 5 insertar notas

                if ($this->input->post('nota') != '') {

                    $key_5 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                    $identificador_5 = hash("crc32b", $key_5);

                    $data_5 = array(
                        'identificador' => $identificador_5,
                        'usuario_identificador' => $this->session->userdata('user_identificador'),
                        'origen_modulo' => 'Procesos de venta',
                        'origen_identificador' => $identificador_1,
                        'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
                        'fecha_registro' => $fecha_registro
                    );

                    if (!$data_5) {
                        throw new Exception('Ha ocurrido un error, por favor inténtalo más tarde. (11)');
                    }

                    if (!$this->notas_model->insertar_nota($data_5)) {
                        throw new Exception('No fue posible procesar su solicitud en este momento, por favor intentelo más tarde. (12)');
                    }
                }

                // Paso 6 insertar facturación de proceso venta

                $cliente_row = $this->clientes_model->obtener_cliente_por_identificador($this->input->post('cliente_identificador'))->row();

                $key_6 = "facturacion-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $identificador_6 = hash("crc32b", $key_6);

                $data_6 = array(
                    'identificador' => !empty($identificador_6) ? $identificador_6 : null,
                    'desarrollo' => !empty($desarrollo_row->nombre) ? $desarrollo_row->nombre : null,
                    'inmueble_identificador' => !empty($inmueble_row->identificador) ? $inmueble_row->identificador : null,
                    'inmueble' => !empty($inmueble_row->nombre) ? $inmueble_row->nombre : null,
                    'concepto' => !empty($inmueble_row->nombre) ? 'Factura general de ' . $inmueble_row->nombre : null,
                    'cliente_nombre' => !empty($cliente_row->nombre) || !empty($cliente_row->apellido_paterno) || !empty($cliente_row->apellido_materno) ? trim($cliente_row->nombre . ' ' . $cliente_row->apellido_paterno . ' ' . $cliente_row->apellido_materno) : null,
                    'rfc' => !empty($cliente_row->rfc) ? $cliente_row->rfc : null,
                    'codigo_postal' => !empty($cliente_row->codigo_postal) ? $cliente_row->codigo_postal : null,
                    'regimen_fiscal' => !empty($cliente_row->regimen_fiscal) ? $cliente_row->regimen_fiscal : null,
                    'uso_cfdi' => !empty($cliente_row->uso_cfdi) ? $cliente_row->uso_cfdi : null,
                    'monto' => !empty(trim($this->input->post('precio_venta'))) ? trim($this->input->post('precio_venta')) : null,
                    'estatus_factura' => 'solicitud de factura',
                    'fecha_registro' => !empty($fecha_registro) ? $fecha_registro : null,
                    'fecha_actualizacion' => !empty($fecha_registro) ? $fecha_registro : null,
                );

                if (!$data_6) {
                    throw new Exception('Ha ocurrido un error, por favor inténtalo más tarde. (13)');
                }

                if (!$this->facturas_model->insertar_factura($data_6)) {
                    throw new Exception('No fue posible procesar su solicitud en este momento, por favor intentelo más tarde. (14)');
                } else {
                    $this->session->set_flashdata('MENSAJE_INFO', 'La solicitud de factura general de ' . mb_strtoupper($inmueble_row->nombre) . ' ha sido creada.');
                }

                // Comprobar si hubo algún error durante las consultas
                if ($this->db->trans_status() === FALSE) {
                    // Si hay algún error, revertir la transacción
                    $this->db->trans_rollback();
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (11)', $data['regresar_a']);
                } else {
                    // Si todo está bien, confirmar la transacción
                    $this->db->trans_commit();
                    $this->mensaje_del_sistema('MENSAJE_EXITO', 'Proceso de venta iniciado con éxito, ahora podrías administrar la tabla de pagos.', $data['ir_a']);
                }
            } catch (Exception $e) {
                // Manejar cualquier excepción que pueda ocurrir
                $this->db->trans_rollback();
                $this->mensaje_del_sistema('MENSAJE_ERROR', $e->getMessage(), $data['regresar_a']);
            }

            $this->construir_site_ui('site/procesos_venta/agregar', $data);
        }
    }

    function obtener_detalles_inmueble($identificador = null)
    {
        $inmueble_row = $this->inmuebles_model->obtener_detalles_inmueble_y_desarrollo($identificador)->row();

        echo json_encode($inmueble_row);
    }
    function agregar_proceso_venta_para_desarrollo()
    {
        $data['controlador'] = 'site/procesos_venta/agregar_proceso_venta_para_desarrollo';
        $data['ir_a'] = 'site/inmuebles/plan_pagos/' . $this->input->post('inmueble_identificador');
        $data['regresar_a'] = 'site/desarrollos/ver/' . $this->input->post('nodo_identificador');

        $this->form_validation->set_rules('cliente_identificador', 'cliente', 'trim|required');
        $this->form_validation->set_rules('precio_venta', 'precio de venta', 'trim|required');
        $this->form_validation->set_rules('pago_caja', 'pago de caja', 'trim');
        $this->form_validation->set_rules('apartado', 'apartado', 'trim');
        $this->form_validation->set_rules('enganche', 'enganche', 'trim');
        $this->form_validation->set_rules('no_pagos', 'numero de pagos', 'trim|required');
        $this->form_validation->set_rules('frecuencia', 'frecuencia', 'trim|required');
        $this->form_validation->set_rules('dia_pago', 'dia de pago', 'trim|required');
        $this->form_validation->set_rules('fecha_inicio', 'fecha de inicio', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/desarrollos/ver', $data);
        } else {

            $this->session->set_flashdata('cliente_identificador', $this->input->post('cliente_identificador'));
            $this->session->set_flashdata('precio_venta', $this->input->post('precio_venta'));
            $this->session->set_flashdata('pago_caja', $this->input->post('pago_caja'));
            $this->session->set_flashdata('apartado', $this->input->post('apartado'));
            $this->session->set_flashdata('enganche', $this->input->post('enganche'));
            $this->session->set_flashdata('no_pagos', $this->input->post('no_pagos'));
            $this->session->set_flashdata('frecuencia', $this->input->post('frecuencia'));
            $this->session->set_flashdata('dia_pago', $this->input->post('dia_pago'));
            $this->session->set_flashdata('fecha_inicio', $this->input->post('fecha_inicio'));

            if (!$this->input->post()) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
            }

            if (!$this->input->post('inmueble_identificador')) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
            }

            $inmueble_row = $this->inmuebles_model->obtener_inmueble_por_identificador($this->input->post('inmueble_identificador'))->row();

            $desarrollo_row = $this->inmuebles_model->obtener_desarrollo_por_identificador_hijo($this->input->post('inmueble_identificador'))->row();

            if (!$inmueble_row) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (3)', $data['regresar_a']);
            }

            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "proceso_venta-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            $no_pagos = $this->input->post('no_pagos');

            if ($this->input->post('apartado') != null) {
                $no_pagos = $no_pagos + 1;
            }

            if ($this->input->post('enganche') != '0') { //cambiar 0 por '0'
                $no_pagos = $no_pagos + 1;
            }

            $data_1 = array(
                'identificador' => $identificador_1,
                'inmueble_identificador' => $inmueble_row->identificador,
                'cliente_identificador' => trim($this->input->post('cliente_identificador')),
                'precio_lista' => !empty($inmueble_row->precio) ? $inmueble_row->precio : null,
                'precio_venta' => trim($this->input->post('precio_venta')),
                'apartado' => trim($this->input->post('apartado')),
                'enganche' => trim($this->input->post('enganche')),
                'pagado' => 0,
                'no_pagos' => trim($no_pagos),
                'no_pagos_concretados' => 0,
                'dia_pago' => trim($this->input->post('dia_pago')),
                'frecuencia' => trim($this->input->post('frecuencia')),
                'fecha_inicio' => trim($this->input->post('fecha_inicio')),
                'estatus' => 'activo',
                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_registro,
            );

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4)', $data['regresar_a']);
            }

            $key_2 = "pagos-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $count = 1;
            $data_2 = array();

            $fechas_pago_list = $this->calular_fechas($this->input->post('no_pagos'), $this->input->post('frecuencia'), $this->input->post('dia_pago'), $this->input->post('fecha_inicio'));

            if (($this->input->post('apartado') != 0)) {

                $identificador_2 = hash("crc32b", $key_2 . "-" . $count . "-apartado");

                $data_2[] = array(
                    'identificador' => $identificador_2,
                    'proceso_venta_identificador' => $identificador_1,
                    'inmueble_identificador' => $inmueble_row->identificador,
                    'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                    'fecha_pago' => null,
                    'concepto' => 'Apartado',
                    'monto' => trim($this->input->post('apartado')),
                    'saldo' => trim($this->input->post('saldo')),
                    'cantidad_pago' => trim($this->input->post('cantidad_pago')),
                    'metodo_pago' => null,
                    'estatus_pago' => 'por cobrar',
                    'estatus' => 'activo',
                    'fecha_registro' => $fecha_registro,
                    'fecha_actualizacion' => $fecha_registro,
                );
            }

            if (($this->input->post('enganche') != 0) || ($this->input->post('enganche') != 0.00)) {
                $identificador_2 = hash("crc32b", $key_2 . "-" . $count . "-enganche");

                $data_2[] = array(
                    'identificador' => $identificador_2,
                    'proceso_venta_identificador' => $identificador_1,
                    'inmueble_identificador' => $inmueble_row->identificador,
                    'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                    'fecha_pago' => null,
                    'concepto' => 'Enganche',
                    'monto' => trim($this->input->post('enganche')),
                    'saldo' => trim($this->input->post('saldo')),
                    'cantidad_pago' => trim($this->input->post('cantidad_pago')),
                    'metodo_pago' => null,
                    'estatus_pago' => 'por cobrar',
                    'estatus' => 'activo',
                    'fecha_registro' => $fecha_registro,
                    'fecha_actualizacion' => $fecha_registro,
                );
            }

            while ($count <= $this->input->post('no_pagos')) {

                $identificador_2 = hash("crc32b", $key_2 . "-" . $count);

                $data_2[] = array(
                    'identificador' => $identificador_2,
                    'proceso_venta_identificador' => $identificador_1,
                    'inmueble_identificador' => $inmueble_row->identificador,
                    'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                    'fecha_pago' => null,
                    'concepto' => 'Pago ' . $count,
                    'monto' => trim($this->input->post('cantidad_pago')),
                    'saldo' => trim($this->input->post('saldo')),
                    'cantidad_pago' => trim($this->input->post('cantidad_pago')),
                    'metodo_pago' => null,
                    'estatus_pago' => 'por cobrar',
                    'estatus' => 'activo',
                    'fecha_registro' => $fecha_registro,
                    'fecha_actualizacion' => $fecha_registro,
                );

                $count++;
            }

            if (!$data_2) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (5)', $data['regresar_a']);
            }

            $data_3 = array(
                'estatus_inmueble' => 'proceso',
                'fecha_actualizacion' => $fecha_registro,
            );

            if (!$data_3) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (6)', $data['regresar_a']);
            }

            $identificador_3 = hash("crc32b", $key_2 . "-" . "pago_caja");

            $data_4 = array(
                'identificador' => $identificador_3,
                'proceso_venta_identificador' => $identificador_1,
                'inmueble_identificador' => $inmueble_row->identificador,
                'fecha_programada' => !empty($fechas_pago_list[$count - 1]) ? $fechas_pago_list[$count - 1] : null,
                'fecha_pago' => $fecha_registro,
                'concepto' => 'Pago de caja ' . ucfirst($inmueble_row->nombre) . ' ' . ucfirst($desarrollo_row->nombre),
                'monto' => trim($this->input->post('pago_caja')),
                'metodo_pago' => 'efectivo',
                'estatus_pago' => 'por cobrar',
                'estatus' => 'activo',
                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_registro,
            );

            if (!$data_4) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (6)', $data['regresar_a']);
            }

            if (!$this->procesos_venta_model->insertar_proceso_venta($data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (7)', $data['regresar_a']);
            }

            if (!$this->pagos_model->insertar_matriz_pagos($data_2)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (8)', $data['regresar_a']);
            }

            if (!$this->inmuebles_model->actualizar_inmueble_por_identificador($inmueble_row->identificador, $data_3)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (9)', $data['regresar_a']);
            }

            if (!$this->pagos_caja_model->insertar_pago_caja($data_4)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (9)', $data['regresar_a']);
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'Se ha vinculado al cliente y la entidad con éxito.', $data['ir_a']);
        }
    }

    function calular_fechas($no_pagos, $frecuencia, $dia_pago, $fecha_inicio)
    {
        $fecha_inicio = new DateTime($fecha_inicio);

        $fechas_pago = array();

        switch ($frecuencia) {
            case 'único':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                break;
            case 'diario':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P1D'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                }
                break;
            case 'semanal':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P7D'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                }
                break;
            case 'mensual':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P1M'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-' . $dia_pago);
                }
                break;
            case 'bimestral':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P2M'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-' . $dia_pago);
                }
                break;
            case 'trimestral':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P3M'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-' . $dia_pago);
                }
                break;
            case 'semestral':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P6M'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-' . $dia_pago);
                }
                break;
            case 'anual':
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                for ($i = 1; $i < $no_pagos; $i++) {
                    $fecha_inicio->add(new DateInterval('P1Y'));
                    $fechas_pago[] = $fecha_inicio->format('Y-m-' . $dia_pago);
                }
                break;
            default:
                $fechas_pago[] = $fecha_inicio->format('Y-m-d');
                break;
        }
        return $fechas_pago;
    }

    public function obtener_reporte_ventas_por_desarrollo()
    {
        $inmuebles_nodo_list = $this->inmuebles_model->obtener_inmuebles_tipo_desarrollo()->result();

        $result = '
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Desarrollo</th>
                        <th>Inmuebles</th>
                        <th>Disponibles</th>
                        <th>Por validar</th>
                        <th>Total</th>
                        <th>Total Precio Venta</th>
                        <th>Total Pagado</th>
                        <th>Porcentaje Pagado</th>
                        <th>Saldo Pendiente</th>
                        <th>Porcentaje Pendiente</th>
                        <th>No. Pagos Concretados</th>
                    </tr>
                </thead>
                <tbody>
        ';

        foreach ($inmuebles_nodo_list as $inmueble_nodo_key => $inmueble_nodo_value) {

            $cantidad_inmuebles = $this->inmuebles_model->obtener_cantidad_inmuebles_por_desarrollo_identificador($inmueble_nodo_value->identificador);
            $cantidad_inmuebles_disponibles = $this->inmuebles_model->obtener_cantidad_inmuebles_disponibles_por_desarrollo_identificador($inmueble_nodo_value->identificador);
            $cantidad_inmuebles_en_proceso = $this->inmuebles_model->obtener_cantidad_inmuebles_en_proceso_por_desarrollo_identificador($inmueble_nodo_value->identificador);
            // $cantidad_inmuebles_vendidos = $this->inmuebles_model->obtener_cantidad_inmuebles_vendidos_por_desarrollo_identificador($inmueble_nodo_value->identificador);
            // $cantidad_inmuebles_apartados_o_reservados = $this->inmuebles_model->obtener_cantidad_inmuebles_apartados_o_reservados_por_desarrollo_identificador($inmueble_nodo_value->identificador);

            $valor_total = $this->inmuebles_model->obtener_valor_total_inmueble_nodo($inmueble_nodo_value->identificador)->row();

            $proceso_venta_resultados = $this->procesos_venta_model->obtener_resultados_por_procesos_de_venta_por_inmueble_nodo_identificador($inmueble_nodo_value->identificador)->row();

            $porcentaje_pagado = 0;

            if (!empty($proceso_venta_resultados->suma_precio_venta) && !empty($proceso_venta_resultados->suma_pagado) && $proceso_venta_resultados->suma_precio_venta != 0) {
                $porcentaje_pagado = ($proceso_venta_resultados->suma_pagado / $proceso_venta_resultados->suma_precio_venta) * 100;
            }

            $result .= '
                <tr>
                    <td>' . mb_strtoupper($inmueble_nodo_value->nombre) . '</td>
                    <td>' . $cantidad_inmuebles . '</td>
                    <td>' . $cantidad_inmuebles_disponibles . '</td>
                    <td>' . $cantidad_inmuebles_en_proceso . '</td>
                    <td>' . number_format($valor_total->suma_precio, 2) . '</td>
                    <td>' . number_format($proceso_venta_resultados->suma_precio_venta, 2) . '</td>
                    <td>' . number_format($proceso_venta_resultados->suma_pagado, 2) . '</td>
                    <td>' . round($porcentaje_pagado, 2) . '%</td>
                    <td>' . number_format($proceso_venta_resultados->suma_precio_venta - $proceso_venta_resultados->suma_pagado, 2) . '</td>
                    <td>' . round(100 - $porcentaje_pagado, 2) . '%</td>
                    <td>' . (!empty($proceso_venta_resultados->suma_no_pagos_concretados) ? $proceso_venta_resultados->suma_no_pagos_concretados : 0) . '/' . (!empty($proceso_venta_resultados->suma_no_pagos) ? $proceso_venta_resultados->suma_no_pagos : 0) . '</td>
                </tr>
            ';
        }

        $result .= '
                </tbody>
            </table>
        ';

        echo json_encode($result);
        exit();
    }
}
