<?php defined('BASEPATH') or exit('No direct script access allowed');

class Notas_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_notas()
    {
        $query = $this->db
            ->get('notas');

        return $query;
    }

    public function obtener_nota_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('notas');

        return $query;
    }

    public function obtener_nota_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('notas');

        return $query;
    }

    public function insertar_nota($data)
    {
        $query = $this->db
            ->insert('notas', $data);

        return $query;
    }

    public function insertar_matriz_notas($data)
    {
        $query = $this->db
            ->insert_batch('notas', $data);

        return $query;
    }

    public function actualizar_nota_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->update('notas', $data);

        return $query;
    }

    public function actualizar_nota_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('notas', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

    public function obtener_notas_por_origen_identificador($identificador)
    {
        $query = $this->db
            ->where('origen_identificador', $identificador)
            ->get('notas');

        return $query;
    }

    public function obtener_notas_por_origen_identificador_y_detalles($identificador)
    {
        $query = $this->db
            ->where('t1.origen_identificador', $identificador)
            ->select("
                t1.*,
                t2.correo_electronico as usuarios_correo_electronico
            ")
            ->from("notas t1")
            ->join("usuarios t2", "t2.identificador = t1.usuario_identificador")
            ->order_by("t1.fecha_registro DESC")
            ->get();

        return $query;
    }

    public function obtener_notas_con_usuario()
    {
        $query = $this->db
            ->select("
                t1.*,
                TRIM(CONCAT(COALESCE(t2.nombre, ''), ' ', COALESCE(t2.apellido_paterno, ''), ' ', COALESCE(t2.apellido_materno, ''))) as identidad_nombre_completo 
                ")
            ->from("notas t1")
            ->join("identidades t2", "t2.usuario_identificador = t1.usuario_identificador")
            ->get();

        return $query;
    }

    public function eliminar_nota_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', strval($identificador))
            ->delete('notas');

        return $query;
    }
}
