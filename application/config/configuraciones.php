<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Configuraciones generales para el sistema 
|--------------------------------------------------------------------------
| En este archivo se van a definir algunas configuaciones generales y
| específicas en algunos casos, para el sistema; esto para no
| modificar el archivo config.php que trae configuraciones específicase de CI.
|
*/

/** v3.1.13 */

/*
|--------------------------------------------------------------------------
| Configuracion del sistema
|--------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| Base de datos, ¿El sistema o web llevará base de datos?
|--------------------------------------------------------------------------
| En caso de que el sistema o web requiera declarar la variable como TRUE, 
| en caso contrario usar FALSE.
|
*/

$config['db_activa'] = true;

/*
|--------------------------------------------------------------------------
| Identificadores del sistema
|--------------------------------------------------------------------------
| Aquí se configura todo lo que identifica al sistema y branding.
|
*/

$config['sistema_id'] = 'sistema_grupojv';

$config['titulo'] = 'Sistema de gestión inmobiliaria';
$config['nombre_comercial'] = 'Sistema de gestión inmobiliaria';
$config['nombre_fiscal'] = 'Grupo JV';
$config['descripcion'] = 'ERP procesos internos';
$config['palabras_clave'] = 'Administración inmobiliaria';
$config['autor'] = 'jid.agency';

/*
|--------------------------------------------------------------------------
| Redes sociales
|--------------------------------------------------------------------------
| Configurar todos los links externos de redes sociales de la marca.
|
*/

$config['whatsapp'] = null;
$config['facebook'] = null;
$config['instagram'] = null;
$config['linkedin'] = null;
$config['twitter'] = null;

/* ====== Estatus del sistema ====== */

$select_estatus = array(
    (object) array(
        'nombre'    => 'Activo',
        'valor'     => 'activo',
        'activo'    => true,
    ),
    (object) array(
        'nombre'    => 'Suspendido',
        'valor'     => 'suspendido',
        'activo'    => false,
    )
);

$config['select_estatus'] = $select_estatus;

/* ====== tipo_inmueble ====== */

$select_modalidad = array(
    (object) array(
        'nombre'    => 'Venta',
        'valor'     => 'venta',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Renta',
        'valor'     => 'renta',
        'activo'    => false,
    )
);

$config['select_modalidad'] = $select_modalidad;

/* ====== tipo_inmueble ====== */

$select_tipo_inmueble = array(
    (object) array(
        'nombre'    => 'Bodega',
        'valor'     => 'bodega',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Casa',
        'valor'     => 'casa',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Departamento',
        'valor'     => 'departamento',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Desarrollo',
        'valor'     => 'desarrollo',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Fraccionamiento',
        'valor'     => 'fraccionamiento',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Habitación',
        'valor'     => 'habitación',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Local comercial',
        'valor'     => 'local comercial',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Lote',
        'valor'     => 'lote',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Oficina',
        'valor'     => 'oficina',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Terreno',
        'valor'     => 'terreno',
        'activo'    => false,
    )
);

$config['select_tipo_inmueble'] = $select_tipo_inmueble;

/* ====== prototipo ====== */

$select_prototipo = array(
    (object) array(
        'nombre'    => '1',
        'valor'     => '1',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '1+F',
        'valor'     => '1+f',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '2+F',
        'valor'     => '2+f',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '3+F',
        'valor'     => '3+f',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'GH',
        'valor'     => 'gh',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'PH',
        'valor'     => 'ph',
        'activo'    => false,
    ),
);

$config['select_prototipo'] = $select_prototipo;

/* ====== estatus_inmueble ====== */

$select_estatus_inmueble = array(
    (object) array(
        'nombre'    => 'Apartado',
        'valor'     => 'apartado',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Disponible',
        'valor'     => 'disponible',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Proceso',
        'valor'     => 'proceso',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Reservado',
        'valor'     => 'reservado',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Vendido',
        'valor'     => 'vendido',
        'activo'    => false,
    )
);

$config['select_estatus_inmueble'] = $select_estatus_inmueble;
/* ====== estatus_cliente ====== */

$select_estatus_cliente = array(
    (object) array(
        'nombre'    => 'Comprador',
        'valor'     => 'comprador',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Copropietario',
        'valor'     => 'copropietario',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Inquilino',
        'valor'     => 'inquilino',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Socio',
        'valor'     => 'socio',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Vendedor',
        'valor'     => 'vendedor',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Prospecto',
        'valor'     => 'prospecto',
        'activo'    => true,
    ),
    (object) array(
        'nombre'    => 'Descartar',
        'valor'     => 'descartar',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Descartado',
        'valor'     => 'descartado',
        'activo'    => false,
    )
);

