<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migraciones_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function obtener_crm_clientes($limit = 1000, $offset = 0)
    {
        $this->db->select('
            t1.*,
            t2.correo as crm_usuarios_correo
        ');
        $this->db->from('crm_clientes t1');
        $this->db->join('crm_usuarios t2', 't2.id = t1.asesor_id');
        $this->db->order_by('t1.id', 'asc');
        $this->db->limit($limit, $offset);

        return $this->db->get();
    }

    public function obtener_clientes($limit = 1000, $offset = 0)
    {
        return $this->db->order_by('id', 'asc')->limit($limit, $offset)->get('clientes');
    }

    public function insertar_matriz_clientes($data)
    {
        if (!empty($data)) {
            return $this->db->insert_batch('clientes', $data);
        } else {
            return false;
        }
    }




    public function obtener_crm_usuarios_con_identidad($limit = 1000, $offset = 0, $excluded_domains = [])
    {
        $this->db->select('
            t1.*,
            t2.id as identidades_id,
            t2.nombre as identidades_nombre,
            t2.apellidos as identidades_apellidos,
            t2.no_celular as identidades_no_celular,
            t2.notificaciones_activas as identidades_notificaciones_activas,
            t2.notificaciones_correo as identidades_notificaciones_correo,
            t2.notificaciones_horario_entrega as identidades_notificaciones_horario_entrega,
            t2.notificaciones_ultima_entrega as identidades_ultima_entrega,
            t2.inicios_de_sesion as identidades_inicios_de_sesion,
            t2.ultima_fecha_que_inicio as identidades_ultima_fecha_que_inicio,
            t2.fecha_registro as identidades_fecha_registro,
        ');
        $this->db->from('crm_usuarios t1');
        $this->db->join('crm_identidad t2', 't2.id = t1.identidad_id');

        if (!empty($excluded_domains)) {
            foreach ($excluded_domains as $domain) {
                $this->db->not_like('t1.correo', '@' . $domain);
            }
        }

        $this->db->order_by('t1.id', 'asc');
        $this->db->limit($limit, $offset);

        return $this->db->get();
    }

    public function usuarios_verificar_correo_existente($correo)
    {
        $this->db->select('id');
        $this->db->from('usuarios');
        $this->db->where('correo_electronico', $correo);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true; // El correo ya existe
        } else {
            return false; // El correo no existe
        }
    }

    public function usuarios_obtener_identificador_por_correo($correo)
    {
        $this->db->select('identificador');
        $this->db->from('usuarios');
        $this->db->where('correo_electronico', $correo);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->identificador;
        } else {
            return null; // Si no se encuentra el correo, retorna null
        }
    }

    public function insertar_matriz_usuarios($data)
    {
        if (!empty($data)) {
            return $this->db->insert_batch('usuarios', $data);
        } else {
            return false;
        }
    }

    public function insertar_matriz_identidades($data)
    {
        if (!empty($data)) {
            return $this->db->insert_batch('identidades', $data);
        } else {
            return false;
        }
    }

    public function crm_bitacora_clientes_obtener_bitacora_por_crm_cliente_id($crm_cliente_id)
    {
        $this->db->select('
            t1.*,
            t3.identificador as usuarios_identificador
        ');
        $this->db->from('crm_bitacora_clientes t1');
        $this->db->join('crm_usuarios t2', 't2.id = t1.creado_por_id');
        $this->db->join('usuarios t3', 't3.correo_electronico = t2.correo');
        $this->db->where('t1.cliente_id', $crm_cliente_id);

        return $this->db->get();
    }

    public function notas_insertar_matriz($data)
    {
        if (!empty($data)) {
            return $this->db->insert_batch('notas', $data);
        } else {
            return false;
        }
    }







    public function desarrollos_interes_obtener_todos()
    {
        return $this->db->get('desarrollos_interes');
    }
}
