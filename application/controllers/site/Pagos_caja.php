<?php defined('BASEPATH') or exit('No direct script access allowed');

class pagos_caja extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('pagos_model');
		$this->load->model('pagos_caja_model');
	}

	public function index()
	{
		$data['pagina_titulo'] = 'Pagos caja';
		$data['pagina_subtitulo'] = 'Registro de pagos caja';
		$data['pagina_menu_pagos'] = true;

		$data['controlador'] = 'site/pagos_caja';
		$data['regresar_a'] = 'site/pagos_caja';
		$controlador_js = "site/pagos_caja/index";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->construir_site_ui('site/pagos_caja/index', $data);
	}

	public function obtener_tabla_index()
	{
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$pagos_caja_list = $this->pagos_caja_model->obtener_tabla_index();

		$data = [];

		foreach ($pagos_caja_list->result() as $pago_key => $pago_caja_row) {

			$opciones = '<a href="' . site_url('site/pagos_caja/ver/' . $pago_caja_row->inmueble_identificador) . '">Ver pagos</a>';
			$opciones .= ' | ';
			$opciones .= '<a href="' . site_url('site/inmuebles/plan_pagos/' . $pago_caja_row->inmueble_identificador) . '">Ver inmueble</a>';

			$data[] = array(
				'id' => $pago_key + 1,
				'identificador' => $pago_caja_row->identificador,
				'fecha_programada' => (!empty($pago_caja_row->fecha_programada) ? date('Y/m/d', strtotime($pago_caja_row->fecha_programada)) : ''),
				'fecha_pago' => (!empty($pago_caja_row->fecha_pago) ? date('Y/m/d', strtotime($pago_caja_row->fecha_pago)) : ''),
				'concepto' => $pago_caja_row->concepto,
				'monto' => $pago_caja_row->monto,
				'estatus_pago' => ucfirst($pago_caja_row->estatus_pago),
				'estatus' => ucfirst($pago_caja_row->estatus),
				'fecha_registro' => date('Y/m/d', strtotime($pago_caja_row->fecha_registro)),
				'fecha_actualizacion' => date('Y/m/d', strtotime($pago_caja_row->fecha_actualizacion)),
				'opciones' => $opciones,
			);
		}

		$result = array(
			'draw' => $draw,
			'recordsTotal' => $pagos_caja_list->num_rows(),
			'recordsFiltered' => $pagos_caja_list->num_rows(),
			'data' => $data
		);

		echo json_encode($result);
		exit();
	}

	public function ver($identificador)
	{
		if ($this->input->post()) {
			$identificador = $this->input->post('identificador');
		}

		$data['pagina_titulo'] = 'Plan de pagos del inmueble';
		$data['pagina_subtitulo'] = 'Detalles del plan de pagos';
		$data['pagina_menu_pagos'] = true;

		$data['controlador'] = 'site/pagos_caja/ver/' . $identificador;
		$data['regresar_a'] = 'site/pagos_caja';
		$controlador_js = "site/pagos_caja/ver";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->construir_site_ui('site/pagos_caja/ver', $data);
	}

	public function obtener_tabla_ver_proceso_venta($identificador)
	{
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));

		$pagos_caja_list = $this->pagos_caja_model->obtener_tabla_ver_proceso_venta($identificador);
		$pagos_list = $this->pagos_model->obtener_tabla_ver_proceso_venta($identificador);

		$cont_lista = 0;

		foreach ($pagos_caja_list->result() as $pago_caja_key => $pago_caja_value) {

			$cont_lista = $cont_lista + 1;

			$opciones = '<a href="' . site_url('site/pagos_caja') . '">Editar pago</a>';

			if (isset($pago_caja_value->archivo_comprobante_pago) and !empty($pago_caja_value->archivo_comprobante_pago)) {

				$tipo_extension = pathinfo($pago_caja_value->archivo_comprobante_pago, PATHINFO_EXTENSION);

				if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
					$tipo_extension = 'archivo';
				} elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
					$tipo_extension = 'imagen';
				}

				$opciones_archivo = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $pago_caja_value->identificador . '/' . $pago_caja_value->archivo_comprobante_pago) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de pago</a>';
			} else {

				$opciones_archivo = 'N/A';
			}

			$data[] = array(
				'id' => $cont_lista,
				'identificador' => $pago_caja_value->identificador,
				'fecha_programada' => (!empty($pago_caja_value->fecha_programada) ? date('Y/m/d', strtotime($pago_caja_value->fecha_programada)) : ''),
				'fecha_pago' => (!empty($pago_caja_value->fecha_pago) ? date('Y/m/d', strtotime($pago_caja_value->fecha_pago)) : ''),
				'concepto' => $pago_caja_value->concepto,
				'monto' => $pago_caja_value->monto,
				'archivo_comprobante_pago' => $opciones_archivo,
				'estatus_pago' => ucfirst($pago_caja_value->estatus_pago),
				'estatus' => ucfirst($pago_caja_value->estatus),
				'fecha_registro' => date('Y/m/d', strtotime($pago_caja_value->fecha_registro)),
				'fecha_actualizacion' => date('Y/m/d', strtotime($pago_caja_value->fecha_actualizacion)),
				'opciones' => $opciones,
			);
		}

		foreach ($pagos_list->result() as $pago_key => $pago_value) {

			$cont_lista = $cont_lista + 1;

			$opciones = '<a href="' . site_url('site/inmuebles/plan_pagos/' . $pago_value->inmueble_identificador) . '">Editar pago</a>';

			if (isset($pago_value->archivo_comprobante_pago) and !empty($pago_value->archivo_comprobante_pago)) {

				$tipo_extension = pathinfo($pago_value->archivo_comprobante_pago, PATHINFO_EXTENSION);

				if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
					$tipo_extension = 'archivo';
				} elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
					$tipo_extension = 'imagen';
				}

				$opciones_archivo = '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $pago_value->identificador . '/' . $pago_value->archivo_comprobante_pago) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de pago</a>';
			} else {

				$opciones_archivo = 'N/A';
			}

			$data[] = array(
				'id' => $cont_lista,
				'identificador' => $pago_value->identificador,
				'fecha_programada' => (!empty($pago_value->fecha_programada) ? date('Y/m/d', strtotime($pago_value->fecha_programada)) : ''),
				'fecha_pago' => (!empty($pago_value->fecha_pago) ? date('Y/m/d', strtotime($pago_value->fecha_pago)) : ''),
				'concepto' => $pago_value->concepto,
				'monto' => $pago_value->monto,
				'archivo_comprobante_pago' => $opciones_archivo,
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

	public function actualizar_dato_pago()
	{
		$identificador = $this->input->post('identificador');
		$columna = $this->input->post('columna');
		$nuevoValor = $this->input->post('nuevoValor');

		$data_1 = array(
			$columna => $nuevoValor
		);

		$this->pagos_caja_model->actualizar_pago_caja_por_identificador($identificador, $data_1);

		echo json_encode(array('status' => 'success', 'message' => 'Dato actualizado'));
	}

	public function obtener_opciones_select_estatus_pago()
	{
		echo json_encode(select_estatus_pago());
		exit();
	}
}
