<?php defined('BASEPATH') or exit('No direct script access allowed');

class Registrar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("identidades_model");
        $this->load->model("usuarios_model");
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Registrar';
        $data['pagina_subtitulo'] = 'Registrar';
        $data['pagina_menu_login'] = true;

        $data['mensaje_exito'] = $this->session->flashdata('MENSAJE_EXITO');
        $data['mensaje_info'] = $this->session->flashdata('MENSAJE_INFO');
        $data['mensaje_error'] = $this->session->flashdata('MENSAJE_ERROR');

        $data['controlador'] = 'registrar';
        $data['regresar_a'] = 'registrar';
        $controlador_js = "registrar/index";

        $data['styles'] = array();

        $data['scripts'] = array(
            //array('es_rel' => true, 'src' => ''.$controlador_js.'.js'),
        );
  
        $this->load->view('registrar/index', $data);
    }

    public function registrar_usuario()
    { $data['pagina_titulo'] = 'Agregar desarrollo';
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
            $this->load->view("registrar/index", $data);
        } else {

            $usuario_row = $this->usuarios_model->obtener_usuario_por_correo_electronico_o_telefono($this->db->escape($this->input->post('usuario')))->row();

            if (!$usuario_row) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se ha encontrado una cuenta de usuario relacionada con este correo electrónico o número de teléfono, por favor verifique sus credenciales.', $data['controlador']);
            }

            $this->session->set_flashdata('usuario', $this->input->post('usuario'));

            $identidad_row = $this->identidades_model->obtener_identidad_por_identificador_para_login($usuario_row->identidad_identificador)->row();

            if (!$identidad_row) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se ha completado su hoja de registro, por favor solicite completar sus datos.', $data['controlador']);
            }

            if ($usuario_row->estatus != "activo") {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Su cuenta de usuario se encuentra suspendida.', $data['controlador']);
            }

            if (!password_verify($this->input->post('contrasenha'), $usuario_row->contrasenha)) {
                $this->mensaje_del_sistema('MENSAJE_ERROR', 'Contraseña incorrecta, por favor inténtelo de nuevo.', $data['controlador']);
            }

            redirect('site/inicio');

            $this->load->view("login/index", $data);
        }
    }
    // public function index()
    // {
    //     $data['pagina_titulo'] = 'Login';
    //     $data['pagina_subtitulo'] = 'Login';
    //     $data['pagina_menu_login'] = true;

    //     $data['mensaje_exito'] = $this->session->flashdata('MENSAJE_EXITO');
    //     $data['mensaje_info'] = $this->session->flashdata('MENSAJE_INFO');
    //     $data['mensaje_error'] = $this->session->flashdata('MENSAJE_ERROR');

    //     $data['controlador'] = 'login';
    //     $data['regresar_a'] = 'login';
    //     $controlador_js = "login/index";

    //     $data['styles'] = array();

    //     $data['scripts'] = array(
    //         //array('es_rel' => true, 'src' => ''.$controlador_js.'.js'),
    //     );

    //     $this->form_validation->set_rules('usuario', 'Correo electrónico o número de teléfono', 'trim|required|min_length[1]|max_length[100]');
    //     $this->form_validation->set_rules('contrasenha', 'Contraseña', 'trim|required|min_length[8]|max_length[100]');

    //     if ($this->form_validation->run() == false) {

    //         if ($this->session->userdata('user_en_sesion') == true) {
    //             redirect('site/inicio');
    //             /*if ($this->session->userdata('user_sistema') == sistema_id()) {
    // 				redirect('site/inicio');
    //             }*/
    //         }

    //         $this->load->view("login/index", $data);
    //     } else {

    //         $usuario_row = $this->usuarios_model->obtener_usuario_por_correo_electronico_o_telefono($this->db->escape($this->input->post('usuario')))->row();

    //         if (!$usuario_row) {
    //             $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se ha encontrado una cuenta de usuario relacionada con este correo electrónico o número de teléfono, por favor verifique sus credenciales.', $data['controlador']);
    //         }

    //         $this->session->set_flashdata('usuario', $this->input->post('usuario'));

    //         $identidad_row = $this->identidades_model->obtener_identidad_por_identificador_para_login($usuario_row->identidad_identificador)->row();

    //         if (!$identidad_row) {
    //             $this->mensaje_del_sistema('MENSAJE_ERROR', 'No se ha completado su hoja de registro, por favor solicite completar sus datos.', $data['controlador']);
    //         }

    //         if ($usuario_row->estatus != "activo") {
    //             $this->mensaje_del_sistema('MENSAJE_ERROR', 'Su cuenta de usuario se encuentra suspendida.', $data['controlador']);
    //         }

    //         if (!password_verify($this->input->post('contrasenha'), $usuario_row->contrasenha)) {
    //             $this->mensaje_del_sistema('MENSAJE_ERROR', 'Contraseña incorrecta, por favor inténtelo de nuevo.', $data['controlador']);
    //         }

    //         $this->_preparar_datos_sesion(
    //             $usuario_row->identificador,
    //             $usuario_row->identidad_identificador,
    //             $usuario_row->rol_identificador,
    //             $usuario_row->correo_electronico,
    //             $usuario_row->telefono,
    //             $identidad_row->nombre,
    //             $identidad_row->apellido_paterno,
    //             $identidad_row->apellido_materno,
    //             //$relacion_usuario_rol_row->rol_id
    //             null
    //         );

    //         redirect('site/inicio');

    //         $this->load->view("login/index", $data);
    //     }
    // }

    // public function cerrar_sesion()
    // {
    //     $this->session->sess_destroy();
    //     redirect('login');
    // }

    /**
     * Función privada que prepara los datos que el usuario que recién inicia sesión va a requerir
     * mientras se encuentre en ella.
     *
     * @param string $id
     * @param string $identidad_identificador
     * @param string $rol_identificador
     * @param string $correo_electronico
     * @param string $telefono
     * @param string $nombre
     * @param string $apellido_paterno
     * @param string $apellido_materno
     * @param string $rol
     * @return void
     */

    // private function _preparar_datos_sesion($identificador, $identidad_identificador, $rol_identificador, $correo_electronico, $telefono, $nombre, $apellido_paterno, $apellido_materno, $rol)
    // {

    //     if (!isset($apellido_materno)) {
    //         $apellido_materno = null;
    //     }

    //     $sesion_data = array(
    //         'user_identificador' => $identificador,
    //         'user_identidad_identificador' => $identidad_identificador,
    //         'user_rol_identificador' => !empty($rol_identificador) ? $rol_identificador : null,
    //         'user_correo_electronico' => $correo_electronico,
    //         'user_telefono' => $telefono,
    //         'user_nombre' => $nombre,
    //         'user_apellido_paterno' => $apellido_paterno,
    //         'user_apellido_materno' => $apellido_materno,
    //         'user_rol' => $rol,
    //         'user_sistema' => sistema_id(),
    //         'user_en_sesion' => true
    //     );

    //     $this->session->set_userdata($sesion_data);
    // }
}
