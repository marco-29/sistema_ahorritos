<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    /** Métodos Básicos [Inicio] */
    public function get_usuarios() {
        $query = $this->db
            ->get('usuarios');

        return $query;
    }

    public function get_usuario_por_id($id) {
        $query = $this->db
            ->where('id', intval($id))
            ->get('usuarios');
        
        return $query;
    }

    public function insert_usuario($data) {
        $query = $this->db
            ->insert('usuarios', $data);

        return $query;
    }

    public function insert_matriz_usuarios($data) {
        $query = $this->db
            ->insert_batch('usuarios', $data);

        return $query;
    }

    public function update_usuario($id, $data) {
        $query = $this->db
            ->where('id', $id)
            ->update('usuarios', $data);

        return $query;
    }

    public function update_contrasenha($identificador, $data) {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('usuarios', $data);

        return $query;
    }

    public function actualizar_usuario_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('usuarios', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

    public function obtener_usuarios_activos() {
        $query = $this->db
            ->where('estatus', 'activo')
            ->get('usuarios');
        
        return $query;
    }

    public function obtener_usuarios_activos_con_detalles() {
        $query = $this->db
            ->where('estatus', 'activo')
            ->select("
                t1.*,
                TRIM(CONCAT(COALESCE(t2.nombre, ''), ' ', COALESCE(t2.apellido_paterno, ''), ' ', COALESCE(t2.apellido_materno, ''))) as identidad_nombre_completo,
            ")
            ->from("usuarios t1")
            ->join("identidades t2", "t1.identidad_identificador = t2.identificador")
            ->order_by('identidad_nombre_completo', 'asc')
            ->get();
        
        return $query;
    }

    public function obtener_tabla_index() {
        $query = $this->db
        ->select("
            t1.*,
            TRIM(CONCAT(COALESCE(t2.nombre, ''), ' ', COALESCE(t2.apellido_paterno, ''), ' ', COALESCE(t2.apellido_materno, ''))) as identidad_nombre_completo,
        ")
        ->from("usuarios t1")
        ->join("identidades t2", "t1.identidad_identificador = t2.identificador")
        ->get();

        return $query;
    }

    public function obtener_usuario_por_correo_electronico_o_telefono($usuario) {   
        return $this->db->query('SELECT * FROM `usuarios` WHERE BINARY `correo_electronico` = '.$usuario.' OR `telefono` = '.$usuario);
    }

	public function obtener_para_proyectos_ver($identificador, $proyecto_identificador) {
        $query = $this->db
            ->where_in('t1.identificador', $identificador)
            ->where('t3.proyecto_identificador', $proyecto_identificador)
			->select("
				t1.identificador as identificador,
				t1.correo_electronico as correo_electronico,
				t1.telefono as telefono,
				TRIM(CONCAT(COALESCE(t2.nombre, ''), ' ', COALESCE(t2.apellido_paterno, ''), ' ', COALESCE(t2.apellido_materno, ''))) as identidad_nombre_completo,
                t3.creo_proyecto as rel_proyectos_usuarios_creo_proyecto,
                t3.usuario_permisos as rel_proyectos_usuarios_permisos
			")
			->from("usuarios t1")
			->join("identidades t2", "t2.identificador = t1.identidad_identificador")
			->join("rel_proyectos_usuarios t3", "t3.usuario_identificador = t1.identificador")
			->get();
        
        return $query;
    }

    public function obtener_usuario_por_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.identificador', $identificador)
            ->select("
                t1.*,
                t2.nombre,
                t2.apellido_paterno,
                t2.apellido_materno,
                TRIM(CONCAT(COALESCE(t2.nombre, ''), ' ', COALESCE(t2.apellido_paterno, ''), ' ', COALESCE(t2.apellido_materno, ''))) as identidad_nombre_completo,
            ")
            ->from("usuarios t1")
            ->join("identidades t2", "t1.identidad_identificador = t2.identificador")
            ->get();

        return $query;
    }
}
