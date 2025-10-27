<?php defined('BASEPATH') or exit('No direct script access allowed');

class Inmuebles_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_inmuebles()
    {
        $query = $this->db
            ->get('inmuebles');

        return $query;
    }

    public function obtener_desarrollos()
    {
        $query = $this->db
            ->where('t1.tipo_inmueble', 'desarrollo')
            ->select('t1.*')
            ->from('inmuebles t1')
            ->get();

        return $query;
    }

    public function obtener_inmueble_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('inmuebles');

        return $query;
    }

    public function obtener_inmueble_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('inmuebles');

        return $query;
    }

    public function obtener_desarrollo_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('inmuebles');

        return $query;
    }

    public function obtener_inmuebles_hijos_por_identificador($inmueble_hijo_identificador)
    {
        $query = $this->db
            ->where('identificador', $inmueble_hijo_identificador)
            ->get('inmuebles');

        return $query;
    }

    public function insertar_inmueble($data)
    {
        $query = $this->db
            ->insert('inmuebles', $data);

        return $query;
    }

    public function insertar_matriz_inmuebles($data)
    {
        $query = $this->db
            ->insert_batch('inmuebles', $data);

        return $query;
    }

    public function actualizar_inmueble_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('inmuebles', $data);

        return $query;
    }

    public function actualizar_inmueble_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('inmuebles', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

    public function obtener_catalogo_index($tipo_inmueble)
    {
        $this->db
            ->select("t1.*")
            ->from("inmuebles t1")
            ->order_by('t1.nombre', 'ASC')
            ->join("rel_inmuebles t2", "t2.inmueble_hijo_identificador = t1.identificador", "left");

        if ($tipo_inmueble) {
            $this->db->where('t1.tipo_inmueble', $tipo_inmueble);
            //$this->db->where('t2.inmueble_hijo_identificador IS NULL', null, false);
        }

        $query = $this->db->get();

        return $query;
    }

    public function obtener_inmuebles_por_desarrollo($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->select("
                    t1.*,
                ")
            ->from("inmuebles t1")
            ->join("rel_inmuebles t2", "t2.inmueble_hijo_identificador = t1.identificador")
            ->get();
        return $query;
    }

    function obtener_inmuebles_tipo_desarrollo()
    {
        $query = $this->db
            ->where('t1.tipo_inmueble', 'desarrollo')
            ->select("t1.*")
            ->from("inmuebles t1")
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
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->order_by('t2.inmueble_hijo_identificador', 'asc')
            ->get();

        return $query;
    }

    public function obtener_cantidad_inmuebles_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_inmuebles_disponibles_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where('t1.estatus_inmueble', 'disponible')
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_inmuebles_en_proceso_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where('t1.estatus_inmueble', 'proceso')
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_inmuebles_vendidos_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where('t1.estatus_inmueble', 'vendido')
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_cantidad_inmuebles_apartados_o_reservados_por_desarrollo_identificador($identificador)
    {
        $query = $this->db
            ->where('t2.inmueble_nodo_identificador', $identificador)
            ->where_in('t1.estatus_inmueble', array('apartado', 'reservado'))
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador')
            ->count_all_results();

        return $query;
    }

    public function obtener_desarrollo_por_identificador_hijo($identificador)
    {
        $query = $this->db
            ->where('t1.inmueble_hijo_identificador', $identificador)
            ->select('t1.inmueble_nodo_identificador, t2.*')
            ->from('rel_inmuebles t1')
            ->join('inmuebles t2', 't2.identificador = t1.inmueble_nodo_identificador')
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
            ->from("inmuebles t1")
            ->join("rel_inmuebles t2", "t2.inmueble_hijo_identificador = t1.identificador")
            ->join('inmuebles t3', 't3.identificador = t2.inmueble_nodo_identificador')
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
            ->from('inmuebles t1')
            ->join('rel_inmuebles t2', 't2.inmueble_hijo_identificador = t1.identificador', 'left')
            ->join('inmuebles t3', 't3.identificador = t2.inmueble_nodo_identificador', 'left')
            ->get();

        return $query;
    }

    public function obtener_inmueble_por_identificador_sin_proceso_venta()
    {
        $query = $this->db
            ->where('estatus_inmueble', 'disponible')
            ->get('inmuebles');

        return $query;
    }
}
