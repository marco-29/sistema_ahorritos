<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {

    public function alerta_sistema($concepto, $concepto2)
    {
    }

    public function suceso_sistema($data_2)
    {
        $query = $this->db
            ->insert('logs', $data_2);

        return $query;
    }

    public function obtener_todos_los_registros()
    {
        return $this->db->order_by("id", "desc")
            ->get('logs');
    }

}