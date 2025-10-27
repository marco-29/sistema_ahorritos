<?php $this->load->view('site/modals/comprobante_pago/subir_comprobante_pago'); ?>
<?php $this->load->view('site/modals/comprobante_pago_expediente/subir_comprobante_pago_expediente'); ?>
<?php $this->load->view('site/modals/comprobante_pago/ver_archivo'); ?>
<div class="app-content content center-layout">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos">
                    <h3 class="text-white"><strong><?php echo $pagina_titulo; ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="content-header row px-1 my-1">
            <div class="content-header-left col-md-6 col-12">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/inicio'); ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/desarrollos'); ?>">Desarrollos</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/desarrollos/ver/' . $desarrollo_row->inmueble_nodo_identificador); ?>"><?php echo ucfirst($desarrollo_row->nombre); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                <li class="">&nbsp;&nbsp;&nbsp;&nbsp;<small><em><span name="mensaje_proceso_venta" id="mensaje_proceso_venta" class="info"></span></em></small></li>
                            <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                </div>
            </div>
        </div>
        <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>
        <div class="content-detached content-right">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row match-height mb-2 font-medium-2">
                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Inmueble:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="inmueble" id="inmueble"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>T. total m<sup>2</sup>:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="inmuebles_tamanho_total" id="inmuebles_tamanho_total"></span>m<sup>2</sup></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fecha inicio:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="fecha_inicio" id="fecha_inicio"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Frecuencia:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="frecuencia" id="frecuencia"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Precio lista:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="precio_lista" id="precio_lista"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Precio venta:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="precio_venta" id="precio_venta"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. pagos:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="no_pagos" id="no_pagos"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Total en tabla:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="total_tabla" id="total_tabla"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pagado:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="pagado" id="pagado"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Por validar:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="por_validar" id="por_validar"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Por cobrar:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="por_cobrar" id="por_cobrar"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vencido:</td>
                                                        <td class="text-right">
                                                            <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                                                <b><span name="vencido" id="vencido"></span></b>
                                                            <?php else : ?>
                                                                <b><span>N/A</span></b>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php if ($inmueble_row->estatus_inmueble === 'proceso' || $inmueble_row->estatus_inmueble === 'vendido') : ?>
                                        <div class="row match-height mb-2">
                                            <div class="col-xl-12 col-md-12 col-sm-12">
                                                <a class="btn btn-outline-secondary btn-min-width" href="javascript:agregar_pago()">Agregar pago</a>
                                                <a class="btn btn-outline-info btn-min-width" href="<?php echo site_url('site/inmuebles/guardar_tabla_deber_ser/' . $inmueble_row->identificador); ?>">Guardar tabla para contrato</a>
                                                <a class="btn btn-outline-info btn-min-width" href="<?php echo site_url('site/inmuebles/guardar_tabla_ser/' . $inmueble_row->identificador); ?>">Guardar tabla para escritura</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <table name="table" id="table" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificador</th>
                                                <th>Fecha programada</th>
                                                <th>Fecha pago</th>
                                                <th>Concepto</th>
                                                <th>Monto</th>
                                                <th>Comprobante de pago</th>
                                                <th>Comprobante de pago para expediente</th>
                                                <th>Estatus pago</th>
                                                <th>Estatus sistema</th>
                                                <th>Fecha registro</th>
                                                <th>Fecha actualización</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="bug-list-sidebar-content">
                    <!-- Predefined Views -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?php echo site_url('almacenamiento/site/recursos/inmuebles/portada-800x600.jpg'); ?>" class="img-fluid">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="my-3">
                                        <ul class="list-unstyled font-medium-2">
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/notas/' . $inmueble_row->identificador); ?>">1. Notas</a></li>
                                            <li><a class="active" href="<?php echo site_url('site/inmuebles/plan_pagos/' . $inmueble_row->identificador); ?>"><b>2. Plan de pagos</b></a></li>
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/datos_cliente'); ?>">Datos del cliente</a></li-->
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/datos_inmueble'); ?>">Datos del inmueble</a></li-->
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/' . ($desarrollo_row->nombre == 'andeza' ? 'contrato' : ($desarrollo_row->nombre == 'portamar' ? 'contrato_portamar' : '')) . '/' . $inmueble_row->identificador); ?>">3. Contrato</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/facturacion/' . $inmueble_row->identificador); ?>">4. Facturación</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/documentos/' . $inmueble_row->identificador); ?>">5. Documentos</a></li>
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/otros'); ?>">Otros</a></li-->
                                        </ul>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-12">
                                    <h4>Datos del inmueble:</h4><br>
                                    <p>Nombre del Inmueble<br>
                                        <b><?php echo strtoupper($inmueble_row->nombre); ?></b>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>Identificador<br><b><?php echo $inmueble_row->identificador; ?></b></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tipo de inmueble</b><br><?php echo ucfirst($inmueble_row->tipo_inmueble); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de construcción</b><br><?php echo $inmueble_row->tamanho_construccion . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de la terraza</b><br><?php echo $inmueble_row->tamanho_terraza . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño del total</b><br><?php echo $inmueble_row->tamanho_total . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Prototipo</b><br><?php echo $inmueble_row->prototipo; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Modalidad</b><br><?php echo ucfirst($inmueble_row->modalidad); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Estatus del inmueble</b><br><?php echo ucfirst($inmueble_row->estatus); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Predefined Views -->
                </div>
            </div>
        </div>

        <div class="content-detached content-right">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                                        <h4><b>Tabla para contrato</b></h4>
                                        <hr>
                                    </div>
                                    <table name="tabla_deber_ser" id="tabla_deber_ser" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificador</th>
                                                <th>Fecha programada</th>
                                                <th>Fecha pago</th>
                                                <th>Concepto</th>
                                                <th>Monto</th>
                                                <th>Estatus pago</th>
                                                <th>Estatus sistema</th>
                                                <th>Fecha registro</th>
                                                <th>Fecha actualización</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($deber_ser) : ?>
                                                <?php foreach ($deber_ser as $deber_ser_key => $deber_ser_value) : ?>
                                                    <tr>
                                                        <td><?php echo !empty($deber_ser_value->id) ? $deber_ser_value->id : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->identificador) ? $deber_ser_value->identificador : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->fecha_programada) ? date('Y/m/d', strtotime($deber_ser_value->fecha_programada)) : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->fecha_pago) ? date('Y/m/d', strtotime($deber_ser_value->fecha_pago)) : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->concepto) ? $deber_ser_value->concepto : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->monto) ? '$' . number_format($deber_ser_value->monto, 2) : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->estatus_pago) ? ucfirst($deber_ser_value->estatus_pago) : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->estatus) ? ucfirst($deber_ser_value->estatus) : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->fecha_registro) ? date('Y/m/d', strtotime($deber_ser_value->fecha_registro)) : ''; ?></td>
                                                        <td><?php echo !empty($deber_ser_value->fecha_actualizacion) ? date('Y/m/d', strtotime($deber_ser_value->fecha_actualizacion)) : ''; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="content-detached content-right">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                                        <h4><b>Tabla para escritura</b></h4>
                                        <hr>
                                    </div>
                                    <table name="tabla_ser" id="tabla_ser" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificador</th>
                                                <th>Fecha programada</th>
                                                <th>Fecha pago</th>
                                                <th>Concepto</th>
                                                <th>Monto</th>
                                                <th>Estatus pago</th>
                                                <th>Estatus sistema</th>
                                                <th>Fecha registro</th>
                                                <th>Fecha actualización</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($ser) : ?>
                                                <?php foreach ($ser as $ser_key => $ser_value) : ?>
                                                    <tr>
                                                        <td><?php echo !empty($ser_value->id) ? $ser_value->id : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->identificador) ? $ser_value->identificador : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->fecha_programada) ? date('Y/m/d', strtotime($ser_value->fecha_programada)) : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->fecha_pago) ? date('Y/m/d', strtotime($ser_value->fecha_pago)) : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->concepto) ? $ser_value->concepto : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->monto) ? '$' . number_format($ser_value->monto, 2) : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->estatus_pago) ? ucfirst($ser_value->estatus_pago) : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->estatus) ? ucfirst($ser_value->estatus) : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->fecha_registro) ? date('Y/m/d', strtotime($ser_value->fecha_registro)) : ''; ?></td>
                                                        <td><?php echo !empty($ser_value->fecha_actualizacion) ? date('Y/m/d', strtotime($ser_value->fecha_actualizacion)) : ''; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>