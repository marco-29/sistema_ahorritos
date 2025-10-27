<?php defined('BASEPATH') or exit('No direct script access allowed');

class pagos extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('pagos_model');
		$this->load->model('archivos_model');
        $this->load->model('contratos_model');
        $this->load->model('inmuebles_model');
        $this->load->model('rel_inmuebles_model');
        $this->load->model('procesos_venta_model');
        $this->load->model('clientes_model');
        $this->load->model('logs_model');
        $this->load->model('notas_model');
        $this->load->model('facturas_model');
	}

	public function index()
	{
		$data['pagina_titulo'] = 'Pagos';
		$data['pagina_subtitulo'] = 'Registro de pagos calendarizados';
		$data['pagina_menu_pagos'] = true;

		$data['controlador'] = 'site/pagos';
		$data['regresar_a'] = 'site/pagos';
		$controlador_js = "site/pagos/index";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$pagos_list = $this->pagos_model->obtener_pagos()->result();

		$data['pagos_list'] = $pagos_list;

		$this->construir_site_ui('site/pagos/index', $data);
	}

	public function obtener_tabla_index()
	{
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$pagos_list = $this->pagos_model->obtener_tabla_index();

		$data = [];

		foreach ($pagos_list->result() as $pago_key => $pago_row) {

			$opciones = '<a href="javascript:eliminar_pago(\'' . $pago_row->identificador . '\');">Eliminar</a>';

			if (isset($pago_row->archivo_comprobante_pago) and !empty($pago_row->archivo_comprobante_pago)) {

				$tipo_extension = pathinfo($pago_row->archivo_comprobante_pago, PATHINFO_EXTENSION);

				if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
					$tipo_extension = 'archivo';
				} elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
					$tipo_extension = 'imagen';
				}

				$opciones_archivo = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $pago_row->identificador . '/' . $pago_row->archivo_comprobante_pago) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Ver comprobante</a>';
			} else {

				$opciones_archivo = 'N/A';
			}

			if (isset($pago_row->archivo_comprobante_pago_expediente) and !empty($pago_row->archivo_comprobante_pago_expediente)) {

				$tipo_extension = pathinfo($pago_row->archivo_comprobante_pago_expediente, PATHINFO_EXTENSION);

				if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
					$tipo_extension = 'archivo';
				} elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
					$tipo_extension = 'imagen';
				}

				$opciones_archivo_expediente = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $pago_row->identificador . '/' . $pago_row->archivo_comprobante_pago_expediente) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Ver comprobante</a>';
			} else {

				$opciones_archivo_expediente = 'N/A';
			}

			$data[] = array(
				'id' => $pago_key + 1,
				'identificador' => $pago_row->identificador,
				'inmueble_identificador' => strtoupper($pago_row->nombre_inmueble),
				'proceso_venta_identificador' => "<a href='inmuebles/plan_pagos/$pago_row->identificador_inmueble'>Identificador de pago: $pago_row->proceso_venta_identificador</a>",
				'fecha_programada' => (!empty($pago_row->fecha_programada) ? date('Y/m/d', strtotime($pago_row->fecha_programada)) : ''),
				'fecha_pago' => (!empty($pago_row->fecha_pago) ? date('Y/m/d', strtotime($pago_row->fecha_pago)) : ''),
				'concepto' => $pago_row->concepto,
				'monto' => $pago_row->monto,
				'archivo_comprobante_pago' => $opciones_archivo,
				'archivo_comprobante_pago_expediente' => $opciones_archivo_expediente,
				'estatus_pago' => ucfirst($pago_row->estatus_pago),
				'estatus' => ucfirst($pago_row->estatus),
				'fecha_registro' => date('Y/m/d', strtotime($pago_row->fecha_registro)),
				'fecha_actualizacion' => date('Y/m/d', strtotime($pago_row->fecha_actualizacion)),
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

	public function obtener_saldos()
	{

		$pagos_list = $this->pagos_model->obtener_pagos()->result();

		$total = 0;
		$contador = 0;
		foreach ($pagos_list as $pago_row) {
			$total = $total + $pago_row->monto;
			$contador++;
		}

		$pagado = 0;
		$contador_pagado = 0;
		$por_validar = 0;
		$por_cobrar = 0;
		$vencido = 0;
		foreach ($pagos_list as $pago_row) {
			if ($pago_row->estatus_pago === 'cobrado') {
				$pagado = $pagado + $pago_row->monto;
				$contador_pagado++;
			}
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
			'precio_venta' => number_format($total, 2),
			'pagado' => number_format($pagado, 2),
			'por_validar' => number_format($por_validar, 2),
			'por_cobrar' => number_format($por_cobrar, 2),
			'vencido' => number_format($vencido, 2),
			'no_pagos' => $contador_pagado . '/' . $contador,
		);

		echo json_encode($data);
	}

	public function actualizar_pago()
	{
		$identificador = $this->input->post('identificador');
		$columna = $this->input->post('columna'); // Índice de la columna
		$nuevoValor = $this->input->post('nuevoValor');

		$data = array(
			$columna => $nuevoValor,
			'fecha_actualizacion' => date('Y-m-d H:i:s'),
		);

		// Llama a tu modelo para actualizar el dato en la base de datos
		$this->pagos_model->actualizar_pago_por_identificador($identificador, $data);

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
                    'identificador' => $identificador_3,
                    'pago_identificador' => $identificador,
                    'desarrollo' => $desarrollo_row->nombre,
                    'inmueble_identificador' => $inmueble_row->identificador,
                    'inmueble' => $inmueble_row->nombre,
                    'concepto' => $pago_row->concepto,
                    'cliente_nombre' => $cliente_row->nombre . ' ' . $cliente_row->apellido_paterno . ' ' . $cliente_row->apellido_materno,
                    'rfc' => $cliente_row->rfc,
                    'codigo_postal' => '',
                    'regimen_fiscal' => '',
                    'uso_cfdi' => '',
                    'monto' => $pago_row->monto,
                    'estatus_factura' => 'solicitud de complemento de pago',
                    'fecha_registro' => $fecha_registro,
                    'fecha_actualizacion' => $fecha_registro,
                );

                $this->facturas_model->insertar_factura($data_3);
            }
        }

		// Devuelve una respuesta (puede ser JSON o lo que necesites)
		echo json_encode(array('status' => 'success', 'message' => 'Dato actualizado'));
	}

	public function obtener_opciones_select_estatus_pago()
	{
		echo json_encode(select_estatus_pago());
		exit();
	}
}
