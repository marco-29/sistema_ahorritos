<?php $this->load->view('site/modals/facturas/subir_archivos'); ?>
<?php $this->load->view('site/modals/facturas/ver_archivo'); ?>
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
                            <li class="">&nbsp;&nbsp;&nbsp;&nbsp;<small><em><span name="mensaje_proceso_venta" id="mensaje_proceso_venta" class="info"></span></em></small></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                </div>
            </div>
        </div>
        <div class="content-detached content-right">
            <div class="content-body">
                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="row match-height mb-2 font-medium-2">

                                        <div class="col-xl-8 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <h3>Datos de facturación</h3>
                                            </div>
                                        </div>

                                        <!-- <div class="col-xl-2 col-md-4 col-sm-12">
                                            <div class="col-xl-12 col-md-12 col-sm-12">
                                                <a class="btn btn-outline-info btn-min-width" href="#">Editar datos de facturación</a>
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-md-4 col-sm-12">
                                            <div class="col-xl-12 col-md-12 col-sm-12">
                                                <a class="btn btn-outline-success btn-min-width" href="#">Nueva solicitud de factura</a>
                                            </div>
                                        </div> -->

                                    </div>

                                    <div class="row match-height mb-2 font-medium-2">

                                        <div class="col-xl-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12 text-bold-800 grey darken-2" for="nombre">Nombre o razón social</label>
                                                    <div class="col-lg-12">
                                                        <b><span><?php echo trim(ucwords((!empty($cliente_row->nombre) ? $cliente_row->nombre : '') . ' ' . (!empty($cliente_row->apellido_paterno) ? $cliente_row->apellido_paterno : '') . ' ' . (!empty($cliente_row->apellido_materno) ? $cliente_row->apellido_materno : ''))); ?></span></b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12 text-bold-800 grey darken-2" for="regimen_fiscal">Régimen fiscal</label>
                                                    <!-- <div class="col-lg-12">
                                                        <select name="regimen_fiscal" id="regimen_fiscal" class="form-control">
                                                            <option value="">Seleccione un regimen fiscal…</option>
                                                            <option value="601">601 - General de Ley Personas Morales</option>
                                                            <option value="603">603 - Personas Morales con Fines no Lucrativos</option>
                                                            <option value="610">610 - Residentes en el Extranjero sin Establecimiento Permanente en México</option>
                                                            <option value="620">620 - Sociedades Cooperativas de Producción que optan por diferir sus ingresos 622 Actividades Agrícolas, Ganaderas,Silvícolas y Pesqueras</option>
                                                            <option value="623">623 - Opcional para Grupos de Sociedades</option>
                                                            <option value="624">624- Coordinados</option>
                                                            <option value="626">626- Régimen Simplificado de Confianza</option>
                                                        </select>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12 text-bold-800 grey darken-2" for="rfc">RFC</label>
                                                    <div class="col-lg-12">
                                                        <b><span><?php echo !empty($cliente_row->rfc) ? mb_strtoupper($cliente_row->rfc) : ''; ?></span></b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12 text-bold-800 grey darken-2" for="cfdi">Uso de CFDI</label>
                                                    <div class="col-lg-12">
                                                        <b><span></span></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12 text-bold-800 grey darken-2" for="codgi_postal">Código Postal</label>
                                                    <div class="col-lg-12">
                                                        <b><span></span></b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12 text-bold-800 grey darken-2" for="constancia_situacion_fiscal">Constancia de situación fiscal</label>
                                                    <div class="col-lg-12">
                                                        <b><span></span></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row match-height mb-2">
                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                            <h4>Facturación AN301</h4>
                                        </div>
                                    </div>

                                    <table name="table" id="table" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificador</th>
                                                <th>Desarrollo</th>
                                                <th>Inmueble</th>
                                                <th>Identificador del pago</th>
                                                <th>Concepto del pago</th>
                                                <th>Nombre cliente</th>
                                                <th>RFC</th>
                                                <th>Codigo postal</th>
                                                <th>Regimen fiscal</th>
                                                <th>Uso CFDI</th>
                                                <th>Monto</th>
                                                <th>Archivos</th>
                                                <th>Estatus facturación</th>
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
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/plan_pagos/' . $inmueble_row->identificador); ?>">2. Plan de pagos</a></li>
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/datos_cliente'); ?>">Datos del cliente</a></li-->
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/datos_inmueble'); ?>">Datos del inmueble</a></li-->
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/' . ($desarrollo_row->nombre == 'andeza' ? 'contrato' : ($desarrollo_row->nombre == 'portamar' ? 'contrato_portamar' : '')) . '/' . $inmueble_row->identificador); ?>">3. Contrato</a></li>
                                            <li><a class="active" href="<?php echo site_url('site/inmuebles/facturacion/' . $inmueble_row->identificador); ?>"><b>4. Facturación</b></a></li>
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
    </div>
</div>