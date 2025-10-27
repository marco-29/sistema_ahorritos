<?php defined('BASEPATH') or exit('No direct script access allowed');

class Procesos_venta_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_procesos_venta()
    {
        $query = $this->db
            ->get('procesos_venta');

        return $query;
    }

    public function obtener_proceso_venta_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('procesos_venta');

        return $query;
    }

    public function obtener_proceso_venta_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('procesos_venta');

        return $query;
    }

    public function insertar_proceso_venta($data)
    {
        $query = $this->db
            ->insert('procesos_venta', $data);

        return $query;
    }

    public function insertar_matriz_procesos_venta($data)
    {
        $query = $this->db
            ->insert_batch('procesos_venta', $data);

        return $query;
    }

    public function actualizar_proceso_venta_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('procesos_venta', $data);

        return $query;
    }

    public function actualizar_proceso_venta_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('procesos_venta', $data);

        return $query;
    }

    public function actualizar_proceso_venta_por_inmueble_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('inmueble_identificador', $identificador)
            ->update('procesos_venta', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */
    public function obtener_cliente_por_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->select('t2.*')
            ->from('procesos_venta t1')
            ->join('clientes t2', 't2.identificador = t1.cliente_identificador')
            ->get();

        return $query;
    }

    public function obtener_tabla_index()
    {
        $query = $this->db
            ->select("
                t1.*,
                t4.nombre as inmuebles_nodo_nombre,
                t2.nombre as inmuebles_nombre,
                t2.tipo_inmueble as inmuebles_tipo_inmueble,
                t2.tamanho_total as inmuebles_tamanho_total
            ")
            ->from("procesos_venta t1")
            ->join("inmuebles t2", "t2.identificador = t1.inmueble_identificador")
            ->join("rel_inmuebles t3", "t3.inmueble_hijo_identificador = t1.inmueble_identificador")
            ->join("inmuebles t4", "t4.identificador = t3.inmueble_nodo_identificador")

            ->order_by('t1.id', 'asc')
            ->get();

        return $query;
    }

    public function obtener_procesos_venta_por_inmueble_identificador($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_identificador', $identificador)
            ->where('t1.estatus', 'activo')
            ->select("
                t1.*,
                t4.nombre as inmuebles_nodo_nombre,
                t2.nombre as inmuebles_nombre,
                t2.tipo_inmueble as inmuebles_tipo_inmueble,
                t2.tamanho_total as inmuebles_tamanho_total,
                t2.etapa as inmuebles_etapa
            ")
            ->from("procesos_venta t1")
            ->join("inmuebles t2", "t2.identificador = t1.inmueble_identificador")
            ->join("rel_inmuebles t3", "t3.inmueble_hijo_identificador = t1.inmueble_identificador")
            ->join("inmuebles t4", "t4.identificador = t3.inmueble_nodo_identificador")
            ->order_by('t1.fecha_inicio', 'desc')
            ->get();

        return $query;
    }

    public function obtener_resultados_por_procesos_de_venta_por_inmueble_nodo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->select('
                SUM(precio_venta) as suma_precio_venta,
                SUM(pagado) as suma_pagado,
                SUM(no_pagos) as suma_no_pagos,
                SUM(no_pagos_concretados) as suma_no_pagos_concretados
            ')
            ->from("procesos_venta t1")
            ->join("rel_inmuebles t2", "t2.inmueble_hijo_identificador = t1.inmueble_identificador")
            ->order_by('t1.inmueble_identificador', 'asc')
            ->get();

        return $query;
    }

    public function obtener_datos_cliente_para_facturacion_por_identificador($identificador_cliente){
        $query = $this->db
            ->where('t1.cliente_identificador', $identificador_cliente)
            ->where('t1.estatus', 'activo')
            ->select("
                t1.*,
                t2.*
            ")
            ->from("procesos_venta t1")
            ->join("clientes t2", "t2.identificador = t1.cliente_identificador")
            ->get();

        return $query;
    }
}
