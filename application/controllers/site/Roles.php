<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {

	public function __construct() {
        parent::__construct();

		$this->load->model('roles_model');
    }

	public function index() {
        $data['pagina_titulo'] = 'Roles';
        $data['pagina_subtitulo'] = 'Roles';
		$data['pagina_menu_roles'] = true;

		$data['controlador'] = 'site/roles';
		$data['regresar_a'] = 'site/inicio';
		$controlador_js = "site/roles/index";

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
			array('es_rel' => true, 'src' => ''.$controlador_js.'.js'),
		);

		$this->construir_site_ui('site/roles/index', $data);
	}

	public function obtener_tabla_index() {

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $roles_list = $this->roles_model->obtener_roles();

        $data = [];

		$cont = 1;
		
        foreach ($roles_list->result() as $key => $rol_row) {

            $data[] = array(
                'id' => $cont,
                'identificador' => $rol_row->identificador,
            );

			$cont++;
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $roles_list->num_rows(),
            'recordsFiltered' => $roles_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

	public function agregar() {
        $data['pagina_titulo'] = 'Agregar';
        $data['pagina_subtitulo'] = 'Agregar nuevo rol';
		$data['pagina_menu_roles'] = true;

		$data['controlador'] = 'site/roles/agregar';
		$data['regresar_a'] = 'site/roles';
		$controlador_js = 'site/roles/agregar';

		$data['styles'] = array(
			array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
		);

		$data['scripts'] = array(
			array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
			array('es_rel' => true, 'src' => ''.$controlador_js.'.js'),
		);

		$this->form_validation->set_rules('nombre_producto', 'nombre del producto', 'trim|required|min_length[1]|max_length[250]');
		$this->form_validation->set_rules('cantidad', 'cantidad', 'trim|required');
		$this->form_validation->set_rules('costo_unitario', 'costo unitario', 'trim|required');
		$this->form_validation->set_rules('total', 'total', 'trim|required');
		$this->form_validation->set_rules('fecha_ingreso', 'fecha de ingreso', 'trim|required');
		$this->form_validation->set_rules('nota', 'Nota', 'trim|min_length[1]|max_length[500]');

		if ($this->form_validation->run() == false) {
			$this->construir_site_ui('site/roles/agregar', $data);
        } else {

			$this->session->set_flashdata('nombre_producto', $this->input->post('nombre_producto'));
			$this->session->set_flashdata('cantidad', $this->input->post('cantidad'));
			$this->session->set_flashdata('costo_unitario', $this->input->post('costo_unitario'));
			$this->session->set_flashdata('total', $this->input->post('total'));
			$this->session->set_flashdata('fecha_ingreso', $this->input->post('fecha_ingreso'));
			$this->session->set_flashdata('nota', $this->input->post('nota'));

			/* Paso_1 */

			$fecha_registro = date("Y-m-d H:i:s");
			$fecha = date("Y-m-d-H-i-s", strtotime($fecha_registro));
			
			$key_1 = "control_inventario-".$fecha;
			$identificador_1 = hash("crc32b", $key_1);

			$data_post_1 = array(
				'identificador' => $identificador_1,
				'nombre_producto' => trim($this->input->post('nombre_producto')),
				'cantidad' => trim($this->input->post('cantidad')),
				'costo_unitario' => trim($this->input->post('costo_unitario')),
				'total' => trim($this->input->post('total')),
				'fecha_ingreso' => trim($this->input->post('fecha_ingreso')),
				'nota' => trim($this->input->post('nota')),
				'estatus' => trim(strval('activo')),
				'fecha_registro' => $fecha_registro,
            );

			if (!$data_post_1) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
			}

			if (!$this->control_inventario_model->insert_control_inventario($data_post_1)) {
				$this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
			}

			/* Paso_2 */

			$this->mensaje_del_sistema('MENSAJE_EXITO', '"'.trim($this->input->post('nombre_producto')).'" se agregó con éxito.', $data['regresar_a']);

			$this->construir_site_ui('site/roles/agregar', $data);
		}
	}

}
