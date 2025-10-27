<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migraciones extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('migraciones_model');
    }

    public function index()
    {
        $data['pagina_titulo'] = 'Migraciones';
        $data['pagina_subtitulo'] = 'Migración de clientes';
        $data['pagina_menu_migraciones'] = true;

        $data['controlador'] = 'site/migraciones';
        $data['regresar_a'] = 'site/migraciones';
        $controlador_js = "site/migraciones/index";

        $data['styles'] = array(
            array('es_rel' => false, 'href' => base_url() . 'app-assets/vendors/css/tables/datatable/datatables.min.css'),
        );

        $data['scripts'] = array(
            array('es_rel' => false, 'src' => base_url() . 'app-assets/vendors/js/tables/datatable/datatables.min.js'),
            array('es_rel' => true, 'src' => '' . $controlador_js . '.js'),
        );

        $this->construir_site_ui('site/migraciones/index', $data);
    }





    public function migrar_usuarios()
    {
        $offset = $this->input->post('offset');
        $limit = 50;

        $excluded_domains = ['fixit.com.mx'];

        $total_records = $this->db->count_all('crm_usuarios');

        $crm_usuarios_list = $this->migraciones_model->obtener_crm_usuarios_con_identidad($limit, $offset, $excluded_domains)->result();

        $data_usuarios = array();
        $data_identidades = array();

        foreach ($crm_usuarios_list as $crm_usuario_value) {
            if (!$this->migraciones_model->usuarios_verificar_correo_existente($crm_usuario_value->correo)) {
                $identificador = hash("crc32b", 'usuario-' . microtime(true) . ' - ' . $crm_usuario_value->id);

                $data_usuarios[] = array(
                    'identificador' => $identificador,
                    'identidad_identificador' => $identificador,
                    'correo_electronico' => $crm_usuario_value->correo,
                    'telefono' => !empty($crm_usuario_value->identidades_no_celular) ? preg_replace('/\D/', '', trim($crm_usuario_value->identidades_no_celular)) : null,
                    'contrasenha' => $crm_usuario_value->contrasena,
                    'token' => null,
                    'valido_email' => 'si',
                    'valido_telefono' => 'si',
                    'estatus' => mb_strtolower($crm_usuario_value->estatus),
                    'fecha_registro' => $crm_usuario_value->fecha_registro,
                    'fecha_actualizacion' => $crm_usuario_value->fecha_registro
                );

                $data_identidades[] = array(
                    'identificador' => $identificador,
                    'usuario_identificador' => $identificador,
                    'nombre' => !empty($crm_usuario_value->identidades_nombre) ? trim(mb_strtolower($crm_usuario_value->identidades_nombre)) : null,
                    'apellido_paterno' => !empty($crm_usuario_value->identidades_apellidos) ? trim(mb_strtolower($crm_usuario_value->identidades_apellidos)) : null,
                    'apellido_materno' => null,
                    'fecha_registro' => $crm_usuario_value->fecha_registro,
                    'fecha_actualizacion' => $crm_usuario_value->fecha_registro
                );
            }
        }

        $usuarios_insert = $this->migraciones_model->insertar_matriz_usuarios($data_usuarios);
        $identidades_insert = $this->migraciones_model->insertar_matriz_identidades($data_identidades);

        $new_offset = $offset + $limit;
        $finished = ($new_offset >= $total_records) ? true : false;

        echo json_encode(array(
            'finished' => $finished,
            'new_offset' => $new_offset,
            'progress' => min(100, round(($new_offset / $total_records) * 100, 2)),
            'data_processed' => $crm_usuarios_list
        ));
    }













    public function migrar_datos()
    {
        $offset = $this->input->post('offset');
        $limit = 150; // Cambiado de progreso

        // Obtener el total de registros
        $total_records = $this->db->count_all('crm_clientes');
        // $total_records = 30;

        // Obtener el lote de registros
        $crm_clientes_list = $this->migraciones_model->obtener_crm_clientes($limit, $offset)->result();

        $desarrollos_interes_list = $this->migraciones_model->desarrollos_interes_obtener_todos()->result();

        // Procesar los registros obtenidos
        $data_migracion = array();

        foreach ($crm_clientes_list as $crm_cliente_value) {
            $identificador = hash("crc32b", 'clientes-' . microtime(true) . ' - ' . $crm_cliente_value->id);

            // Obtener el identificador del asesor basado en el correo
            $asesor_identificador = $this->migraciones_model->usuarios_obtener_identificador_por_correo($crm_cliente_value->crm_usuarios_correo);

            // Inicializar el identificador del desarrollo de interés
            $desarrollo_interes_identificador = '228e218f';

            // Buscar el desarrollo de interés en la lista obtenida
            foreach ($desarrollos_interes_list as $desarrollo_interes_value) {
                if (stripos($crm_cliente_value->desarrollo, $desarrollo_interes_value->nombre) !== false) {
                    $desarrollo_interes_identificador = $desarrollo_interes_value->identificador;
                    break; // Salir del loop una vez que se encuentra la coincidencia
                }
            }

            $bitacora_list = $this->migraciones_model->crm_bitacora_clientes_obtener_bitacora_por_crm_cliente_id($crm_cliente_value->id)->result();

            if ($bitacora_list) {
                $data_notas = array();
                foreach ($bitacora_list as $bitacora_key => $bitacora_value) {
                    $data_notas[] = array(
                        'identificador' => hash("crc32b", 'notas-' . microtime(true) . ' - ' . $bitacora_value->id),
                        'usuario_identificador' => $bitacora_value->usuarios_identificador,
                        'origen_modulo' => 'clientes',
                        'origen_identificador' => $identificador,
                        'nota' => $bitacora_value->comentario,
                        'fecha_registro' => $bitacora_value->fecha_registro
                    );
                }

                $this->migraciones_model->notas_insertar_matriz($data_notas);
            }



            // Verificar si razon_social está presente
            if (!empty($crm_cliente_value->nombre_razon_social)) {
                $nombre = !empty($crm_cliente_value->nombre_razon_social) ? trim(mb_strtolower($crm_cliente_value->nombre_razon_social)) : null;
                $apellido_paterno = null;
                $apellido_materno = null;
                $nombre_representante_legal = (!empty($crm_cliente_value->nombre) ? trim(mb_strtolower($crm_cliente_value->nombre)) : null) . ' ' . (!empty($crm_cliente_value->segundo_nombre) ? trim(mb_strtolower($crm_cliente_value->segundo_nombre)) : null);
                $apellido_representante_legal = (!empty($crm_cliente_value->apellido_paterno) ? trim(mb_strtolower($crm_cliente_value->apellido_paterno)) : null) . ' ' . (!empty($crm_cliente_value->apellido_materno) ? trim(mb_strtolower($crm_cliente_value->apellido_materno)) : null);
                $razon_social = null;
                $persona_fiscal = 'moral';
            } else {
                $nombre = (!empty($crm_cliente_value->nombre) ? trim(mb_strtolower($crm_cliente_value->nombre)) : null) . ' ' . (!empty($crm_cliente_value->segundo_nombre) ? trim(mb_strtolower($crm_cliente_value->segundo_nombre)) : null);
                $apellido_paterno = !empty($crm_cliente_value->apellido_paterno) ? trim(mb_strtolower($crm_cliente_value->apellido_paterno)) : null;
                $apellido_materno = !empty($crm_cliente_value->apellido_materno) ? trim(mb_strtolower($crm_cliente_value->apellido_materno)) : null;
                $nombre_representante_legal = null;
                $apellido_representante_legal = null;
                $razon_social = null;
                $persona_fiscal = 'física';
            }

            $telefono = !empty($crm_cliente_value->no_celular) ? preg_replace('/\D/', '', trim($crm_cliente_value->no_celular)) : null;
            $telefono_casa = !empty($crm_cliente_value->no_casa) ? preg_replace('/\D/', '', trim($crm_cliente_value->no_casa)) : null;
            $telefono_trabajo = !empty($crm_cliente_value->no_oficina) ? preg_replace('/\D/', '', trim($crm_cliente_value->no_oficina)) : null;

            $correo_electronico = !empty($crm_cliente_value->correo) ? trim(mb_strtolower($crm_cliente_value->correo)) : null;
            $estado_civil = !empty($crm_cliente_value->estado_civil) ? trim(mb_strtolower($crm_cliente_value->estado_civil)) : null;

            $como_se_entero = !empty($crm_cliente_value->medio_difusion) ? trim(mb_strtolower($crm_cliente_value->medio_difusion)) : null;
            $metodo_contacto = !empty($crm_cliente_value->medio_contacto) ? trim(mb_strtolower($crm_cliente_value->medio_contacto)) : null;

            // Definir el mapeo de estatus antiguos a nuevos
            $map_estatus = array(
                'prospecto'     => 'prospecto',
                'cliente'       => 'comprador',
                'descartado'    => 'descartado',
                'por descartar' => 'descartar'
            );

            // Obtener el estatus antiguo y convertirlo a minúsculas y sin espacios
            $anterior_estatus_cliente = !empty($crm_cliente_value->estatus) ? trim(mb_strtolower($crm_cliente_value->estatus)) : null;

            // Mapear el estatus antiguo al nuevo
            $estatus_cliente = isset($map_estatus[$anterior_estatus_cliente]) ? $map_estatus[$anterior_estatus_cliente] : null;

            $nivel_interes = !empty($crm_cliente_value->nivel_interes_semanal) ? trim(mb_strtolower($crm_cliente_value->nivel_interes_semanal)) : null;

            $fecha_registro = !empty($crm_cliente_value->fecha_registro) ? $crm_cliente_value->fecha_registro : null;
            $fecha_actualizacion = !empty($crm_cliente_value->fecha_registro) ? $crm_cliente_value->fecha_registro : null;

            $data_migracion[] = array(
                "identificador" => $identificador,
                "asesor_identificador" => $asesor_identificador, // Aquí se asigna el identificador del asesor
                "desarrollo_interes_identificador" => $desarrollo_interes_identificador, // Aquí se asigna el identificador del desarrollo de interés
                "nombre" => $nombre,
                "apellido_paterno" => $apellido_paterno,
                "apellido_materno" => $apellido_materno,
                "razon_social" => null,
                "nombre_representante_legal" => $nombre_representante_legal,
                "apellido_representante_legal" => $apellido_representante_legal,
                "telefono" => $telefono,
                "telefono_casa" => $telefono_casa,
                "telefono_trabajo" => $telefono_trabajo,
                "correo_electronico" => $correo_electronico,
                "fecha_nacimiento" => null,
                "estado_civil" => $estado_civil,
                "curp" => null,
                "ine" => null,
                "rfc" => null,
                "domicilio_fiscal" => null,
                "codigo_postal" => null,
                "regimen_fiscal" => null,
                "uso_cfdi" => null,
                "como_se_entero" => $como_se_entero,
                "metodo_contacto" => $metodo_contacto,
                "estatus_cliente" => $estatus_cliente,
                "nivel_interes" => $nivel_interes,
                "persona_fiscal" => $persona_fiscal,
                "estatus" => "activo",
                'fecha_registro' => $fecha_registro,
                'fecha_actualizacion' => $fecha_actualizacion
            );
        }

        // Insertar los datos procesados en la base de datos
        $this->migraciones_model->insertar_matriz_clientes($data_migracion);

        // Calcular el nuevo offset
        $new_offset = $offset + $limit;

        // Verificar si se ha procesado todo
        $finished = ($new_offset >= $total_records) ? true : false;

        // Responder con JSON incluyendo los datos procesados
        echo json_encode(array(
            'finished' => $finished,
            'new_offset' => $new_offset,
            'progress' => min(100, round(($new_offset / $total_records) * 100, 2)),
            'data_processed' => $data_migracion
        ));
    }
}
