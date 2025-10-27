<?php defined('BASEPATH') or exit('No direct script access allowed');

class Facturas_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_facturas()
    {
        $query = $this->db
            ->get('facturas');

        return $query;
    }

    public function obtener_tabla_ver_facturacion($identificador_inmueble) {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador_inmueble)
            ->select('t1.*')
            ->from('facturas t1')
            ->get();

        return $query;
    }

    public function obtener_factura_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('facturas');

        return $query;
    }

    public function obtener_factura_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('facturas');

        return $query;
    }

    public function insertar_factura($data)
    {
        $query = $this->db
            ->insert('facturas', $data);

        return $query;
    }

    public function insertar_matriz_facturas($data)
    {
        $query = $this->db
            ->insert_batch('facturas', $data);

        return $query;
    }

    public function actualizar_factura_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('facturas', $data);

        return $query;
    }

    public function actualizar_factura_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('facturas', $data);

        return $query;
    }

    public function eliminar_factura_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->delete('facturas');

        return $query;
    }

    /** Métodos Básicos [Fin] */

    public function obtener_factura_por_pago_identificador_concepto($pago_identificador, $concepto) {
        $query = $this->db
            ->where('pago_identificador', $pago_identificador)
            ->where('concepto', $concepto)
            ->get('facturas');
        return $query;
    }
}
