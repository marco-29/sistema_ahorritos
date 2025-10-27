<?php defined('BASEPATH') or exit('No direct script access allowed');

class Inicio_model extends CI_Model
{

    public function obtener_total_clientes()
    {
        $query = $this->db
            ->from('clientes')
            ->count_all_results();

        return $query;
    }

    public function obtener_total_clientes_prospectos()
    {
        $query = $this->db
            ->where('estatus_cliente', 'prospecto')
            ->from('clientes')
            ->count_all_results();

        return $query;
    }

    public function obtener_total_clientes_compradores()
    {
        $query = $this->db
            ->where('estatus_cliente', 'comprador')
            ->from('clientes')
            ->count_all_results();

        return $query;
    }

    public function obtener_total_inmuebles()
    {
        $query = $this->db
            ->from('inmuebles')
            ->count_all_results();

        return $query;
    }

    public function obtener_total_inmuebles_en_proceso()
    {
        $query = $this->db
            ->where('estatus_inmueble', 'proceso')
            ->from('inmuebles')
            ->count_all_results();

        return $query;
    }

    public function obtener_clientes()
    {
        $query = $this->db
            ->from('clientes')
            ->get();

        return $query;
    }

    public function actualizar_cliente_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('clientes', $data);

        return $query;
    }
}
