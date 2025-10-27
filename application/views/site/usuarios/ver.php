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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/usuarios'); ?>">Usuarios</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/usuarios/agregar'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</a>
                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/usuarios/editar/' . $usuario_row->identificador); ?>"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar</a>
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

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Nombre</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo ucwords(!empty($usuario_row->identidad_nombre_completo) ?  $usuario_row->identidad_nombre_completo : ''); ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Usuario identificador</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($usuario_row->identificador) ? $usuario_row->identificador : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Teléfono</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($usuario_row->telefono) ? $usuario_row->telefono : ''; ?></p>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                    <h5 class="">Correo electrónico</h5>
                                                    <p class="text-bold-700 font-medium-2"><?php echo !empty($usuario_row->correo_electronico) ? $usuario_row->correo_electronico : ''; ?></p>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-12 mb-1">

                                                    <div class="list-group">
                                                        <div class="list-group-item flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="text-bold-600">Notas</h5>
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