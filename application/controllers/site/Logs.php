<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends MY_Controller
{

	/**
	 * Este es el constructor del sistema.
	 */
	public function __construct()
	{
		parent::__construct();

		/**
		 * Estos son los modelos que se usan en el controlador
		 */
		$this->load->model('logs_model');
	}

	/**
	 * Función que carga la página principal del apartado.
	 */
	public function index()
	{
		/**
		 * Opciones para el menú principal.
		 */
		$data['pagina_menu_usuarios'] = true;
		$data['pagina_titulo'] = 'Registros sistema';

		/**
		 * Cargar los mensajes de estatus para el usuario.
		 */
		$data['mensaje_exito'] = $this->session->flashdata('MENSAJE_EXITO');
		$data['mensaje_info'] = $this->session->flashdata('MENSAJE_INFO');
		$data['mensaje_error'] = $this->session->flashdata('MENSAJE_ERROR');

		$logs_list = $this->logs_model->obtener_todos_los_registros()->result();

		if (!$logs_list) {
			$data['mensaje_info'] = 'Aún no ha ocurrido algo en el sistema, te avisaremos cuando algo nuevo aparezca, por favor, vuelva a comprobar más tarde.';
		}

		$data['logs_list'] = $logs_list;

		/**
		 * Construir la vista con Header y Footer
		 */
		$this->construir_site_ui('site/logs/index', $data);
	}
}