$config['select_estatus_cliente'] = $select_estatus_cliente;

/* ====== persona_fiscal ====== */

$select_persona_fiscal = array(
    (object) array(
        'nombre'    => 'Física',
        'valor'     => 'física',
        'activo'    => true,
    ),
    (object) array(
        'nombre'    => 'Moral',
        'valor'     => 'moral',
        'activo'    => false,
    ),
);

$config['select_persona_fiscal'] = $select_persona_fiscal;

/* ====== frecuencia ====== */

$select_frecuencia = array(
    (object) array(
        'nombre'    => 'Único',
        'valor'     => 'único',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Diario',
        'valor'     => 'diario',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Semanal',
        'valor'     => 'semanal',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Mensual',
        'valor'     => 'mensual',
        'activo'    => true,
    ),
    (object) array(
        'nombre'    => 'Bimestral',
        'valor'     => 'bimestral',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Trimestral',
        'valor'     => 'trimestral',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Semestral',
        'valor'     => 'semestral',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Anual',
        'valor'     => 'anual',
        'activo'    => false,
    )
);

$config['select_frecuencia'] = $select_frecuencia;

/* ====== estatus_pago ====== */

$select_estatus_pago = array(
    (object) array(
        'nombre'    => 'Por validar',
        'valor'     => 'por validar',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Cobrado',
        'valor'     => 'cobrado',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Por cobrar',
        'valor'     => 'por cobrar',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Vencido',
        'valor'     => 'vencido',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'No valido',
        'valor'     => 'no valido',
        'activo'    => false,
    )
);

$config['select_estatus_pago'] = $select_estatus_pago;

/* ====== estatus_factura ====== */

$select_estatus_factura = array(
    (object) array(
        'nombre'    => 'Solicitud de factura',
        'valor'     => 'solicitud de factura',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Facturado',
        'valor'     => 'facturado',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Facturado complemento',
        'valor'     => 'facturado complemento',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Solicitud de complemento de pago',
        'valor'     => 'solicitud de complemento de pago',
        'activo'    => false,
    )
);

$config['select_estatus_factura'] = $select_estatus_factura;

/* ====== estado_civil ====== */

$select_estado_civil = array(
    (object) array(
        'nombre'    => 'Soltero',
        'valor'     => 'soltero',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Casado por lo civil',
        'valor'     => 'casado por lo civil',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Divorciado legalmente',
        'valor'     => 'divorciado legalmente',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Separado legalmente',
        'valor'     => 'separado legalmente',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Viudo',
        'valor'     => 'viudo',
        'activo'    => false,
    )
);

$config['select_estado_civil'] = $select_estado_civil;

/* ====== regimen_fiscal ====== */

$select_regimen_fiscal = array(
    (object) array(
        'nombre'    => '605 - Sueldos y Salarios e Ingresos Asimilados a Salarios',
        'valor'     => '605',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '606 - Arrendamiento',
        'valor'     => '606',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '607 - Régimen de Enajenación o Adquisición de Bienes',
        'valor'     => '607',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '608 - Demás ingresos',
        'valor'     => '608',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '610 - Residentes en el Extranjero sin Establecimiento Permanente en México',
        'valor'     => '610',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '611 - Ingresos por Dividendos (socios y accionistas)',
        'valor'     => '611',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '612 - Personas Físicas con Actividades Empresariales y Profesionales',
        'valor'     => '612',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '614 - Ingresos por intereses',
        'valor'     => '614',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '615 - Régimen de los ingresos por obtención de premios',
        'valor'     => '615',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '616 - Sin obligaciones fiscales',
        'valor'     => '616',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '621 - Incorporación Fiscal',
        'valor'     => '621',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '625 - Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas',
        'valor'     => '625',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '626 - Régimen Simplificado de Confianza',
        'valor'     => '626',
        'activo'    => false,
    ),
);

$config['select_regimen_fiscal'] = $select_regimen_fiscal;

/* ====== regimen_fiscal ====== */

