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

                <div class="media float-right">
                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <?php if ($cliente_row) : ?>
                                <a class="btn btn-outline-info" href="<?php echo site_url('site/pdf_generar/index/' . $cliente_row->identificador . '/' . $inmueble_row->identificador . '/' . $proceso_venta_row->identificador); ?>" target="_blank">Ver contrato en PDF</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

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
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/' . ($desarrollo_row->nombre == 'andeza' ? 'contrato' : ($desarrollo_row->nombre == 'portamar' ? 'contrato_portamar' : '')) . '/' . $inmueble_row->identificador); ?>"><b>3. Contrato</b></a></li>
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
                                        <b><?php echo mb_strtoupper($inmueble_row->nombre); ?></b>
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

                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>
                <?php if ($proceso_venta_row) : ?>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <!-- Predefined Views -->
                            <div class="card">
                                <div class="card-header">

                                    <?php echo form_open(uri_string(), array('class' => 'needs-validation', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>
                                    <input type="hidden" class="form-control" name="identificador" id="identificador" placeholder="identificador" value="<?php echo $inmueble_row->identificador; ?>" readonly required>
                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-outline-secondary btn-min-width mr-1"><i class="fa fa-check-circle"></i>&nbsp;Guardar datos</button>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                            <h4><b>Datos del cliente</b></h4>
                                            <hr>
                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="nombre">Nombre (Persona física)</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre') == false ? (!empty($this->session->flashdata('nombre')) ? $this->session->flashdata('nombre') : (!empty($cliente_row->nombre) ? ucwords($cliente_row->nombre) : set_value('nombre'))) : set_value('nombre'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un nombre o razón social válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="apellido_paterno">Apellido paterno (Persona física)</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido paterno" value="<?php echo set_value('apellido_paterno') == false ? (!empty($this->session->flashdata('apellido_paterno')) ? $this->session->flashdata('apellido_paterno') : (!empty($cliente_row->apellido_paterno) ? ucwords($cliente_row->apellido_paterno) : set_value('apellido_paterno'))) : set_value('apellido_paterno'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un apellido paterno válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="apellido_materno">Apellido materno (Persona física)</label>
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

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="nombre_representante_legal">Nombre representante legal (Persona moral)</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="nombre_representante_legal" id="nombre_representante_legal" placeholder="Nombre representante legal" value="<?php echo set_value('nombre_representante_legal') == false ? (!empty($this->session->flashdata('nombre_representante_legal')) ? $this->session->flashdata('nombre_representante_legal') : (!empty($cliente_row->nombre_representante_legal) ? ucwords($cliente_row->nombre_representante_legal) : set_value('nombre_representante_legal'))) : set_value('nombre_representante_legal'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un Nombre representante legal válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="apellido_representante_legal">Apellido representante legal (Persona moral)</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="apellido_representante_legal" id="apellido_representante_legal" placeholder="Apellido representante legal" value="<?php echo set_value('apellido_representante_legal') == false ? (!empty($this->session->flashdata('apellido_representante_legal')) ? $this->session->flashdata('apellido_representante_legal') : (!empty($cliente_row->apellido_representante_legal) ? ucwords($cliente_row->apellido_representante_legal) : set_value('apellido_representante_legal'))) : set_value('apellido_representante_legal'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un Apellido representante legal válido.
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
                                                        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha de nacimiento" value="<?php echo set_value('fecha_nacimiento') == false ? ((!empty($this->session->flashdata('fecha_nacimiento'))) ? $this->session->flashdata('fecha_nacimiento') : (!empty($cliente_row->fecha_nacimiento) ? date('Y-m-d', strtotime($cliente_row->fecha_nacimiento)) : set_value('fecha_nacimiento'))) : set_value('fecha_nacimiento'); ?>">
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
                                                    <label class="col-lg-12" for="contrato_cliente_fecha_nacimiento_letra">Fecha de nacimiento del cliente con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_cliente_fecha_nacimiento_letra" id="contrato_cliente_fecha_nacimiento_letra" rows="4" maxlength="240" placeholder="Fecha de nacimiento del cliente con letra"><?php echo set_value('contrato_cliente_fecha_nacimiento_letra') == false ? ((!empty($this->session->flashdata('contrato_cliente_fecha_nacimiento_letra'))) ? strval($this->session->flashdata('contrato_cliente_fecha_nacimiento_letra')) : ((!empty($contrato_row->cliente_fecha_nacimiento_letra)) ? mb_strtoupper($contrato_row->cliente_fecha_nacimiento_letra) : set_value('contrato_cliente_fecha_nacimiento_letra'))) : set_value('contrato_cliente_fecha_nacimiento_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere un Fecha de nacimiento del cliente con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_cliente_nacionalidad">Nacionalidad</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="contrato_cliente_nacionalidad" id="contrato_cliente_nacionalidad" placeholder="Nacionalidad" value="<?php echo set_value('contrato_cliente_nacionalidad') == false ? (!empty($this->session->flashdata('contrato_cliente_nacionalidad')) ? $this->session->flashdata('contrato_cliente_nacionalidad') : (!empty($cliente_row->contrato_cliente_nacionalidad) ? ucwords($cliente_row->contrato_cliente_nacionalidad) : set_value('contrato_cliente_nacionalidad'))) : set_value('contrato_cliente_nacionalidad'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un Fecha de nacimiento del cliente con letra válido.
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
                                                            <option value="" <?php echo set_select('estado_civil', '', set_value('estado_civil') ? false : '' == (!empty($this->session->flashdata('estado_civil')) ? $this->session->flashdata('estado_civil') : (!empty($cliente_row->estado_civil) ? $cliente_row->estado_civil : set_value('estado_civil')))); ?>>Seleccione una estado civil…</option>
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
                                                        <input type="text" class="form-control" style="text-transform:uppercase;" name="curp" id="curp" placeholder="CURP" value="<?php echo set_value('curp') == false ? (!empty($this->session->flashdata('curp')) ? $this->session->flashdata('curp') : (!empty($cliente_row->curp) ? $cliente_row->curp : set_value('curp'))) : set_value('curp'); ?>">
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
                                                        <input type="number" class="form-control" name="ine" id="ine" placeholder="INE" value="<?php echo set_value('ine') == false ? (!empty($this->session->flashdata('ine')) ? $this->session->flashdata('ine') : (!empty($cliente_row->ine) ? $cliente_row->ine : set_value('ine'))) : set_value('ine'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un INE válido.
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
                                                        <input type="text" class="form-control" style="text-transform:uppercase;" name="rfc" id="rfc" placeholder="RFC" value="<?php echo set_value('rfc') == false ? (!empty($this->session->flashdata('rfc')) ? $this->session->flashdata('rfc') : (!empty($cliente_row->rfc) ? $cliente_row->rfc : set_value('rfc'))) : set_value('rfc'); ?>">
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
                                                    <label class="col-lg-12" for="correo_electronico">Correo electrónico</label>
                                                    <div class="col-lg-12">
                                                        <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico" value="<?php echo set_value('correo_electronico') == false ? (!empty($this->session->flashdata('correo_electronico')) ? $this->session->flashdata('correo_electronico') : (!empty($cliente_row->correo_electronico) ? $cliente_row->correo_electronico : set_value('correo_electronico'))) : set_value('correo_electronico'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un correo electrónico válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                                            <h4><b>Datos del inmueble</b></h4>
                                            <hr>
                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="inmueble_nombre">Nombre inmueble</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="inmueble_nombre" id="inmueble_nombre" placeholder="Nombre inmueble" value="<?php echo set_value('inmueble_nombre') == false ? (!empty($this->session->flashdata('inmueble_nombre')) ? $this->session->flashdata('inmueble_nombre') : (!empty($inmueble_row->nombre) ? ucwords($inmueble_row->nombre) : set_value('inmueble_nombre'))) : set_value('inmueble_nombre'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un Nombre inmueble válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_inmueble_nombre_letra">Nombre inmueble con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_inmueble_nombre_letra" id="contrato_inmueble_nombre_letra" rows="4" maxlength="240" placeholder="Nombre inmueble con letra"><?php echo set_value('contrato_inmueble_nombre_letra') == false ? ((!empty($this->session->flashdata('contrato_inmueble_nombre_letra'))) ? strval($this->session->flashdata('contrato_inmueble_nombre_letra')) : ((!empty($contrato_row->inmueble_nombre_letra)) ? mb_strtoupper($contrato_row->inmueble_nombre_letra) : set_value('contrato_inmueble_nombre_letra'))) : set_value('contrato_inmueble_nombre_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere un nombre inmueble con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="inmueble_tamanho_construccion">Superficie construcción número</label>
                                                    <div class="col-lg-12">
                                                        <input type="number" class="form-control" name="inmueble_tamanho_construccion" id="inmueble_tamanho_construccion" placeholder="Superficie construcción" value="<?php echo set_value('inmueble_tamanho_construccion') == false ? (!empty($this->session->flashdata('inmueble_tamanho_construccion')) ? $this->session->flashdata('inmueble_tamanho_construccion') : (!empty($inmueble_row->tamanho_construccion) ? $inmueble_row->tamanho_construccion : set_value('inmueble_tamanho_construccion'))) : set_value('inmueble_tamanho_construccion'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un tamaño construcción válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_inmueble_tamanho_construccion_letra">Superficie de construcción con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_inmueble_tamanho_construccion_letra" id="contrato_inmueble_tamanho_construccion_letra" rows="4" maxlength="240" placeholder="Tamaño de construcción con letra"><?php echo set_value('contrato_inmueble_tamanho_construccion_letra') == false ? ((!empty($this->session->flashdata('contrato_inmueble_tamanho_construccion_letra'))) ? strval($this->session->flashdata('contrato_inmueble_tamanho_construccion_letra')) : ((!empty($contrato_row->inmueble_tamanho_construccion_letra)) ? mb_strtoupper($contrato_row->inmueble_tamanho_construccion_letra) : set_value('contrato_inmueble_tamanho_construccion_letra'))) : set_value('contrato_inmueble_tamanho_construccion_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere unn tamaño de construcción con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="inmueble_tamanho_terraza">Superficie terraza número</label>
                                                    <div class="col-lg-12">
                                                        <input type="number" class="form-control" name="inmueble_tamanho_terraza" id="inmueble_tamanho_terraza" placeholder="Superficie terraza" value="<?php echo set_value('inmueble_tamanho_terraza') == false ? (!empty($this->session->flashdata('inmueble_tamanho_terraza')) ? $this->session->flashdata('inmueble_tamanho_terraza') : (!empty($inmueble_row->tamanho_terraza) ? $inmueble_row->tamanho_terraza : set_value('inmueble_tamanho_terraza'))) : set_value('inmueble_tamanho_terraza'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un tamaño terraza válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_inmueble_tamanho_terraza_letra">Superficie de terraza con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_inmueble_tamanho_terraza_letra" id="contrato_inmueble_tamanho_terraza_letra" rows="4" maxlength="240" placeholder="Tamaño de terraza con letra"><?php echo set_value('contrato_inmueble_tamanho_terraza_letra') == false ? ((!empty($this->session->flashdata('contrato_inmueble_tamanho_terraza_letra'))) ? strval($this->session->flashdata('contrato_inmueble_tamanho_terraza_letra')) : ((!empty($contrato_row->inmueble_tamanho_terraza_letra)) ? mb_strtoupper($contrato_row->inmueble_tamanho_terraza_letra) : set_value('contrato_inmueble_tamanho_terraza_letra'))) : set_value('contrato_inmueble_tamanho_terraza_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere un tamaño de terraza con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="inmueble_tamanho_total">Superficie total número</label>
                                                    <div class="col-lg-12">
                                                        <input type="number" class="form-control" name="inmueble_tamanho_total" id="inmueble_tamanho_total" placeholder="Superficie total" value="<?php echo set_value('inmueble_tamanho_total') == false ? (!empty($this->session->flashdata('inmueble_tamanho_total')) ? $this->session->flashdata('inmueble_tamanho_total') : (!empty($inmueble_row->tamanho_total) ? $inmueble_row->tamanho_total : set_value('inmueble_tamanho_total'))) : set_value('inmueble_tamanho_total'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un tamaño total válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_inmueble_tamanho_total_letra">Superficie total con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_inmueble_tamanho_total_letra" id="contrato_inmueble_tamanho_total_letra" rows="4" maxlength="240" placeholder="Tamaño total con letra"><?php echo set_value('contrato_inmueble_tamanho_total_letra') == false ? ((!empty($this->session->flashdata('contrato_inmueble_tamanho_total_letra'))) ? strval($this->session->flashdata('contrato_inmueble_tamanho_total_letra')) : ((!empty($contrato_row->inmueble_tamanho_total_letra)) ? mb_strtoupper($contrato_row->inmueble_tamanho_total_letra) : set_value('contrato_inmueble_tamanho_total_letra'))) : set_value('contrato_inmueble_tamanho_total_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere un tamaño total con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_inmueble_cajon_estacionamiento_numero">No. cajones de estacionamiento con número</label>
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" name="contrato_inmueble_cajon_estacionamiento_numero" id="contrato_inmueble_cajon_estacionamiento_numero" placeholder="Cajón de estacionamiento número" value="<?php echo set_value('contrato_inmueble_cajon_estacionamiento_numero') == false ? (!empty($this->session->flashdata('contrato_inmueble_cajon_estacionamiento_numero')) ? $this->session->flashdata('contrato_inmueble_cajon_estacionamiento_numero') : (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? mb_strtoupper($contrato_row->inmueble_cajon_estacionamiento_numero) : set_value('contrato_inmueble_cajon_estacionamiento_numero'))) : set_value('contrato_inmueble_cajon_estacionamiento_numero'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un cajón de estacionamiento con número válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_inmueble_cajon_estacionamiento_letra">No. cajones de estacionamiento con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_inmueble_cajon_estacionamiento_letra" id="contrato_inmueble_cajon_estacionamiento_letra" rows="4" maxlength="240" placeholder="No. cajones de estacionamiento con letra"><?php echo set_value('contrato_inmueble_cajon_estacionamiento_letra') == false ? ((!empty($this->session->flashdata('contrato_inmueble_cajon_estacionamiento_letra'))) ? strval($this->session->flashdata('contrato_inmueble_cajon_estacionamiento_letra')) : ((!empty($contrato_row->inmueble_cajon_estacionamiento_letra)) ? mb_strtoupper($contrato_row->inmueble_cajon_estacionamiento_letra) : set_value('contrato_inmueble_cajon_estacionamiento_letra'))) : set_value('contrato_inmueble_cajon_estacionamiento_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere un cajón de estacionamiento con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                                            <h4><b>Datos del proceso de venta</b></h4>
                                            <hr>
                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="proceso_venta_precio_venta">Precio de venta número</label>
                                                    <div class="col-lg-12">
                                                        <input type="number" class="form-control" name="proceso_venta_precio_venta" id="proceso_venta_precio_venta" placeholder="Precio de venta número" value="<?php echo set_value('proceso_venta_precio_venta') == false ? (!empty($this->session->flashdata('proceso_venta_precio_venta')) ? $this->session->flashdata('proceso_venta_precio_venta') : (!empty($proceso_venta_row->precio_venta) ? $proceso_venta_row->precio_venta : set_value('proceso_venta_precio_venta'))) : set_value('proceso_venta_precio_venta'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere un precio de venta válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_proceso_venta_precio_venta_letra">Precio de venta con letra</label>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="contrato_proceso_venta_precio_venta_letra" id="contrato_proceso_venta_precio_venta_letra" rows="4" maxlength="240" placeholder="Precio de venta con letra"><?php echo set_value('contrato_proceso_venta_precio_venta_letra') == false ? ((!empty($this->session->flashdata('contrato_proceso_venta_precio_venta_letra'))) ? strval($this->session->flashdata('contrato_proceso_venta_precio_venta_letra')) : ((!empty($contrato_row->proceso_venta_precio_venta_letra)) ? mb_strtoupper($contrato_row->proceso_venta_precio_venta_letra) : set_value('contrato_proceso_venta_precio_venta_letra'))) : set_value('contrato_proceso_venta_precio_venta_letra'); ?></textarea>
                                                        <div class="invalid-feedback">
                                                            Se requiere unn precio de venta con letra válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-2">
                                            <h4><b>Datos del contrato</b></h4>
                                            <hr>
                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-lg-12" for="contrato_fecha_contrato">Fecha contrato</label>
                                                    <div class="col-lg-12">
                                                        <input type="date" class="form-control" name="contrato_fecha_contrato" id="contrato_fecha_contrato" placeholder="Fecha contrato" value="<?php echo set_value('contrato_fecha_contrato') == false ? ((!empty($this->session->flashdata('contrato_fecha_contrato'))) ? strval($this->session->flashdata('contrato_fecha_contrato')) : (!empty($contrato_row->fecha_contrato) ? date('Y-m-d', strtotime($contrato_row->fecha_contrato)) : set_value('contrato_fecha_contrato'))) : set_value('contrato_fecha_contrato'); ?>">
                                                        <div class="invalid-feedback">
                                                            Se requiere una fecha contrato válido.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-2 mb-2">
                                            <h4><b>Nota</b></h4>
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

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <hr>
                                            <div class="form-group col-6">
                                                <button type="submit" class="btn btn-outline-secondary btn-min-width mr-1"><i class="fa fa-check-circle"></i>&nbsp;Guardar datos</button>
                                            </div>
                                            <?php foreach ($contrato_list as $key => $contrato_value) :
                                                if (($contrato_value->inmueble_identificador == $inmueble_row->identificador) && ($contrato_value->proceso_venta_identificador == $proceso_venta_row->identificador) && ($contrato_value->cliente_identificador == $cliente_row->identificador)) : ?>
                                                    <div class="form-group col-6">
                                                        <a class="btn btn-outline-info btn-min-width" href="<?php echo site_url('site/inmuebles/guardar_tabla_deber_ser/' . $inmueble_row->identificador); ?>">Guardar tabla para contrato</a>
                                                    </div>
                                            <?php endif;
                                            endforeach; ?>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <!--/ Predefined Views -->
                        </div>

                        <div class="col-sm-9 col-xs-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body card-contrato">

                                        <div class="row match-height mt-2">
                                            <div class="col-xl-1 col-md-1 col-sm-12">
                                            </div>
                                            <div class="col-xl-10 col-md-10 col-sm-12 car-contrato" id="contrato" style="text-align: justify;">
                                                <p><strong>CONTRATO PRIVADO DE COMPRAVENTA A PLAZOS CON RESERVA DE DOMINIO QUE CELEBRAN POR UNA PARTE LA PERSONA MORAL DENOMINADA “CONSTRUCTORA ANJUMI”, S.A. DE C.V., REPRESENTADA EN ESTE ACTO POR SU APODERADO LEGAL, EL SEÑOR HUGO HERNÁNDEZ PÉREZ, DENOMINADO PARA EFECTOS DEL PRESENTE CONTRATO COMO EL “VENDEDOR”, Y POR OTRA PARTE POR SU PROPIO DERECHO <strong><span class="text-info contrato-variable" name="campo_nombre_completo_1" id="campo_nombre_completo_1" style="color: #3bafda"><?php echo (!empty($cliente_row->nombre) ? mb_strtoupper(trim($cliente_row->nombre)) : ''); ?> <?php echo (!empty($cliente_row->apellido_paterno) ? mb_strtoupper(trim($cliente_row->apellido_paterno)) : ''); ?> <?php echo (!empty($cliente_row->apellido_materno) ? mb_strtoupper(trim($cliente_row->apellido_materno)) : ''); ?></span></strong>, DENOMINADO EN LO SUCESIVO COMO EL “COMPRADOR”, QUIENES SE SUJETAN AL TENOR DE LAS SIGUIENTES DENOMINACIONES, DECLARACIONES Y CLÁUSULAS.</strong></p>
                                                <p class="text-center" style="text-align: center;"><strong>D E N O M I N A C I O N E S</strong></p>
                                                <ol type="A">
                                                    <li>Cuando el presente se refiera al <strong>“VENDEDOR”</strong>, se entenderá con ello a la persona moral <strong>“CONSTRUCTORA ANJUMI”, S.A. DE C.V.</strong></li>
                                                    <li>Cuando el presente se refiera al <strong>“COMPRADOR”</strong>, se entenderá con ello al C. <span class="text-info contrato-variable" name="campo_nombre_completo_2" id="campo_nombre_completo_2" style="color: #3bafda"><?php echo (!empty($cliente_row->nombre) ? mb_strtoupper(trim($cliente_row->nombre)) : ''); ?> <?php echo (!empty($cliente_row->apellido_paterno) ? mb_strtoupper(trim($cliente_row->apellido_paterno)) : ''); ?> <?php echo (!empty($cliente_row->apellido_materno) ? mb_strtoupper(trim($cliente_row->apellido_materno)) : ''); ?></span>.</li>
                                                    <li>Cuando el presente se refiera a el <strong>“INMUEBLE”</strong>, se entenderá con ello al inmueble tipo lote de terreno, identificado con el numero<strong><span class="text-info contrato-variable" name="campo_nombre_inmueble_1" id="campo_nombre_inmueble_1" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span></strong>, perteneciente a la fracción 02, subdivición de la fusión de lotes 7 y 23 Z-1 P1/1, Ejido Mandinga y Matoza, Municipio de Alvarado, Veracruz Ignacio de la Llave. </li>
                                                    <ol type="A" start="3">
                                                        <li>1. El inmueble identificado como el lote número <span class="text-info contrato-variable" name="campo_nombre_inmueble_2" id="campo_nombre_inmueble_2" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span>, con una superficie de: <span class="text-info contrato-variable" name="campo_tamanio_1" id="campo_tamanio_1" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_total) ? trim($contrato_row->tamanho_total) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_total_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_total_letra)) : ''); ?> <?php echo (!empty($contrato_row->tamanho_terraza) ? trim($contrato_row->tamanho_terraza) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_terraza_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_terraza_letra)) : ''); ?></span> de interiores, <span class="text-info contrato-variable" name="campo_construccion_1" id="campo_construccion_1" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_construccion) ? trim($contrato_row->tamanho_construccion) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_construccion_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_construccion_letra)) : ''); ?></span> de terraza, con <span class="text-info contrato-variable" name="campo_cajon_estacionamiento_2" id="campo_cajon_estacionamiento_2" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? trim($contrato_row->inmueble_cajon_estacionamiento_numero) : ''); ?> <?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_letra) ? mb_strtoupper(trim($contrato_row->inmueble_cajon_estacionamiento_letra)) : ''); ?></span> cajones de estacionamiento, los cuales serán asignados por la administración. </li>
                                                    </ol>
                                                </ol>
                                                <p>Las medidas y ubicación del INMUEBLE se detallan en el plano arquitectónico que se adjunta al presente contrato como <strong>Anexo A.</strong></p>
                                                <p class="text-center" style="text-align: center;"><strong>D E C L A R A C I O N E S</strong></p>
                                                <p><strong>I. POR PARTE DE “VENDEDOR”, QUE: </strong></p>
                                                <p><strong>I.1.</strong>Es una Sociedad Mercantil legalmente constituida conforme a las leyes mexicanas como se desprende de la Escritura Pública, 26,949 (veintiséis mil novecientos cuarenta y nueve), Volumen 707 (setecientos siete) de fecha 1° (primero) de diciembre del año 2016 (dos mil dieciséis), otorgada ante la fe del licenciado Arturo Hernández Reynante, Notario Público número 09 (nueve), de la ciudad de Xalapa - Enríquez, estado de Veracruz. Inscrita bajo el folio mercantil electrónico número <strong>N-2017020636</strong>, de fecha 09 (nueve) de marzo del año 2017 (dos mil diecisiete).</p>
                                                <p>Se encuentra debidamente inscrita en la Administración Tributaria de la Secretaría de Hacienda y Crédito Público, con Registro Federal de Contribuyentes <strong>CAN161201F34.</strong></p>
                                                <p><strong>I.2.</strong> Su representante cuenta con la representación legal y facultades suficientes para obligarla mediante la celebración del presente contrato como lo acredita con el instrumento descrito en el inciso anterior, personalidad y facultades que no le han sido revocadas, ni modificadas o restringidas, y se identifica con la Credencial de elector con número de OCR 1246062274198. </p>
                                                <p><strong>I.3. </strong>Es legítimo propietario del inmueble identificado como fracción de terreno que resultó de la subdivisión de la fracción de terreno resultante de la fusión de los lotes 23 Z-1 P1/1 (veintitrés “Z” guión uno “P”, uno, diagonal, uno), 7Z-1P1/1 (siete “Z” guión uno “P” uno diagonal uno), ubicados en el ejido Mandinga y Matoza, municipio de Alvarado, Veracruz Ignacio de la Llave, con una superficie de 143,360.84 m² (ciento cuarenta y tres mol trescientos sesenta metros, ochenta y cuatro decímetros cuadrados) tal como lo acredita con Escritura Pública Volumen 722 (setecientos veintidós), Instrumento Número 27,830 (veintisiete mil ochocientos treinta), de fecha 23 (veintitrés) de agosto del año 2017 (dos mil diecisiete), otorgada ante la fe del licenciado Arturo Hernández Reynante, Notario Público número 09 (nueve), de la ciudad de Xalapa - Enríquez , estado de Veracruz. Inscrita bajo el número 13,412 (trece mil cuatrocientos doce), Volumen 671 (seiscientos setenta y uno) de la sección Primera, de fecha 07 (siete) de diciembre del 2017 (dos mil diecisiete), inmueble sobre el cual el "VENDEDOR", construirá un Fraccionamiento, en el cual, cada lote contará con la infraestructura necesaria para el adecuado funcionamiento de los servicios de suministro de energía eléctrica, agua potable, drenaje y alcantarillado, y demás obras de equipamiento urbano, así como las especificaciones de seguridad y clase de materiales utilizados en la construcción de la misma.</p>
                                                <p><strong>I.4. </strong>Que es materia del presente contrato privado de compraventa con reserva de dominio, el inmueble tipo lote de terreno, identificado con el número <span class="text-info contrato-variable" name="campo_nombre_inmueble_3" id="campo_nombre_inmueble_3" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span> perteneceinte a la fracción de terreno que resultó de la subdivisión de la fracción de terreno resultante de la fusión de los lotes 23 Z-1 P1/1 (veintitrés “Z” guión uno “P”, uno, diagonal, uno), 7Z-1P1/1 (siete “Z” guión uno “P” uno diagonal uno), ubicados en el ejido Mandinga y Matoza, municipio de Alvarado, Veracruz Ignacio de la Llave, “INMUEBLE”; mismo que se ubica en el lugar que señala el plano que a la presente se acompaña como Anexo A, el cual en adelante y para los efectos de este contrato se identificarán como el “INMUEBLE”. <br> “LAS PARTES” acuerdan que la numeración en donde se ubique el “INMUEBLE” materia de esta compraventa podrá ser sujeta a modificación única y exclusivamente en su numeración de conformidad a lo que señale las autoridades competentes, al momento de expedir la licencia de uso de suelo y demás documentos; lo anterior sin que afecte la altura y ubicación de los lotes contratados. </p>
                                                <p><strong>I.5. </strong>Que es su deseo celebrar el presente contrato con el “COMPRADOR”, conforme a los términos aquí consignados. </p>
                                                <p><strong>I.6. </strong>Para los efectos de este contrato señala como domicilio el ubicado en <strong>Calzada Zavaleta número 1108 (mil ciento ocho), interior 102 (ciento dos), Santa Cruz Buena vista, Puebla, Puebla, C.P. 72150.</strong> </p>
                                                <p><strong>II. POR PARTE DEL “COMPRADOR”, QUE: </strong></p>
                                                <p><strong>II.1. </strong>Ser una persona física en pleno goce de sus facultades, que nació el dia <span class="text-info contrato-variable" style="color: #3bafda"><?php echo !empty($contrato_row->cliente_fecha_nacimiento_letra) ? mb_strtoupper($contrato_row->cliente_fecha_nacimiento_letra) : ''; ?></span>, de nacionalidad <span class="text-info contrato-variable" style="color: #3bafda"><?php echo !empty($contrato_row->cliente_nacionalidad) ? mb_strtoupper($contrato_row->cliente_nacionalidad) : ''; ?></span>, quien cuenta con Clave Única de Registro de Población (CURP) <span class="text-info contrato-variable" name="campo_curp_1" id="campo_curp_1" style="color: #3bafda"><?php echo (!empty($cliente_row->curp) ? mb_strtoupper(trim($cliente_row->curp)) : ''); ?></span>, con estado civil <span class="text-info contrato-variable" name="campo_estado_civil_1" id="campo_estado_civil_1" style="color: #3bafda"><?php echo (!empty($cliente_row->estado_civil) ? mb_strtoupper(trim($cliente_row->estado_civil)) : ''); ?></span>, y que cuenta con capacidad legal y económica para celebrar el presente contrato y obligarse en los términos del mismo, quien se identifica con su credencial para votar número de OCR <span class="text-info contrato-variable" name="campo_ine_1" id="campo_ine_1" style="color: #3bafda"><?php echo (!empty($cliente_row->ine) ? trim($cliente_row->ine) : ''); ?></span> expedida por el Instituto Nacional Electoral, documento que contiene su fotografía y su firma. </p>
                                                <p><strong>II.2. </strong>Se encuentra debidamente inscrita en el Registro Federal de Contribuyentes con clave <span class="text-info contrato-variable" name="campo_rf_1" id="campo_rf_1" style="color: #3bafda"><?php echo (!empty($cliente_row->rfc) ? mb_strtoupper(trim($cliente_row->rfc)) : ''); ?></span>. Documento que se adjunta en copia simple al presente contrato.</p>
                                                <p><strong>II.3. </strong>Señala como su domicilio para el cumplimiento de las obligaciones derivadas de este contrato, el ubicado en <span class="text-info contrato-variable" name="campo_domicilio_fiscal_1" id="campo_domicilio_fiscal_1" style="color: #3bafda"><?php echo (!empty($cliente_row->domicilio_fiscal) ? mb_strtoupper(trim($cliente_row->domicilio_fiscal)) : ''); ?></span></p>
                                                <p><strong>II.4.</strong> Que conoce el estado actual del inmueble materia del presente contrato, y que al momento de la escrituración deberá estar libre de todo gravamen de carácter civil, fiscal o administrativo.</p>
                                                <p><strong>II.5.</strong> Reconoce y acepta que el Inmueble, estará afecto al régimen de propiedad en condominio y en consecuencia, acepta dicha propiedad limitada, en los términos de la ley respectiva.</p>
                                                <p><strong>II.6.</strong> Así mismo acepta que <strong>“INMUEBLE”</strong> que adquirirá tendrán su administración en lo particular; misma que estará regida por un Reglamento General en el que se establecerán los derechos y obligaciones que tienen los condóminos en su unidad y con el mantenimiento del complejo en general.</p>
                                                <p><strong>II.7.</strong> Bajo protesta de decir verdad, que conoce la responsabilidad que para todos los efectos legales se refiere la LEY NACIONAL DE EXTINCIÓN DE DOMINIO publicada en el Diario Oficial de la Federación; por lo que manifiesta que “INMUEBLE” que se sujeta a este contrato no es, ni será instrumento, objeto producto de algún delito; tampoco será utilizada o destinada a ocultar bienes del producto de algún delito; y que si son utilizados para la utilización de un delito, el “VENDEDOR” no tiene conocimiento de dicho ilícito, relevándolo en su caso de cualquier responsabilidad.</p>
                                                <p>El <strong>“COMPRADOR”</strong> estará obligado a hacer del conocimiento a la autoridad competente, en la que externe expresamente que <strong>“INMUEBLE”</strong> se enajeno de <strong>“BUENA FE”</strong>, y que en los actos en donde se vea involucrado el <strong>“INMUEBLE”</strong>, no existe conocimiento y/o participación por parte del <strong>“VENDEDOR”</strong>. Debiendo el <strong>“COMPRADOR”</strong> proporcionar información al <strong>“VENDEDOR”</strong> de tal denuncia y/o carpeta de investigación.</p>
                                                <p>El <strong>“COMPRADOR”</strong> bajo protesta de decir verdad manifiesta: Que los recursos que destina y/o destinará al pago de <strong>“INMUEBLE”</strong>, proviene y/o provendrán de fuentes lícitas.</p>
                                                <p>El <strong>“COMPRADOR”</strong> se obliga a pagar todos los gastos legales y honorarios de abogados, así como a indemnizar y sacar en paz y a salvo al <strong>“VENDEDOR”</strong>, para el caso de que por la comisión de algún delito sea imputable al <strong>“COMPRADOR”</strong> o a cualquiera de sus funcionarios, factores, empleados, trabajadores, prestadores de servicios, visitantes, clientes o a cualquier persona que el <strong>“COMPRADOR”</strong> hubiere permitido el acceso a <strong>“INMUEBLE”</strong>, procediese la extinción del dominio respecto de <strong>“INMUEBLE”</strong>.</p>
                                                <p>“LAS PARTES” pactan que será causa de rescisión del contrato, sin necesidad de declaración judicial, cualquier indagatoria o carpeta de investigación derivada que ocurra: el solo hecho de que “INMUEBLE” sea resguardado, relacionado, investigado o asegurado por cualquier autoridad derivado de la sospecha o comprobación de la comisión de delitos consumados o intentados dentro o fuera de “INMUEBLE”, cometidos por el “COMPRADOR” o por cualquier persona a la que el “COMPRADOR” o quien haya intervenido y se le haya permitido la entrada a “INMUEBLE” que pudiera ser constitutivo de delitos previsto en la “Ley Nacional de Extinción de Dominio”.</p>
                                                <p><strong>“LAS PARTES”</strong> pactan que será causa de rescisión del contrato, sin necesidad de declaración judicial, cualquier indagatoria o carpeta de investigación derivada que ocurra: el solo hecho de que <strong>“INMUEBLE”</strong> sea resguardado, relacionado, investigado o asegurado por cualquier autoridad derivado de la sospecha o comprobación de la comisión de delitos consumados o intentados dentro o fuera de <strong>“INMUEBLE”,</strong> cometidos por el <strong>“PROMITENTE COMPRADOR”</strong> o por cualquier persona a la que el <strong>“COMPRADOR”</strong> o por cualquier persona a la que el <strong>“COMPRADOR”</strong> o quien haya intervenido y se le haya permitido la entrada a <strong>“INMUEBLE”</strong> que pudiera ser constitutivo de delitos previsto en la <strong>“Ley Nacional de Extinción de Dominio”</strong>.</p>
                                                <p><strong>II.8.</strong> Desea obligarse a celebrar este contrato con el <strong>“VENDEDOR”,</strong> por medio del cual adquiera <strong>“INMUEBLE”</strong> en los términos y condiciones aquí establecidas:</p>
                                                <p><strong>III. POR PARTE DE “LAS PARTES”, QUE: </strong></p>
                                                <p><strong>III.1. </strong> Es su voluntad celebrar el presente contrato privado compraventa a plazos, con reserva de domino.</p>
                                                <p><strong>III.2. </strong>Se reconocen recíprocamente la personalidad con la que comparecen, mismas que no les han sido revocadas, modificadas o limitada de modo alguno, reconociendo en el mismo tenor la capacidad para obligarse y contratar, y expresando en consecuencia su voluntad de celebrar el presente contrato, en los términos y condiciones que enseguida se especifican.</p>
                                                <p><strong>III.3. </strong>Todos los anexos que se adjunten al presente forman parte integrante del presente contrato. Dichos documentos deberán ser entregados por parte del <strong>“VENDEDOR”</strong> al <strong>“COMPRADOR”</strong>, firmando el <strong>“COMPRADOR”</strong>, el acuse de recibo manifestando que conoce y acepta el contenido del mismo.</p>
                                                <p><strong>III.4.</strong> <strong>“INMUEBLE”</strong> materia de este contrato, contará con la infraestructura adecuada para el funcionamiento de sus servicios básicos, y concuerda con el diseño que se le ha mostrado en los renders presentados por el <strong>“VENDEDOR”</strong>. </p>
                                                <p><strong>III.5.</strong> <strong>“INMUEBLE”</strong> se adecua a las especificaciones para usos de suelo, a sus restricciones específicas y al reglamento de construcción y lineamientos urbanos permitidos para la construcción en esa zona.</p>
                                                <p><strong>III.6.</strong> Conocen el contenido del presente contrato, y que es su voluntad obligarse en términos del mismo, no habiendo mediado dolo, mala fe, vicio, error o violencia alguna en su celebración. </p>
                                                <p>De conformidad con las Declaraciones anteriores, <strong>“LAS PARTES”</strong> se someten a las siguientes: </p>
                                                <p class="text-center" style="text-align: center;"><strong>C L Á U S U L A S</strong></p>
                                                <p><strong>PRIMERA. -</strong> OBJETO</p>
                                                <p>En virtud de este acuerdo de voluntades, el <strong>“VENDEDOR”</strong> vende bajo la modalidad Ad Mensuram al <strong>“COMPRADOR”</strong> adquiere para si:</p>
                                                <p><strong>A. </strong>El inmueble tipo lote de terreno, identificado con el número <span class="text-info contrato-variable" name="campo_nombre_inmueble_4" id="campo_nombre_inmueble_4" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span>perteneceinte a la <strong>fracción 02, subdivición de la fusión de lotes 7 y 23 Z-1 P1/1, Ejido Mandinga y Matoza, Municipio de Alvarado, Veracruz Ignacio de la Llave</strong> con una superficie total de terreno de <span class="text-info contrato-variable" name="campo_tamanio_2" id="campo_tamanio_2" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_total) ? trim($contrato_row->tamanho_total) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_total_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_total_letra)) : ''); ?> <?php echo (!empty($contrato_row->tamanho_terraza) ? trim($contrato_row->tamanho_terraza) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_terraza_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_terraza_letra)) : ''); ?></span>, con un valor de venta de <strong><span class="text-info contrato-variable" name="campo_precio_venta_1" id="campo_precio_venta_1" style="color: #3bafda"><?php echo !empty($proceso_venta_row->precio_venta) ? '$' . number_format($proceso_venta_row->precio_venta, 2) : ''; ?> MXN <?php echo (!empty($contrato_row->precio_venta) ? trim($contrato_row->precio_venta) : ''); ?> <?php echo (!empty($contrato_row->proceso_venta_precio_venta_letra) ? mb_strtoupper(trim($contrato_row->proceso_venta_precio_venta_letra)) : ''); ?></span></strong> con las medidas y ubicación que se detalladan en el plano arquitectónico que se adjunta al presente contrato como <strong>Anexo A.</strong></p>
                                                <p><strong>SEGUNDA. -</strong> PRECIO</p>
                                                <p><strong>“LAS PARTES”</strong> están de acuerdo en que el precio de la presente compraventa con reserva de dominio sea por la cantidad de: <strong><span class="text-info contrato-variable" name="campo_precio_venta_2" id="campo_precio_venta_2" style="color: #3bafda"><?php echo !empty($proceso_venta_row->precio_venta) ? '$' . number_format($proceso_venta_row->precio_venta, 2) : ''; ?> MXN <?php echo (!empty($contrato_row->precio_venta) ? trim(number_format($contrato_row->precio_venta, 2)) : ''); ?> <?php echo (!empty($contrato_row->proceso_venta_precio_venta_letra) ? mb_strtoupper(trim($contrato_row->proceso_venta_precio_venta_letra)) : ''); ?></span></strong>, cantidad que deberá ser cubierta por el <strong>“COMPRADOR”</strong> conforme a la siguiente tabla:</p>
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-xs-12">

                                                        <table class="table table-responsive text-center" name="table" id="table" style="text-align: center; justify-content: center;">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3" style="border: 1px solid black; background-color: #6cbffa;">Resumen de pagos</th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border: 1px solid black; background-color: #6cbffa;">Concepto</th>
                                                                    <th style="border: 1px solid black; background-color: #6cbffa;">Monto</th>
                                                                    <th style="border: 1px solid black; background-color: #6cbffa;">Fecha programada</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if ($deber_ser) : ?>
                                                                    <?php foreach ($deber_ser as $pago_key => $deber_ser_row) : ?>
                                                                        <tr>
                                                                            <td style="border: 1px solid black;"><?php echo !empty($deber_ser_row->concepto) ? $deber_ser_row->concepto : ''; ?></td>
                                                                            <td style="border: 1px solid black;"><?php echo !empty($deber_ser_row->monto) ? '$' . number_format($deber_ser_row->monto, 2, '.', ',') : ''; ?></td>
                                                                            <td style="border: 1px solid black;"><?php echo !empty($deber_ser_row->fecha_programada) ? date('Y/m/d', strtotime($deber_ser_row->fecha_programada)) : ''; ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <p>El <strong>“COMPRADOR”</strong> de conformidad acepta que pagará a más tardar los primeros 15 (quince) días de cada mes señalado en la tabla anterior.</p>
                                                <p>El <strong>“COMPRADOR”</strong> se obliga a enviar al correo <strong>ccastilla@grupojv.com.mx y escrituración@grupojv.com.mx </strong> del <strong> “VENDEDOR”</strong> las fichas de pago, además se obligá el <strong>“COMPRADOR”</strong> a guardar y exhibir los pagos al momento de la escrituración.</p>
                                                <p>En caso de que el <strong>“COMPRADOR”</strong> realice alguna mensualidad y/o pago con cheque y éste fuera devuelto por carecer de fondos suficientes, el <strong>“VENDEDOR”</strong> tendrá derecho a cobrar el <strong>20% (veinte por ciento)</strong> sobre el documento devuelto, de acuerdo con el artículo 193 de la ley General de Títulos y Operaciones de Crédito, más las comisiones bancarias que en su caso le hayan sido cargadas, pago que el primero se obliga a cubrir a favor del segundo dentro de los 5 (cinco) días naturales siguientes a su cobro y sin ulterior gestión. </p>
                                                <p>El <strong>“COMPRADOR”</strong> señala estar de acuerdo y conforme que hasta en tanto no pague el precio del <strong>“INMUEBLE”</strong> no le asistirá derecho alguno de propiedad ni posesión sobre el mismo, por lo que no podrá usar o disponer de él hasta que no haya cubierto fehacientemente el pago total del valor de <strong>“INMUEBLE”.</strong></p>
                                                <p><strong>TERCERA. – FALTA DE PAGO PUNTUAL. </strong></p>
                                                <p>En caso de que el <strong>“COMPRADOR”</strong> presente un retraso en el pago de sus mensualidades señaladas en la cláusula anterior, se causará un interés del 1.5% (uno punto cinco por ciento) sobre saldos insolutos, por cada mes o fracción de mes que transcurra desde el momento del incumplimiento y hasta que dicho pago sea cubierto íntegramente con el interés respectivo.</p>
                                                <p>Manifestando <strong>“LAS PARTES”</strong> que se tomará como cantidad base para calcular el interés el valor total de la promesa de compraventa, el <strong>“COMPRADOR”</strong> está conforme y acepta estar de acuerdo con el <strong>“VENDEDOR”</strong> que en caso de desear liquidar o seguir pagando podría sufrir un incremento dependiendo de la inflación.</p>
                                                <p>El <strong>“COMPRADOR”</strong> tiene pleno conocimiento en este acto que la pena establecida en el párrafo anterior es totalmente independiente a la que se menciona en la cláusula <strong>octava.</strong></p>
                                                <p><strong>CUARTA. - FORMA DE PAGO. </strong></p>
                                                <p>El pago del <strong>“COMPRADOR”</strong> al <strong>“VENDEDOR”</strong> deberá realizarse mediante cheque o transferencia bancaria de fondos inmediatamente disponibles a la cuenta No. <strong>0120395455</strong>, <strong>CLABE 01 265 0001 203 954 552.</strong> del <strong>Banco BBVA BANCOMER,</strong> a nombre de <strong>“CONSTRUCTORA ANJUMI”, S.A. DE C.V.”</strong></p>
                                                <p>El <strong>“VENDEDOR”</strong> por escrito al <strong>“COMPRADOR”</strong>, podrá indicarle un nuevo número de cuenta en el que deberá realizar los subsecuentes depósitos a que se comprometa, lo que sucederá mediante simple aviso de manera electrónica o por escrito.</p>
                                                <p><strong>QUINTA. -IMPUESTOS.</strong></p>
                                                <p><strong>“LAS PARTES”</strong> están de acuerdo que el <strong>“INMUEBLE”</strong>, causa Impuesto al Valor Agregado Inmobiliario; por lo que el <strong>“COMPRADOR”</strong> conviene con el <strong>“VENDEDOR”</strong> en agregar el 16% (dieciséis por ciento) sobre el valor, o cualquier impuesto que las autoridades establezcan.</p>

                                                <p>SEXTA. - <strong>TRANSMISIÓN DE LA PROPIEDAD.</strong></p>
                                                <p>Para que el <strong>“VENDEDOR”</strong> pueda transmitir al <strong>“COMPRADOR”</strong> la propiedad del <strong>“INMUEBLE”</strong> mediante el otorgamiento de la Escritura Pública correspondiente, será necesario que se haya liquidado en su totalidad el precio del <strong>“INMUEBLE”</strong> y así como estar al corriente en el pago mensual del mantenimiento tal como establece la cláusula <strong>décima</strong>, así como el pago del impuesto predial, el cual correrá a cargo del <strong>“COMPRADOR”</strong> una vez que le sea entregado el <strong>“INMUEBLE”</strong>, aunado a que deberán de cubrir todos los requisitos de ley para realizar la escritura correspondiente como lo son, constancia de no adeudo de agua y cualquier otro documento que se requiera al momento de efectuar la escritura respectiva. Adicionalmente a lo anterior deberá de tener completo el expediente antilavado que se deba de conformar, obligándose el <strong>“COMPRADOR”</strong> en este acto a entregar toda la documentación que el <strong>“VENDEDOR”</strong> le solicite y que se detalla en el <strong>Anexo B.</strong></p>

                                                <p>Una vez pagado el precio en su totalidad y cumplidas las condiciones demás obligaciones que se derivan de este contrato, <strong>“LAS PARTES”</strong> se obligan a formalizar en escritura pública la transmisión de la propiedad del <strong>“INMUEBLE”</strong>, ante el Licenciado <strong>Arturo Hernández Orozco,</strong> titular de la Notaría Número 09 (nueve), de la Ciudad de Xalapa-Enríquez, Estado de Veracruz de Ignacio de la Llave. Para el caso de que el <strong>“COMPRADOR”</strong> desee cambiar la notaría antes mencionada y si dicho cambio llegara a generar algún costo, dicho costo deberá ser cubierto por el <strong>“COMPRADOR”</strong>, liberando en este acto al <strong>“VENDEDOR”</strong>, pues ha sido plena voluntad del <strong>“COMPRADOR”</strong> dicho cambio.</p>

                                                <p>Por lo anterior, el dominio de <strong>“INMUEBLE”</strong>, queda reservado en favor del <strong>“VENDEDOR”</strong> hasta en tanto se haya dado total cumplimiento al contrato en su conjunto.</p>

                                                <p><strong>SÉPTIMA. - FECHA DE ENTREGA.</strong></p>
                                                <p>El <strong>“VENDEDOR”</strong> se compromete a entregar el <strong>“INMUEBLE”</strong>, a más tardar en el mes de ______________ pudiendo extenderse hasta en 90 (noventa) días naturales más, dicha entrega, sin que genere responsabilidad, cargo o pena alguna a cargo del <strong>“VENDEDOR”</strong>. </p>

                                                <p>Para que la entrega sea efectuada, el precio total del <strong>“INMUEBLE”</strong> deberá ser cubierto previamente, por el <strong>“COMPRADOR”</strong> al <strong>“VENDEDOR”</strong>, en los términos del presente CONTRATO.</p>

                                                <p>Para el caso de que el pago del bien inmueble materia del presente contrato, este sujeto a que el cliente obtenga un crédito dicha fecha de entrega señalada podría variar, sin embargo, tal situación no afectará las fechas de pago acordadas según clausula segunda del presente contrato, ESTO ES, NO ESTA SUJETO A LA OBTENCIÓN O NO DE UN CRÉDITO PARA QUE EL <strong>“COMPRADOR”</strong> CUMPLA CON SU OBLIGACIÓN DE PAGO</p>

                                                <p>Para que el <strong>“VENDEDOR”</strong> entregue el <strong>“INMUEBLE”</strong>, al <strong>“COMPRADOR”</strong>, será necesario que, en la fecha prevista para tal efecto y previa notificación que realice el <strong>“VENDEDOR”</strong> al <strong>“COMPRADOR”</strong> mediante correo electrónico <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong> señalado por el <strong>“COMPRADOR”</strong>, <strong>“LAS PARTES”</strong> deberán realizar una visita al <strong>“INMUEBLE”</strong> y se firme la correspondiente ACTA DE ENTREGA-RECEPCIÓN.</p>

                                                <p>Si el <strong>“COMPRADOR”</strong> no asiste a la visita o se niegan a firmar el acta de entrega-recepción, el <strong>“VENDEDOR”</strong> o su representante, en presencia de dos testigos, hará constar los hechos ocurridos y se entenderá que se realiza la entrega del <strong>“INMUEBLE”</strong> y el <strong>“COMPRADOR”</strong> perderá el derecho de señalar los detalles pendientes o deficientes. Iniciando el plazo para el pago de mantenimiento haya o no firmado el acta, así mismo ya sea que lo ocupe o no el <strong>“INMUEBLE”</strong>. Además de que deberá cubrir el pago de agua, predial en caso de no hacerlo no se podrá escriturar.</p>

                                                <p><strong>OCTAVA. -PENAS CONVENCIONALES</strong></p>
                                                <p>Por acuerdo expreso de <strong>“LAS PARTES”</strong> establecen, que el incumplimiento del pago de dos o más depósitos del presente Contrato imputable al <strong>“COMPRADOR”</strong>, será causal de rescisión del presente contrato sin necesidad de resolución judicial.</p>
                                                <p>Además de la rescisión, <strong>“COMPRADOR”</strong> en este acto expresa su libre voluntad y acepta que pagará al <strong>“VENDEDOR”</strong> como pena convencional derivado del incumplimiento, el 40% (cuarenta por ciento) del precio base de la operación, cantidad que será tomada de los depósitos efectuados por <strong>“COMPRADOR”</strong> en el supuesto de que existan dichos depósitos.</p>

                                                <p>Si se diera el supuesto descrito en el párrafo inmediato anterior, el <strong>“VENDEDOR”</strong> se obliga a depositar el importe correspondiente al excedente de los depósitos, si los hubiere, mediante cheque certificado a nombre de <strong>“COMPRADOR”</strong> lo que sucederá en un plazo de 30 días naturales.</p>

                                                <p><strong>NOVENA. -REGLAMENTO.</strong> </p>
                                                <p>El <strong>“COMPRADOR”</strong>, se obliga a observar lo dispuesto en el reglamento interior que regule el <strong>“INMUEBLE”</strong>, por lo que se deberá sujetar a todas las disposiciones que en él se señalen, de igual forma el <strong>“COMPRADOR”</strong>, están de acuerdo que el <strong>“VENDEDOR”</strong> y/o el desarrollador no pagará mantenimiento hasta que las unidades del desarrollador no sean vendidas o rentadas renunciando al artículo 55, 57 de la ley que regula el régimen de propiedad en condominio en el estado de Veracruz de Ignacio de la Llave, renunciando a cualquier disposición legal que contraríe a lo antes señalado, por lo que al suscribir no se reserva derecho alguno por tal hecho; actos que quedarán establecido en el reglamento; instrumento que se materializa al momento de realizar la entrega recepción mencionada en la <strong>cláusula Séptima</strong>.</p>

                                                <p><strong>DÉCIMA. - GASTOS DE MANTENIMIENTO. </strong></p>
                                                <p>El <strong>“COMPRADOR”</strong>, se obliga a pagar de manera mensual, los gastos de mantenimiento que genere el <strong>“INMUEBLE”</strong>, desde que tome posesión jurídica y/o material de la misma.</p>

                                                <p>En este acto el <strong>“COMPRADOR”</strong> se hace sabedor que el monto por concepto de gastos de mantenimiento se acordará por el <strong>“VENDEDOR”</strong> y/o el desarrollador plasmando tal hecho en el reglamento interior, y en el cual se determinará la cuota en base a los costos que por dicho concepto genere, en congruencia con la variación de los precios del mercado, de igual manera acepta y están conformes <strong>“LAS PARTES”</strong> que el desarrollador detentara la administración del fraccionamiento por periodo de 10 (diez) años, acto que se efectúa para el efecto de que la plusvalía del inmueble se mantenga, aunado a que el antes mencionado es de su interés cuidar del inmueble para que se mantenga su nombre y prestigio como constructor, sin perseguir en ningún momento ánimos de lucro; dichos actos se establecerán en el reglamento interior que se le hará del conocimiento al momento de realizar la entrega del <strong>“INMUEBLE”</strong>.</p>

                                                <p>En caso de no estar al corriente en los pagos de mantenimiento, no procederá la firma de la escritura pública en la que el <strong>“VENDEDOR”</strong> transmita la propiedad del <strong>“INMUEBLE”</strong> al <strong>“COMPRADOR”</strong>. Además de que la falta del pago de mantenimiento generará un interés del 10% (diez por ciento), tal como se señalará en el reglamento del fraccionamiento perteneciente al complejo y del cual forma parte el <strong>“INMUEBLE”</strong>.</p>

                                                <p><strong>DÉCIMA PRIMERA. ESCRITURACIÓN.</strong>.</p>
                                                <p><strong>“LAS PARTES”</strong> acuerdan que la celebración de la escritura definitiva en la que se haga constar la transmisión de los derechos del <strong>“INMUEBLE”</strong> materia del presente contrato, se llevará a cabo a partir de la notificación que se realizara por parte del <strong>“VENDEDOR”</strong>, al correo electrónico <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong>, en el cual se notificará que el <strong>“INMUEBLE”</strong> se encuentra listo para llevar a cabo dicha escrituración.</p>

                                                <p><strong>“LAS PARTES”</strong> acuerdan que, para llevar a cabo la transmisión de los derechos, el <strong>“COMPRADOR”</strong> deberá depositar el finiquito señalado en la cláusula segunda el cual se deberá ver reflejado, en la cuenta bancaria del <strong>“VENDEDOR”</strong>, con lo cual podrá acreditar el <strong>“COMPRADOR”</strong> que ha cumplido con el pago total del <strong>“INMUEBLE”</strong>. </p>

                                                <p>Una vez cumplido lo anterior la escrituración deberá de llevarse a cabo en un plazo no mayor a 3 (tres) meses, en caso de no llevar a cabo dicha escrituración por causa imputable al <strong>“COMPRADOR”</strong> se hará acreedor a una pena del 0.1% (cero punto uno por ciento) sobre el total del monto de la compraventa por cada día natural que transcurra después de los 3 (tres) meses mencionados. Para lo cual el <strong>“COMPRADOR”</strong> deberá de entregar todos los documentos que la Notaría requiera y que de manera enunciativa se indican en el <strong>Anexo B</strong>. </p>

                                                <p><strong>DÉCIMA SEGUNDA. GASTOS.</strong></p>
                                                <p>El <strong>“COMPRADOR”</strong> asume la obligación de pagar todos los gastos, impuestos, contribuciones y derechos que se llegarán a generar por la firma del contrato, incluyendo honorarios notariales, Impuesto sobre Adquisición de Inmuebles, derechos de registro y cualquier otro gasto o costo relativo a la compraventa del <strong>“INMUEBLE”</strong>, en su caso, con excepción hecha al Impuesto sobre la Renta y aquellas contribuciones, cargos, derechos o impuestos que le corresponderán al <strong>“VENDEDOR”</strong> conforme a la legislación aplicable.</p>

                                                <p><strong>DÉCIMA TERCERA. - CASO FORTUITO O FUERZA MAYOR.</strong></p>
                                                <p><strong>“LAS PARTES”</strong> establecen que para el caso de que el desarrollo, no pueda ser ejecutado por caso fortuito o fuerza mayor como sería por temblor, erupción volcánica entre otros, las cantidades que haya entregado al <strong>“COMPRADOR”</strong>, a favor del <strong>“VENDEDOR”</strong>, serán entregadas a más tardar dentro de los 90 (noventa) días naturales contados a partir de la fecha en que se emita dictamen por autoridad competente que señale la imposibilidad de ejecutar o terminar la obra, dichos montos serán depositados a la cuenta a nombre del <strong>“COMPRADOR”</strong>. Dicha cantidad no generará interés alguno.</p>

                                                <p><strong>DÉCIMA CUARTA. - RESCISIÓN DE CONTRATO.</strong></p>
                                                <p>Son causales de rescisión del presente contrato:</p>
                                                <ol type="a">
                                                    <li>El incumplimiento de cualquiera de las obligaciones establecidas en el clausulado de este contrato para <strong>“LAS PARTES”;</strong></li>
                                                    <li>Las que contempla la Ley de la materia como tales.</li>
                                                </ol>
                                                <p><strong>DÉCIMA QUINTA. – OBLIGACIONES DEL “VENDEDOR”.</strong></p>
                                                <p>El <strong>“VENDEDOR” </strong>se obliga frente al <strong>“COMPRADOR”,</strong> al momento de llevar a cabo la escrituración correspondiente, a: </p>
                                                <ol type="a">
                                                    <li>Entregar la documentación requerida para que el Notario Público otorgue la Escritura Pública.</li>
                                                    <li>Obtener todas aquellas licencias o permisos que sean necesarios para el uso del <strong>“INMUEBLE”</strong> y que estén eminentemente relacionados con el presente contrato y dentro de sus actividades.</li>
                                                    <li>Que el <strong>“INMUEBLE”</strong> se encuentre libre de gravamen y al corriente en el pago de contribuciones y servicios contratados en el <strong>“INMUEBLE”</strong> y </li>
                                                    <li>Transmitir al <strong>“COMPRADOR”</strong> la propiedad del <strong>“INMUEBLE”</strong> en los términos de este contrato”.</li>
                                                </ol>
                                                <p><strong>DÉCIMA SEXTA. –</strong> OBLIGACIONES DEL <strong>“COMPRADOR”.</strong></p>
                                                <p>Además de las obligaciones que a su cargo se derivan en los términos del presente contrato, el <strong>“COMPRADOR” </strong>se obliga frente al <strong>“VENDEDOR”</strong> a:</p>
                                                <ol type="A">
                                                    <li>Cubrir puntualmente con su obligación de pago</li>
                                                    <li>Una vez entregado el <strong>“INMUEBLE”,</strong> observar las disposiciones que se deriven del régimen interior y políticas del fraccionamiento, además de cubrir puntualmente con las obligaciones que se deriven del mismo,</li>
                                                    <li>Una vez entregado el <strong>“INMUEBLE”</strong>, cubrir cabal y puntualmente por su cuenta, las cuotas, impuestos y demás cargas fiscales, presentes y futuras, que resulten de la celebración del presente contrato y por cuenta propia cubrir el monto del Impuesto Sobre Adquisición de Bienes Inmuebles que a su cargo resulte de la celebración del presente contrato.</li>
                                                    <li>Cubrir los honorarios notariales y demás gastos y derechos que se deriven de la firma de la Escritura en que conste la transmisión de la propiedad del <strong>“INMUEBLE”,</strong> así como la inscripción de la misma en el Registro Público de la Propiedad.</li>
                                                </ol>

                                                <p><strong>DÉCIMA SÉPTIMA.- AVISOS Y NOTIFICACIONES.</strong></p>
                                                <p>Todos los avisos y notificaciones que las partes deban darse de acuerdo con este Contrato se consignarán por escrito. Tales avisos y otros documentos se tendrán por notificados a las partes cuando sean entregados personalmente y sean debidamente dirigidos a la parte que corresponda a su último domicilio manifestado para efectos de este Contrato, el cual hasta en tanto no exista comunicación en contrario, deberá entenderse que es el siguiente:</p>

                                                <p>El <strong>“COMPRADOR”</strong>. - Que, para los fines y efectos del presente contrato, establecen como domicilio, el ubicado en <strong><span class="text-info contrato-variable" name="campo_direccion_fiscal_1" id="campo_direccion_fiscal_1" style="color: #3bafda"><?php echo (!empty($cliente_row->domicilio_fiscal) ? mb_strtoupper(trim($cliente_row->domicilio_fiscal)) : ''); ?></span></strong>.</p>

                                                <p><strong>Correo:</strong> <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong>.</p>
                                                <p><strong>Teléfono:</strong> <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->telefono) ? trim($cliente_row->telefono) : ''); ?></span></strong>.</p>

                                                <p>El <strong>“VENDEDOR”</strong>.- Que, para los fines y efectos del presente contrato, establecen como domicilio, el ubicado <strong>Calzada Zavaleta número 1108 (mil ciento ocho), interior 102 (ciento dos), Santa Cruz Buena vista, Puebla, Puebla, C.P. 72150.</strong></p>
                                                <p>Correo: <strong>ccastilla@grupojv.com.mx, escrituracion@grupojv.com.mx</strong>.</p>

                                                <p><strong>“LAS PARTES”</strong> acuerdan que las comunicaciones y notificaciones entre ellas podrán ser realizadas por vía electrónica a través de correo electrónico la cual tendrá valides desde el momento en que salga del correo del remitente según la IP, no siendo necesario el acuse de recibido, con ello se acredita el momento de su remisión, el contenido de la notificación y la identificación del remitente y del destinatario, utilizando sus direcciones de correo electrónico.</p>

                                                <p>Se tendrá como válida al efecto del cómputo de los plazos, la fecha que conste en el sistema utilizado para la remisión de la notificación, independientemente de la fecha a la que haya tenido acceso a ella el destinatario, e, incluso si no ha llegado a acceder a ella, por error en la identificación u otra causa no imputable al remitente.</p>

                                                <p><strong>DÉCIMA OCTAVA. - PROTECCIÓN DE DATOS PERSONALES.</strong></p>
                                                <p><strong>“LAS PARTES”</strong> reconocen que con motivo de la realización de este contrato pueden llegar a intercambiar datos personales, según dicho término se define en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (“LFPDPPP”), como responsables directos o como encargados por cuenta de la parte opuesta, por lo que en virtud de este acto consienten recíprocamente la obtención, uso, divulgación, almacenamiento, manejo y tratamiento en cualquier forma de dichos datos por la parte opuesta, únicamente para los fines y efectos que se deriven de este contrato. En razón de lo anterior, <strong>“LAS PARTES”</strong> se obligan a otorgar tratamiento confidencial a la totalidad de los datos personales que obtengan o lleguen a obtener por virtud del presente contrato de la parte opuesta, para lo cual deberán tomar las medidas necesarias de seguridad para garantizar el manejo legítimo, controlado e informado de cualquier dato personal por sí o sus empleados, dependientes, asociados, afiliados o cualquier otra persona con la que tengan relación y en virtud de la cual el dato personal pudiera ser obtenido, como si se tratara de información propia.</p>

                                                <p><strong>“LAS PARTES”</strong> reconocen que por ningún motivo podrán asumir la titularidad o propiedad de los datos personales que obtengan de la parte opuesta, ni podrán hacer uso de los datos personales obtenidos para finalidades distintas a las que se deriven del presente contrato. </p>

                                                <p><strong>“LAS PARTES”</strong> no podrán difundir, comunicar, transferir o divulgar por cualquier medio los datos personales contenidos en el presente contrato o que lleguen a obtener por la celebración del mismo de la otra parte, a cualquier tercero, excepto cuando dicha difusión, comunicación, transferencia o divulgación sea inherente o necesaria para el cumplimiento de los fines de este contrato, o sea requerida por mandamiento de autoridad competente, sujetándose en caso de incumplimiento a las sanciones que para el caso establecen los artículos 63, 64, 65 y 66 de LFPDPPP.</p>

                                                <p>En caso de duda respecto del tratamiento que pueda o no darse a cualquier dato personal de alguna de <strong>“LAS PARTES”</strong>, la parte dudosa deberá solicitar aclaración y autorización para el tratamiento del mismo a la otra. En tanto no sea resuelta la duda, se entenderá que la parte dudosa no está autorizada para tratar el dato personal en cuestión. Al término de la vigencia de este contrato por cualquier causa, <strong>“LAS PARTES”</strong> destruirán cualquier información que contenga datos personales de la parte opuesta, con sujeción a las sanciones mencionadas. <strong>“LAS PARTES”</strong> están de acuerdo en que esta cláusula constituye el Aviso de Privacidad a que se refiere la LFPDPPP, por lo que renuncian expresamente al ejercicio de cualquier acción legal derivada de la falta de dicho aviso.</p>

                                                <p><strong>DÉCIMA NOVENA. - CESIÓN.</strong></p>
                                                <p>Los derechos y obligaciones a favor del <strong>“COMPRADOR”</strong> bajo el contrato podrán ser cedidos por el <strong>“VENDEDOR”</strong> a una sociedad subsidiaria, afiliada o relacionada con la misma, así como a terceras personas, mediante simple notificación por escrito al <strong>“COMPRADOR”</strong> en el domicilio señalado en la cláusula décima séptima, situación que solo se podrá verificar antes de la firma de la escritura ante notario Público.</p>

                                                <p>El <strong>COMPRADOR</strong> manifiesta que no podrá ceder los derechos y obligaciones que se consignan en el presente contrato a ninguna persona, filial o dependencia; para el caso de que lo realice la antes mencionada acepta hacerse acreedora a cubrir a favor del <strong>“VENDEDOR”</strong> una pena del 10% (diez por ciento) del precio total del presente contrato. </p>

                                                <p><strong>VIGÉSIMA. - UNIDAD Y VALIDEZ DEL CONTRATO.</strong></p>
                                                <p>El presente contrato, sus Anexos, consignan el acuerdo íntegro entre <strong>“LAS PARTES”</strong> respecto de las operaciones a que el mismo se refiere y deja sin efectos cualesquiera otros Contratos, compromisos y acuerdos celebrados entre <strong>“LAS PARTES”</strong> con anterioridad, en relación con el objeto de que prevé este contrato.</p>

                                                <p><strong>VIGÉSIMA PRIMERA. - DIVISIBILIDAD.</strong></p>
                                                <p><strong>“LAS PARTES”</strong> están de acuerdo en que, si cualquier disposición de este contrato es declarada ilegal, inválida, no ejecutable, conforme a cualquier Ley, este contrato será interpretado y ejecutado como si dicha disposición no formase parte del presente contrato y las disposiciones restantes de este contrato seguirán siendo vigentes y con toda su fuerza legal y no serán afectadas por la disposición declarada ilegal, inválida, o no ejecutable, o por la separación de la misma del presente.</p>

                                                <p><strong>VIGÉSIMA SEGUNDA. - EJEMPLARES.</strong></p>
                                                <p>Este contrato puede ser celebrado en dos o más ejemplares y cada ejemplar será considerado como si fuera original, y los ejemplares juntos constituirán un solo acuerdo.</p>

                                                <p><strong>VIGÉSIMA TERCERA. - ANEXOS. </strong></p>
                                                <p>El <strong>“COMPRADOR”</strong>, en este acto ratifica todos y cada uno de los anexos que conforman el presente contrato, de los cuales manifiestan conocer su contenido y alcance de todos y cada uno de ellos, los cuales se agregan, al presente contrato, por lo que el <strong>“COMPRADOR”</strong>, firmará el acuse de recibo correspondiente manifestando que conoce y acepta el contenido del mismo. </p>

                                                <p><strong>VIGÉSIMA CUARTA. - TÍTULOS Y ENCABEZADOS.</strong></p>
                                                <p>Los títulos y encabezados contenidos en este contrato se incluyen por conveniencia, y en ningún caso forman parte ni afectan el sentido o interpretación de este contrato.</p>

                                                <p><strong>VIGÉSIMA QUINTA. - CONTENIDO Y ALCANCE LEGAL.</strong></p>
                                                <p>Convienen expresamente ambas partes en que al firmar el presente documento supieron del contenido y alcance legal de las disposiciones que lo rigen, quedando debidamente enterados de las obligaciones y fuerza legal que se desprenden de las mismas, por lo que aceptan plenamente que en el presente Contrato no media error, dolo, lesión, mala fe, renuncia improcedente de derechos o cualquier otro vicio de la voluntad que pudiera invalidarlo, y ratifican que todo lo convenido es la expresión fiel de sus voluntades.</p>

                                                <p><strong>VIGÉSIMA SEXTA. - JURISDICCIÓN. </strong></p>
                                                <p><strong>“LAS PARTES”</strong> en común acuerdo señalan que, para la interpretación, cumplimiento y ejecución del presente contrato, <strong>“LAS PARTES”</strong> se someterán expresamente a las leyes y tribunales de la ciudad de Puebla, renunciando al fuero de otros tribunales que, por motivo de su domicilio, presente o futuro, o por cualquier otra causa, llegase a corresponderles.</p>

                                                <p><strong>ESTANDO ENTERADOS El “VENDEDOR” Y EL “COMPRADOR” DEL CONTENIDO Y FUERZA LEGAL DEL CONTRATO, LO FIRMAN POR DUPLICADO EN LA CIUDAD DE PUEBLA, ESTADO DE PUEBLA CON EFECTOS A PARTIR DEL ____ DEL MES DE ____ DEL AÑO _____________________.</strong></p class="fin">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 50%;">
                                                            <p style="text-align: center;"><strong>“VENDEDOR”</strong></p>
                                                            <br><br><br>
                                                            <hr style="border-color: black;">
                                                            <p style="text-align: center;">“CONSTRUCTORA ANJUMI”, S.A. DE C.V.”
                                                            </p>
                                                            <p style="text-align: center;">(representada por su Administrador único) <br>
                                                                HUGO HERNÁNDEZ PÉREZ
                                                            </p>
                                                        </td>
                                                        <td style="width: 50%;">
                                                            <p style="text-align: center;"><strong>“COMPRADOR”</strong></p>
                                                            <br><br><br>
                                                            <hr style="border-color: black;">
                                                            <p class="text-info contrato-variable" name="campo_nombre_completo_2" id="campo_nombre_completo_2" style="text-align: center; color: #3bafda;"><?php echo (!empty($cliente_row->nombre) ? mb_strtoupper(trim($cliente_row->nombre)) : ''); ?> <?php echo (!empty($cliente_row->apellido_paterno) ? mb_strtoupper(trim($cliente_row->apellido_paterno)) : ''); ?> <?php echo (!empty($cliente_row->apellido_materno) ? mb_strtoupper(trim($cliente_row->apellido_materno)) : ''); ?></p>
                                                            <p style="text-align: center;">(Por su propio derecho)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div class="fin">

                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>