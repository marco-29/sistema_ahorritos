<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notas extends MY_Controller
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
        $this->load->model('notas_model');
        $this->load->model('identidades_model');
        $this->load->model('contratos_model');
    }

    /**
     * Función que carga la página principal del apartado.
     */
    public function index()
    {
        $data['pagina_titulo'] = 'Notas';
        $data['pagina_subtitulo'] = 'Registros de notas';
        $data['pagina_menu_usuarios'] = true;

        $data['controlador'] = 'site/notas';
        $data['ir_a'] = 'site/inicio';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/notas/index";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/notas/index', $data);
    }

    public function obtener_tabla_index()
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $notas_list = $this->notas_model->obtener_notas_con_usuario();
        $catalogo_modulos = select_modulo();
        $data = [];

        foreach ($notas_list->result() as $notas_key => $notas_value) {

            $opciones = '<a href="javascript:eliminar(\'' . $notas_value->identificador . '\');">Eliminar</a>';

            $key = array_search($notas_value->origen_modulo, array_column($catalogo_modulos, 'valor'));
            $modulo_seleccionado = $catalogo_modulos[$key];

            if ($modulo_seleccionado->nombre === 'Contratos') {
                $enlace = $modulo_seleccionado->nombre;
            } else {
                $enlace = '<a href="' . $modulo_seleccionado->url . '" target="_blank">' . $modulo_seleccionado->nombre . '</a>';
            }

            // json_encode($modulo_seleccionado)
            $data[] = array(
                'id' => $notas_key + 1,
                'identificador' => $notas_value->identificador,
                'usuario_identificador' => $notas_value->identidad_nombre_completo,
                'origen_modulo' => $enlace,
                'origen_identificador' => $notas_value->origen_identificador,
                'nota' => ucfirst($notas_value->nota),
                'fecha_registro' => date('Y/m/d', strtotime($notas_value->fecha_registro)),
                'opciones' => $opciones,
            );
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $notas_list->num_rows(),
            'recordsFiltered' => $notas_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

    public function eliminar()
    {

        $data['controlador'] = 'site/notas/eliminar';
        $data['regresar_a'] = 'site/notas';
        $controlador_js = 'site/notas/eliminar';

        /* Datos_necesarios */
        if ($this->input->post('identificador')) {
            $identificador = strval($this->input->post('identificador'));
        }

        if (!isset($identificador) and empty($identificador)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['regresar_a']);
        }

        $notas_row = $this->notas_model->obtener_nota_por_identificador($identificador)->row();

        if (!isset($notas_row) and empty($notas_row)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (2)', $data['regresar_a']);
        }

        if (!$this->notas_model->eliminar_nota_por_identificador($notas_row->identificador)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (5)', $data['regresar_a']);
        }

        $this->mensaje_del_sistema('MENSAJE_EXITO', 'El registro ' . $notas_row->identificador . ' se ha eliminado con éxito.', $data['regresar_a']);
    }

    public function obtener_opciones_select_modulo()
    {
        echo json_encode(select_modulo());
        exit();
    }
}
