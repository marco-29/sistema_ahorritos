<?php defined('BASEPATH') or exit('No direct script access allowed');

class contratos_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_contratos()
    {
        $query = $this->db
            ->get('contratos');

        return $query;
    }

    public function obtener_contrato_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('contratos');

        return $query;
    }

    public function obtener_contrato_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('contratos');

        return $query;
    }

    public function insertar_contrato($data)
    {
        $query = $this->db
            ->insert('contratos', $data);

        return $query;
    }

    public function insertar_matriz_contratos($data)
    {
        $query = $this->db
            ->insert_batch('contratos', $data);

        return $query;
    }

    public function actualizar_contrato_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('contratos', $data);

        return $query;
    }

    public function actualizar_contrato_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('contratos', $data);

        return $query;
    }

    public function actualizar_contrato_por_contrato_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('proceso_venta_identificador', $identificador)
            ->update('contratos', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

    public function obtener_contrato_por_inmueble_proceso_venta_cliente_identificador($inmueble_identificador, $proceso_venta_identificador, $cliente_identificador)
    {
        $query = $this->db
            ->where('inmueble_identificador', $inmueble_identificador)
            ->where('proceso_venta_identificador', $proceso_venta_identificador)
            ->where('cliente_identificador', $cliente_identificador)
            ->get('contratos');

        return $query;
    }
}
