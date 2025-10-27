<div class="app-content content center-layout">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos ">
                    <h3 class="text-white"><strong><?php echo $pagina_titulo; ?> <?php echo ucfirst($inmueble_nodo_row->nombre); ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="content-header row px-1 my-1">
            <div class="content-header-left col-md-6 col-12">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/inicio'); ?>">Inicio</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/desarrollos'); ?>">Desarrollos</a>
                            </li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-outline-secondary" href="<?php echo site_url('site/procesos_venta/agregar/'.$inmueble_nodo_row->identificador); ?>"><i class="fa fa-check-square-o"></i>&nbsp;Proceso venta</a>
                    <a class="btn btn-outline-grey" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
                </div>
            </div>
        </div>

        <div class="content-detached content-right">
            <div class="content-body">

                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>

                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $pagina_subtitulo . ' - ' . ucfirst($inmueble_nodo_row->nombre); ?></h4>
                                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table name="table" id="table" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Precio</th>
                                                    <th>Etapa</th>
                                                    <th>Estatus</th>
                                                    <th>Modalidad</th>
                                                    <th>Prototipo</th>
                                                    <th>T. const.</th>
                                                    <th>T. terraza</th>
                                                    <th>T. total</th>
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
                    </div>
                </section>
            </div>
        </div>

        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="bug-list-sidebar-content">
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
                                            <li><a class="" href="<?php echo site_url('site/desarrollos/ver/' . $inmueble_nodo_row->identificador); ?>"><b>Ver desarrollo</b></a></li>
                                            <li><a class="" href="<?php echo site_url('site/desarrollos/documentos/' . $inmueble_nodo_row->identificador); ?>">Documentos</a></li>
                                        </ul>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-12">
                                    <h4>Datos del desarrollo:</h4><br>
                                    <p>Nombre del desarrollo<br>
                                        <b><?php echo mb_strtoupper($inmueble_nodo_row->nombre); ?></b>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>Identificador<br><b><?php echo $inmueble_nodo_row->identificador; ?></b></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tipo de inmueble</b><br><?php echo ucwords($inmueble_nodo_row->tipo_inmueble); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de construcción</b><br><?php echo $inmueble_nodo_row->tamanho_construccion . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de la terraza</b><br><?php echo $inmueble_nodo_row->tamanho_terraza . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño del total</b><br><?php echo $inmueble_nodo_row->tamanho_total . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Prototipo</b><br><?php echo $inmueble_nodo_row->prototipo; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Modalidad</b><br><?php echo ucfirst($inmueble_nodo_row->modalidad); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Estatus del inmueble</b><br><?php echo ucfirst($inmueble_nodo_row->estatus); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>