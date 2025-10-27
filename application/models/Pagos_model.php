<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pagos_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_pagos()
    {
        $query = $this->db
            ->get('pagos');

        return $query;
    }

    public function obtener_pago_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('pagos');

        return $query;
    }

    public function obtener_pago_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('pagos');

        return $query;
    }

    public function insertar_pago($data)
    {
        $query = $this->db
            ->insert('pagos', $data);

        return $query;
    }

    public function insertar_matriz_pagos($data)
    {
        $query = $this->db
            ->insert_batch('pagos', $data);

        return $query;
    }

    public function actualizar_pago_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('pagos', $data);

        return $query;
    }

    public function actualizar_pago_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('pagos', $data);

        return $query;
    }

    public function eliminar_pago_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->delete('pagos');

        return $query;
    }

    /** Métodos Básicos [Fin] */

    public function obtener_tabla_index()
    {
        $query = $this->db
            ->select("
                t1.*,
                t2.identificador as identificador_inmueble,
                t2.nombre as nombre_inmueble
            ")
            ->from("pagos t1")
            ->join("inmuebles t2", "t2.identificador = t1.inmueble_identificador")
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
            ->from("pagos t1")
            ->order_by('t1.fecha_programada', 'asc')
            ->get();

        return $query;
    }

    public function obtener_tabla_ver_proceso_venta_pagado($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->where('t1.estatus_pago', 'cobrado')
            ->select("
                t1.*,
            ")
            ->from("pagos t1")
            ->order_by('t1.fecha_programada', 'asc')
            ->get();

        return $query;
    }

    public function obtener_pagos_concretados_por_inmueble_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            //->where('t1.estatus_pago', 'cobrado')
            ->select("
                t1.*,
            ")
            ->from("pagos t1")
            ->get();

        return $query;
    }

    public function obtener_pagos_por_cobrar_por_inmueble_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.proceso_venta_identificador', $identificador)
            //->where('t1.estatus_pago', 'cobrado')
            ->select("
                t1.*,
            ")
            ->from("pagos t1")
            ->get();

        return $query;
    }

    public function obtener_apartado_por_inmueble_identificador($identificador){
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->where('t1.concepto', 'Apartado')
            ->select(
                "t1.monto"
            )
            ->from("pagos t1")
            ->get();

        return $query;
    }

    public function obtener_enganche_por_inmueble_identificador($identificador){
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->where('t1.concepto', 'Enganche')
            ->select(
                "t1.monto"
            )
            ->from("pagos t1")
            ->get();

        return $query;
    }

    public function actualizar_ultimo_pago_por_identificador($identificador, $data, $contador)
    {
        $query = $this->db
            ->where('inmueble_identificador', $identificador)
            ->where('id', $contador)
            ->update('pagos', $data);

        return $query;
    }

    public function obtener_inmueble_identificador_por_pago_identificador($pago_identificador)
    {
        $query = $this->db
            ->where('identificador', $pago_identificador)
            ->select("t1.*")
            ->from("pagos t1")
            ->get();

        return $query;
    }
}
