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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/clientes'); ?>">Clientes</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <!-- Outline button group with icons and text. -->
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-outline-grey btn-outline-lighten-1 btn-min-width mr-1" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
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

                                    <div class="row match-height">
                                        <div class="col-xl-6 col-md-6 col-sm-12">

                                            <div class="row">

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="asesor_identificador">Asesor</label>
                                                            <div class="col-lg-12">
                                                                <?php $user_rol_identificador = $this->session->userdata('user_rol_identificador'); ?>
                                                                <select id="asesor_identificador" name="asesor_identificador" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('asesor_identificador', '', set_value('asesor_identificador') ? false : '' == $this->session->flashdata('asesor_identificador')); ?>>Seleccione un asesor…</option>
                                                                    <?php foreach ($usuarios_list as $usuario_key => $usuario_value) : ?>
                                                                        <?php if ($user_rol_identificador) : ?>
                                                                            <?php if ($usuario_value->identificador == $this->session->userdata('user_identificador')) : ?>
                                                                                <option value="<?php echo $usuario_value->identificador; ?>" <?php echo $usuario_value->identificador == $this->session->userdata('user_identificador') ? 'selected' : ''; ?> <?php echo set_select('asesor_identificador', $usuario_value->identificador, set_value('asesor_identificador') ? false : $usuario_value->identificador == $this->session->flashdata('asesor_identificador')); ?>><?php echo trim($usuario_value->correo_electronico); ?></option>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $usuario_value->identificador; ?>" <?php echo $usuario_value->identificador == $this->session->userdata('user_identificador') ? 'selected' : ''; ?> <?php echo set_select('asesor_identificador', $usuario_value->identificador, set_value('asesor_identificador') ? false : $usuario_value->identificador == $this->session->flashdata('asesor_identificador')); ?>><?php echo trim($usuario_value->correo_electronico); ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un asesor válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="persona_fiscal">Tipo de persona fiscal</label>
                                                            <div class="col-lg-12">
                                                                <select id="persona_fiscal" name="persona_fiscal" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('persona_fiscal', '', set_value('persona_fiscal') ? false : '' == $this->session->flashdata('persona_fiscal')); ?>>Seleccione un tipo de persona fiscal…</option>
                                                                    <?php foreach (select_persona_fiscal() as $persona_fiscal_key => $persona_fiscal_row) : ?>
                                                                        <option value="<?php echo $persona_fiscal_row->valor; ?>" <?php echo $persona_fiscal_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('persona_fiscal', $persona_fiscal_row->valor, set_value('persona_fiscal') ? false : $persona_fiscal_row->valor == $this->session->flashdata('persona_fiscal')); ?>><?php echo trim($persona_fiscal_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un tipo de persona fiscal válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <h4 class="form-section">Datos de cliente</h4>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="nombre">Nombre o Razón social</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre') == false ? $this->session->flashdata('nombre') : set_value('nombre'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un nombre o razón social válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="apellido_paterno">Apellido paterno</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido paterno" value="<?php echo set_value('apellido_paterno') == false ? $this->session->flashdata('apellido_paterno') : set_value('apellido_paterno'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un apellido paterno válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="apellido_materno">Apellido materno</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido materno" value="<?php echo set_value('apellido_materno') == false ? $this->session->flashdata('apellido_materno') : set_value('apellido_materno'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un apellido materno válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <h4 class="form-section">Datos del representante legal (Persona moral)</h4>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="nombre_representante_legal">Nombre rep. legal (Persona moral)</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="nombre_representante_legal" id="nombre_representante_legal" placeholder="Nombre del representante legal" value="<?php echo set_value('nombre_representante_legal') == false ? $this->session->flashdata('nombre_representante_legal') : set_value('nombre_representante_legal'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un apellido del paterno válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="apellido_representante_legal">Apellido rep. legal (Persona moral)</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="apellido_representante_legal" id="apellido_representante_legal" placeholder="Apellido del representante legal" value="<?php echo set_value('apellido_representante_legal') == false ? $this->session->flashdata('apellido_representante_legal') : set_value('apellido_representante_legal'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un apellido del representante legal válido.
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
                                                                <input type="text" class="form-control" maxlength="10" pattern="\d{10}" inputmode="numeric" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo set_value('telefono') == false ? $this->session->flashdata('telefono') : set_value('telefono'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un teléfono válido.
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
                                                                <input type="text" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico" value="<?php echo set_value('correo_electronico') == false ? $this->session->flashdata('correo_electronico') : set_value('correo_electronico'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un correo electrónico válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="fecha_nacimiento">Fecha de nacimiento</label>
                                                            <div class="col-lg-12">
                                                                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo set_value('fecha_nacimiento') == false ? $this->session->flashdata('fecha_nacimiento') : set_value('fecha_nacimiento'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una fecha de nacimiento válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="estado_civil">Estado civil</label>
                                                            <div class="col-lg-12">
                                                                <select id="estado_civil" name="estado_civil" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('estado_civil', '', set_value('estado_civil') ? false : '' == $this->session->flashdata('estado_civil')); ?>>Seleccione un estado civil del cliente…</option>
                                                                    <?php foreach (select_estado_civil() as $estatus_key => $estatus_row) : ?>
                                                                        <option value="<?php echo $estatus_row->valor; ?>" <?php echo $estatus_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('estado_civil', $estatus_row->valor, set_value('estado_civil') ? false : $estatus_row->valor == $this->session->flashdata('estado_civil')); ?>><?php echo trim($estatus_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un estado civil válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="curp">CURP</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" style="text-transform:uppercase;" name="curp" id="curp" placeholder="CURP" value="<?php echo set_value('curp') == false ? $this->session->flashdata('curp') : set_value('curp'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un CURP válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="ine">INE</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="ine" id="ine" placeholder="INE" value="<?php echo set_value('ine') == false ? $this->session->flashdata('ine') : set_value('ine'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una INE válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="rfc">RFC</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" style="text-transform:uppercase;" name="rfc" id="rfc" placeholder="RFC" value="<?php echo set_value('rfc') == false ? $this->session->flashdata('rfc') : set_value('rfc'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un RFC válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="domicilio_fiscal">Domicilio fiscal</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="domicilio_fiscal" id="domicilio_fiscal" placeholder="Domicilio fiscal" value="<?php echo set_value('domicilio_fiscal') == false ? $this->session->flashdata('domicilio_fiscal') : set_value('domicilio_fiscal'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un domicilio fiscal válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="como_se_entero">¿Cómo se enteró?</label>
                                                            <div class="col-lg-12">
                                                                <select id="como_se_entero" name="como_se_entero" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('como_se_entero', '', set_value('como_se_entero') ? false : '' == $this->session->flashdata('como_se_entero')); ?>>Seleccione como se enteró…</option>
                                                                    <?php foreach (select_como_se_entero() as $estatus_key => $estatus_row) : ?>
                                                                        <option value="<?php echo $estatus_row->valor; ?>" <?php echo $estatus_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('como_se_entero', $estatus_row->valor, set_value('como_se_entero') ? false : $estatus_row->valor == $this->session->flashdata('como_se_entero')); ?>><?php echo trim($estatus_row->nombre); ?></option>
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
                                                            <label class="col-lg-12 required-field" for="medio_contacto">Medio de contacto</label>
                                                            <div class="col-lg-12">
                                                                <select id="medio_contacto" name="medio_contacto" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('medio_contacto', '', set_value('medio_contacto') ? false : '' == $this->session->flashdata('medio_contacto')); ?>>Seleccione medio de contacto…</option>
                                                                    <?php foreach (select_medio_contacto() as $estatus_key => $estatus_row) : ?>
                                                                        <option value="<?php echo $estatus_row->valor; ?>" <?php echo $estatus_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('medio_contacto', $estatus_row->valor, set_value('medio_contacto') ? false : $estatus_row->valor == $this->session->flashdata('medio_contacto')); ?>><?php echo trim($estatus_row->nombre); ?></option>
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
                                                            <label class="col-lg-12 required-field" for="desarrollo_interes_identificador">Desarrollo de interés</label>
                                                            <div class="col-lg-12">
                                                                <select id="desarrollo_interes_identificador" name="desarrollo_interes_identificador" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('desarrollo_interes_identificador', '', set_value('desarrollo_interes_identificador') ? false : '' == $this->session->flashdata('desarrollo_interes_identificador')); ?>>Seleccione un desarrollo de interés…</option>
                                                                    <?php foreach ($desarrollos_interes_list as $desarrollo_interes_key => $desarrollo_interes_value) : ?>
                                                                        <?php if ($desarrollo_interes_value->estatus != 'suspendido') : ?>
                                                                            <option value="<?php echo $desarrollo_interes_value->identificador; ?>" <?php echo set_select('desarrollo_interes_identificador', $desarrollo_interes_value->identificador, set_value('desarrollo_interes_identificador') ? false : $desarrollo_interes_value->identificador == $this->session->flashdata('desarrollo_interes_identificador')); ?>><?php echo trim(mb_strtoupper($desarrollo_interes_value->nombre)); ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un desarrollo de interés válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="estatus_cliente">Estatus de clientes</label>
                                                            <div class="col-lg-12">
                                                                <select id="estatus_cliente" name="estatus_cliente" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('estatus_cliente', '', set_value('estatus_cliente') ? false : '' == $this->session->flashdata('estatus_cliente')); ?>>Seleccione un estatus del cliente…</option>
                                                                    <?php foreach (select_estatus_cliente() as $estatus_key => $estatus_row) : ?>
                                                                        <option value="<?php echo $estatus_row->valor; ?>" <?php echo $estatus_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('estatus_cliente', $estatus_row->valor, set_value('estatus_cliente') ? false : $estatus_row->valor == $this->session->flashdata('estatus_cliente')); ?>><?php echo trim($estatus_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un estatus de cliente válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <h4 class="form-section">Notas</h4>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="nota">Agregar nota</label>
                                                            <div class="col-lg-12">
                                                                <textarea class="form-control" name="nota" id="nota" rows="8" maxlength="240" placeholder="Nota"><?php echo set_value('nota') == false ? $this->session->flashdata('nota') : set_value('nota'); ?></textarea>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una nota válido.
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 media-right float-right text-right">
                                                                <small class="text-muted" name="nota-count" id="nota-count">0/240</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span><strong><i class="ft-alert-circle green"></i> Check list de requisitos de cliente [Completa todos los pasos].</strong></span>
                                            </div>
                                            <br>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span id="mensaje_comprobacion_nombre"><i class="ft-circle blue"></i> Por favor registre el nombre completo.</span>
                                            </div>
                                            <br>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span id="mensaje_comprobacion_no_celular"><i class="ft-circle blue"></i> Por favor registre el número celular.</span>
                                            </div>
                                            <br>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span id="mensaje_comprobacion_correo"><i class="ft-circle blue"></i> Por favor registre el correo electrónico.</span>
                                            </div>
                                            <br>
                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <span id="mensaje_estatus_cliente"></span>
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