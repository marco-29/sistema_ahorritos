<?php defined('BASEPATH') or exit('No direct script access allowed');

class Desarrollo_interes extends MY_Controller
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
        $this->load->model('desarrollo_interes_model');
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Desarrollos de interes';
        $data['pagina_subtitulo'] = 'Desarrollos de interes';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/desarrollo_interes';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/desarrollo_interes/index";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/desarrollo_interes/index', $data);
    }

    public function obtener_tabla_index()
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $desarrollos_de_interes_list = $this->desarrollo_interes_model->obtener_desarrollo_interes();

        $data = [];
        $cont = 1;

        foreach ($desarrollos_de_interes_list->result() as $desarrollo_interes_row) {

            $opciones = '';

            $data[] = array(
                'id' => $cont,
                'identificador' => $desarrollo_interes_row->identificador,
                'nombre' => mb_strtoupper($desarrollo_interes_row->nombre),
                'opciones' => $opciones,
            );

            $cont++;
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $desarrollos_de_interes_list->num_rows(),
            'recordsFiltered' => $desarrollos_de_interes_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

    public function agregar()
    {
        $data['pagina_titulo'] = 'Agregar desarrollo de interes';
        $data['pagina_subtitulo'] = 'Nuevo desarrollo de interes';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/desarrollo_interes/agregar';
        $data['regresar_a'] = 'site/desarrollo_interes';
        $controlador_js = 'site/desarrollo_interes/agregar';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|max_length[240]');

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/desarrollo_interes/agregar', $data);
        } else {

            $this->session->set_flashdata('nombre', $this->input->post('nombre'));

            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "inmueble-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            $data_1 = array(
                'identificador' => $identificador_1,

                'nombre' => !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
            );

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
            }

            //Querys
            if (!$this->desarrollo_interes_model->insertar_desarrollo_interes($data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'El inmueble ' . $this->input->post('nombre') . ' ha sido agregado con éxito.', $data['regresar_a']);

            $this->construir_site_ui('site/desarrollo_interes/agregar', $data);
        }
    }
}
