<?php defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('identidades_model');
		$this->load->model('usuarios_model');
		$this->load->model('clientes_model');
		$this->load->model('notas_model');
	}

	public function index()
	{
		$data['pagina_titulo'] = 'Usuarios';
		$data['pagina_subtitulo'] = 'Registro de usuario';
		$data['pagina_menu_usuarios'] = true;

		$data['controlador'] = 'site/usuarios';
		$data['regresar_a'] = 'site/inicio';
		$controlador_js = "site/usuarios/index";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->construir_site_ui('site/usuarios/index', $data);
	}

	public function obtener_tabla_index()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));

		$usuarios_list = $this->usuarios_model->obtener_tabla_index();

		$data = [];

		foreach ($usuarios_list->result() as $key => $usuario_row) {
			$opciones = '<a href="' . site_url('site/usuarios/ver/' . $usuario_row->identificador) . '">Ver detalles</a>'
				. '|' .
				'<a href="' . site_url('site/usuarios/editar/' . $usuario_row->identificador) . '">Editar</a>';
			$opciones .= '|';
			$opciones .= '<a href="' . site_url('site/usuarios/cambiar_password/' . $usuario_row->identificador) . '">Cambiar contraseña</a>';

			$data[] = array(
				'id' => $usuario_row->id,
				'identidad_nombre_completo' => ucfirst($usuario_row->identidad_nombre_completo),
				'correo_electronico' => $usuario_row->correo_electronico,
				'telefono' => $usuario_row->telefono,
				'opciones' => $opciones,
			);
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $usuarios_list->num_rows(),
			"recordsFiltered" => $usuarios_list->num_rows(),
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}

	public function ver($identificador)
	{
		$data['pagina_titulo'] = 'Ver usuario';
		$data['pagina_subtitulo'] = 'Ver detalles del usuario';
		$data['pagina_menu_usuarios'] = true;

		$data['controlador'] = 'site/usuarios/ver/' . $identificador;
		$data['ir_a'] = 'site/usuarios/editar/' . $identificador;
		$data['regresar_a'] = 'site/usuarios';
		$controlador_js = "site/usuarios/ver";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$usuario_row = $this->usuarios_model->obtener_usuario_por_identificador($identificador)->row();

		if (!$usuario_row) {
			$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
		}

		$data['usuario_row'] = $usuario_row;

		$notas_list = $this->notas_model->obtener_notas_por_origen_identificador_y_detalles($usuario_row->identificador)->result();

		$data['notas_list'] = $notas_list;

		$this->construir_site_ui('site/usuarios/ver', $data);
	}

	public function agregar()
	{
		$data['pagina_titulo'] = 'Agregar usuario';
		$data['pagina_subtitulo'] = 'Nuevo usuario';
		$data['pagina_menu_usuarios'] = true;

		$data['controlador'] = 'site/usuarios/agregar';
		$data['regresar_a'] = 'site/usuarios/index';
		$controlador_js = 'site/usuarios/agregar';

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->form_validation->set_rules('es_asesor', 'es asesor', 'required');
		$this->form_validation->set_rules('correo_electronico', 'correo electrónico', 'required|valid_email|max_length[150]');
		$this->form_validation->set_rules('telefono', 'teléfono', 'required|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('contrasenha', 'contraseña', 'required|min_length[8]');
		$this->form_validation->set_rules('validar_contrasenha', 'validar contraseña', 'required|matches[contrasenha]');

		$this->form_validation->set_rules('nombre', 'nombre', 'required|max_length[150]');
		$this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'required|max_length[150]');
		$this->form_validation->set_rules('apellido_materno', 'apellido materno', 'max_length[150]');

		//notas
		$this->form_validation->set_rules('nota', 'Nota', 'trim');

		if ($this->form_validation->run() == false) {
			$this->construir_site_ui('site/usuarios/agregar', $data);
		} else {

			$this->session->set_flashdata('es_asesor', $this->input->post('es_asesor'));
			$this->session->set_flashdata('correo_electronico', $this->input->post('correo_electronico'));
			$this->session->set_flashdata('telefono', $this->input->post('telefono'));
			$this->session->set_flashdata('contrasenha', $this->input->post('contrasenha'));
			$this->session->set_flashdata('validar_contrasenha', $this->input->post('validar_contrasenha'));

			//notas
			$this->session->set_flashdata('nota', $this->input->post('nota'));

			$fecha_registro = date("Y-m-d H:i:s");

			$key_1 = "usuario-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
			$identificador_1 = hash("crc32b", $key_1);

			$data_1 = array(
				'identificador' => $identificador_1,
				'identidad_identificador' => $identificador_1,
				'rol_identificador' 				=> !empty($this->input->post('es_asesor')) ? $this->input->post('es_asesor') : null,
				'correo_electronico' => $this->input->post('correo_electronico'),
				'telefono' => $this->input->post('telefono'),
				'contrasenha' => password_hash($this->input->post('contrasenha'), PASSWORD_DEFAULT),
				'valido_email' => 'si',
				'valido_telefono' => 'si',
				'estatus' => 'activo',
				'fecha_registro' => $fecha_registro,
				'fecha_actualizacion' => $fecha_registro,
			);

			if (!$data_1) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
			}

			$data_3 = array(
				'identificador' => $identificador_1,
				'usuario_identificador' => $identificador_1,
				'nombre' 				=> !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
				'apellido_paterno' 		=> !empty($this->input->post('apellido_paterno')) ? mb_strtolower($this->input->post('apellido_paterno')) : null,
				'apellido_materno' 		=> !empty($this->input->post('apellido_materno')) ? mb_strtolower($this->input->post('apellido_materno')) : null,
				'fecha_registro' => $fecha_registro,
				'fecha_actualizacion' => $fecha_registro,
			);

			if (!$data_3) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
			}

			if ($this->input->post('nota') != '') {

				$key_2 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
				$identificador_2 = hash("crc32b", $key_2);

				$data_2 = array(
					'identificador' => $identificador_2,
					'usuario_identificador' => $this->session->userdata('user_identificador'),
					'origen_modulo' => 'usuarios',
					'origen_identificador' => $identificador_1,
					'nota' => !empty($this->input->post('nota')) ? $this->input->post('nota') : null,
					'fecha_registro' => $fecha_registro
				);

				if (!$data_2) {
					$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['controlador']);
				}

				if (!$this->notas_model->insertar_nota($data_2)) {
					$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
				}
			}

			//Querys

			if (!$this->usuarios_model->insert_usuario($data_1)) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (1)', $data['controlador']);
			}

			if (!$this->identidades_model->insert_identidad($data_3)) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (1)', $data['controlador']);
			}

			$this->mensaje_del_sistema('MENSAJE_EXITO', 'El usuario ' . trim($this->input->post('nombre') . ' ' . $this->input->post('apellido_paterno') . ' <b>#' . $identificador_1) . '</b> ha sido agregado con éxito.', $data['regresar_a']);

			$this->construir_site_ui('site/usuarios/agregar', $data);
		}
	}

	public function editar($identificador)
	{
		if ($this->input->post()) {
			$identificador = $this->input->post('identificador');
		}

		$data['pagina_titulo'] = 'Editar usuario';
		$data['pagina_subtitulo'] = 'Actualizar usuario';
		$data['pagina_menu_leads'] = true;

		$data['controlador'] = 'site/usuarios/editar/' . $identificador;
		$data['regresar_a'] = 'site/usuarios/index';
		$controlador_js = 'site/usuarios/editar';

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->form_validation->set_rules('es_asesor', 'es asesor', 'trim');
		$this->form_validation->set_rules('nombre', 'nombre', 'trim|max_length[240]');
		$this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|max_length[240]');
		$this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|max_length[240]');
		$this->form_validation->set_rules('telefono', 'teléfono', 'trim|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('correo_electronico', 'correo electrónico', 'trim|valid_email|max_length[240]');

		//notas
		$this->form_validation->set_rules('nota', 'Nota', 'trim');

		$usuario_row = $this->usuarios_model->obtener_usuario_por_identificador($identificador)->row();
		$notas_row = $this->notas_model->obtener_notas_por_origen_identificador($identificador)->row();

		if (!$usuario_row) {
			$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
		}

		$data['usuario_row'] = $usuario_row;
		$data['notas_row'] = $notas_row;

		if ($this->form_validation->run() == false) {
			$this->construir_site_ui('site/usuarios/editar', $data);
		} else {

			$this->session->set_flashdata('es_asesor', $this->input->post('es_asesor'));
			$this->session->set_flashdata('nombre', $this->input->post('nombre'));
			$this->session->set_flashdata('apellido_paterno', $this->input->post('apellido_paterno'));
			$this->session->set_flashdata('apellido_materno', $this->input->post('apellido_materno'));
			$this->session->set_flashdata('telefono', $this->input->post('telefono'));
			$this->session->set_flashdata('correo_electronico', $this->input->post('correo_electronico'));

			//notas
			$this->session->set_flashdata('nota', $this->input->post('nota'));

			$data_0 = array(
				'nombre' 				=> !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
				'apellido_paterno' 		=> !empty($this->input->post('apellido_paterno')) ? mb_strtolower($this->input->post('apellido_paterno')) : null,
				'apellido_materno' 		=> !empty($this->input->post('apellido_materno')) ? mb_strtolower($this->input->post('apellido_materno')) : null,
				'fecha_actualizacion' 	=> date('Y-m-d H:i:s'),
			);

			if (!$data_0) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (4)', $data['regresar_a']);
			}

			$data_1 = array(
				'rol_identificador' 				=> !empty($this->input->post('es_asesor')) ? $this->input->post('es_asesor') : null,
				'telefono' 				=> !empty($this->input->post('telefono')) ? $this->input->post('telefono') : null,
				'correo_electronico' 	=> !empty($this->input->post('correo_electronico')) ? mb_strtolower($this->input->post('correo_electronico')) : null,
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
					'origen_modulo' => 'usuarios',
					'origen_identificador' => $usuario_row->identificador,
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
			if (!$this->identidades_model->actualizar_identidad_por_identificador($usuario_row->identificador, $data_0)) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (1)', $data['regresar_a']);
			}

			if (!$this->usuarios_model->actualizar_usuario_por_identificador($usuario_row->identificador, $data_1)) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (1)', $data['regresar_a']);
			}

			$this->mensaje_del_sistema('MENSAJE_EXITO', 'El usuario ' . $this->input->post('nombre') . ' ha sido editado con éxito.' . 'y se agrego notas', $data['controlador']);

			$this->construir_site_ui('site/usuarios/editar', $data);
		}
	}

	public function cambiar_password($identificador)
	{
		if ($this->input->post()) {
			$identificador = $this->input->post('identificador');
		}

		$data['pagina_titulo'] = 'Cambiar contraseña';
		$data['pagina_subtitulo'] = 'Cambiar contraseña';
		$data['pagina_menu_leads'] = true;

		$data['controlador'] = 'site/usuarios/cambiar_password/' . $identificador;
		$data['regresar_a'] = 'site/usuarios/index';
		$controlador_js = 'site/usuarios/cambiar_password';

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->form_validation->set_rules('contrasenha', 'contraseña', 'required|max_length[64]');
		$this->form_validation->set_rules('contrasenha_valida', 'Validar contraseña nueva', 'required|matches[contrasenha]|min_length[8]');

		$usuario_row = $this->usuarios_model->obtener_usuario_por_identificador($identificador)->row();

		if (!$usuario_row) {
			$this->session->set_flashdata('MENSAJE_INFO', 'El cliente que intenta editar no existe.', $data['regresar_a']);
		}

		$data['usuario_row'] = $usuario_row;

		if ($this->form_validation->run() == false) {

			$this->construir_site_ui('site/usuarios/cambiar_password', $data);
		} else {

			$data_1 = array(
				'contrasenha' => password_hash($this->input->post('contrasenha'), PASSWORD_DEFAULT)
			);

			if ($this->usuarios_model->update_contrasenha($usuario_row->identificador, $data_1)) {

				$this->session->set_flashdata('MENSAJE_EXITO', 'La contraseña del usuario ' . $usuario_row->correo_electronico . ' #' . $usuario_row->identificador . ' ha sido cambiada correctamente.', $data['regresar_a']);
			} else {

				$this->session->set_flashdata('MENSAJE_ERROR', 'Al parecer hubo un error, por favor intentelo mas tarde.', $data['regresar_a']);
				redirect("clientes");
			}

			$this->construir_site_ui('site/usuarios/cambiar_password', $data);
		}
	}
}
