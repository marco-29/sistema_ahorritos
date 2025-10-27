<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pagos_caja_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_pagos_caja()
    {
        $query = $this->db
            ->get('pagos_caja');

        return $query;
    }

    public function obtener_pago_caja_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('pagos_caja');

        return $query;
    }

    public function obtener_pago_caja_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('pagos_caja');

        return $query;
    }

    public function insertar_pago_caja($data)
    {
        $query = $this->db
            ->insert('pagos_caja', $data);

        return $query;
    }

    public function insertar_matriz_pagos_caja($data)
    {
        $query = $this->db
            ->insert_batch('pagos_caja', $data);

        return $query;
    }

    public function actualizar_pago_caja_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('pagos_caja', $data);

        return $query;
    }

    public function actualizar_pago_caja_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('pagos_caja', $data);

        return $query;
    }

    public function eliminar_pago_caja_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->delete('pagos_caja');

        return $query;
    }

    /** Métodos Básicos [Fin] */

    public function obtener_tabla_index()
    {
        $query = $this->db
            ->select("
                t1.*,
            ")
            ->from("pagos_caja t1")
            ->get();

        return $query;
    }

    public function obtener_tabla_ver_proceso_venta($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->select("
                t1.*,
            ")
            ->from("pagos_caja t1")
            ->order_by('t1.fecha_programada', 'asc')
            ->get();

        return $query;
    }

    public function obtener_pagos_caja_concretados_por_inmueble_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            //->where('t1.estatus_pago', 'cobrado')
            ->select("
                t1.*,
            ")
            ->from("pagos_caja t1")
            ->get();

        return $query;
    }

    public function obtener_apartado_por_inmueble_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->where('t1.concepto', 'Apartado')
            ->select(
                "t1.monto"
            )
            ->from("pagos_caja t1")
            ->get();

        return $query;
    }

    public function obtener_enganche_por_inmueble_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->where('t1.concepto', 'Enganche')
            ->select(
                "t1.monto"
            )
            ->from("pagos_caja t1")
            ->get();

        return $query;
    }
}
