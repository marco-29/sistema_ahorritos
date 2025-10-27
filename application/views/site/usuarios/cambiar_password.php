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

                <h3 class="content-header-title mb-0"><?php echo $pagina_titulo; ?></h3>

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
                        <div class="btn-group" role="group" aria-label="Basic example">
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

                                    <?php echo form_open(uri_string(), array('class' => 'needs-validation p-2', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>

                                    <input type="hidden" class="form-control" name="identificador" id="identificador" placeholder="identificador" value="<?php echo $usuario_row->identificador; ?>" readonly required>

                                    <div class="row match-height">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-4 col-sm-12">

                                                    <p><small>Nueva contraseña para: <strong><?php echo $usuario_row->correo_electronico . ' #' . $usuario_row->identificador; ?></strong></small></p>
                                                    <input type="hidden" name="id" id="id" value="<?php echo $usuario_row->identificador; ?>">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-xl-12" for="contrasenha">Contraseña nueva <span class="red">*</span></label>
                                                            <div class="col-xl-12">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" name="contrasenha" id="contrasenha" placeholder="contraseña" value="<?php echo set_value('contrasenha'); ?>" required>
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button" onclick="mostrar_contrasenha()"><i class="fa fa-eye"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Por favor introduzca la contraseña nueva.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-xl-12" for="contrasenha_valida">Validar nueva contraseña <span class="red">*</span></label>
                                                            <div class="col-xl-12">
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" name="contrasenha_valida" id="contrasenha_valida" placeholder="Validar nueva contraseña de usuario" value="<?php echo set_value('contrasenha_valida'); ?>" required="">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button" onclick="mostrar_contrasenha_valida()"><i class="fa fa-eye"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Por favor introduzca la contraseña nueva para validar.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <!--div class="form-group float-md-left">
                                            </div-->
                                            <div class="form-group float-md-right">
                                                <a class="btn btn-outline-grey btn-min-width mr-1" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
                                                <button type="submit" class="btn btn-outline-secondary btn-min-width mr-1"><i class="fa fa-check-circle"></i>&nbsp;Guardar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>

    </div>
</div>