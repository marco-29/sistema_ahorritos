<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Identidades_model extends CI_Model {

    /** Métodos Básicos [Inicio] */
    public function get_identidades() {
        $query = $this->db
            ->get('identidades');

        return $query;
    }

    public function get_identidad_por_id($id) {
        $query = $this->db
            ->where('id', intval($id))
            ->get('identidades');
        
        return $query;
    }

    public function insert_identidad($data) {
        $query = $this->db
            ->insert('identidades', $data);

        return $query;
    }

    public function insert_matriz_identidades($data) {
        $query = $this->db
            ->insert_batch('identidades', $data);

        return $query;
    }

    public function update_identidad($id, $data) {
        $query = $this->db
            ->where('id', $id)
            ->update('identidades', $data);

        return $query;
    }

    public function actualizar_identidad_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('identidades', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

	public function obtener_identidad_por_identificador_para_login($identificador) {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('identidades');
        
        return $query;
    }
}
