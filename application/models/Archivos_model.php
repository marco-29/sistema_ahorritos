<?php defined('BASEPATH') or exit('No direct script access allowed');

class archivos_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_archivos()
    {
        $query = $this->db
            ->get('archivos');

        return $query;
    }

    public function obtener_archivo_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('archivos');

        return $query;
    }

    public function obtener_archivo_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('archivos');

        return $query;
    }

    public function insertar_archivo($data)
    {
        $query = $this->db
            ->insert('archivos', $data);

        return $query;
    }

    public function insertar_matriz_archivos($data)
    {
        $query = $this->db
            ->insert_batch('archivos', $data);

        return $query;
    }

    public function actualizar_archivo_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('archivos', $data);

        return $query;
    }

    public function actualizar_archivo_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('archivos', $data);

        return $query;
    }

    public function eliminar_archivo_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->delete('archivos');

        return $query;
    }
    /** Métodos Básicos [Fin] */

    function obtener_archivos_proceso_venta($modulo_origen, $identificador_origen)
    {
        $query = $this->db
            ->where('modulo_origen', $modulo_origen)
            ->where('identificador_origen', $identificador_origen)
            ->get('archivos');

        return $query;
    }

    function obtener_archivo_por_origen_tipo_etapa($modulo_origen, $identificador_origen, $tipo, $etapa)
    {
        $query = $this->db
            ->where('modulo_origen', $modulo_origen)
            ->where('identificador_origen', $identificador_origen)
            ->where('tipo', $tipo)
            ->where('etapa', $etapa)
            ->get('archivos');

        return $query;
    }
}
