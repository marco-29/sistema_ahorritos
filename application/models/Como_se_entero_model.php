<?php defined('BASEPATH') or exit('No direct script access allowed');

class Como_se_entero_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_como_se_entero()
    {
        $query = $this->db
            ->get('como_se_entero');

        return $query;
    }

    public function obtener_como_se_entero_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('como_se_entero');

        return $query;
    }

    public function obtener_como_se_entero_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('como_se_entero');

        return $query;
    }

    public function insertar_como_se_entero($data)
    {
        $query = $this->db
            ->insert('como_se_entero', $data);

        return $query;
    }

    public function actualizar_como_se_entero_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('como_se_entero', $data);

        return $query;
    }

    public function actualizar_como_se_entero_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('como_se_entero', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */
}
