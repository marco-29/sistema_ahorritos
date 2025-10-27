<?php defined('BASEPATH') or exit('No direct script access allowed');

class Clientes_model extends CI_Model
{

    /** Métodos Básicos [Inicio] */
    public function obtener_clientes()
    {
        $query = $this->db
            ->get('clientes');

        return $query;
    }

    public function obtener_cliente_por_id($id)
    {
        $query = $this->db
            ->where('id', intval($id))
            ->get('clientes');

        return $query;
    }

    public function cliente_obtener_por_id($id)
    {
        $query = $this->db
            ->where('t1.id', $id)
            ->select("
                t1.*,
                t2.correo_electronico as usuarios_correo_electronico,
                t3.nombre as desarrollos_interes_nombre,
                CONCAT_WS(' ', t1.nombre, t1.apellido_paterno, t1.apellido_materno) as clientes_nombre,
                CONCAT_WS(' ', t1.nombre_representante_legal, t1.apellido_representante_legal) as clientes_nombre_representante_legal,
                ultima_nota.nota as ultima_nota
            ")
            ->from("clientes t1")
            ->join('usuarios t2', 't2.identificador = t1.asesor_identificador', 'left')
            ->join('desarrollos_interes t3', 't3.identificador = t1.desarrollo_interes_identificador', 'left')
            ->join(
                "(SELECT t4.origen_identificador, t4.nota 
                FROM notas t4 
                WHERE t4.fecha_registro = (SELECT MAX(t5.fecha_registro) 
                                   FROM notas t5 
                                   WHERE t5.origen_identificador = t4.origen_identificador)) as ultima_nota",
                'ultima_nota.origen_identificador = t1.identificador',
                'left'
            )
            ->get();

        return $query;
    }

    public function obtener_cliente_por_identificador($identificador)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->get('clientes');

