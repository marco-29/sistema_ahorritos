<?php $this->load->view('site/modals/notas/nota_cliente'); ?>
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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/clientes'); ?>">Clientes</a></li>
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

                                    <input type="hidden" class="form-control" name="identificador" id="identificador" placeholder="identificador" value="<?php echo $cliente_row->identificador; ?>" readonly required>

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
                                                                    <option value="" <?php echo set_select('asesor_identificador', '', set_value('asesor_identificador') ? false : '' == (!empty($this->session->flashdata('asesor_identificador')) ? $this->session->flashdata('asesor_identificador') : (!empty($cliente_row->asesor_identificador) ? $cliente_row->asesor_identificador : set_value('asesor_identificador')))); ?>>Seleccione un asesor…</option>
                                                                    <?php foreach ($usuarios_list as $usuario_key => $usuario_value) : ?>
                                                                        <?php if ($user_rol_identificador) : ?>
                                                                            <?php if ($usuario_value->identificador == $this->session->userdata('user_identificador')) : ?>
                                                                                <option value="<?php echo $usuario_value->identificador; ?>" <?php echo set_select('asesor_identificador', $usuario_value->identificador, set_value('asesor_identificador') ? false : $usuario_value->identificador == (!empty($this->session->flashdata('asesor_identificador')) ? $this->session->flashdata('asesor_identificador') : (!empty($cliente_row->asesor_identificador) ? $cliente_row->asesor_identificador : set_value('asesor_identificador')))); ?>><?php echo trim($usuario_value->correo_electronico); ?></option>
                                                                            <?php endif; ?>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $usuario_value->identificador; ?>" <?php echo set_select('asesor_identificador', $usuario_value->identificador, set_value('asesor_identificador') ? false : $usuario_value->identificador == (!empty($this->session->flashdata('asesor_identificador')) ? $this->session->flashdata('asesor_identificador') : (!empty($cliente_row->asesor_identificador) ? $cliente_row->asesor_identificador : set_value('asesor_identificador')))); ?>><?php echo trim($usuario_value->correo_electronico); ?></option>
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
                                                                    <option value="" <?php echo set_select('persona_fiscal', '', set_value('persona_fiscal') ? false : '' == (!empty($this->session->flashdata('persona_fiscal')) ? $this->session->flashdata('persona_fiscal') : (!empty($cliente_row->persona_fiscal) ? $cliente_row->persona_fiscal : set_value('persona_fiscal')))); ?>>Seleccione un persona fiscal…</option>
                                                                    <?php foreach (select_persona_fiscal() as $key => $persona_fiscal_row) : ?>
                                                                        <option value="<?php echo $persona_fiscal_row->valor; ?>" <?php echo set_select('persona_fiscal', $persona_fiscal_row->valor, set_value('persona_fiscal') ? false : $persona_fiscal_row->valor == (!empty($this->session->flashdata('persona_fiscal')) ? $this->session->flashdata('persona_fiscal') : (!empty($cliente_row->persona_fiscal) ? $cliente_row->persona_fiscal : set_value('persona_fiscal')))); ?>><?php echo trim($persona_fiscal_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar una persona fiscal válida.
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
                                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre') == false ? (!empty($this->session->flashdata('nombre')) ? $this->session->flashdata('nombre') : (!empty($cliente_row->nombre) ? ucwords($cliente_row->nombre) : set_value('nombre'))) : set_value('nombre'); ?>" required>
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
                                                                <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido paterno" value="<?php echo set_value('apellido_paterno') == false ? (!empty($this->session->flashdata('apellido_paterno')) ? $this->session->flashdata('apellido_paterno') : (!empty($cliente_row->apellido_paterno) ? ucwords($cliente_row->apellido_paterno) : set_value('apellido_paterno'))) : set_value('apellido_paterno'); ?>">
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
                                                            <label class="col-lg-12" for="apellido_materno">Apellido materno </label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido materno" value="<?php echo set_value('apellido_materno') == false ? (!empty($this->session->flashdata('apellido_materno')) ? $this->session->flashdata('apellido_materno') : (!empty($cliente_row->apellido_materno) ? ucwords($cliente_row->apellido_materno) : set_value('apellido_materno'))) : set_value('apellido_materno'); ?>">
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
                                                                <input type="text" class="form-control" name="nombre_representante_legal" id="nombre_representante_legal" placeholder="Nombre del representante legal" value="<?php echo set_value('nombre_representante_legal') == false ? (!empty($this->session->flashdata('nombre_representante_legal')) ? $this->session->flashdata('nombre_representante_legal') : (!empty($cliente_row->nombre_representante_legal) ? ucwords($cliente_row->nombre_representante_legal) : set_value('nombre_representante_legal'))) : set_value('nombre_representante_legal'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un nombre del representante legal válido.
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
                                                                <input type="text" class="form-control" name="apellido_representante_legal" id="apellido_representante_legal" placeholder="Apellido del representante legal" value="<?php echo set_value('apellido_representante_legal') == false ? (!empty($this->session->flashdata('apellido_representante_legal')) ? $this->session->flashdata('apellido_representante_legal') : (!empty($cliente_row->apellido_representante_legal) ? ucwords($cliente_row->apellido_representante_legal) : set_value('apellido_representante_legal'))) : set_value('apellido_representante_legal'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un apellido del representante legal materno válido.
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
                                                                <input type="text" class="form-control" maxlength="10" pattern="\d{10}" inputmode="numeric" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo set_value('telefono') == false ? (!empty($this->session->flashdata('telefono')) ? $this->session->flashdata('telefono') : (!empty($cliente_row->telefono) ? $cliente_row->telefono : set_value('telefono'))) : set_value('telefono'); ?>" required>
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
                                                                <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico" value="<?php echo set_value('correo_electronico') == false ? (!empty($this->session->flashdata('correo_electronico')) ? $this->session->flashdata('correo_electronico') : (!empty($cliente_row->correo_electronico) ? $cliente_row->correo_electronico : set_value('correo_electronico'))) : set_value('correo_electronico'); ?>" required>
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
                                                                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha ingreso" value="<?php echo set_value('fecha_nacimiento') == false ? ((!empty($this->session->flashdata('fecha_nacimiento'))) ? $this->session->flashdata('fecha_nacimiento') : (!empty($cliente_row->fecha_nacimiento) ? date('Y-m-d', strtotime($cliente_row->fecha_nacimiento)) : set_value('fecha_nacimiento'))) : set_value('fecha_nacimiento'); ?>">
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
                                                                    <option value="" <?php echo set_select('estado_civil', '', set_value('estado_civil') ? false : '' == (!empty($this->session->flashdata('estado_civil')) ? $this->session->flashdata('estado_civil') : (!empty($cliente_row->estado_civil) ? $cliente_row->estado_civil : set_value('estado_civil')))); ?>>Seleccione una estatus de cliente…</option>
                                                                    <?php foreach (select_estado_civil() as $key => $estatus_cliente_row) : ?>
                                                                        <option value="<?php echo $estatus_cliente_row->valor; ?>" <?php echo set_select('estado_civil', $estatus_cliente_row->valor, set_value('estado_civil') ? false : $estatus_cliente_row->valor == (!empty($this->session->flashdata('estado_civil')) ? $this->session->flashdata('estado_civil') : (!empty($cliente_row->estado_civil) ? $cliente_row->estado_civil : set_value('estado_civil')))); ?>><?php echo trim($estatus_cliente_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un estado civil válido.
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
                                                                <input type="text" class="form-control" style="text-transform:uppercase;" name="curp" id="curp" placeholder="Correo electrónico" value="<?php echo strtoupper(set_value('curp') == false ? (!empty($this->session->flashdata('curp')) ? $this->session->flashdata('curp') : (!empty($cliente_row->curp) ? $cliente_row->curp : set_value('curp'))) : set_value('curp')); ?>">
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
                                                                <input type="number" class="form-control" name="ine" id="ine" placeholder="Correo electrónico" value="<?php echo strtoupper(set_value('ine') == false ? (!empty($this->session->flashdata('ine')) ? $this->session->flashdata('ine') : (!empty($cliente_row->ine) ? $cliente_row->ine : set_value('ine'))) : set_value('ine')); ?>">
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
                                                            <label class="col-lg-12" for="rfc">RFC</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" style="text-transform:uppercase;" name="rfc" id="rfc" placeholder="Correo electrónico" value="<?php echo strtoupper(set_value('rfc') == false ? (!empty($this->session->flashdata('rfc')) ? $this->session->flashdata('rfc') : (!empty($cliente_row->rfc) ? $cliente_row->rfc : set_value('rfc'))) : set_value('rfc')); ?>">
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
                                                            <label class="col-lg-12" for="domicilio_fiscal">Domicilio fiscal</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="domicilio_fiscal" id="domicilio_fiscal" placeholder="Domicilio fiscal" value="<?php echo set_value('domicilio_fiscal') == false ? (!empty($this->session->flashdata('domicilio_fiscal')) ? $this->session->flashdata('domicilio_fiscal') : (!empty($cliente_row->domicilio_fiscal) ? $cliente_row->domicilio_fiscal : set_value('domicilio_fiscal'))) : set_value('domicilio_fiscal'); ?>">
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
                                                                    <option value="" <?php echo set_select('como_se_entero', '', set_value('como_se_entero') ? false : '' == (!empty($this->session->flashdata('como_se_entero')) ? $this->session->flashdata('como_se_entero') : (!empty($cliente_row->como_se_entero) ? $cliente_row->como_se_entero : set_value('como_se_entero')))); ?>>Seleccione como se enteró…</option>
                                                                    <?php foreach (select_como_se_entero() as $key => $como_se_entero_row) : ?>
                                                                        <option value="<?php echo $como_se_entero_row->valor; ?>" <?php echo set_select('como_se_entero', $como_se_entero_row->valor, set_value('como_se_entero') ? false : $como_se_entero_row->valor == (!empty($this->session->flashdata('como_se_entero')) ? $this->session->flashdata('como_se_entero') : (!empty($cliente_row->como_se_entero) ? $cliente_row->como_se_entero : set_value('como_se_entero')))); ?>><?php echo trim($como_se_entero_row->nombre); ?></option>
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
                                                                    <option value="" <?php echo set_select('medio_contacto', '', set_value('medio_contacto') ? false : '' == (!empty($this->session->flashdata('medio_contacto')) ? $this->session->flashdata('medio_contacto') : (!empty($cliente_row->metodo_contacto) ? $cliente_row->metodo_contacto : set_value('medio_contacto')))); ?>>Seleccione como se enteró…</option>
                                                                    <?php foreach (select_medio_contacto() as $key => $medio_contacto_row) : ?>
                                                                        <option value="<?php echo $medio_contacto_row->valor; ?>" <?php echo set_select('medio_contacto', $medio_contacto_row->valor, set_value('medio_contacto') ? false : $medio_contacto_row->valor == (!empty($this->session->flashdata('medio_contacto')) ? $this->session->flashdata('medio_contacto') : (!empty($cliente_row->metodo_contacto) ? $cliente_row->metodo_contacto : set_value('medio_contacto')))); ?>><?php echo trim($medio_contacto_row->nombre); ?></option>
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
                                                                    <option value="" <?php echo set_select('desarrollo_interes_identificador', '', set_value('desarrollo_interes_identificador') ? false : '' == (!empty($this->session->flashdata('desarrollo_interes_identificador')) ? $this->session->flashdata('desarrollo_interes_identificador') : (!empty($cliente_row->desarrollo_interes_identificador) ? $cliente_row->desarrollo_interes_identificador : set_value('desarrollo_interes_identificador')))); ?>>Seleccione un desarrollo de interés…</option>
                                                                    <?php foreach ($desarrollos_interes_list as $desarrollo_interes_key => $desarrollo_interes_value) : ?>
                                                                        <?php if ($desarrollo_interes_value->estatus != 'suspendido') : ?>
                                                                            <option value="<?php echo $desarrollo_interes_value->identificador; ?>" <?php echo set_select('desarrollo_interes_identificador', $desarrollo_interes_value->identificador, set_value('desarrollo_interes_identificador') ? false : $desarrollo_interes_value->identificador == (!empty($this->session->flashdata('desarrollo_interes_identificador')) ? $this->session->flashdata('desarrollo_interes_identificador') : (!empty($cliente_row->desarrollo_interes_identificador) ? $cliente_row->desarrollo_interes_identificador : set_value('desarrollo_interes_identificador')))); ?>><?php echo trim(mb_strtoupper($desarrollo_interes_value->nombre)); ?></option>
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
                                                            <label class="col-lg-12 required-field" for="estatus_cliente">Estatus de cliente</label>
                                                            <div class="col-lg-12">
                                                                <select id="estatus_cliente" name="estatus_cliente" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('estatus_cliente', '', set_value('estatus_cliente') ? false : '' == (!empty($this->session->flashdata('estatus_cliente')) ? $this->session->flashdata('estatus_cliente') : (!empty($cliente_row->estatus_cliente) ? $cliente_row->estatus_cliente : set_value('estatus_cliente')))); ?>>Seleccione una estatus de cliente…</option>
                                                                    <?php foreach (select_estatus_cliente() as $key => $estatus_cliente_row) : ?>
                                                                        <option value="<?php echo $estatus_cliente_row->valor; ?>" <?php echo set_select('estatus_cliente', $estatus_cliente_row->valor, set_value('estatus_cliente') ? false : $estatus_cliente_row->valor == (!empty($this->session->flashdata('estatus_cliente')) ? $this->session->flashdata('estatus_cliente') : (!empty($cliente_row->estatus_cliente) ? $cliente_row->estatus_cliente : set_value('estatus_cliente')))); ?>><?php echo trim($estatus_cliente_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un estatus de cliente válido.
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
                                                            <label class="col-lg-12">Agregar nota</label>
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

                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 col-sm-12 mb-1">
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12 mb-1">

                                                    <div class="list-group">
                                                        <div class="list-group-item flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="text-bold-600">Notas</h5>
                                                                <a class="btn btn-outline-secondary btn-sm" href="<?php echo "javascript:agregar_nota('$cliente_row->identificador')"; ?>">Agregar</a>
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