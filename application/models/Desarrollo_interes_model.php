<?php defined('BASEPATH') or exit('No direct script access allowed');

class Desarrollo_interes_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_desarrollo_interes()
    {
        $query = $this->db
            ->order_by('nombre', 'asc')
            ->get('desarrollos_interes');

        return $query;
    }

    public function obtener_desarrollos()
    {
        $query = $this->db
            ->where('t1.tipo_inmueble', 'desarrollo')
            ->select('t1.*')
            ->from('desarrollos_interes t1')
            ->get();

        return $query;
    }

    public function obtener_inmueble_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('desarrollos_interes');

        return $query;
    }

    public function obtener_inmueble_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('desarrollos_interes');

        return $query;
    }

    public function obtener_desarrollo_interes_hijos_por_identificador($inmueble_hijo_identificador)
    {
        $query = $this->db
            ->where('identificador', $inmueble_hijo_identificador)
            ->get('desarrollos_interes');

        return $query;
    }

    public function insertar_desarrollo_interes($data)
    {
        $query = $this->db
            ->insert('desarrollos_interes', $data);

        return $query;
    }

    public function insertar_matriz_desarrollo_interes($data)
    {
        $query = $this->db
            ->insert_batch('desarrollos_interes', $data);

        return $query;
    }

    public function actualizar_inmueble_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('desarrollos_interes', $data);

        return $query;
    }

    public function actualizar_inmueble_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('desarrollos_interes', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

    public function obtener_catalogo_index($tipo_inmueble)
    {
        $this->db
            ->select("t1.*")
            ->from("desarrollos_interes t1")
            ->order_by('t1.nombre', 'ASC')
            ->join("rel_desarrollo_interes t2", "t2.inmueble_hijo_identificador = t1.identificador", "left");

        if ($tipo_inmueble) {
            $this->db->where('t1.tipo_inmueble', $tipo_inmueble);
            //$this->db->where('t2.inmueble_hijo_identificador IS NULL', null, false);
        }

        $query = $this->db->get();

        return $query;
    }

    public function obtener_desarrollo_interes_por_desarrollo($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->select("
                    t1.*,
                ")
            ->from("desarrollos_interes t1")
            ->join("rel_desarrollo_interes t2", "t2.inmueble_hijo_identificador = t1.identificador")
            ->get();
        return $query;
    }

    function obtener_desarrollo_interes_tipo_desarrollo()
    {
        $query = $this->db
            ->where('t1.tipo_inmueble', 'desarrollo')
            ->select("t1.*")
            ->from("desarrollos_interes t1")
            ->order_by('t1.nombre', 'ASC')
            ->get();

        return $query;
    }

    public function obtener_valor_total_inmueble_nodo($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->select('
                SUM(t1.precio) as suma_precio
            ')
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->order_by('t2.inmueble_hijo_identificador', 'asc')
            ->get();

        return $query;
    }

    public function obtener_cantidad_desarrollo_interes_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_desarrollo_interes_disponibles_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where('t1.estatus_inmueble', 'disponible')
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_desarrollo_interes_en_proceso_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where('t1.estatus_inmueble', 'proceso')
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_desarrollo_interes_vendidos_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where('t1.estatus_inmueble', 'vendido')
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_desarrollo_interes_apartados_o_reservados_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where_in('t1.estatus_inmueble', array('apartado', 'reservado'))
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_desarrollo_por_identificador_hijo($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_hijo_identificador', $identificador)
            ->select('t1.inmueble_nodo_identificador, t2.*')
            ->from('rel_desarrollo_interes t1')
            ->join('desarrollos_interes t2', 't2.identificador = t1.inmueble_nodo_identificador')
            ->get();

        return $query;
    }

    public function obtener_detalles_inmueble_y_desarrollo($identificador)
    {
        $query = $this->db
            ->where('t1.identificador', $identificador)
            ->select("
                t1.*,
                t3.nombre as desarrollo_nombre
            ")
            ->from("desarrollos_interes t1")
            ->join("rel_desarrollo_interes t2", "t2.inmueble_hijo_identificador = t1.identificador")
            ->join('desarrollos_interes t3', 't3.identificador = t2.inmueble_nodo_identificador')
            ->get();

        return $query;
    }

    public function obtener_inmueble_y_desarrollo()
    {
        $query = $this->db
            ->select("
                t1.*,
                t3.nombre as desarrollo_nombre
            ")
            ->from('desarrollos_interes t1')
            ->join('rel_desarrollo_interes t2', 't2.inmueble_hijo_identificador = t1.identificador', 'left')
            ->join('desarrollos_interes t3', 't3.identificador = t2.inmueble_nodo_identificador', 'left')
            ->get();

        return $query;
    }

    public function obtener_inmueble_por_identificador_sin_proceso_venta()
    {
        $query = $this->db
            ->where('estatus_inmueble', 'disponible')
            ->get('desarrollos_interes');

        return $query;
    }
}