        return $query;
    }

    public function insertar_cliente($data)
    {
        $query = $this->db
            ->insert('clientes', $data);

        return $query;
    }

    public function insertar_matriz_clientes($data)
    {
        $query = $this->db
            ->insert_batch('clientes', $data);

        return $query;
    }

    public function actualizar_cliente_por_id($id, $data)
    {
        $query = $this->db
            ->where('id', $id)
            ->update('clientes', $data);

        return $query;
    }

    public function actualizar_cliente_por_identificador($identificador, $data)
    {
        $query = $this->db
            ->where('identificador', $identificador)
            ->update('clientes', $data);

        return $query;
    }
    /** Métodos Básicos [Fin] */

    private function _aplicar_filtros_y_busqueda($busqueda = '', $filtros = [])
    {
        $this->db->from("clientes t1");
        $this->db->join('usuarios t2', 't2.identificador = t1.asesor_identificador', 'left');
        $this->db->join('desarrollos_interes t3', 't3.identificador = t1.desarrollo_interes_identificador', 'left');
        $this->db->join(
            "(SELECT t4.origen_identificador, t4.nota 
            FROM notas t4 
            WHERE t4.fecha_registro = (SELECT MAX(t5.fecha_registro) 
                               FROM notas t5 
                               WHERE t5.origen_identificador = t4.origen_identificador)) as ultima_nota",
            'ultima_nota.origen_identificador = t1.identificador',
            'left'
        );

        // Aplicar filtros múltiples
        if (!empty($filtros['estatus_cliente'])) {
            $this->db->where_in('t1.estatus_cliente', $filtros['estatus_cliente']);
        }
        if (!empty($filtros['desarrollo_interes'])) {
            $this->db->where_in('t1.desarrollo_interes_identificador', $filtros['desarrollo_interes']);
        }
        if (!empty($filtros['como_se_entero'])) {
            $this->db->where_in('t1.como_se_entero', $filtros['como_se_entero']);
        }
        if (!empty($filtros['asesor'])) {
            $this->db->where_in('t1.asesor_identificador', $filtros['asesor']);
        }
        if (!empty($filtros['interes'])) {
            $this->db->where_in('t1.nivel_interes', $filtros['interes']);
        }
        if (!empty($filtros['medio_contacto'])) {
            $this->db->where_in('t1.metodo_contacto', $filtros['medio_contacto']);
        }

        // Aplicar búsqueda global
        if (!empty($busqueda)) {
            $columns = [
                'CONCAT_WS(" ", t1.nombre, t1.apellido_paterno, t1.apellido_materno)',
                'CONCAT_WS(" ", t1.nombre_representante_legal, t1.apellido_representante_legal)',
                't1.correo_electronico',
                't3.nombre',
                't2.correo_electronico',
                't1.telefono',
                'ultima_nota.nota'
            ];
            $terms = explode(' ', $busqueda);

            $this->db->group_start();
            foreach ($terms as $term) {
                $this->db->group_start();
                foreach ($columns as $column) {
                    $this->db->or_like($column, $term);
                }
                $this->db->group_end();
            }
            $this->db->group_end();
        }

        // Verificar si existe el identificador de rol de usuario en la sesión
        $user_rol_identificador = $this->session->userdata('user_rol_identificador');

        if ($user_rol_identificador) {
            $this->db->where('t1.asesor_identificador', $this->session->userdata('user_identificador'));
        }
    }

    public function obtener_tabla_index($limit, $start, $busqueda = '', $order_columns = [], $filtros = [])
    {
        // Aplicar filtros y búsqueda
        $this->_aplicar_filtros_y_busqueda($busqueda, $filtros);

        // Seleccionar los campos necesarios
        $this->db->select("
            t1.*,
            t2.correo_electronico as usuarios_correo_electronico,
            t3.nombre as desarrollos_interes_nombre,
            CONCAT_WS(' ', t1.nombre, t1.apellido_paterno, t1.apellido_materno) as clientes_nombre,
            CONCAT_WS(' ', t1.nombre_representante_legal, t1.apellido_representante_legal) as clientes_nombre_representante_legal,
            ultima_nota.nota as ultima_nota
        ");

        // Definir columnas para ordenación
        $columns = [
            't1.id',
            'clientes_nombre',
            't3.nombre',
            't1.nivel_interes',
            't1.como_se_entero',
            't1.metodo_contacto',
            't1.correo_electronico',
            't1.telefono',
            'ultima_nota',
            't1.estatus_cliente',
            't1.persona_fiscal',
            'clientes_nombre_representante_legal',
            't1.domicilio_fiscal',
            't1.fecha_nacimiento',
            't1.estado_civil',
            't1.curp',
            't1.ine',
            't1.rfc',
            't1.identificador',
            't2.correo_electronico',
            't1.fecha_registro',
            't1.fecha_actualizacion'
        ];

        // Aplicar ordenación
        if (!empty($order_columns)) {
            foreach ($order_columns as $order_column) {
                $col_idx = $order_column['column'];
                $col_dir = $order_column['dir'];
                if (isset($columns[$col_idx])) {
                    $this->db->order_by($columns[$col_idx - 1], $col_dir);
                }
            }
        } else {
            $this->db->order_by('t1.id', 'asc');
        }

        // Aplicar límite
        if ($limit > 0) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        return $query;
    }

    public function contar_clientes()
    {
        $this->db->from("clientes t1");
        $this->db->join('usuarios t2', 't2.identificador = t1.asesor_identificador', 'left');
        $this->db->join('desarrollos_interes t3', 't3.identificador = t1.desarrollo_interes_identificador', 'left');

        // Verificar si existe el identificador de rol de usuario en la sesión
        $user_rol_identificador = $this->session->userdata('user_rol_identificador');

        if ($user_rol_identificador) {
            $this->db->where('t1.asesor_identificador', $this->session->userdata('user_identificador'));
        }

        return $this->db->count_all_results();
    }

    public function contar_clientes_filtrados($busqueda = '', $filtros = [])
    {
        $this->_aplicar_filtros_y_busqueda($busqueda, $filtros);
        return $this->db->count_all_results();
    }

    public function obtener_opciones_select_clientes()
    {
        $query = $this->db
            ->select("
                t1.*,
                TRIM(BOTH ' ' FROM CONCAT(
                    COALESCE(UCASE(SUBSTRING(t1.nombre, 1, 1)), ''),
                    COALESCE(LCASE(SUBSTRING(t1.nombre, 2)), ''),
                    ' ',
                    COALESCE(UCASE(SUBSTRING(t1.apellido_paterno, 1, 1)), ''),
                    COALESCE(LCASE(SUBSTRING(t1.apellido_paterno, 2)), ''),
                    ' ',
                    COALESCE(UCASE(SUBSTRING(t1.apellido_materno, 1, 1)), ''),
                    COALESCE(LCASE(SUBSTRING(t1.apellido_materno, 2)), ''),
                    ' | ',
                    COALESCE(t1.telefono, ''),
                    ' | ',
                    COALESCE(t1.correo_electronico, ''),
                    ' | #',
                    COALESCE(t1.identificador, '')
                )) AS nombre_completo,
            ")
            ->from("clientes t1")
            ->where('t1.estatus', 'activo')
            ->where_in('t1.estatus_cliente', array('comprador', 'copropietario', 'inquilino', 'socio', 'vendedor', 'prospecto'))
            ->get();

        return $query;
    }

    public function obtener_estatus()
    {
        $query = $this->db
            ->distinct()
            ->select('t1.estatus_cliente')
            ->order_by('estatus_cliente', 'asc')
            ->from('clientes t1')
            ->get()
            ->result();
        return $query;
    }

    public function obtener_desarrollo()
    {
        $query = $this->db
            ->distinct()
            ->select('t1.desarrollo_interes_identificador,
                      t2.nombre as nombre_desarrollo')
            ->order_by('desarrollo_interes_identificador', 'asc')
            ->from('clientes t1')
            ->join('desarrollos_interes t2', 't1.desarrollo_interes_identificador = t2.identificador')
            ->get()
            ->result();
        return $query;
    }

    public function obtener_medio_de_difusion()
    {
        $query = $this->db
            ->distinct()
            ->select('t1.como_se_entero')
            ->order_by('como_se_entero', 'asc')
            ->from('clientes t1')
            ->get()
            ->result();
        return $query;
    }

    public function obtener_asesor()
    {
        $query = $this->db
            ->distinct()
            ->select('t1.asesor_identificador, t2.correo_electronico as asesor')
            ->order_by('t2.correo_electronico', 'asc')
            ->from('clientes t1')
            ->join('usuarios t2', 't1.asesor_identificador = t2.identificador')
            ->get()
            ->result();
        return $query;
    }

    public function verificar_existencia($campo, $valor)
    {
        return $this->db->select("
                    t1.*,
                    CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D')) AS nombre_completo,
                    t2.correo_electronico as usuarios_correo_electronico
                ")
            ->from('clientes t1')
            ->join('usuarios t2', 't2.identificador = t1.asesor_identificador')
            ->where(
                $campo === 'nombre_completo'
                    ? "CASE 
                        WHEN t1.apellido_materno IS NULL OR t1.apellido_materno = '' THEN 
                            CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D')) 
                        ELSE 
                            CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D'), ' ', COALESCE(t1.apellido_materno, 'N/D')) 
                    END ="
                    : 't1.' . $campo,
                $valor
            )
            ->get()
            ->row();
    }

    // public function verificar_cliente_existe($nombre_completo)
    // {
    //     $query = $this->db
    //         ->where("CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D')) =", $nombre_completo)
    //         ->select("CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D'))")
    //         ->from('clientes t1')
    //         ->get();
    //     return $query;
    // }

    public function verificar_cliente_existe($nombre_completo)
    {
        $query = $this->db
            ->where("
            CASE
                WHEN t1.apellido_materno IS NULL OR t1.apellido_materno = '' THEN 
                    CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D')) = '$nombre_completo'
                ELSE 
                    CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D'), ' ', COALESCE(t1.apellido_materno, 'N/D')) = '$nombre_completo'
            END
        ", NULL, FALSE)
            ->select("CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D'), ' ', COALESCE(t1.apellido_materno, 'N/D')) AS nombre_completo")
            ->from('clientes t1')
            ->get();

        return $query;
    }


    public function verificar_telefono_existe($telefono)
    {
        $query = $this->db
            ->where("telefono =", $telefono)
            ->select("CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D'))")
            ->from('clientes t1')
            ->get();
        return $query;
    }

    public function verificar_correo_existe($correo)
    {
        $query = $this->db
            ->where("correo_electronico =", $correo)
            ->select("CONCAT(COALESCE(t1.nombre, 'N/D'), ' ', COALESCE(t1.apellido_paterno, 'N/D'))")
            ->from('clientes t1')
            ->get();
        return $query;
    }
}
