<?php $this->load->view('site/modals/notas/nota_cliente'); ?>
<div class="app-content content center-layout">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos ">
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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/clientes'); ?>">Clientes</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/clientes/agregar'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</a>
                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/clientes/editar/' . $cliente_row->identificador); ?>"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
                            <a class="btn btn-outline-grey" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="content-body">
            <section id="section">

                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title"><?php echo $pagina_subtitulo; ?></h4>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="row match-height">

                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="row">

                                                <div class="col-xl-12 col-md-12 col-sm-12 mb-1">
                                                    <h5 class="">Tipo de persona fiscal</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->persona_fiscal) ? ucfirst($cliente_row->persona_fiscal) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Nombre completo o razón social</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo trim(ucwords((!empty($cliente_row->nombre) ? $cliente_row->nombre : '') . ' ' . (!empty($cliente_row->apellido_paterno) ? $cliente_row->apellido_paterno : '') . ' ' . (!empty($cliente_row->apellido_materno) ? $cliente_row->apellido_materno : ''))); ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Identificador de cliente</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->identificador) ? $cliente_row->identificador : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Teléfono</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->telefono) ? $cliente_row->telefono : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Correo electrónico</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->correo_electronico) ? $cliente_row->correo_electronico : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Fecha de nacimiento</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->fecha_nacimiento) ? date('d/m/Y', strtotime($cliente_row->fecha_nacimiento)) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Estado civil</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->estado_civil) ? ucfirst($cliente_row->estado_civil) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">CURP</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->curp) ? mb_strtoupper($cliente_row->curp) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">INE</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->ine) ? mb_strtoupper($cliente_row->ine) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">RFC</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->rfc) ? mb_strtoupper($cliente_row->rfc) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Domicilio fiscal</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->domicilio_fiscal) ? ucwords($cliente_row->domicilio_fiscal) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Estatus de cliente</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->estatus_cliente) ? ucfirst($cliente_row->estatus_cliente) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Estatus del sistema</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->estatus) ? ucfirst($cliente_row->estatus) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Fecha registro</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->fecha_registro) ? date('Y/m/d', strtotime($cliente_row->fecha_registro)) : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Fecha actualización</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($cliente_row->fecha_actualizacion) ? date('Y/m/d', strtotime($cliente_row->fecha_actualizacion)) : ''; ?></p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 mb-1">
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12 mb-1">

                                                    <div class="list-group">
                                                        <div class="list-group-item flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="text-bold-600">Notas</h5>
                                                                <a class="btn btn-outline-secondary btn-sm" href="<?php echo "javascript:agregar_nota('$cliente_row->identificador')";?>">Agregar</a>
                                                            </div>
                                                        </div>
                                                        <?php foreach ($notas_list as $nota_key => $nota_value) : ?>
                                                            <div class="list-group-item flex-column align-items-start <?php echo $nota_key == 0 ? 'active' : ''; ?>">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                    <small><?php echo date('d M y H:i a', strtotime($nota_value->fecha_registro)) ?></small>
                                                                </div>
                                                                <p><?php echo $nota_value->nota; ?></p>
                                                                <small><?php echo $nota_value->usuarios_correo_electronico; ?></small>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group float-md-right">
                                                <a class="btn btn-outline-grey btn-min-width mr-1" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
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
</div>