$select_regimen_fiscal_moral = array(
    (object) array(
        'nombre'    => '601 - General de Ley Personas Morales',
        'valor'     => '601',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '603 - Personas Morales con Fines no Lucrativos',
        'valor'     => '603',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '610 - Residentes en el Extranjero sin Establecimiento Permanente en México',
        'valor'     => '610',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '620 - Sociedades Cooperativas de Producción que optan por diferir sus ingresos 622 Actividades Agrícolas, Ganaderas,Silvícolas y Pesqueras',
        'valor'     => '620',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '622 - Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras',
        'valor'     => '622',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '623 - Opcional para Grupos de Sociedades',
        'valor'     => '623',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '624 - Coordinados',
        'valor'     => '624',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '626 - Régimen Simplificado de Confianza',
        'valor'     => '626',
        'activo'    => false,
    )
);

$config['select_regimen_fiscal_moral'] = $select_regimen_fiscal_moral;

/* ====== uso_cfdi ====== */

$select_uso_cfdi = array(
    (object) array(
        'nombre'    => 'CN01 - Nómina',
        'valor'     => 'cn01',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'G03 - Gastos en general',
        'valor'     => 'g03',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I01 - Construcciones',
        'valor'     => 'i01',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I02 - Mobiliario y equipo de oficina por inversiones',
        'valor'     => 'i02',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I03 - Equipo de transporte',
        'valor'     => 'i03',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I04 - Equipo de cómputo y accesorios',
        'valor'     => 'i04',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D01 - Honorarios médicos, dentales y gastos hospitalarios',
        'valor'     => 'd01',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D02 - Gastos médicos por incapacidad o discapacidad',
        'valor'     => 'd02',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D03 - Gastos funerales',
        'valor'     => 'd03',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D04 - Donativos',
        'valor'     => 'd04',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D05 - Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)',
        'valor'     => 'd05',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D06 - Aportaciones voluntarias al SAR',
        'valor'     => 'd06',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D07 - Primas por seguros de gastos médicos',
        'valor'     => 'd07',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D08 - Gastos de transportación escolar obligatoria',
        'valor'     => 'd08',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D09 - Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones',
        'valor'     => 'd09',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'D10 - Pagos por servicios educativos (colegiaturas)',
        'valor'     => 'd10',
        'activo'    => false,
    ),
);

$config['select_uso_cfdi'] = $select_uso_cfdi;

$select_uso_cfdi_moral = array(
    (object) array(
        'nombre'    => 'G01 - Adquisición de mercancías',
        'valor'     => 'g01',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'G02 - Devoluciones, descuentos o bonificaciones ',
        'valor'     => 'g02',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'G03 - Gastos en general',
        'valor'     => 'g03',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I01 - Construcciones',
        'valor'     => 'i01',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I02 - Mobiliario y equipo de oficina por inversiones',
        'valor'     => 'i02',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I03 - Equipo de transporte',
        'valor'     => 'i03',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I04 - Equipo de cómputo y accesorios',
        'valor'     => 'i04',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I05 - Dados, troqueles, moldes, matrices y herramental',
        'valor'     => 'i05',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I06 - Comunicaciones telefónicas',
        'valor'     => 'i06',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I07 - Comunicaciones satelitales',
        'valor'     => 'i07',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'I08 - Otra maquinaria y equipo',
        'valor'     => 'i08',
        'activo'    => false,
    ),

    (object) array(
        'nombre'    => 'CP01 - Pagos',
        'valor'     => 'cp01',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'S01 - Sin Efectos Fiscales',
        'valor'     => 's01',
        'activo'    => false,
    ),
);

$config['select_uso_cfdi_moral'] = $select_uso_cfdi_moral;

/* ====== etapa ====== */

$select_etapa = array(
    (object) array(
        'nombre'    => 'Seleccione una opción...',
        'valor'     => '',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '1',
        'valor'     => '1',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '2',
        'valor'     => '2',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '3',
        'valor'     => '3',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '4',
        'valor'     => '4',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '5',
        'valor'     => '5',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '6',
        'valor'     => '6',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '7',
        'valor'     => '7',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '8',
        'valor'     => '8',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '9',
        'valor'     => '9',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => '10',
        'valor'     => '10',
        'activo'    => false,
    ),
);

$config['select_etapa'] = $select_etapa;

/* ====== modulo ====== */

$select_modulo = array(
    (object) array(
        'nombre'    => 'Clientes',
        'valor'     => 'clientes',
        'url'       => 'clientes',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Usuarios',
        'valor'     => 'usuarios',
        'url'       => 'usuarios',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Contratos',
        'valor'     => 'contratos',
        'url'       => 'inmuebles/contrato',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Procesos de ventas',
        'valor'     => 'procesos de venta',
        'url'       => 'procesos_venta',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Inmuebles',
        'valor'     => 'inmuebles',
        'url'       => 'desarrollos',
        'activo'    => false,
    ),
);

