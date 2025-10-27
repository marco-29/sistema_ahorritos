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
                        <div class="btn-group" role="group" aria-label="Basic example">
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

                                    <?php echo form_open_multipart(uri_string(), array('class' => 'needs-validation p-2', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>

                                    <h5 class="form-section"><i class="ft-user"></i> Datos del servicio</h5>

                                    <div class="row match-height">
                                        <div class="col-xl-6 col-md-6 col-sm-12">

                                            <div class="row">

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="es_asesor">Rol</label>
                                                            <div class="col-lg-12">
                                                                <select id="es_asesor" name="es_asesor" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('es_asesor', '', set_value('es_asesor') ? false : '' == $this->session->flashdata('es_asesor')); ?>>Es asesor…</option>
                                                                    <?php foreach (select_es_asesor() as $estatus_key => $estatus_row) : ?>
                                                                        <option value="<?php echo $estatus_row->valor; ?>" <?php echo $estatus_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('es_asesor', $estatus_row->valor, set_value('es_asesor') ? false : $estatus_row->valor == $this->session->flashdata('es_asesor')); ?>><?php echo trim($estatus_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un estatus de como se enteró válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="correo_electronico">Correo electrónico</label>
                                                            <div class="col-lg-12">
                                                                <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico" value="<?php echo set_value('correo_electronico') == false ? $this->session->flashdata('correo_electronico') : set_value('correo_electronico'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una correo electrónico válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="telefono">Teléfono</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo set_value('telefono') == false ? $this->session->flashdata('telefono') : set_value('telefono'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una teléfono válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="contrasenha">Contraseña</label>
                                                            <div class="col-lg-12 input-group">
                                                                <input type="password" class="form-control" name="contrasenha" id="contrasenha" placeholder="Contraseña" value="<?php echo set_value('contrasenha') == false ? $this->session->flashdata('contrasenha') : set_value('contrasenha'); ?>" required>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-secondary" type="button" id="mostrar_contrasenha_btn">
                                                                        <i class="fa fa-eye"></i> <!-- Icono de ojo abierto -->
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <small class="col-lg-12 text-muted">La contraseña debe tener al menos 8 caracteres.</small>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="validar_contrasenha">Validar contraseña</label>
                                                            <div class="col-lg-12 input-group">
                                                                <input type="password" class="form-control" name="validar_contrasenha" id="validar_contrasenha" placeholder="Validar contraseña" value="<?php echo set_value('validar_contrasenha') == false ? $this->session->flashdata('validar_contrasenha') : set_value('validar_contrasenha'); ?>" required>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-secondary" type="button" id="mostrar_validar_contrasenha_btn">
                                                                        <i class="fa fa-eye"></i> <!-- Icono de ojo abierto -->
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <small class="col-lg-12 text-muted">Vuelve a ingresar la contraseña para validar.</small>
                                                        </div>
                                                    </div>

                                                </div>

                                                <small class="col-lg-12 mb-2" id="validar_contrasenha_mensaje"></small>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="nombre">Nombre/s</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre') == false ? $this->session->flashdata('nombre') : set_value('nombre'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una nombre válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="apellido_paterno">Apellido paterno</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido paterno" value="<?php echo set_value('apellido_paterno') == false ? $this->session->flashdata('apellido_paterno') : set_value('apellido_paterno'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una apellido paterno válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="apellido_materno">Apellido materno</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido materno" value="<?php echo set_value('apellido_materno') == false ? $this->session->flashdata('apellido_materno') : set_value('apellido_materno'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una apellido materno válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12 mt-2 mb-2">
                                                    <h4 class="text-bold-800 grey darken-2">Nota</h4>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12">Nota</label>
                                                            <div class="col-lg-12">
                                                                <textarea class="form-control" name="nota" id="nota" rows="8" maxlength="500" placeholder="Nota"><?php echo set_value('nota') == false ? $this->session->flashdata('nota') : set_value('nota'); ?></textarea>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una nota válido.
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 media-right float-right text-right">
                                                                <small class="text-muted" name="nota-count" id="nota-count">0/500</small>
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
                                                <a class="btn btn-outline-grey btn-outline-lighten-1 btn-min-width mr-1" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
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