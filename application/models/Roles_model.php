<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

    /** Métodos Básicos [Inicio] */
    public function obtener_roles() {
        $query = $this->db
            ->get('roles');

        return $query;
    }

    public function obtener_rol_por_id($id) {
        $query = $this->db
            ->where('id', intval($id))
            ->get('roles');
        
        return $query;
    }

    public function insertar_rol($data) {
        $query = $this->db
            ->insert('roles', $data);

        return $query;
    }

    public function insertar_matriz_roles($data) {
        $query = $this->db
            ->insert_batch('roles', $data);

        return $query;
    }

    public function actualizar_rol($id, $data) {
        $query = $this->db
            ->where('id', $id)
            ->update('roles', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */
	
}
