<?php defined('BASEPATH') or exit('No direct script access allowed');

class Desarrollos extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('clientes_model');
        $this->load->model('inmuebles_model');
        $this->load->model('rel_inmuebles_model');
        $this->load->model('logs_model');
        $this->load->model('notas_model');
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Desarrollos';
        $data['pagina_subtitulo'] = 'Registro de desarrollos';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/desarrollos';
        $data['ir_a'] = 'site/inicio';
        $data['regresar_a'] = 'site/inicio';
        $controlador_js = "site/desarrollos/index";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/desarrollos/index', $data);
    }

    public function obtener_catalogo_index($etiqueta_id = null)
    {
        $path_url = '';

        switch ($etiqueta_id) {
            case 'tipo_inmueble_desarrollos':
                $tipo_inmueble = 'desarrollo';
                $path_url = 'site/desarrollos/ver/';
                break;

            case 'tipo_inmueble_fraccionamientos':
                $tipo_inmueble = 'fraccionamiento';
                $path_url = '';
                break;

            case 'tipo_inmueble_terrenos':
                $tipo_inmueble = 'terreno';
                $path_url = '';
                break;

            case 'tipo_inmueble_bodegas':
                $tipo_inmueble = 'bodega';
                $path_url = '';
                break;

            case 'tipo_inmueble_departamentos':
                $tipo_inmueble = 'departamento';
                $path_url = 'site/inmuebles/notas/';
                break;

            case 'tipo_inmueble_casas':
                $tipo_inmueble = 'casa';
                $path_url = '';
                break;

            case 'tipo_inmueble_lotes':
                $tipo_inmueble = 'lote';
                $path_url = '';
                break;

            case 'tipo_inmueble_habitaciones':
                $tipo_inmueble = 'habitación';
                $path_url = '';
                break;

            default:
                $tipo_inmueble = null;
                $path_url = '';
                break;
        }

        $inmuebles_list = $this->inmuebles_model->obtener_catalogo_index($tipo_inmueble);

        $result = array();

        foreach ($inmuebles_list->result() as $key => $inmueble_value) {

            $result[] = '
                <div class="col-xl-2 col-md-2 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <img class="card-img-top img-fluid" src="' . base_url('almacenamiento\site\recursos\inmuebles\portada-800x600.jpg') . '" alt="">
                            <div class="card-body">
                                <h4 class="card-title">' . mb_strtoupper($inmueble_value->nombre) . '</h4>
                                <p class="card-text">' . ucfirst($inmueble_value->tipo_inmueble) . '</p>
                                <a href="' . site_url($path_url . $inmueble_value->identificador) . '" class="btn btn-outline-secondary btn-block">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        echo json_encode($result);
        exit();
    }

    public function agregar()
    {
        $data['pagina_titulo'] = 'Agregar desarrollo';
        $data['pagina_subtitulo'] = 'Nuevo desarrollo';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/desarrollos/agregar';
        $data['regresar_a'] = 'site/desarrollos';
        $controlador_js = 'site/desarrollos/agregar';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|max_length[240]');
        $this->form_validation->set_rules('no_inmuebles', 'no. inmuebles', 'trim');
        $this->form_validation->set_rules('tipo_inmueble', 'tipo inmuebles', 'trim');
        $this->form_validation->set_rules('modalidad', 'modalidad', 'trim');
        $this->form_validation->set_rules('prototipo', 'prototipo', 'trim');
        $this->form_validation->set_rules('tamanho_construccion', 'tamaño construcción recurrente', 'trim');
        $this->form_validation->set_rules('tamanho_terraza', 'tamaño terraza recurrente', 'trim');
        $this->form_validation->set_rules('tamanho_total', 'tamaño total recurrente', 'trim');
        $this->form_validation->set_rules('precio', 'precio', 'trim');

        //notas
        $this->form_validation->set_rules('nota', 'Nota', 'trim');

        if ($this->form_validation->run() == false) {
            $this->construir_site_ui('site/desarrollos/agregar', $data);
        } else {

            $this->session->set_flashdata('nombre', $this->input->post('nombre'));
            $this->session->set_flashdata('no_inmuebles', $this->input->post('no_inmuebles'));
            $this->session->set_flashdata('modalidad', $this->input->post('modalidad'));
            $this->session->set_flashdata('prototipo', $this->input->post('prototipo'));
            $this->session->set_flashdata('tamanho_construccion', $this->input->post('tamanho_construccion'));
            $this->session->set_flashdata('tamanho_terraza', $this->input->post('tamanho_terraza'));
            $this->session->set_flashdata('tamanho_total', $this->input->post('tamanho_total'));
            $this->session->set_flashdata('precio', $this->input->post('precio'));

            //notas
            $this->session->set_flashdata('nota', $this->input->post('nota'));

            $fecha_registro = date("Y-m-d H:i:s");

            $key_1 = "inmueble-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
            $identificador_1 = hash("crc32b", $key_1);

            $data_1 = array(
                'identificador' => $identificador_1,
                'nombre' => !empty($this->input->post('nombre')) ? mb_strtolower($this->input->post('nombre')) : null,
                'tipo_inmueble' => 'desarrollo',
                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_registro,
            );

            if (!$data_1) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Ha ocurrido un error, por favor inténtalo más tarde. (1)', $data['controlador']);
            }

            if ($this->input->post('nota') != '') {

                $key_2 = "notas-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $identificador_2 = hash("crc32b", $key_2);

                $data_2 = array(
                    'identificador' => $identificador_2,
                    'usuario_identificador' => $this->session->userdata('user_identificador'),
                    'origen_modulo' => 'inmuebles',
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

            if ($this->input->post('no_inmuebles') > 0) {

                $key_3 = "inmueble-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $key_4 = "rel_inmuebles-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
                $count = 1;
                $data_3 = array();
                $data_4 = array();

                while ($count <= $this->input->post('no_inmuebles')) {
                    $identificador_3 = hash("crc32b", $key_3 . "-" . $count);
                    $identificador_4 = hash("crc32b", $key_4 . "-" . $count);

                    $data_3[] = array(
                        'identificador' => $identificador_3,
                        'nombre' => !empty($this->input->post('nombre')) ? trim(mb_strtolower($this->input->post('nombre') . ' inmueble ' . $count)) : null,
                        'tipo_inmueble' => !empty($this->input->post('tipo_inmueble')) ? $this->input->post('tipo_inmueble') : null,
                        'modalidad' => !empty($this->input->post('modalidad')) ? $this->input->post('modalidad') : null,
                        'prototipo' => !empty($this->input->post('prototipo')) ? $this->input->post('prototipo') : null,
                        'estatus_inmueble' => 'disponible',
                        'etapa' => 1,
                        'tamanho_construccion' => !empty($this->input->post('tamanho_construccion')) ? $this->input->post('tamanho_construccion') : 0,
                        'tamanho_terraza' => !empty($this->input->post('tamanho_terraza')) ? $this->input->post('tamanho_terraza') : 0,
                        'tamanho_total' => !empty($this->input->post('tamanho_total')) ? $this->input->post('tamanho_total') : 0,
                        'precio' => !empty($this->input->post('precio')) ? $this->input->post('precio') : 0,
                        'fecha_registro' => $fecha_registro,
                        'fecha_actualizacion' => $fecha_registro,
                    );

                    $data_4[] = array(
                        'identificador' => $identificador_4,
                        'inmueble_nodo_identificador' => $identificador_1,
                        'inmueble_hijo_identificador' => $identificador_3,
                        'fecha_registro' => $fecha_registro,
                    );

                    $count++;
                }
            }

            //Querys
            if (!$this->inmuebles_model->insertar_inmueble($data_1)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (2)', $data['controlador']);
            }

            if ($this->input->post('no_inmuebles') > 0) {
                if (!$this->inmuebles_model->insertar_matriz_inmuebles($data_3)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (3)', $data['controlador']);
                }

                if (!$this->rel_inmuebles_model->insertar_matriz_rel_inmuebles($data_4)) {
                    $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se pudo procesar la solicitud, por favor inténtalo más tarde. (4)', $data['controlador']);
                }
            }

            $this->mensaje_del_sistema('MENSAJE_EXITO', 'El desarrollo "' . $this->input->post('nombre') . ' <b>#' . $identificador_1 . '</b>" ha sido registrado de forma exitosa.', 'site/desarrollos/ver/' . $identificador_1);

            $this->construir_site_ui('site/desarrollos/agregar', $data);
        }
    }

    public function ver($identificador = null)
    {
        if ($this->input->post()) {
            $identificador = $this->input->post('identificador');
        }

        $data['pagina_titulo'] = 'Ver desarrollo';
        $data['pagina_subtitulo'] = 'Registro de inmuebles';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/desarrollos/ver/' . $identificador;
        $data['regresar_a'] = 'site/desarrollos';
        $controlador_js = "site/desarrollos/ver";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        if (empty($identificador)) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', mostrar_mensaje_error_solicitud() . '&nbsp(1)', $data['regresar_a']);
        }

        $inmueble_nodo_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        if (!$inmueble_nodo_row) {
            $this->mensaje_del_sistema('MENSAJE_ERROR', mostrar_mensaje_error_solicitud() . '&nbsp(2)', $data['regresar_a']);
        }

        $data['inmueble_nodo_row'] = $inmueble_nodo_row;

        $this->construir_site_ui('site/desarrollos/ver', $data);
    }

    public function obtener_inmuebles_por_desarrollo($identificador)
    {
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));

        $inmueble_list = $this->inmuebles_model->obtener_inmuebles_por_desarrollo($identificador);

        $data = [];
        $cont = 1;

        foreach ($inmueble_list->result() as $inmuebles_row) {

            $opciones = '<a href="' . site_url('site/inmuebles/notas/' . $inmuebles_row->identificador) . '">Ver detalles</a>';
            if (in_array($inmuebles_row->estatus_inmueble, array('disponible', 'apartado'))) {
                $opciones .= '&nbsp;|&nbsp;';
                $opciones .= '<a href="' . site_url('site/procesos_venta/agregar/' . $inmuebles_row->identificador) . '">Proceso venta</a>';
            }

            $data[] = array(
                'id' => $cont,
                'identificador' => $inmuebles_row->identificador,
                'nombre' => mb_strtoupper($inmuebles_row->nombre),
                'tipo_inmueble' => ucwords($inmuebles_row->tipo_inmueble),
                'precio' => $inmuebles_row->precio,
                'etapa' => $inmuebles_row->etapa,
                'estatus_inmueble' => ucwords($inmuebles_row->estatus_inmueble),
                'modalidad' => ucwords($inmuebles_row->modalidad),
                'prototipo' => mb_strtoupper($inmuebles_row->prototipo),
                'tamanho_construccion' => !empty($inmuebles_row->tamanho_construccion) ? $inmuebles_row->tamanho_construccion : '',
                'tamanho_terraza' => !empty($inmuebles_row->tamanho_terraza) ? $inmuebles_row->tamanho_terraza : '',
                'tamanho_total' => !empty($inmuebles_row->tamanho_total) ? $inmuebles_row->tamanho_total : '',
                'opciones' => $opciones,
            );

            $cont++;
        }

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $inmueble_list->num_rows(),
            'recordsFiltered' => $inmueble_list->num_rows(),
            'data' => $data
        );

        echo json_encode($result);
        exit();
    }

    public function actualizar_dato()
    {
        $identificador = $this->input->post('identificador');
        $columna = $this->input->post('columna'); // Índice de la columna
        $nuevoValor = $this->input->post('nuevoValor');

        //aqui conusltar el inmubele a modificar
        $inmueble = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        $data = array(
            $columna => $nuevoValor
        );

        $data_2 = array(
            'identificador_usuario' => 'Identificador: ' . $this->session->userdata('user_identificador'),
            'correo' => ' Correo: ' . $this->session->userdata('user_correo_electronico'),
            'tipo' => 'Actualizacion',
            'concepto' => 'Se actualizo el ' . ucfirst($columna) . ' del inmueble con el identificador: ' . $identificador,
            'columna' => $columna,
            'valor_nuevo' => $nuevoValor,
            'datos' => json_encode($inmueble, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'fecha_registro' => date('Y-m-d H:i:s'),
        );
        // Llama a tu modelo para actualizar el dato en la base de datos
        $this->inmuebles_model->actualizar_inmueble_por_identificador($identificador, $data);

        $this->logs_model->suceso_sistema($data_2);

        // Devuelve una respuesta (puede ser JSON o lo que necesites)
        echo json_encode(array('status' => 'success', 'message' => 'Dato actualizado'));
    }

    public function obtener_opciones_select_tipo_inmueble()
    {
        echo json_encode(select_tipo_inmueble());
        exit();
    }

    public function obtener_opciones_select_prototipo()
    {
        echo json_encode(select_prototipo());
        exit();
    }

    public function obtener_opciones_select_modalidad()
    {
        echo json_encode(select_modalidad());
        exit();
    }

    public function obtener_opciones_select_estatus_inmueble()
    {
        echo json_encode(select_estatus_inmueble());
        exit();
    }

    public function obtener_opciones_select_etapa()
    {
        echo json_encode(select_etapa());
        exit();
    }

    public function obtener_opciones_select_estatus()
    {
        echo json_encode(select_estatus());
        exit();
    }

    public function obtener_opciones_select_clientes()
    {
        $result = $this->clientes_model->obtener_opciones_select_clientes()->result();

        echo json_encode($result);
        exit();
    }

    public function documentos($identificador = null)
    {
        $data['pagina_titulo'] = 'Documentos';
        $data['pagina_subtitulo'] = 'Documentos';
        $data['pagina_menu_inmuebles'] = true;

        $data['controlador'] = 'site/desarrollos/documentos/';
        $data['regresar_a'] = 'site/desarrollos';
        $controlador_js = 'site/desarrollos/documentos';

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/forms/selects/select2.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/forms/select/select2.full.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $inmueble_nodo_row = $this->inmuebles_model->obtener_inmueble_por_identificador($identificador)->row();

        $data['inmueble_nodo_row'] = $inmueble_nodo_row;

        $this->construir_site_ui('site/desarrollos/documentos', $data);
    }

    public function cargar_archivo($identificador)
    {
        $data['controlador'] = 'site/desarrollos/cargar_archivo/' . $identificador;
        $data['regresar_a'] = 'site/desarrollos/documentos/' . $identificador;
        $controlador_js = 'site/desarrollos/cargar_archivo';

        if (isset($_FILES) && $_FILES['cargar_archivo']['error'] == '0') {

            $config['upload_path']   = './almacenamiento/archivos/' . $identificador;

            if (!is_dir($config['upload_path'])) {
                //$this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no existe", site_url($data['regresar_a']));
                mkdir($config['upload_path'], 0777, TRUE);
            }

            $config['allowed_types'] = '*';
            $config['max_size'] = 1024 * 1500;
            //$config['overwrite']     = true;
            //$config['encrypt_name']  = true;
            $config['remove_spaces'] = true;

            if (!is_dir($config['upload_path'])) {
                $this->mensaje_del_sistema("MENSAJE_ERROR", "La carpeta de carga no existe", site_url($data['regresar_a']));
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('cargar_archivo')) {

                $this->mensaje_del_sistema("MENSAJE_ERROR", trim('Archivo de expediente ' . $this->upload->display_errors()), site_url($data['regresar_a']));
            } else {

                $data_imagen = $this->upload->data();
                $cargar_archivo = $data_imagen['file_name'];
            }
        } else {

            $cargar_archivo = null;
        }

        $this->mensaje_del_sistema("MENSAJE_EXITO", trim('El archivo ' . $cargar_archivo . ' se ha cargado con éxito.'), site_url($data['regresar_a']));
    }

    public function subir_etapa($identificador)
    {
        $data['pagina_titulo'] = 'Ver desarrollo';
        $data['pagina_subtitulo'] = 'Registro de inmuebles';
        $data['pagina_menu_desarrollos'] = true;

        $data['controlador'] = 'site/desarrollos/ver/' . $identificador;
        $data['regresar_a'] = 'site/desarrollos';
        $controlador_js = "site/desarrollos/ver";

        $inmueble_list = $this->inmuebles_model->obtener_inmuebles_por_desarrollo($identificador);

        foreach ($inmueble_list as $inmueble) {
            if ($inmueble->estatus_inmueble != 'vendido') {

                $nueva_etapa = $inmueble->etapa + 1;

                $data = array(
                    'etapa' => $nueva_etapa
                );

                // Llama a tu modelo para actualizar el dato en la base de datos
                $this->inmuebles_model->actualizar_inmueble_por_identificador($inmueble->identificador, $data);
            }
        }

        $this->construir_site_ui('site/desarrollos/ver', $data);
    }
}
