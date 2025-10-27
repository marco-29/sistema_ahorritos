<?php defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('clientes_model');
		$this->load->model('desarrollo_interes_model');
		$this->load->model('notas_model');
		$this->load->model('usuarios_model');
	}

	public function index()
	{
		$data['pagina_titulo'] = 'Clientes';
		$data['pagina_subtitulo'] = 'Registro de clientes';
		$data['pagina_menu_clientes'] = true;

		$data['controlador'] = 'site/clientes';
		$data['regresar_a'] = 'site/clientes';
		$controlador_js = "site/clientes/index";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url('app-assets/vendors/css/forms/selects/select2.min.css')),
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
			array('es_rel' => false, 'href' => 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css'),
			array('es_rel' => false, 'href' => 'https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url('app-assets/vendors/js/forms/select/select2.full.min.js')),
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$desarrollos = $this->clientes_model->obtener_desarrollo();
		$data['desarrollos'] = $desarrollos;

		$estatus = $this->clientes_model->obtener_estatus();
		$data['estatus'] = $estatus;

		$medio = $this->clientes_model->obtener_medio_de_difusion();
		$data['medio'] = $medio;

		$asesor = $this->clientes_model->obtener_asesor();
		$data['asesor'] = $asesor;

		$this->construir_site_ui('site/clientes/index', $data);
	}

	public function obtener_tabla_index()
	{
		// Recoger los parámetros enviados por DataTables
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$search = $this->input->post('search')['value'];
		$order_columns = $this->input->post('order');

		// Recoger filtros
		$filtros = array(
			'estatus_cliente' => $this->input->post('filtro_estatus_cliente'),
			'desarrollo_interes' => $this->input->post('filtro_desarrollo_interes'),
			'como_se_entero' => $this->input->post('filtro_como_se_entero'),
			'asesor' => $this->input->post('filtro_asesor'),
			'interes' => $this->input->post('filtro_interes_semanal'),
			'medio_contacto' => $this->input->post('filtro_medio_contacto')
		);

		// Llamar al modelo para obtener los datos de la tabla
		$clientes_list = $this->clientes_model->obtener_tabla_index($length, $start, $search, $order_columns, $filtros);

		$totalRecords = $this->clientes_model->contar_clientes();
		$totalRecordsFiltered = $this->clientes_model->contar_clientes_filtrados($search, $filtros);

		$data = array();

		// Definir las operaciones disponibles según el estatus del cliente
		$estatus_operaciones = array(
			'comprador' => array(
				array('class' => 'success', 'function' => 'prospecto', 'icon' => 'ft-chevron-up', 'label' => 'Promover a prospecto'),
				array('class' => 'text-warning', 'function' => 'descartar', 'icon' => 'ft-chevron-down', 'label' => 'Promover a por descartar'),
				array('class' => 'text-danger', 'function' => 'descartado', 'icon' => 'ft-chevrons-down', 'label' => 'Promover a descartado'),
			),
			'prospecto' => array(
				array('class' => 'text-info', 'function' => 'comprador', 'icon' => 'ft-chevrons-up', 'label' => 'Promover a comprador'),
				array('class' => 'text-warning', 'function' => 'descartar', 'icon' => 'ft-chevron-down', 'label' => 'Promover a por descartar'),
				array('class' => 'text-danger', 'function' => 'descartado', 'icon' => 'ft-chevrons-down', 'label' => 'Promover a descartado'),
			),
			'descartar' => array(
				array('class' => 'text-info', 'function' => 'comprador', 'icon' => 'ft-chevrons-up', 'label' => 'Promover a comprador'),
				array('class' => 'success', 'function' => 'prospecto', 'icon' => 'ft-chevron-up', 'label' => 'Promover a prospecto'),
				array('class' => 'text-danger', 'function' => 'descartado', 'icon' => 'ft-chevrons-down', 'label' => 'Promover a descartado'),
			),
			'descartado' => array(
				array('class' => 'text-info', 'function' => 'comprador', 'icon' => 'ft-chevrons-up', 'label' => 'Promover a comprador'),
				array('class' => 'success', 'function' => 'prospecto', 'icon' => 'ft-chevron-up', 'label' => 'Promover a prospecto'),
				array('class' => 'text-warning', 'function' => 'descartar', 'icon' => 'ft-chevron-down', 'label' => 'Promover a por descartar'),
			),
		);

		// Definir los niveles de interés
		$niveles_interes = array(
			'alto' => 'I.S. Alto',
			'medio' => 'I.S. Medio',
			'bajo' => 'I.S. Bajo',
			'nulo' => 'I.S. Nulo',
		);

		// Procesar cada cliente
		foreach ($clientes_list->result() as $cliente_row) {

			// Construir 'operaciones_estatus' dinámicamente
			$operaciones_estatus = '';
			$estatus_cliente = $cliente_row->estatus_cliente;
			if (isset($estatus_operaciones[$estatus_cliente])) {
				foreach ($estatus_operaciones[$estatus_cliente] as $operacion) {
					$operaciones_estatus .= '<a class="' . $operacion['class'] . '" href="javascript:' . $operacion['function'] . '(' . $cliente_row->id . ')" name="' . $operacion['function'] . '_' . $cliente_row->id . '" id="' . $operacion['function'] . '_' . $cliente_row->id . '"><i class="' . $operacion['icon'] . '"></i>' . $operacion['label'] . '</a><br>';
				}
			}

			// Construir 'opciones'
			$opciones = '';
			$opciones .= '<a href="" class="dropdown-toggle dropdown-menu-right btn-xs mb-1 mr-1" id="btnGroupDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>';
			$opciones .= '<div class="dropdown-menu p-2" aria-labelledby="btnGroupDrop1">';
			$opciones .= '<h6 class="highlight text-muted">Cambiar estatus</h6>';
			$opciones .= $operaciones_estatus;
			$opciones .= '<hr style="border: 1px solid rgba(67, 66, 66, 0.200)">';
			$opciones .= '<h6 class="highlight text-muted">Opciones</h6>';
			$opciones .= '<a class="text-info" href="' . site_url('site/clientes/ver/' . $cliente_row->identificador) . '"><i class="icon-eye"></i> Ver detalles</a><br>';
			$opciones .= '<a class="text-info" href="' . site_url('site/clientes/editar/' . $cliente_row->identificador) . '"><i class="icon-note"></i> Editar</a><br>';
			$opciones .= '<a class="text-info" href="javascript:comentario(' . $cliente_row->id . ')" name="comentario_' . $cliente_row->id . '" id="comentario_' . $cliente_row->id . '"><i class="icon-speech"></i> Nota</a><br>';
			$opciones .= '<hr style="border: 1px solid rgba(67, 66, 66, 0.200)">';
			$opciones .= '<h6 class="highlight text-muted">Modificaciones</h6>';

			foreach ($niveles_interes as $nivel => $label) {
				$opciones .= '<a class="text-info" href="javascript:interes_' . $nivel . '(' . $cliente_row->id . ')" name="' . $nivel . '_' . $cliente_row->id . '" id="' . $nivel . '_' . $cliente_row->id . '"><i class="ft-bar-chart-2"></i> ' . $label . '</a><br>';
			}

			$opciones .= '</div>';

			// Construir el array de datos para este cliente
			$data[] = array(
				'opciones' => $opciones,
				'id' => $cliente_row->id,
				'nombre' => ucwords($cliente_row->clientes_nombre ?? ''),
				'desarrollo_interes_identificador' => mb_strtoupper($cliente_row->desarrollos_interes_nombre ?? ''),
				'estatus_cliente' => ucfirst($cliente_row->estatus_cliente ?? ''),
				'nivel_interes' => ucfirst($cliente_row->nivel_interes ?? ''),
				'como_se_entero' => $cliente_row->como_se_entero ?? null,
				'metodo_contacto' => $cliente_row->metodo_contacto ?? null,
				'correo_electronico' => $cliente_row->correo_electronico ?? null,
				'telefono' => $cliente_row->telefono ?? null,
				'ultima_nota' => $cliente_row->ultima_nota ?? null,
				'persona_fiscal' => ucfirst($cliente_row->persona_fiscal ?? ''),
				'nombre_representante_legal' => ucwords($cliente_row->clientes_nombre_representante_legal ?? ''),
				'domicilio_fiscal' => $cliente_row->domicilio_fiscal ?? null,
				'fecha_nacimiento' => !empty($cliente_row->fecha_nacimiento) ? date('Y/m/d', strtotime($cliente_row->fecha_nacimiento)) : null,
				'estado_civil' => ucfirst($cliente_row->estado_civil ?? ''),
				'curp' => strtoupper($cliente_row->curp ?? ''),
				'ine' => $cliente_row->ine ?? null,
				'rfc' => strtoupper($cliente_row->rfc ?? ''),
				'ultima_nota' => $cliente_row->ultima_nota ?? null,
				'identificador' => $cliente_row->identificador ?? null,
				'asesor' => $cliente_row->usuarios_correo_electronico ?? null,
				'fecha_registro' => !empty($cliente_row->fecha_registro) ? date('Y-m-d', strtotime($cliente_row->fecha_registro)) : null,
				'fecha_actualizacion' => !empty($cliente_row->fecha_actualizacion) ? date('Y-m-d', strtotime($cliente_row->fecha_actualizacion)) : null
			);
		}

		$result = array(
			'draw' => $draw,
			'recordsTotal' => $totalRecords,
			'recordsFiltered' => $totalRecordsFiltered,
			'data' => $data
		);

		// Enviar respuesta en formato JSON
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($result));
	}

	public function ver($identificador = null)
	{
		$data['pagina_titulo'] = 'Ver cliente';
		$data['pagina_subtitulo'] = 'Ver detalles del cliente';
		$data['pagina_menu_clientes'] = true;

		$data['controlador'] = 'site/clientes/ver/' . $identificador;
		$data['ir_a'] = 'site/clientes/editar/' . $identificador;
		$data['regresar_a'] = 'site/clientes';
		$controlador_js = "site/clientes/ver";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$cliente_row = $this->clientes_model->obtener_cliente_por_identificador($identificador)->row();

		if (!$cliente_row) {
			$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
		}

		$data['cliente_row'] = $cliente_row;

		$notas_list = $this->notas_model->obtener_notas_por_origen_identificador_y_detalles($cliente_row->identificador)->result();

		$data['notas_list'] = $notas_list;

		$this->construir_site_ui('site/clientes/ver', $data);
	}

	public function guardar_nota()
	{
		$identificador = $this->input->post('identificador');

		$data['controlador'] = 'site/clientes/ver/' . $identificador;
		$data['ir_a'] = 'site/clientes/ver/' . $identificador;

		if ($this->input->post('nota') != '') {

			$fecha_registro = date("Y-m-d H:i:s");

			$key_1 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
			$identificador_1 = hash("crc32b", $key_1);

			$data_1 = array(
				'identificador' => $identificador_1,
				'usuario_identificador' => $this->session->userdata('user_identificador'),
				'origen_modulo' => 'clientes',
				'origen_identificador' => $identificador,
				'nota' => !empty($this->input->post('nota')) ? mb_strtolower($this->input->post('nota')) : null,
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

		$this->construir_site_ui('site/clientes/notas', $data);
	}

	public function agregar()
	{
		$data['pagina_titulo'] = 'Agregar cliente';
		$data['pagina_subtitulo'] = 'Nuevo cliente';
		$data['pagina_menu_clientes'] = true;

		$data['controlador'] = 'site/clientes/agregar';
		$data['regresar_a'] = 'site/clientes';
		$controlador_js = 'site/clientes/agregar';

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->form_validation->set_rules('asesor_identificador', 'asesor', 'trim|required');
		$this->form_validation->set_rules('persona_fiscal', 'estatus', 'trim|required');
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|max_length[240]');
		$this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|max_length[240]');
		$this->form_validation->set_rules('nombre_representante_legal', 'nombre representante legal', 'trim|max_length[240]');
		$this->form_validation->set_rules('apellido_representante_legal', 'apellido representante legal', 'trim|max_length[240]');
		$this->form_validation->set_rules('telefono', 'teléfono', 'trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('correo_electronico', 'correo electrónico', 'trim|required|valid_email|max_length[240]');
		$this->form_validation->set_rules('fecha_nacimiento', 'fecha de nacimiento', 'trim');
		$this->form_validation->set_rules('estado_civil', 'estado civil', 'trim');
		$this->form_validation->set_rules('curp', 'CURP', 'trim|max_length[18]');
		$this->form_validation->set_rules('ine', 'INE', 'trim|max_length[50]');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|max_length[20]');
		$this->form_validation->set_rules('domicilio_fiscal', 'domicilio fiscal', 'trim|max_length[240]');
		$this->form_validation->set_rules('como_se_entero', '¿cómo se enteró?', 'trim|required');
		$this->form_validation->set_rules('medio_contacto', 'Medio de contacto', 'trim|required');
		$this->form_validation->set_rules('desarrollo_interes_identificador', 'desarrollo de interés', 'trim|required');
		$this->form_validation->set_rules('estatus_cliente', 'estatus', 'trim|required');

		//notas
		$this->form_validation->set_rules('nota', 'Nota', 'trim');

		$usuarios_list = $this->usuarios_model->get_usuarios()->result();
		$desarrollos_interes_list = $this->desarrollo_interes_model->obtener_desarrollo_interes()->result();

		$data['usuarios_list'] = $usuarios_list;
		$data['desarrollos_interes_list'] = $desarrollos_interes_list;

		if ($this->form_validation->run() == false) {
			$this->construir_site_ui('site/clientes/agregar', $data);
		} else {

			$this->session->set_flashdata('asesor_identificador', $this->input->post('asesor_identificador'));
			$this->session->set_flashdata('persona_fiscal', $this->input->post('persona_fiscal'));
			$this->session->set_flashdata('nombre', $this->input->post('nombre'));
			$this->session->set_flashdata('apellido_paterno', $this->input->post('apellido_paterno'));
			$this->session->set_flashdata('apellido_materno', $this->input->post('apellido_materno'));
			$this->session->set_flashdata('nombre_representante_legal', $this->input->post('nombre_representante_legal'));
			$this->session->set_flashdata('apellido_representante_legal', $this->input->post('apellido_representante_legal'));
			$this->session->set_flashdata('telefono', $this->input->post('telefono'));
			$this->session->set_flashdata('correo_electronico', $this->input->post('correo_electronico'));
			$this->session->set_flashdata('fecha_nacimiento', $this->input->post('fecha_nacimiento'));
			$this->session->set_flashdata('estado_civil', $this->input->post('estado_civil'));
			$this->session->set_flashdata('curp', $this->input->post('curp'));
			$this->session->set_flashdata('ine', $this->input->post('ine'));
			$this->session->set_flashdata('rfc', $this->input->post('rfc'));
			$this->session->set_flashdata('domicilio_fiscal', $this->input->post('domicilio_fiscal'));
			$this->session->set_flashdata('como_se_entero', $this->input->post('como_se_entero'));
			$this->session->set_flashdata('medio_contacto', $this->input->post('medio_contacto'));
			$this->session->set_flashdata('desarrollo_interes_identificador', $this->input->post('desarrollo_interes_identificador'));
			$this->session->set_flashdata('estatus_cliente', $this->input->post('estatus_cliente'));

			//notas
			$this->session->set_flashdata('nota', $this->input->post('nota'));

			$fecha_registro = date("Y-m-d H:i:s");

			if ($this->input->post('apellido_materno') == '' or $this->input->post('apellido_materno') == null) {
				$nombre_completo = trim($this->input->post('nombre')) . ' ' . trim($this->input->post('apellido_paterno')) . ' ' . trim($this->input->post('apellido_materno'));
			} else {
				$nombre_completo = trim($this->input->post('nombre')) . ' ' . trim($this->input->post('apellido_paterno')) . ' ' . trim($this->input->post('apellido_materno'));
			}
			$telefono = $this->input->post('telefono');
			$correo = $this->input->post('correo_electronico');

			$nombre_completo_existe = $this->clientes_model->verificar_cliente_existe($nombre_completo)->row();
			$telefono_existe = $this->clientes_model->verificar_telefono_existe($telefono)->row();
			$correo_existe = $this->clientes_model->verificar_correo_existe($correo)->row();

			if ($nombre_completo_existe or ($telefono_existe or $correo_existe)) { //v or f = v
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'El usuario ya fue registrado', $data['controlador']);
			} else {
				$key_1 = "cliente-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
				$identificador_1 = hash("crc32b", $key_1);

				$data_1 = array(
					'identificador' 		=> $identificador_1,
					'asesor_identificador' 		=> !empty($this->input->post('asesor_identificador')) ? $this->input->post('asesor_identificador') : null,
					'persona_fiscal' 		=> !empty($this->input->post('persona_fiscal')) ? $this->input->post('persona_fiscal') : null,
					'nombre' 				=> !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
					'apellido_paterno' 		=> !empty($this->input->post('apellido_paterno')) ? mb_strtolower($this->input->post('apellido_paterno')) : null,
					'apellido_materno' 		=> !empty($this->input->post('apellido_materno')) ? mb_strtolower($this->input->post('apellido_materno')) : null,
					'nombre_representante_legal' 		=> !empty($this->input->post('nombre_representante_legal')) ? mb_strtolower($this->input->post('nombre_representante_legal')) : null,
					'apellido_representante_legal' 		=> !empty($this->input->post('apellido_representante_legal')) ? mb_strtolower($this->input->post('apellido_representante_legal')) : null,
					'telefono' 				=> !empty($this->input->post('telefono')) ? $this->input->post('telefono') : null,
					'correo_electronico' 	=> !empty($this->input->post('correo_electronico')) ? mb_strtolower($this->input->post('correo_electronico')) : null,
					'fecha_nacimiento' 		=> (!empty($this->input->post('fecha_nacimiento'))) ? strval(date('Y-m-d', strtotime($this->input->post('fecha_nacimiento')))) : null,
					'estado_civil' 			=> !empty($this->input->post('estado_civil')) ? $this->input->post('estado_civil') : null,
					'curp' 					=> !empty($this->input->post('curp')) ? mb_strtolower($this->input->post('curp')) : null,
					'ine' 					=> !empty($this->input->post('ine')) ? $this->input->post('ine') : null,
					'rfc' 					=> !empty($this->input->post('rfc')) ? mb_strtolower($this->input->post('rfc')) : null,
					'domicilio_fiscal' 		=> !empty($this->input->post('domicilio_fiscal')) ? mb_strtolower($this->input->post('domicilio_fiscal')) : null,
					'como_se_entero' 		=> !empty($this->input->post('como_se_entero')) ? $this->input->post('como_se_entero') : null,
					'metodo_contacto' 		=> !empty($this->input->post('medio_contacto')) ? $this->input->post('medio_contacto') : null,
					'desarrollo_interes_identificador' 		=> !empty($this->input->post('desarrollo_interes_identificador')) ? $this->input->post('desarrollo_interes_identificador') : null,
					'estatus_cliente' 		=> !empty($this->input->post('estatus_cliente')) ? $this->input->post('estatus_cliente') : 'prospecto',
					'estatus' 				=> 'activo',
					'fecha_registro' 		=> $fecha_registro,
					'fecha_actualizacion' 	=> $fecha_registro,
				);

				if (!$data_1) {
					$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
				}

				if (!$this->clientes_model->insertar_cliente($data_1)) {
					$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
				}

				if ($this->input->post('nota') != '') {

					$key_2 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
					$identificador_2 = hash("crc32b", $key_2);

					$data_2 = array(
						'identificador' => $identificador_2,
						'usuario_identificador' => $this->session->userdata('user_identificador'),
						'origen_modulo' => 'clientes',
						'origen_identificador' => $identificador_1,
						'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
						'fecha_registro' => $fecha_registro
					);

					if (!$data_2) {
						$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (3)', $data['controlador']);
					}

					if (!$this->notas_model->insertar_nota($data_2)) {
						$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
					}
				}

				$this->mensaje_del_sistema('MENSAJE_EXITO', 'El prospecto: "' . trim($this->input->post('nombre') . ' ' . $this->input->post('apellido_paterno') . ' ' . '<b>#' . $identificador_1) . '</b>" ha sido registrado de forma exitosa.', site_url('site/clientes/ver/' . $identificador_1));
			}

			$this->construir_site_ui('site/clientes/agregar', $data);
		}
	}

	public function verificar_existencia()
	{
		$data = json_decode(file_get_contents("php://input"));

		if (isset($data->campo) && isset($data->valor)) {
			$campo = $data->campo;
			$valor = $data->valor;

			// Cargar el modelo y verificar existencia del cliente
			$this->load->model("Clientes_model");
			$cliente = $this->clientes_model->verificar_existencia($campo, $valor);

			if ($cliente) {
				// Utiliza output_json para responder con el asesor que registró al cliente
				$this->output_json(["existe" => true, "asesor" => $cliente->usuarios_correo_electronico]);
			} else {
				$this->output_json(["existe" => false]);
			}
		} else {
			$this->output_json(["error" => "Datos incompletos"]);
		}
	}


	public function editar($identificador)
	{
		if ($this->input->post()) {
			$identificador = $this->input->post('identificador');
		}

		$data['pagina_titulo'] = 'Editar cliente';
		$data['pagina_subtitulo'] = 'Actualizar cliente';
		$data['pagina_menu_leads'] = true;

		$data['controlador'] = 'site/clientes/editar/' . $identificador;
		$data['regresar_a'] = 'site/clientes/index';
		$controlador_js = 'site/clientes/editar';

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->form_validation->set_rules('asesor_identificador', 'asesor', 'trim|required');
		$this->form_validation->set_rules('persona_fiscal', 'estatus', 'trim|required');
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|required|max_length[240]');
		$this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|max_length[240]');
		$this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|max_length[240]');
		$this->form_validation->set_rules('nombre_representante_legal', 'nombre representante legal', 'trim|max_length[240]');
		$this->form_validation->set_rules('apellido_representante_legal', 'apellido representante legal', 'trim|max_length[240]');
		$this->form_validation->set_rules('telefono', 'teléfono', 'trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('correo_electronico', 'correo electrónico', 'trim|required|valid_email|max_length[240]');
		$this->form_validation->set_rules('fecha_nacimiento', 'fecha de nacimiento', 'trim');
		$this->form_validation->set_rules('estado_civil', 'estado civil', 'trim');
		$this->form_validation->set_rules('curp', 'CURP', 'trim|max_length[18]');
		$this->form_validation->set_rules('ine', 'INE', 'trim|max_length[50]');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|max_length[20]');
		$this->form_validation->set_rules('domicilio_fiscal', 'domicilio fiscal', 'trim|max_length[240]');
		$this->form_validation->set_rules('como_se_entero', '¿Cómo se enteró?', 'trim|required');
		$this->form_validation->set_rules('medio_contacto', 'Medio de contacto', 'trim|required');
		$this->form_validation->set_rules('desarrollo_interes_identificador', 'desarrollo de interés', 'trim|required');
		$this->form_validation->set_rules('estatus_cliente', 'estatus', 'trim');

		//notas
		$this->form_validation->set_rules('nota', 'Nota', 'trim');

		$cliente_row = $this->clientes_model->obtener_cliente_por_identificador($identificador)->row();
		$notas_row = $this->notas_model->obtener_notas_por_origen_identificador($identificador)->row();

		if (!$cliente_row) {
			$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
		}

		$usuarios_list = $this->usuarios_model->get_usuarios()->result();
		$desarrollos_interes_list = $this->desarrollo_interes_model->obtener_desarrollo_interes()->result();
		$notas_list = $this->notas_model->obtener_notas_por_origen_identificador_y_detalles($cliente_row->identificador)->result();

		$data['notas_list'] = $notas_list;
		$data['desarrollos_interes_list'] = $desarrollos_interes_list;
		$data['usuarios_list'] = $usuarios_list;
		$data['cliente_row'] = $cliente_row;
		$data['notas_row'] = $notas_row;

		if ($this->form_validation->run() == false) {
			$this->construir_site_ui('site/clientes/editar', $data);
		} else {

			$this->session->set_flashdata('asesor_identificador', $this->input->post('asesor_identificador'));
			$this->session->set_flashdata('persona_fiscal', $this->input->post('persona_fiscal'));
			$this->session->set_flashdata('nombre', $this->input->post('nombre'));
			$this->session->set_flashdata('apellido_paterno', $this->input->post('apellido_paterno'));
			$this->session->set_flashdata('apellido_materno', $this->input->post('apellido_materno'));
			$this->session->set_flashdata('nombre_representante_legal', $this->input->post('nombre_representante_legal'));
			$this->session->set_flashdata('apellido_representante_legal', $this->input->post('apellido_representante_legal'));
			$this->session->set_flashdata('telefono', $this->input->post('telefono'));
			$this->session->set_flashdata('correo_electronico', $this->input->post('correo_electronico'));
			$this->session->set_flashdata('fecha_nacimiento', $this->input->post('fecha_nacimiento'));
			$this->session->set_flashdata('estado_civil', $this->input->post('estado_civil'));
			$this->session->set_flashdata('curp', $this->input->post('curp'));
			$this->session->set_flashdata('ine', $this->input->post('ine'));
			$this->session->set_flashdata('rfc', $this->input->post('rfc'));
			$this->session->set_flashdata('domicilio_fiscal', $this->input->post('domicilio_fiscal'));
			$this->session->set_flashdata('como_se_entero', $this->input->post('como_se_entero'));
			$this->session->set_flashdata('medio_contacto', $this->input->post('medio_contacto'));
			$this->session->set_flashdata('desarrollo_interes_identificador', $this->input->post('desarrollo_interes_identificador'));
			$this->session->set_flashdata('estatus_cliente', $this->input->post('estatus_cliente'));

			//notas
			$this->session->set_flashdata('nota', $this->input->post('nota'));

			$data_1 = array(
				'asesor_identificador' 		=> !empty($this->input->post('asesor_identificador')) ? $this->input->post('asesor_identificador') : null,
				'persona_fiscal' 		=> !empty($this->input->post('persona_fiscal')) ? $this->input->post('persona_fiscal') : null,
				'nombre' 				=> !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
				'apellido_paterno' 		=> !empty($this->input->post('apellido_paterno')) ? mb_strtolower($this->input->post('apellido_paterno')) : null,
				'apellido_materno' 		=> !empty($this->input->post('apellido_materno')) ? mb_strtolower($this->input->post('apellido_materno')) : null,
				'nombre_representante_legal' 		=> !empty($this->input->post('nombre_representante_legal')) ? mb_strtolower($this->input->post('nombre_representante_legal')) : null,
				'apellido_representante_legal' 		=> !empty($this->input->post('apellido_representante_legal')) ? mb_strtolower($this->input->post('apellido_representante_legal')) : null,
				'telefono' 				=> !empty($this->input->post('telefono')) ? $this->input->post('telefono') : null,
				'correo_electronico' 	=> !empty($this->input->post('correo_electronico')) ? mb_strtolower($this->input->post('correo_electronico')) : null,
				'fecha_nacimiento' 		=> (!empty($this->input->post('fecha_nacimiento'))) ? strval(date('Y-m-d', strtotime($this->input->post('fecha_nacimiento')))) : null,
				'estado_civil' 			=> !empty($this->input->post('estado_civil')) ? $this->input->post('estado_civil') : null,
				'curp' 					=> !empty($this->input->post('curp')) ? mb_strtolower($this->input->post('curp')) : null,
				'ine' 					=> !empty($this->input->post('ine')) ? $this->input->post('ine') : null,
				'rfc' 					=> !empty($this->input->post('rfc')) ? mb_strtolower($this->input->post('rfc')) : null,
				'domicilio_fiscal' 		=> !empty($this->input->post('domicilio_fiscal')) ? mb_strtolower($this->input->post('domicilio_fiscal')) : null,
				'como_se_entero' 		=> !empty($this->input->post('como_se_entero')) ? $this->input->post('como_se_entero') : null,
				'metodo_contacto' 		=> !empty($this->input->post('medio_contacto')) ? $this->input->post('medio_contacto') : null,
				'desarrollo_interes_identificador' 		=> !empty($this->input->post('desarrollo_interes_identificador')) ? $this->input->post('desarrollo_interes_identificador') : null,
				'estatus_cliente' 		=> !empty($this->input->post('estatus_cliente')) ? $this->input->post('estatus_cliente') : null,
				'fecha_actualizacion' 	=> date('Y-m-d H:i:s'),
			);

			if (!$data_1) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4)', $data['regresar_a']);
			}

			if ($this->input->post('nota') != '') {

				$key_2 = "notas-" . date("Y-m-d-H-i-s", strtotime(date('Y-m-d H:i:s')));
				$identificador_2 = hash("crc32b", $key_2);

				$data_2 = array(
					'identificador' => $identificador_2,
					'usuario_identificador' => $this->session->userdata('user_identificador'),
					'origen_modulo' => 'clientes',
					'origen_identificador' => $cliente_row->identificador,
					'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
					'fecha_registro' => date('Y-m-d H:i:s')
				);

				if (!$data_2) {
					$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
				}

				if (!$this->notas_model->insertar_nota($data_2)) {
					$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
				}
			}

			//Querys
			if (!$this->clientes_model->actualizar_cliente_por_identificador($cliente_row->identificador, $data_1)) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (1)', $data['regresar_a']);
			}

			$this->mensaje_del_sistema('MENSAJE_EXITO', 'El prospecto: "' . $this->input->post('nombre') . ' <b>#' . $identificador . '</b>" ha sido modificado de forma exitosa.', $data['controlador']);

			$this->construir_site_ui('site/clientes/editar', $data);
		}
	}

	public function actualizar_campos_vacios()
	{

		// Esta parte del codigo es una prueba para hacer edicion masiva de filas y asignar datos null a campos vacios y liberar memoria.
		$query = $this->db->get('clientes');

		$data = array();

		foreach ($query->result() as $key => $value) {
			$data[] = array(
				'id' => !empty($value->id) ? $value->id : NULL,
				'identificador' => !empty($value->identificador) ? $value->identificador : NULL,
				'nombre' => !empty($value->nombre) ? mb_strtolower($value->nombre) : NULL,
				'apellido_paterno' => !empty($value->apellido_paterno) ? mb_strtolower($value->apellido_paterno) : NULL,
				'apellido_materno' => !empty($value->apellido_materno) ? mb_strtolower($value->apellido_materno) : NULL,
				'razon_social' => !empty($value->razon_social) ? mb_strtolower($value->razon_social) : NULL,
				'nombre_representante_legal' => !empty($value->nombre_representante_legal) ? mb_strtolower($value->nombre_representante_legal) : NULL,
				'apellido_representante_legal' => !empty($value->apellido_representante_legal) ? mb_strtolower($value->apellido_representante_legal) : NULL,
				'telefono' => !empty($value->telefono) ? trim($value->telefono) : NULL,
				'correo_electronico' => !empty($value->correo_electronico) ? mb_strtolower($value->correo_electronico) : NULL,
				'fecha_nacimiento' => !empty($value->fecha_nacimiento) ? trim($value->fecha_nacimiento) : NULL,
				'estado_civil' => !empty($value->estado_civil) ? mb_strtolower($value->estado_civil) : NULL,
				'curp' => !empty($value->curp) ? mb_strtolower($value->curp) : NULL,
				'ine' => !empty($value->ine) ? mb_strtolower($value->ine) : NULL,
				'rfc' => !empty($value->rfc) ? mb_strtolower($value->rfc) : NULL,
				'domicilio_fiscal' => !empty($value->domicilio_fiscal) ? mb_strtolower($value->domicilio_fiscal) : NULL,
			);
		}

		// echo $this->db->update_batch('clientes', $data, 'id');
	}

	// Funciones públicas para cambiar el estatus del cliente
	public function comprador($id)
	{
		return $this->cambiar_estatus_cliente($id, 'comprador', 'El cliente se ha promovido correctamente a comprador.');
	}

	public function prospecto($id)
	{
		return $this->cambiar_estatus_cliente($id, 'prospecto', 'El cliente se ha promovido correctamente a prospecto.');
	}

	public function descartar($id)
	{
		return $this->cambiar_estatus_cliente($id, 'descartar', 'El cliente se ha promovido correctamente a por descartar.');
	}

	public function descartado($id)
	{
		return $this->cambiar_estatus_cliente($id, 'descartado', 'El cliente se ha promovido correctamente a descartado.');
	}

	// Funciones públicas para cambiar el nivel de interés del cliente
	public function interes_alto($id)
	{
		return $this->cambiar_nivel_interes($id, 'alto', 'El cliente se ha cambiado correctamente a interés alto.');
	}

	public function interes_medio($id)
	{
		return $this->cambiar_nivel_interes($id, 'medio', 'El cliente se ha cambiado correctamente a interés medio.');
	}

	public function interes_bajo($id)
	{
		return $this->cambiar_nivel_interes($id, 'bajo', 'El cliente se ha cambiado correctamente a interés bajo.');
	}

	public function interes_nulo($id)
	{
		return $this->cambiar_nivel_interes($id, 'nulo', 'El cliente se ha cambiado correctamente a interés nulo.');
	}

	// Función para agregar un comentario (nota)
	public function comentario($id)
	{
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data, true);
		$comentario = isset($data['comentario']) ? $data['comentario'] : '';

		$this->db->trans_begin();

		try {
			$cliente_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

			if (!$cliente_row) {
				throw new Exception('No se pudo encontrar el cliente especificado.');
			}

			// Agregar nota
			$this->agregar_nota($cliente_row, $comentario);

			// Obtener cliente actualizado
			$cliente_actualizado_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

			$operaciones_estatus = $this->obtener_operaciones_estatus($cliente_actualizado_row);
			$opciones = $this->build_opciones($cliente_actualizado_row, $operaciones_estatus);
			$data = $this->build_data($cliente_actualizado_row, $opciones);

			$this->db->trans_commit();

			return $this->output_json(
				array(
					'success' => true,
					'message' => 'El comentario se ha agregado correctamente.',
					'data' => $data
				)
			);
		} catch (Exception $e) {
			$this->db->trans_rollback();

			return $this->output_json(
				array(
					'error' => true,
					'message' => $e->getMessage()
				)
			);
		}
	}

	// Función para obtener información del cliente
	public function obtener_info_cliente($id)
	{
		$cliente_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

		if (!$cliente_row) {
			return $this->output_json(
				array(
					'error' => true,
					'message' => 'No se pudo encontrar el cliente especificado.'
				)
			);
		}

		$notas_list = $this->notas_model->obtener_notas_por_origen_identificador_y_detalles($cliente_row->identificador)->result();

		$data = $this->build_data($cliente_row, '');
		$data['notas_list'] = $notas_list;

		return $this->output_json(
			array(
				'success' => true,
				'message' => 'Información del cliente obtenida correctamente.',
				'data' => $data
			)
		);
	}

	// Función privada para cambiar el estatus del cliente
	private function cambiar_estatus_cliente($id, $nuevo_estatus, $success_message)
	{
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data, true);
		$comentario = isset($data['comentario']) ? $data['comentario'] : '';

		$this->db->trans_begin();

		try {
			$cliente_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

			if (!$cliente_row) {
				throw new Exception('No se pudo encontrar el cliente especificado.');
			}

			$data_update = array(
				'estatus_cliente' => $nuevo_estatus
			);

			if (!$this->clientes_model->actualizar_cliente_por_id($cliente_row->id, $data_update)) {
				throw new Exception('No se pudo actualizar la información del cliente.');
			}

			// Agregar nota
			$this->agregar_nota($cliente_row, $comentario);

			// Obtener cliente actualizado
			$cliente_actualizado_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

			if (!$cliente_actualizado_row) {
				throw new Exception('No se pudo obtener la información actualizada del cliente.');
			}

			$operaciones_estatus = $this->obtener_operaciones_estatus($cliente_actualizado_row);
			$opciones = $this->build_opciones($cliente_actualizado_row, $operaciones_estatus);
			$data = $this->build_data($cliente_actualizado_row, $opciones);

			$this->db->trans_commit();

			return $this->output_json(
				array(
					'success' => true,
					'message' => $success_message,
					'data' => $data
				)
			);
		} catch (Exception $e) {
			$this->db->trans_rollback();

			return $this->output_json(
				array(
					'error' => true,
					'message' => $e->getMessage()
				)
			);
		}
	}

	// Función privada para cambiar el nivel de interés del cliente
	private function cambiar_nivel_interes($id, $nuevo_nivel, $success_message)
	{
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data, true);
		$comentario = isset($data['comentario']) ? $data['comentario'] : '';

		$this->db->trans_begin();

		try {
			$cliente_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

			if (!$cliente_row) {
				throw new Exception('No se pudo encontrar el cliente especificado.');
			}

			$data_update = array(
				'nivel_interes' => $nuevo_nivel
			);

			if (!$this->clientes_model->actualizar_cliente_por_id($cliente_row->id, $data_update)) {
				throw new Exception('No se pudo actualizar la información del cliente.');
			}

			// Agregar nota
			$this->agregar_nota($cliente_row, $comentario);

			// Obtener cliente actualizado
			$cliente_actualizado_row = $this->clientes_model->cliente_obtener_por_id($id)->row();

			if (!$cliente_actualizado_row) {
				throw new Exception('No se pudo obtener la información actualizada del cliente.');
			}

			$operaciones_estatus = $this->obtener_operaciones_estatus($cliente_actualizado_row);
			$opciones = $this->build_opciones($cliente_actualizado_row, $operaciones_estatus);
			$data = $this->build_data($cliente_actualizado_row, $opciones);

			$this->db->trans_commit();

			return $this->output_json(
				array(
					'success' => true,
					'message' => $success_message,
					'data' => $data
				)
			);
		} catch (Exception $e) {
			$this->db->trans_rollback();

			return $this->output_json(
				array(
					'error' => true,
					'message' => $e->getMessage()
				)
			);
		}
	}

	// Función privada para agregar una nota
	private function agregar_nota($cliente_row, $comentario)
	{
		$fecha_registro = date("Y-m-d H:i:s");
		$key = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
		$identificador = hash("crc32b", $key);

		$data_nota = array(
			'identificador' => $identificador,
			'usuario_identificador' => $this->session->userdata('user_identificador'),
			'origen_modulo' => 'clientes',
			'origen_identificador' => $cliente_row->identificador,
			'nota' => $comentario,
			'fecha_registro' => $fecha_registro,
		);

		if (!$this->notas_model->insertar_nota($data_nota)) {
			throw new Exception('No se pudo actualizar la nota.');
		}
	}

	// Función privada para obtener las operaciones de estatus disponibles
	private function obtener_operaciones_estatus($cliente)
	{
		$estatus_cliente = $cliente->estatus_cliente;

		$operaciones = array(
			'comprador' => array(
				array('class' => 'success', 'function' => 'prospecto', 'icon' => 'ft-chevron-up', 'label' => 'Promover a prospecto'),
				array('class' => 'text-warning', 'function' => 'descartar', 'icon' => 'ft-chevron-down', 'label' => 'Promover a por descartar'),
				array('class' => 'text-danger', 'function' => 'descartado', 'icon' => 'ft-chevrons-down', 'label' => 'Promover a descartado'),
			),
			'prospecto' => array(
				array('class' => 'text-info', 'function' => 'comprador', 'icon' => 'ft-chevrons-up', 'label' => 'Promover a comprador'),
				array('class' => 'text-warning', 'function' => 'descartar', 'icon' => 'ft-chevron-down', 'label' => 'Promover a por descartar'),
				array('class' => 'text-danger', 'function' => 'descartado', 'icon' => 'ft-chevrons-down', 'label' => 'Promover a descartado'),
			),
			'descartar' => array(
				array('class' => 'text-info', 'function' => 'comprador', 'icon' => 'ft-chevrons-up', 'label' => 'Promover a comprador'),
				array('class' => 'success', 'function' => 'prospecto', 'icon' => 'ft-chevron-up', 'label' => 'Promover a prospecto'),
				array('class' => 'text-danger', 'function' => 'descartado', 'icon' => 'ft-chevrons-down', 'label' => 'Promover a descartado'),
			),
			'descartado' => array(
				array('class' => 'text-info', 'function' => 'comprador', 'icon' => 'ft-chevrons-up', 'label' => 'Promover a comprador'),
				array('class' => 'success', 'function' => 'prospecto', 'icon' => 'ft-chevron-up', 'label' => 'Promover a prospecto'),
				array('class' => 'text-warning', 'function' => 'descartar', 'icon' => 'ft-chevron-down', 'label' => 'Promover a por descartar'),
			),
		);

		$operaciones_estatus = '';
		if (isset($operaciones[$estatus_cliente])) {
			foreach ($operaciones[$estatus_cliente] as $operacion) {
				$operaciones_estatus .= '<a class="' . $operacion['class'] . '" href="javascript:' . $operacion['function'] . '(' . $cliente->id . ')" name="' . $operacion['function'] . '_' . $cliente->id . '" id="' . $operacion['function'] . '_' . $cliente->id . '"><i class="' . $operacion['icon'] . '"></i>' . $operacion['label'] . '</a><br>';
			}
		}

		return $operaciones_estatus;
	}

	// Función privada para construir las opciones de acción
	private function build_opciones($cliente, $operaciones_estatus)
	{
		$opciones = '';

		$opciones .= '<a href="" class="dropdown-toggle dropdown-menu-right btn-xs mb-1 mr-1" id="btnGroupDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>';

		$opciones .= '<div class="dropdown-menu p-2" aria-labelledby="btnGroupDrop1">';

		$opciones .= '<h6 class="highlight text-muted">Cambiar estatus</h6>';

		$opciones .= $operaciones_estatus;

		$opciones .= '<hr style="border: 1px solid rgba(67, 66, 66, 0.200)">';
		$opciones .= '<h6 class="highlight text-muted">Opciones</h6>';

		$opciones .= '<a class="text-info" href="' . site_url('site/clientes/ver/' . $cliente->identificador) . '"><i class="icon-eye"></i> Ver detalles</a><br>';
		$opciones .= '<a class="text-info" href="' . site_url('site/clientes/editar/' . $cliente->identificador) . '"><i class="icon-note"></i> Editar</a><br>';
		$opciones .= '<a class="text-info" href="javascript:comentario(' . $cliente->id . ')" name="comentario_' . $cliente->id . '" id="comentario_' . $cliente->id . '"><i class="icon-speech"></i> Nota</a><br>';

		$opciones .= '<hr style="border: 1px solid rgba(67, 66, 66, 0.200)">';
		$opciones .= '<h6 class="highlight text-muted">Modificaciones</h6>';

		$niveles_interes = array(
			'alto' => 'I.S. Alto',
			'medio' => 'I.S. Medio',
			'bajo' => 'I.S. Bajo',
			'nulo' => 'I.S. Nulo',
		);

		foreach ($niveles_interes as $nivel => $label) {
			$opciones .= '<a class="text-info" href="javascript:interes_' . $nivel . '(' . $cliente->id . ')" name="' . $nivel . '_' . $cliente->id . '" id="' . $nivel . '_' . $cliente->id . '"><i class="ft-bar-chart-2"></i> ' . $label . '</a><br>';
		}

		$opciones .= '</div>';

		return $opciones;
	}

	// Función privada para construir los datos de respuesta
	private function build_data($cliente, $opciones)
	{
		return array(
			'opciones' => $opciones,
			'id' => $cliente->id,
			'nombre' => ucwords($cliente->clientes_nombre ?? ''),
			'desarrollo_interes_identificador' => mb_strtoupper($cliente->desarrollos_interes_nombre ?? ''),
			'estatus_cliente' => ucfirst($cliente->estatus_cliente ?? ''),
			'nivel_interes' => ucfirst($cliente->nivel_interes ?? ''),
			'como_se_entero' => $cliente->como_se_entero ?? null,
			'metodo_contacto' => $cliente->metodo_contacto ?? null,
			'correo_electronico' => $cliente->correo_electronico ?? null,
			'telefono' => $cliente->telefono ?? null,
			'ultima_nota' => $cliente->ultima_nota ?? null,
			'persona_fiscal' => ucfirst($cliente->persona_fiscal ?? ''),
			'nombre_representante_legal' => ucwords($cliente->clientes_nombre_representante_legal ?? ''),
			'domicilio_fiscal' => $cliente->domicilio_fiscal ?? null,
			'fecha_nacimiento' => !empty($cliente->fecha_nacimiento) ? date('Y/m/d', strtotime($cliente->fecha_nacimiento)) : null,
			'estado_civil' => ucfirst($cliente->estado_civil ?? ''),
			'curp' => strtoupper($cliente->curp ?? ''),
			'ine' => $cliente->ine ?? null,
			'rfc' => strtoupper($cliente->rfc ?? ''),
			'identificador' => $cliente->identificador ?? null,
			'asesor' => $cliente->usuarios_correo_electronico ?? null,
			'fecha_registro' => !empty($cliente->fecha_registro) ? date('Y-m-d', strtotime($cliente->fecha_registro)) : null,
			'fecha_actualizacion' => !empty($cliente->fecha_actualizacion) ? date('Y-m-d', strtotime($cliente->fecha_actualizacion)) : null
		);
	}

	// Función para enviar la respuesta en formato JSON
	private function output_json($data)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
