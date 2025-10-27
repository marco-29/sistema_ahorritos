<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rel_inmuebles_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_rel_inmuebles()
    {
        $query = $this->db
            ->get('rel_inmuebles');

        return $query;
    }

    public function obtener_rel_inmueble_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('rel_inmuebles');

        return $query;
    }

    public function obtener_rel_inmueble_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('rel_inmuebles');

        return $query;
    }

    public function obtener_desarrollo_identificador_por_inmueble_hijo_iedntificador($identificador)
    {
        $query = $this->db
            ->where('inmueble_hijo_identificador', $identificador)
            ->get('rel_inmuebles');

        return $query;
    }

    public function insertar_rel_inmueble($data)
    {
        $query = $this->db
            ->insert('rel_inmuebles', $data);

        return $query;
    }

    public function insertar_matriz_rel_inmuebles($data)
    {
        $query = $this->db
            ->insert_batch('rel_inmuebles', $data);

        return $query;
    }

    public function actualizar_rel_inmueble_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('rel_inmuebles', $data);

        return $query;
    }

    public function actualizar_rel_inmueble_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('rel_inmuebles', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */
}
