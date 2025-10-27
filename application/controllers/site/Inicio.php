<?php defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('inicio_model');
	}

	public function index()
	{
		$data['pagina_titulo'] = 'Inicio';
		$data['pagina_subtitulo'] = 'Inicio';
		$data['pagina_menu_inicio'] = true;

		$data['controlador'] = 'site/inicio';
		$data['regresar_a'] = 'site/inicio';
		$controlador_js = "site/inicio/index";

		$data['styles'] = array();

		$data['scripts'] = array(
			array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
		);

		$this->construir_site_ui('site/inicio/index', $data);
	}

	public function actualizar_clientes()
	{
		$clientes_list = $this->inicio_model->obtener_clientes()->result();

		foreach ($clientes_list as $key => $value) {

			if (empty($value->identificador)) {
				$fecha_registro = DateTime::createFromFormat('U.u', microtime(true));
				$fecha_registro->format("Y-m-d H:i:s.v");

				$key_1 = "clientes-" . $fecha_registro->format("Y-m-d-H-i-s-v") . '-' . $value->id;
				$identificador_1 = hash("crc32b", $key_1);

				echo $value->id;
				echo '<br>';
				echo $identificador_1;
				echo '<br>';

				$this->inicio_model->actualizar_cliente_por_id($value->id, array('identificador' => $identificador_1));
			}
		}
	}







	public function obtener_total_clientes()
	{
		$total_clientes = $this->inicio_model->obtener_total_clientes();
		echo json_encode(array('total_clientes' => $total_clientes));
	}

	public function obtener_total_clientes_prospectos()
	{
		$total_clientes_prospectos = $this->inicio_model->obtener_total_clientes_prospectos();
		echo json_encode(array('total_clientes_prospectos' => $total_clientes_prospectos));
	}

	public function obtener_total_clientes_compradores()
	{
		$total_clientes_compradores = $this->inicio_model->obtener_total_clientes_compradores();
		echo json_encode(array('total_clientes_compradores' => $total_clientes_compradores));
	}

	public function obtener_total_inmuebles()
	{
		$total_inmuebles = $this->inicio_model->obtener_total_inmuebles();
		echo json_encode(array('total_inmuebles' => $total_inmuebles));
	}

	public function obtener_total_inmuebles_en_proceso()
	{
		$total_inmuebles_en_proceso = $this->inicio_model->obtener_total_inmuebles_en_proceso();
		echo json_encode(array('total_inmuebles_en_proceso' => $total_inmuebles_en_proceso));
	}
}