$config['select_modulo'] = $select_modulo;

/* ====== proceso_venta ====== */

$select_proceso_venta = array(
    (object) array(
        'nombre'    => 'Seleccione una opción...',
        'valor'     => '',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Inicio de proceso',
        'valor'     => 'inicio_de_proceso',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Datos de contrato',
        'valor'     => 'datos_de_contrato',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Solicitud firma contrato',
        'valor'     => 'solicitud_firma_contrato',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Contrato firmado',
        'valor'     => 'contrato_firmado',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'En proceso pago',
        'valor'     => 'en_proceso_pago',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Liquidado',
        'valor'     => 'liquidado',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Solicitud activa',
        'valor'     => 'solicitud_activa',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Escriturado',
        'valor'     => 'escriturado',
        'activo'    => false,
    ),
);

$config['select_proceso_venta'] = $select_proceso_venta;

/* ====== como_se_entero ====== */

$select_como_se_entero = array(
    (object) array(
        'nombre'    => 'Activación de hospitales',
        'valor'     => 'Activación de hospitales',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Base de datos',
        'valor'     => 'Base de datos',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Blender',
        'valor'     => 'Blender',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Broker',
        'valor'     => 'Broker',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Busca Hogares',
        'valor'     => 'busca hogares',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Espectacular',
        'valor'     => 'Espectacular',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Evento externo',
        'valor'     => 'Evento externo',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Evento W.T.C.',
        'valor'     => 'Evento W.T.C.',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Facebook',
        'valor'     => 'Facebook',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Instagram',
        'valor'     => 'Instagram',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Lamudi',
        'valor'     => 'Lamudi',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'LinkedIn',
        'valor'     => 'LinkedIn',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Lona Torres',
        'valor'     => 'Lona Torres',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Luxury',
        'valor'     => 'Luxury',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Metros cúbico',
        'valor'     => 'Metros cúbico',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Periódico',
        'valor'     => 'Periódico',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Pro-actividad',
        'valor'     => 'Pro-actividad',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Página web',
        'valor'     => 'Página web',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Radio',
        'valor'     => 'Radio',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Referido',
        'valor'     => 'Referido',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Revista',
        'valor'     => 'Revista',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Segunda mano',
        'valor'     => 'Segunda mano',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Showroom',
        'valor'     => 'Showroom',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Tu hogar',
        'valor'     => 'Tu hogar',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'TV',
        'valor'     => 'TV',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Vivanuncios',
        'valor'     => 'Vivanuncios',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Whatsapp',
        'valor'     => 'Whatsapp',
        'activo'    => false,
    ),
);

$config['select_como_se_entero'] = $select_como_se_entero;

/* ====== Interes semanal ====== */

$select_interes_semanal = array(
    (object) array(
        'nombre'    => 'Alto',
        'valor'     => 'alto',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Medio',
        'valor'     => 'medio',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Bajo',
        'valor'     => 'bajo',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Nulo',
        'valor'     => 'nulo',
        'activo'    => false,
    )
);

$config['select_interes_semanal'] = $select_interes_semanal;

/* ====== Medio de contacto ====== */

$select_medio_contacto = array(
    (object) array(
        'nombre'    => 'Busca Hogares',
        'valor'     => 'busca hogares',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Correo',
        'valor'     => 'correo',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Facebook',
        'valor'     => 'facebook',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Llamada',
        'valor'     => 'llamada',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Notarias',
        'valor'     => 'notarias',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Pagina JV',
        'valor'     => 'pagina jv',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Pro-actividad',
        'valor'     => 'pro-actividad',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Red Social',
        'valor'     => 'red social',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Teléfono',
        'valor'     => 'teléfono',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Visita',
        'valor'     => 'visita',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Vivanuncios',
        'valor'     => 'vivanuncios',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'WhatsApp',
        'valor'     => 'whatsapp',
        'activo'    => false,
    )
);

$config['select_medio_contacto'] = $select_medio_contacto;

// Select si es asesor
$select_es_asesor = array(
    (object) array(
        'nombre'    => 'Asesor',
        'valor'     => 'c1fce77c',
        'activo'    => false,
    ),
    (object) array(
        'nombre'    => 'Administrador',
        'valor'     => null,
        'activo'    => false,
    )
);

$config['select_es_asesor'] = $select_es_asesor;