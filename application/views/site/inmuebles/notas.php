<?php $this->load->view('site/modals/comprobante_pago/subir_comprobante_pago'); ?>
<?php $this->load->view('site/modals/comprobante_pago/ver_archivo'); ?>
<?php $this->load->view('site/modals/notas/nota_inmueble'); ?>
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
                                    <div class="col-xl-6 col-md-6 col-sm-12">

                                        <div class="row">

                                            <div class="col-xl-12 col-md-12 col-sm-12 mb-1">
                                            </div>

                                            <div class="col-xl-12 col-md-12 col-sm-12 mb-1">

                                                <div class="list-group">
                                                    <div class="list-group-item flex-column align-items-start">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="text-bold-600">Notas</h5>
                                                            <a class="btn btn-outline-secondary btn-sm" href="<?php echo "javascript:agregar_nota('$inmueble_row->identificador')"; ?>">Agregar</a>
                                                        </div>
                                                    </div>
                                                    <?php foreach ($notas_list as $nota_key => $nota_value) : ?>
                                                        <div class="list-group-item list-group-item-action flex-column align-items-start <?php echo $nota_key == 0 ? 'active' : ''; ?>">
                                                            <div class="d-flex float-right">
                                                                <small><?php echo date('d M y H:i a', strtotime($nota_value->fecha_registro)); ?></small>
                                                            </div>
                                                            <p><?php echo $nota_value->nota; ?></p>
                                                            <small class="float-right"><?php echo $nota_value->usuarios_correo_electronico; ?></small>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

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
                                            <li><a class="active" href="<?php echo site_url('site/inmuebles/notas/' . $inmueble_row->identificador); ?>"><b>1. Notas</b></a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/plan_pagos/' . $inmueble_row->identificador); ?>">2. Plan de pagos</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/' . ($desarrollo_row->nombre == 'andeza' ? 'contrato' : ($desarrollo_row->nombre == 'portamar' ? 'contrato_portamar' : '')) . '/' . $inmueble_row->identificador); ?>">3. Contrato</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/facturacion/' . $inmueble_row->identificador); ?>">4. Facturación</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/documentos/' . $inmueble_row->identificador); ?>">5. Documentos</a></li>
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