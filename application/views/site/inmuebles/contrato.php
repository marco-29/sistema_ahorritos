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
                                                <p><strong>CONTRATO PRIVADO DE PROMESA DE COMPRAVENTA A PLAZOS CON RESERVA DE DOMINIO QUE CELEBRAN POR UNA PARTE LA PERSONA MORAL DENOMINADA “2820 CONSTRUCTORA PUEBLA” S. A. DE C. V., REPRESENTADA POR SU ADMINISTRADOR ÚNICO FRANCISCO JAVIER BARRANCO ZUÑIGA, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ EL “PROMITENTE VENDEDOR” Y POR LA OTRA PARTE <strong><span class="text-info contrato-variable" name="campo_nombre_completo_1" id="campo_nombre_completo_1" style="color: #3bafda"><?php echo (!empty($cliente_row->nombre) ? mb_strtoupper(trim($cliente_row->nombre)) : ''); ?> <?php echo (!empty($cliente_row->apellido_paterno) ? mb_strtoupper(trim($cliente_row->apellido_paterno)) : ''); ?> <?php echo (!empty($cliente_row->apellido_materno) ? mb_strtoupper(trim($cliente_row->apellido_materno)) : ''); ?></span></strong>, POR SU PROPIO DERECHO, DENOMINADO EN LO SUCESIVO COMO EL “PROMITENTE COMPRADOR”, Y A QUIENES CUANDO SE LES NOMBREN DE MANERA CONJUNTA, SE LES DENOMINARÁN COMO “LAS PARTES”, QUIENES SE SUJETAN AL TENOR DE LAS SIGUIENTES DENOMINACIONES, DECLARACIONES Y CLÁUSULAS.</strong></p>
                                                <p class="text-center" style="text-align: center;"><strong>D E N O M I N A C I O N E S</strong></p>
                                                <ol type="A">
                                                    <li>Cuando el presente se refiera al <strong>“PROMITENTE VENDEDOR”</strong>, se entenderá con ello a la persona moral <strong>“2820 CONSTRUCTORA PUEBLA” S.A. DE C.V.</strong></li>
                                                    <li>Cuando el presente se refiera al <strong>“PROMITENTE COMPRADOR”</strong>, se entenderá con ello a <span class="text-info contrato-variable" name="campo_nombre_completo_2" id="campo_nombre_completo_2" style="color: #3bafda"><?php echo (!empty($cliente_row->nombre) ? mb_strtoupper(trim($cliente_row->nombre)) : ''); ?> <?php echo (!empty($cliente_row->apellido_paterno) ? mb_strtoupper(trim($cliente_row->apellido_paterno)) : ''); ?> <?php echo (!empty($cliente_row->apellido_materno) ? mb_strtoupper(trim($cliente_row->apellido_materno)) : ''); ?></span>.</li>
                                                    <li>Cuando el presente se refiera a el <strong>“DEPARTAMENTO”</strong>, se entenderá con ello al inmueble tipo departamento, identificado con el <strong><span class="text-info contrato-variable" name="campo_nombre_inmueble_1" id="campo_nombre_inmueble_1" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span></strong>, con <strong><span class="text-info contrato-variable" name="campo_cajon_estacionamiento_1" id="campo_cajon_estacionamiento_1" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? trim($contrato_row->inmueble_cajon_estacionamiento_numero) : ''); ?> <?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_letra) ? mb_strtoupper(trim($contrato_row->inmueble_cajon_estacionamiento_letra)) : ''); ?></span></strong> lugares de estacionamiento, dentro del Complejo, el cual se encuentra ubicado en el número 2719 “A” (dos mil setecientos diecinueve “A”), del predio ubicado en Avenida Osa Mayor, de la Colonia Centro Comercial Angelópolis, de esta ciudad de Puebla, del Estado de Puebla.</li>
                                                    <ol type="A" start="3">
                                                        <li>1. El “DEPARTAMENTO <span class="text-info contrato-variable" name="campo_nombre_inmueble_2" id="campo_nombre_inmueble_2" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span>, con una superficie de total: <span class="text-info contrato-variable" name="campo_tamanio_1" id="campo_tamanio_1" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_total) ? trim($contrato_row->tamanho_total) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_total_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_total_letra)) : ''); ?> <?php echo (!empty($contrato_row->tamanho_terraza) ? trim($contrato_row->tamanho_terraza) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_terraza_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_terraza_letra)) : ''); ?></span> de interiores, <span class="text-info contrato-variable" name="campo_construccion_1" id="campo_construccion_1" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_construccion) ? trim($contrato_row->tamanho_construccion) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_construccion_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_construccion_letra)) : ''); ?></span> de terraza, con <span class="text-info contrato-variable" name="campo_cajon_estacionamiento_2" id="campo_cajon_estacionamiento_2" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? trim($contrato_row->inmueble_cajon_estacionamiento_numero) : ''); ?> <?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_letra) ? mb_strtoupper(trim($contrato_row->inmueble_cajon_estacionamiento_letra)) : ''); ?></span> cajones de estacionamiento, los cuales serán asignados por la administración.</li>
                                                    </ol>
                                                </ol>
                                                <p>Las medidas y ubicación del departamento se detallan en el plano arquitectónico que se adjunta al presente contrato como <strong>Anexo A.</strong></p>
                                                <p class="text-center" style="text-align: center;"><strong>D E C L A R A C I O N E S</strong></p>
                                                <p><strong>I.</strong>Declara el “PROMITENTE VENDEDOR” por conducto de su administrador único, que:</p>
                                                <p><strong>I.1.</strong>Es una Sociedad legalmente constituida conforme a las leyes mexicanas como se desprende del instrumento público número 75,467 (setenta y cinco mil cuatrocientos sesenta y siete), volumen 1,556 (mil quinientos cincuenta y seis) de fecha del 10 (diez) de julio de 2020 (dos mil veinte), otorgada ante la fe del Licenciado Mario Salazar Martínez, Notario Público titular de la notaría pública número 42 (cuarenta y dos) de la ciudad de Puebla, Puebla y debidamente inscrita en el Registro Público de la Propiedad y el Comercio de la misma ciudad, bajo el folio mercantil electrónico número N-2020041448, de fecha 31 (treinta y uno) de julio de 2020 (dos mil veinte).</p>
                                                <p>Su representada se encuentra debidamente inscrita en la Administración Tributaria de la Secretaría de Hacienda y Crédito Público, quien cuenta con Registro Federal de Contribuyentes DMO200710IE0.</p>
                                                <p><strong>I.2.</strong> Su representante cuenta con la capacidad legal y facultades suficientes para obligarla mediante la celebración del contrato y para que las obligaciones previstas en el mismo le sean plenamente exigibles en sus términos, como lo acredita con el instrumento público número 19054 (diecinueve mil cincuenta y cuatro), Volumen 290 (doscientos noventa), de fecha 15 (quince) de junio de 2022 (dos mil veintidós), otorgado ante la fe del Licenciado César José Sotomayor Sánchez, Notario Público número 11 (once) del distrito judicial de Puebla, personalidad que a la fecha no ha sido revocada, modificada o restringida de forma alguna. </p>
                                                <p><strong>I.3. </strong>Su representada es propietaria del Inmueble identificado como fracción II marcada con el número 2719 “A” (dos mil setecientos diecinueve “A”), del predio ubicado en Avenida Osa Mayor de la Colonia Centro Comercial Angelópolis de esta ciudad de Puebla, con una superficie de 9,084.93 m2 (nueve mil ochenta y cuatro punto noventa y tres metros cuadrados), lo que acredita en términos del Instrumento Público 16,857 (dieciséis mil ochocientos cincuenta y siete), Volumen 268 (doscientos sesenta y ocho), otorgado ante la fe del licenciado César José Soto Mayor Sánchez titular de la Notaría Pública número 11 (once), del Distrito Judicial de Puebla, inscrita en el Registro Público de la Propiedad del distrito judicial de Puebla, con fecha 29 (veintinueve) de marzo del año 2022 (dos mil veintidós); bajo la inscripción <strong>2937040 folio 0523271 1;</strong> cuya descripción, ubicación, medidas, linderos y colindancias son las siguientes: comprendidos dentro de las siguientes medidas y colindancias: <strong> AL NORTE:</strong> en siete tramos: el primero en dirección oriente en 14.24 m. (catorce punto veinticuatro metros), el segundo en 18.88 m. (dieciocho punto ochenta y ocho metros), el tercero en 15.64 m. (quince punto sesenta y cuatro metros), el cuarto en 6.86 m. (seis punto ochenta y seis metros), el quinto en 15.00 m. (quince metros), el sexto en 14.89 m. (catorce punto ochenta y nueve metros), el séptimo en 6.25 m. (seis punto veinticinco metros), estos siete tramos lindan con Avenida Osa Mayor; <strong>AL SUR:</strong> en cuatro tramos: el primero en dirección oriente en 3.33 m. (tres punto treinta y tres metros), el segundo en 52.22 m. (cincuenta y dos punto veintidós metros), el tercero en 33.44 m. (treinta y tres punto cuarenta y cuatro metros), el cuarto en 7.56 m. (siete punto cincuenta y seis metros), todos lindan con propiedad particular; <strong>AL ORIENTE:</strong> en 92.02 m. (noventa y dos punto cero dos metros), linda con fracción l; <strong>AL PONIENTE:</strong> en siete tramos: el primero con dirección noroeste en 3.42 m. (tres punto cuarenta y dos metros), el segundo en 2.94 m. (dos punto noventa y cuatro metros), el tercero en 3.09 m. (tres punto cero nueve metros), el cuarto en 65.99 m. (sesenta y cinco punto noventa y nueve metros), el quinto en 4.78 m. (cuatro punto setenta y ocho metros), el sexto quiebra al noreste en 7.16 m. (siete punto dieciséis metros), el séptimo en 5.23 m. (cinco punto veintitrés metros), estos siete tramos lindan con propiedad particular.</p>
                                                <p><strong>I.4. </strong>En el terreno señalado en la declaración inmediata anterior, se edificará el desarrollo denominado <strong>“ANDEZA”</strong> el cual se encontrará sujeto a su propio régimen de propiedad en condominio. En dicho desarrollo se ubicará el departamento materia del presente contrato en lo sucesivo el <strong>“DEPARTAMENTO”</strong>, que es la unidad privativa identificada como:</p>
                                                <p>El <strong>“DEPARTAMENTO”</strong> marcado con el número <strong><span class="text-info contrato-variable" name="campo_nombre_inmueble_3" id="campo_nombre_inmueble_3" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span></strong>, con <strong><span class="text-info contrato-variable" name="campo_cajon_estacionamiento_3" id="campo_cajon_estacionamiento_3" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? trim($contrato_row->inmueble_cajon_estacionamiento_numero) : ''); ?> <?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_letra) ? mb_strtoupper(trim($contrato_row->inmueble_cajon_estacionamiento_letra)) : ''); ?></span></strong> cajones de estacionamiento, del edificio sujeto al régimen de propiedad en condominio del inmueble identificado con el número <strong>2719 “A” (dos mil setecientos diecinueve “A”)</strong>, del predio ubicado en <strong>Avenida Osa Mayor de la Colonia Centro Comercial Angelópolis de esta ciudad de Puebla</strong>, mismo que se ubica en el lugar que señala el plano que a la presente se acompaña como <strong>Anexo A</strong> y que para efectos del presente contrato se denominará como el <strong>“DEPARTAMENTO”</strong>.</p>
                                                <p><strong>“LAS PARTES”</strong> acuerdan que la anotación y nivel en donde se ubique el inmueble materia de esta promesa de compraventa podrá ser sujeto a modificación única y exclusivamente en su numeración de conformidad a lo que señale las autoridades competentes, al momento de expedir la licencia de uso de suelo y demás documentos; lo anterior sin que afecte la altura y ubicación del departamento contratado.</p>
                                                <p><strong>I.5. </strong>Es su intención comprometerse a transmitir la propiedad del “DEPARTAMENTO” a favor del “PROMITENTE COMPRADOR” al cumplirse todos los términos y condiciones contenidos en el contrato. </p>
                                                <p><strong>I.6. </strong>La celebración del contrato y el cumplimiento de sus obligaciones bajo el mismo no contraviene ni constituye un incumplimiento de cualquier contrato, convenio u obligación a la que esté sujeta. </p>
                                                <p><strong>I.7 </strong>Todas las declaraciones del contrato son ciertas y correctas por lo que no existen vicios del consentimiento en la celebración del contrato. </p>
                                                <p><strong>I.8. </strong>Para los fines y efectos del presente Contrato, establece como domicilio convencional el ubicado en <strong> Camino Real a Cholula, número 6667 (seis mil seiscientos sesenta y siete), Colonia Zavaleta, Puebla, Puebla, C.P. 72150.</strong></p>
                                                <p><strong>II. Declara el “PROMITENTE COMPRADOR” por su propio derecho, que: </strong></p>
                                                <p><strong>II.1. </strong>Es una persona física de nacionalidad mexicana, mayor de edad, nacida el día <span class="text-info contrato-variable" style="color: #3bafda"><?php echo !empty($contrato_row->cliente_fecha_nacimiento_letra) ? mb_strtoupper($contrato_row->cliente_fecha_nacimiento_letra) : ''; ?></span> , su estado civil es <span class="text-info contrato-variable" name="campo_estado_civil_1" id="campo_estado_civil_1" style="color: #3bafda"><?php echo (!empty($cliente_row->estado_civil) ? mb_strtoupper(trim($cliente_row->estado_civil)) : ''); ?></span>, quien cuenta con Clave Única de Registro de Población (CURP) <span class="text-info contrato-variable" name="campo_curp_1" id="campo_curp_1" style="color: #3bafda"><?php echo (!empty($cliente_row->curp) ? mb_strtoupper(trim($cliente_row->curp)) : ''); ?></span>, con capacidad física y jurídica suficiente para la celebración del contrato y para cumplir que las obligaciones previstas en el mismo le sean plenamente exigibles en sus términos, quien se identifica con su credencial para votar número de OCR <span class="text-info contrato-variable" name="campo_ine_1" id="campo_ine_1" style="color: #3bafda"><?php echo (!empty($cliente_row->ine) ? trim($cliente_row->ine) : ''); ?></span> expedida por el Instituto Nacional Electoral, documento que contiene su fotografía y firma. </p>
                                                <p><strong>II.2. </strong>Se encuentra debidamente inscrita en el Registro Federal de Contribuyentes con clave <span class="text-info contrato-variable" name="campo_rf_1" id="campo_rf_1" style="color: #3bafda"><?php echo (!empty($cliente_row->rfc) ? mb_strtoupper(trim($cliente_row->rfc)) : ''); ?></span>. Documento que se adjunta en copia simple al presente contrato.</p>
                                                <p><strong>II.3. </strong>Señala como su domicilio para el cumplimiento de las obligaciones derivadas de este contrato, el ubicado en <span class="text-info contrato-variable" name="campo_domicilio_fiscal_1" id="campo_domicilio_fiscal_1" style="color: #3bafda"><?php echo (!empty($cliente_row->domicilio_fiscal) ? mb_strtoupper(trim($cliente_row->domicilio_fiscal)) : ''); ?></span></p>
                                                <p><strong>II.4.</strong> Es su deseo y voluntad adquirir con recursos propios el <strong>“DEPARTAMENTO”</strong> propiedad del <strong>“PROMITENTE VENDEDOR”</strong>, de manifestación y conformidad con las características y particularidades técnicas de la construcción del <strong>“DEPARTAMENTO”</strong>, las cuales se encuentran establecidas en el <strong>Anexo B</strong>, que formará parte integral del presente contrato.</p>
                                                <p><strong>II.5.</strong> Reconoce y acepta que el “DEPARTAMENTO”, se encontrará sujeto al Régimen de Propiedad en Condominio y, en consecuencia, acepta dicha propiedad limitada, es decir reconocen y aceptan que las caras del edificio, azoteas y demás áreas que no se describan en el anexo b del régimen de condominio que se efectúe en su momento quedará a favor del desarrollador del proyecto para que lo dispongan sin limitación alguna.</p>
                                                <p>Así mismo acepta que el “DEPARTAMENTO” que adquiere tendrá su administración; mismo que estará regido por su reglamento interno del complejo, en el que se establecerán los derechos y obligaciones que tendrán los condóminos en su unidad y en el cual se señalará el mantenimiento del complejo en general. </p>
                                                <p><strong>II.6.</strong> El “PROMITENTE COMPRADOR” se obliga a realizar entrega de todos y cada uno de los documentos que se describen en el Anexo F, mismos que sirven para la integración del expediente antilavado de conformidad a la Ley Federal para la Prevención e Identificación de Operaciones con Recursos de Procedencia Ilícita, mismos que deberán ser entregados al “PROMITENTE VENDOR” y a la notaría a efecto de poder realizar, en su momento, la escrituración correspondiente, debiendo así actualizar los documentos las veces que así se requieran durante el proceso de la misma.</p>
                                                <p><strong>II.7.</strong> Está consciente de que la transmisión de la propiedad del “DEPARTAMENTO”, por parte del “PROMITENTE VENDEDOR” se encuentra sujeta a que se resuelvan todas las condiciones establecidas en el propio contrato que se detallan más adelante.</p>
                                                <p><strong>II.8.</strong> <strong>Bajo protesta de decir verdad</strong>, que conoce la responsabilidad que para todos los efectos legales se refiere la <strong>Ley Nacional de Extinción de Dominio;</strong> por lo que manifiesta que <strong> “DEPARTAMENTO”</strong> que se sujeta a este contrato no es, ni será instrumento, objeto producto de algún delito; tampoco será utilizada o destinada a ocultar bienes del producto de algún delito; y que si son utilizados para la utilización de un delito, el <strong>“PROMITENTE VENDEDOR”</strong> no tiene conocimiento de dicho ilícito, relevándolo en su caso de cualquier responsabilidad.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> estará obligado a hacer del conocimiento a la autoridad competente, en la que externe expresamente que el <strong>“DEPARTAMENTO”</strong> se enajeno de <strong>“BUENA FE”</strong>, y que en los actos en donde se vea involucrado el <strong>“DEPARTAMENTO”</strong>, no existe conocimiento y/o participación por parte del <strong>“PROMITENTE VENDEDOR”</strong>. Debiendo el <strong>“PROMITENTE COMPRADOR”</strong> proporcionar información al <strong>“PROMITENTE VENDEDOR”</strong> de tal denuncia y/o carpeta de investigación.</p>
                                                <p>Por lo tanto, el <strong>“PROMITENTE VENDEDOR”</strong> al no conocer sobre la realización por parte del <strong>“PROMITENTE COMPRADOR”</strong> o de terceros de ninguno de los hechos ilícitos y delitos a los que se refieren la Ley, actúa con absoluta <strong>“BUENA FE”.</strong></p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> bajo protesta de decir verdad manifiesta: Que los recursos que destina y/o destinará al pago del <strong>“DEPARTAMENTO”</strong> y el enganche del mismo provienen y/o provendrán de fuentes lícitas”.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> libera al <strong>“PROMITENTE VENDEDOR”</strong> de toda responsabilidad en la que pudiera verse involucrado, derivado de la comisión de delitos consumados o no, dentro o fuera del <strong>“DEPARTAMENTO”</strong>.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> estará obligado a notificar al <strong>“PROMITENTE VENDEDOR”</strong> de cualquier notificación o procedimiento o juicio que, se inicie conforme a la <strong>“Ley Nacional de Extinción de Dominio”</strong> y proporcionar toda la información necesaria para defender los intereses del <strong>“PROMITENTE VENDEDOR”</strong>.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> se obliga a pagar todos los gastos legales y honorarios de abogados, así como a indemnizar y sacar en paz y a salvo al <strong>“PROMITENTE VENDEDOR”,</strong> para el caso de que por la comisión de algún delito sea imputable al “PROMITENTE COMPRADOR” o a cualquiera de sus funcionarios, factores, empleados, trabajadores, prestadores de servicios, visitantes, clientes o a cualquier persona que el “PROMITENTE COMPRADOR” hubiere permitido el acceso al <strong>“DEPARTAMENTO”,</strong> procediese la extinción del dominio respecto del <strong>“DEPARTAMENTO”.</strong></p>
                                                <p><strong>“LAS PARTES”</strong> pactan que será causa de rescisión del contrato, sin necesidad de declaración judicial, cualquier indagatoria o carpeta de investigación derivada que ocurra: el solo hecho de que el <strong>“DEPARTAMENTO”</strong> sea resguardado, relacionado, investigado o asegurado por cualquier autoridad derivado de la sospecha o comprobación de la comisión de delitos consumados o intentados dentro o fuera del <strong>“DEPARTAMENTO”,</strong> cometidos por el <strong>“PROMITENTE COMPRADOR”</strong> o por cualquier persona a la que el <strong>“PROMITENTE COMPRADOR”</strong> o que por si haya intervenido y se le haya permitido la entrada al <strong>“DEPARTAMENTO”</strong> que pudiera ser constitutivo de delitos previsto en la <strong>“Ley Nacional de Extinción de Dominio”</strong></p>
                                                <p><strong>II.10.</strong> Desea obligarse a celebrar este contrato con el <strong>“PROMITENTE VENDEDOR”,</strong> por medio del cual adquiera el <strong>“DEPARTAMENTO”</strong> en los términos y condiciones aquí establecidas:</p>
                                                <p><strong>III. POR “LAS PARTES”: </strong></p>
                                                <p><strong>III.1. </strong>Que es su voluntad celebrar el presente contrato <strong>PRIVADO DE PROMESA DE COMPRAVENTA A PLAZOS CON RESERVA DE DOMINIO.</strong></p>
                                                <p><strong>III.2. </strong>Se reconocen recíprocamente la personalidad con la que comparecen, misma que no les ha sido revocada, modificada o limitada de modo alguno, reconociendo en el mismo tenor la capacidad para obligarse y contratar, y expresando en consecuencia su voluntad de celebrar el presente contrato, en los términos y condiciones que enseguida se especifican.</p>
                                                <p><strong>III.3. </strong>Que todos los anexos que se adjunten al presente contrato, debidamente firmados por <strong>“LAS PARTES”,</strong> forman parte integrante de él. Dichos documentos deberán ser entregados por el <strong> “PROMITENTE VENDEDOR”</strong> al <strong>“PROMITENTE COMPRADOR”</strong> a más tardar al momento de la escrituración.</p>
                                                <p><strong>III.4. </strong>Están de acuerdo que las características técnicas de los materiales de la estructura, de las instalaciones y acabados son las correctas, y se anexarán al presente contrato como <strong>Anexo B.</strong></p>
                                                <p><strong>III.5. </strong>Que el <strong>“DEPARTAMENTO”</strong> materia de este contrato, contará con la infraestructura adecuada para el funcionamiento de sus servicios básicos, y concuerda con el diseño que se le ha mostrado en los renders presentados por el <strong>“PROMITENTE VENDEDOR”.</strong></p>
                                                <p><strong>III.6. </strong>Que el <strong>“DEPARTAMENTO” </strong> se adecua a las especificaciones para usos de suelo, a sus restricciones específicas y al reglamento de construcción y lineamientos urbanos permitidos para la construcción en esa zona.</p>
                                                <p><strong>III.7. </strong>Que conocen el contenido del presente contrato, y que es su voluntad obligarse en términos del mismo, no habiendo mediado dolo, mala fe, vicio, error o violencia alguna en su celebración.</p>
                                                <p><strong>EN VIRTUD DE LO ANTERIORMENTE EXPUESTO, “LAS PARTES”</strong> están de acuerdo en obligarse a lo dispuesto en el presente instrumento jurídico al tenor de las siguientes: </p>
                                                <p class="text-center" style="text-align: center;"><strong>C L Á U S U L A S</strong></p>
                                                <p><strong>PRIMERA. -</strong> OBJETO</p>
                                                <p>El <strong>“PROMITENTE VENDEDOR”</strong> en este acto vende con reserva de dominio y en modalidad ad mesuram y el <strong>“PROMITENTE COMPRADOR”</strong> adquiere para si la propiedad del bien inmueble identificado como:</p>
                                                <p><strong>I. DEPARTAMENTO 04 (cuatro), del Nivel 14 (catorce), torre “ANDEZA”.</strong></p>
                                                <p><strong>A. </strong>El <strong> “DEPARTAMENTO”,</strong> tipo departamento identificado con el <strong>número <span class="text-info contrato-variable" name="campo_nombre_inmueble_4" id="campo_nombre_inmueble_4" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span>, con una superficie de total: <span class="text-info contrato-variable" name="campo_tamanio_2" id="campo_tamanio_2" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_total) ? trim($contrato_row->tamanho_total) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_total_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_total_letra)) : ''); ?> <?php echo (!empty($contrato_row->tamanho_terraza) ? trim($contrato_row->tamanho_terraza) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_terraza_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_terraza_letra)) : ''); ?></span> de interiores, <span class="text-info contrato-variable" name="campo_construccion_2" id="campo_construccion_2" style="color: #3bafda"><?php echo (!empty($contrato_row->tamanho_construccion) ? trim($contrato_row->tamanho_construccion) : ''); ?> <?php echo (!empty($contrato_row->inmueble_tamanho_construccion_letra) ? mb_strtoupper(trim($contrato_row->inmueble_tamanho_construccion_letra)) : ''); ?></span></strong> de terraza, con <span class="text-info contrato-variable" name="campo_cajon_estacionamiento_3" id="campo_cajon_estacionamiento_3" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? trim($contrato_row->inmueble_cajon_estacionamiento_numero) : ''); ?> <?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_letra) ? mb_strtoupper(trim($contrato_row->inmueble_cajon_estacionamiento_letra)) : ''); ?></span> cajones de estacionamiento, con un valor de venta de <strong><span class="text-info contrato-variable" name="campo_precio_venta_1" id="campo_precio_venta_1" style="color: #3bafda"><?php echo !empty($proceso_venta_row->precio_venta) ? '$' . number_format($proceso_venta_row->precio_venta, 2) : ''; ?> MXN <?php echo (!empty($contrato_row->precio_venta) ? trim($contrato_row->precio_venta) : ''); ?> <?php echo (!empty($contrato_row->proceso_venta_precio_venta_letra) ? mb_strtoupper(trim($contrato_row->proceso_venta_precio_venta_letra)) : ''); ?></span></strong> con las medidas, ubicación y características detalladas en el Anexo A.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> en este acto se hace sabedor y acepta las características y especificaciones en carpintería, luminarias, herrajes, instalaciones hidráulicas, eléctricas, y todo tipo de acabados, que se señalarán en el <strong>Anexo D,</strong> el cual formará parte integral del presente contrato.</p>
                                                <p>El <strong>“DEPARTAMENTO”</strong> será transmitido por el <strong>“PROMITENTE VENDEDOR”</strong> al <strong>“PROMITENTE COMPRADOR”</strong> con todos los derechos y garantías, incluyendo todos los derechos, privilegios y usos correspondientes al <strong>“DEPARTAMENTO”,</strong> sin limitación de dominio y sin adeudo alguno una vez cumplidas todas las condiciones del presente contrato.</p>
                                                <p><strong>SEGUNDA. -</strong> PRECIO</p>
                                                <p><strong>“LAS PARTES”</strong> están de acuerdo en que el precio de la presente operación sea la cantidad de: <strong><span class="text-info contrato-variable" name="campo_precio_venta_2" id="campo_precio_venta_2" style="color: #3bafda"><?php echo !empty($proceso_venta_row->precio_venta) ? '$' . number_format($proceso_venta_row->precio_venta, 2) : ''; ?> MXN <?php echo (!empty($contrato_row->precio_venta) ? trim(number_format($contrato_row->precio_venta, 2)) : ''); ?> <?php echo (!empty($contrato_row->proceso_venta_precio_venta_letra) ? mb_strtoupper(trim($contrato_row->proceso_venta_precio_venta_letra)) : ''); ?></span></strong> monto que incluye el valor del “DEPARTAMENTO” más los <strong><span class="text-info contrato-variable" name="campo_cajon_estacionamiento_4" id="campo_cajon_estacionamiento_4" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_numero) ? trim($contrato_row->inmueble_cajon_estacionamiento_numero) : ''); ?> <?php echo (!empty($contrato_row->inmueble_cajon_estacionamiento_letra) ? mb_strtoupper(trim($contrato_row->inmueble_cajon_estacionamiento_letra)) : ''); ?></span></strong> lugares de estacionamiento; dicha cantidad deberá ser cubierta por el <strong>“PROMITENTE COMPRADOR”</strong> al <strong>“PROMITENTE VENDEDOR”,</strong> tal y como es señalado en la siguiente tabla:</p>
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
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> de conformidad acepta que pagará a más tardar los primeros 15 (quince) días de cada mes señalado en la tabla anterior.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> se obliga a enviar a los correos <strong>ccastilla@grupojv.com.mx y escrituración@grupojv.com.mx </strong> del <strong> “PROMITENTE VENDEDOR”</strong> las fichas de pago, además se obligá el <strong>“PROMITENTE COMPRADOR”</strong> a guardar y exhibir los comprobantes de pagos, transferencias, depósitos y/o cheques al momento de la escrituración.</p>
                                                <p>En caso de que el <strong>“PROMITENTE COMPRADOR”</strong> tratara de llevar acabo el pago de alguna mensualidad con cheque y éste fuera devuelto por carecer de fondos suficientes, el <strong>“PROMITENTE VENDEDOR”</strong> tendrá derecho a cobrar el <strong>20% (veinte por ciento)</strong> sobre el documento devuelto, de acuerdo con el artículo 193 de la ley General de Títulos y Operaciones de Crédito, más las comisiones bancarias que en su caso le hayan sido cargadas, pago que el primero se obliga a cubrir a favor del segundo dentro de los 5 (cinco) días naturales siguientes a su cobro y sin ulterior gestión. </p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> señala estar de acuerdo y conforme que hasta en tanto no pague el precio total del <strong>“DEPARTAMENTO”</strong> no le asistirá derecho alguno de propiedad ni posesión sobre el mismo, por lo que no podrá usar o disponer de él hasta que no haya cubierto fehacientemente el pago total del valor de <strong>“EL DEPARTAMENTO”.</strong></p>
                                                <p><strong>TERCERA. </strong> MODALIDAD AD MESURAM.</p>
                                                <p><strong>“LAS PARTES”</strong> en común acuerdo señalan que el presente contrato se celebra en la modalidad <strong>“Ad Mesuram”</strong> por lo cual el <strong>“PROMITENTE VENDEDOR”</strong> y el <strong>“PROMITENTE COMPRADOR”</strong> están de acuerdo en que la superficie final del inmueble objeto del presente contrato, puede variar hasta un 5%. </p>
                                                <p><strong>“LAS PARTES”</strong> establecen que para el caso de que se incremente la superficie del <strong> “DEPARTAMENTO”,</strong> el “PROMITENTE COMPRADOR” deberá cubrir la diferencia del valor por el excedente de superficie que cuente el inmueble, tomando como base el valor de compra por metro cuadrado. En caso contrario, es decir que la superficie disminuyera, el “PROMITENTE VENDEDOR” cubrirá la diferencia, descontándola de la última parcialidad que realice el “PROMITENTE COMPRADOR”.</p>
                                                <p><strong>CUARTA. – </strong>FALTA DE PAGO PUNTUAL. </p>
                                                <p>En caso de que el <strong>“PROMITENTE COMPRADOR”</strong> presente un retraso en el pago de sus mensualidades señaladas en la cláusula anterior, se causará un interés del 1.5% (uno punto cinco por ciento) sobre saldos insolutos, por cada mes o fracción de mes que transcurra desde el momento del incumplimiento y hasta que dicho pago sea cubierto íntegramente con el interés respectivo. </p>
                                                <p>Manifestando <strong>“LAS PARTES”</strong> que se tomará como cantidad base para calcular el interés el valor sobre saldos insolutos, el <strong> “PROMITENTE COMPRADOR”</strong> está conforme y acepta estar de acuerdo con el <strong>“PROMITENTE VENDEDOR”</strong> que en caso de desear liquidar o seguir pagando podría sufrir un incremento dependiendo de la inflación.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> tiene pleno conocimiento en este acto que la pena establecida en el párrafo anterior es totalmente independiente a la que se menciona en la cláusula <strong>NOVENA</strong>.</p>
                                                <p><strong>QUINTA. - </strong>FORMA DE PAGO.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> deberá pagar de sus cuentas de cheques o bancarias exclusivamente a su nombre, al <strong>“PROMITENTE VENDEDOR”</strong> mediante cheque o transferencia bancaria de fondos inmediatamente disponibles a la cuenta No. <strong>0120395455</strong>, del <strong>Banco BBVA BANCOMER,</strong> a nombre de <strong>“2820 CONSTRUCTORA PUEBLA”, S.A. DE C.V.”</strong> con CLABE interbancaria <strong>01 265 0001 203 954 552.</strong></p>
                                                <p>El <strong>“PROMITENTE VENDEDOR”</strong> mediante escrito dirigido al <strong>“PROMITENTE COMPRADOR”,</strong> podrá indicarle un nuevo número de cuenta en el que deberá realizar el subsecuente pago a que se comprometa, lo que sucederá mediante simple aviso de manera electrónica o por escrito.</p>
                                                <p><strong>SEXTA. - </strong>ESTACIONAMIENTO.</p>
                                                <p>El inmueble destinado para estacionamiento, que dará servicio al <strong>“DEPARTAMENTO”</strong> cumplirá en todo momento con los requerimientos que las autoridades administrativas impongan para prestar un servicio adecuado, además se asignarán al <strong>“PROMITENTE COMPRADOR”</strong> de manera exclusiva <strong><span class="text-info contrato-variable" name="campo_nombre_inmueble_5" id="campo_nombre_inmueble_5" style="color: #3bafda"><?php echo (!empty($contrato_row->inmueble_nombre_letra) ? mb_strtoupper(trim($contrato_row->inmueble_nombre_letra)) : ''); ?></span></strong> cajones de estacionamiento mismos que serán asignados por la administración del edificio.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> acepta y está conforme que los cajones de estacionamiento que tiene derecho no podrán ser techados, cerrados ni ser afectados en forma, dimensiones ni cualquier otra que dese en un futuro, por lo que los cajones de estacionamiento quedarán en todo momento como se entrega por parte del <strong>“PROMITENTE VENDEDOR”.</strong></p>
                                                <p>Es del conocimiento y aceptación del <strong>“PROMITENTE COMPRADOR”</strong> que dichos cajones de estacionamiento pagaran un mantenimiento mensual, monto que será señalado en el reglamento de condominio perteneciente al complejo y del cual forma parte el <strong>“DEPARTAMENTO”.</strong></p>
                                                <p>SÉPTIMA. - <strong>TRANSMISIÓN DE LA PROPIEDAD.</strong></p>
                                                <p>Para que el <strong>“PROMITENTE VENDEDOR”</strong> pueda transmitir al <strong>“PROMITENTE COMPRADOR”</strong> la propiedad del <strong>“DEPARTAMENTO”</strong> materia del presente contrato, mediante el otorgamiento de la Escritura Pública correspondiente, será necesario que se haya liquidado en su totalidad el precio del <strong>“DEPARTAMENTO”</strong> y se haya realizado la entrega física del <strong>“DEPARTAMENTO”</strong>, una vez que le sea entregado el <strong>“DEPARTAMENTO”</strong>, aunado a que deberá de cubrir todos los requisitos de ley para realizar la escritura correspondiente así como cumplir con documentación necesaria y que se requiera al momento de efectuar la escritura respectiva señalado como ANEXO E. Por lo que deberá entregar completo y firmado el expediente antilavado que se deba de conformar.</p>
                                                <p>Una vez que se haya pagado el precio en su totalidad y cumplidas las condiciones establecidas en el presente contrato, <strong>“LAS PARTES”</strong> se obligan a formalizar la promesa de compraventa en Escritura Pública es decir la transmisión de la propiedad del <strong>“DEPARTAMENTO”</strong> materia de este instrumento, ante el Notario que así lo determine el <strong>“PROMITENTE COMPRADOR”.</strong></p>
                                                <p>Por lo anterior, el dominio del <strong>“DEPARTAMENTO”,</strong> materia del presente contrato queda reservado en favor del <strong>“PROMITENTE VENDEDOR”</strong> hasta en tanto se haya realizado en su totalidad el pago del <strong>“DEPARTAMENTO”</strong> y hasta que se haya realizado la entrega física del <strong>“DEPARTAMENTO”.</strong></p>
                                                <p><strong>OCTAVA. -</strong> FECHA DE ENTREGA. </p>
                                                <p>El <strong>“PROMITENTE VENDEDOR”</strong> se compromete a entregar el edificio totalmente terminado en cuanto a sus áreas comunes y de servicios, así como la entrega del <strong>“DEPARTAMENTO”</strong> en las condiciones que se señalarán en el <strong>ANEXO B y ANEXO D,</strong> a más tardar en el mes de <strong>enero 2027 (dos mil veintisiete)</strong> pudiendo extenderse hasta en 90 (noventa) días naturales más, dicha entrega, sin penalidad para <strong>“LAS PARTES”.</strong> Para que la entrega sea efectuada, el precio total del <strong>“DEPARTAMENTO”</strong> deberá ser cubierto previamente, por el <strong> “PROMITENTE COMPRADOR”</strong> al <strong>“PROMITENTE VENDEDOR”,</strong> en los términos del presente instrumento.</p>
                                                <p>Para que el <strong>“PROMITENTE VENDEDOR”</strong> entregue el <strong>“DEPARTAMENTO”, </strong> al <strong>“PROMITENTE COMPRADOR”,</strong> será necesario que, en la fecha prevista para tal efecto, y previa notificación que realice el <strong>“PROMITENTE VENDEDOR”</strong> al <strong>“PROMITENTE COMPRADOR”</strong> al correo electrónico <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong> señalado por el <strong>“PROMITENTE COMPRADOR”,</strong> quien deberá realizar una visita al <strong>“DEPARTAMENTO”</strong> y se firme un ACTA DE ENTREGA-RECEPCIÓN, misma que se integrará en su momento al contrato como <strong>ANEXO C.</strong></p>
                                                <p>En el ACTA DE ENTREGA-RECEPCIÓN se harán constar el o los detalles pendientes o deficientes. Por su parte el <strong>“PROMITENTE COMPRADOR”</strong> no podrán negarse a recibir el <strong>“DEPARTAMENTO”,</strong> cuando éstas presenten defectos de ornato o acabados que tarden en ser corregidos menos de 15 (quince) días hábiles.</p>
                                                <p>Si el <strong>“PROMITENTE COMPRADOR”</strong> no asiste a la visita o se niegan a firmar el acta de entrega-recepción, el <strong>“PROMITENTE VENDEDOR”</strong> o su representante, en presencia de dos testigos, hará constar los hechos ocurridos y se entenderá que se realiza la entrega del <strong>“DEPARTAMENTO”</strong> el <strong>“PROMITENTE COMPRADOR”</strong> perderá el derecho de señalar los detalles pendientes o deficientes.</p>
                                                <p><strong>NOVENA. -</strong> PENAS CONVENCIONALES. </p>
                                                <p>Por acuerdo expreso de <strong>“LAS PARTES”,</strong> el incumplimiento del presente contrato imputable al <strong>“PROMITENTE COMPRADOR”,</strong> será rescindido sin necesidad de resolución judicial. Además de la rescisión, el <strong>“PROMITENTE COMPRADOR”</strong> en este acto expresa su libre voluntad y acepta que pagará al <strong>“PROMITENTE VENDEDOR”</strong> como pena convencional el 40% (cuarenta por ciento) del precio total de la operación.</p>
                                                <p>Si se diera el supuesto descrito en el párrafo inmediato anterior, el <strong>“PROMITENTE VENDEDOR”</strong> se obliga a depositar el importe correspondiente al excedente, si lo hubiere, mediante cheque certificado a nombre del <strong>“PROMITENTE COMPRADOR”,</strong> así como los documentos vencidos y por vencer y con este solo hecho ambas partes están de acuerdo que este contrato quedará sin efecto alguno.</p>
                                                <p>En caso de darse el incumplimiento establecido en el párrafo anterior las partes podrán acordar que el <strong>“PROMITENTE COMPRADOR”</strong> realice el pago del precio de compraventa de contado, supuesto en el cual el contrato de promesa de compraventa permanecerá en plena fuerza y efectos</p>
                                                <p><strong>DÉCIMA. - </strong>REGLAMENTO.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”,</strong> se obligará a observar lo dispuesto en el reglamento interior que regulará el <strong>“DEPARTAMENTO”</strong> materia de la presente promesa de compraventa, desde el momento en que el antes mencionado tome posesión jurídica y/o material del <strong>“DEPARTAMENTO”,</strong> haciéndose sabedor desde este momento que las caras de la torre, azoteas y demás áreas que no sean privativas y que no estén comprendidas en el anexo B del reglamento interior que se elaborará para tal efecto, quedan a favor del Desarrollador del proyecto, y las cuales puede usar libremente sin limitación alguna y sin que medie autorización, de igual forma está de acuerdo en que el <strong>“PROMITENTE VENDEDOR”</strong> no pagará mantenimiento hasta que las unidades del desarrollador no sean vendidas o rentadas renunciando al artículo 38, 40 de la ley que regula el régimen en condominio de Puebla, renunciando a cualquier disposición legal que contraríe a lo antes señalado, por lo que al suscribir no se reserva derecho alguno por tal hecho; actos que quedarán establecido en el reglamento; instrumento que se materializa al momento de realizar la entrega física del mismo.</p>
                                                <p>En virtud de lo anterior cualquier modificación y/o adaptación en la distribución interior del <strong>“DEPARTAMENTO”</strong> materia de este contrato y que no afecte la estructura del edificio, que realice el <strong>“PROMITENTE COMPRADOR”</strong> en el <strong>“DEPARTAMENTO”,</strong> deberán solicitarse al <strong>“PROMITENTE VENDEDOR”</strong> por escrito, misma que deberá ceñirse estrictamente a lo establecido en el reglamento del EDIFICIO, para lo cual se deberá presentar un proyecto que autorizará el <strong>“PROMITENTE VENDEDOR”</strong> o quien administre el edificio.</p>
                                                <p><strong>DÉCIMA PRIMERA. -</strong> MANTENIMIENTO.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”,</strong> se obligará a pagar de manera mensual, los gastos de mantenimiento que genere el <strong>“DEPARTAMENTO”,</strong> del completo donde pertenece el bien materia de la compraventa, a partir de la entrega del <strong>“DEPARTAMENTO”,</strong> misma que se realizará previa notificación al <strong>“PROMITENTE COMPRADOR”</strong> y que constara en acta entrega recepción como lo establece la <strong>CLÁUSULA OCTAVA</strong> del presente contrato. </p>
                                                <p>El <strong>“PROMITENTE VENDEDOR”</strong> realizará la debida notificación al <strong>“PROMITENTE COMPRADOR”</strong> en la cual señalará la fecha de entrega del departamento. La notificación se efectuará por escrito al siguiente correo electrónico <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong>, el anterior señalado por el <strong>“PROMITENTE COMPRADOR”.</strong></p>
                                                <p>De lo anterior cabe resaltar que el <strong>“PROMITENTE COMPRADOR”,</strong> se obligará a pagar de manera mensual, los gastos de mantenimiento, aun cuando no se haya entregado el uso y goce del <strong>“DEPARTAMENTO”</strong> por causas directamente imputables al <strong>“PROMITENTE COMPRADOR”.</strong></p>
                                                <p>En este acto el <strong>“PROMITENTE COMPRADOR”</strong> se hace saber que el monto por concepto de gastos de mantenimiento, mismo que se acordará por el <strong>“PROMITENTE VENDEDOR”</strong> y/o el desarrollador plasmando tal hecho en el reglamento interior, y en el cual se determina la cuota en base a los costos que por dicho concepto genere el edificio, en congruencia con la variación de los precios del mercado, de igual manera aceptan y están conformes <strong>“LAS PARTES”</strong> que el desarrollador detentara la administración de la torre por periodo de 10 (diez) años, acto que se efectúa para el efecto de que la plusvalía del inmueble se mantenga, aunado a que el antes mencionado es de su interés cuidar del inmueble para que se mantenga su nombre y prestigio como constructor, sin perseguir en ningún momento ánimos de lucro; dichos actos se establecerá en el reglamento interior que se le hará del conocimiento al momento de realizar la entrega del <strong>“DEPARTAMENTO”.</strong></p>
                                                <p><strong>DÉCIMA SEGUNDA.-</strong> ESCRITURACIÓN. </p>
                                                <p><strong>“LAS PARTES” </strong> acuerdan que la celebración de la escritura definitiva en la que se haga constar la transmisión de los derechos del <strong>“DEPARTAMENTO”</strong> materia del presente contrato, se llevará a cabo a partir de la notificación que se realizara por parte del <strong>“PROMITENTE VENDEDOR”,</strong> al correo electrónico <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong>. </p>
                                                <p><strong>“LAS PARTES”</strong> acuerdan que, para llevar a cabo la transmisión de los derechos, el <strong>“PROMITENTE COMPRADOR”</strong> deberá previamente haber depositado el finiquito señalado en la CLÁUSULA SEGUNDA, y el cual se deberá ver reflejado, en la cuenta bancaria del “PROMITENTE VENDEDOR”, con lo que se acredite que el <strong> “PROMITENTE COMPRADOR”</strong> ha cumplido con el pago total del <strong>“DEPARTAMENTO”.</strong> </p>
                                                <p>Una vez cumplido lo anterior y el <strong>“DEPARTAMENTO”</strong> esté listo para la escrituración deberá de llevarse a cabo en un plazo no mayor a 3 (tres) meses. En caso de no llevar a cabo dicha escrituración por causa imputable al <strong>“PROMITENTE COMPRADOR”</strong> se hará acreedor a una pena del 0.1% sobre el total del monto de la compraventa por cada día natural que transcurra después de los 3 (tres) meses mencionados.</p>
                                                <p>Para lo cual el <strong>“PROMITENTE COMPRADOR”</strong> deberá de entregar todos los documentos que la Notaría requiera y que de manera enunciativa se indican en el <strong> Anexo F,</strong> así como al correo electrónico <strong>escrituracion@grupojv.com.mx.</strong></p>
                                                <p><strong>DÉCIMA TERCERA. –</strong> GASTOS.</p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”</strong> asume la obligación de pagar todos los gastos, impuestos, contribuciones y derechos que se generen por la firma del contrato, incluyendo honorarios notariales, Impuesto sobre Adquisición de Inmuebles, derechos de registro y cualquier otro gasto o costo relativo a la promesa de compraventa del “DEPARTAMENTO”, en su caso, con excepción hecha al Impuesto sobre la renta y aquellas contribuciones, cargos, derechos o impuestos que le correspondan al <strong> “PROMITENTE VENDEDOR”</strong> conforme a la legislación aplicable.</p>
                                                <p><strong>DÉCIMA CUARTA. -</strong> CASO FORTUITO O FUERZA MAYOR.</p>
                                                <p><strong>“LAS PARTES”</strong> establecen que para el caso de que no se pudiera concluir la venta del “DEPARTAMENTO” por caso fortuito o fuerza mayor como sería por temblor, erupción volcánica entre otros, las cantidades que haya entregado al <strong>“PROMITENTE COMPRADOR”,</strong> a favor del <strong>“PROMITENTE VENDEDOR”,</strong> serán entregadas a más tardar dentro de los 90 (noventa) días naturales contados a partir de la fecha en que se emita dictamen por autoridad competente que señale la imposibilidad de ejecutar o terminar la obra, dichos montos serán depositados a la cuenta a nombre del <strong>“PROMITENTE COMPRADOR”.</strong> Dicha cantidad no generará interés alguno. </p>
                                                <p><strong>DÉCIMA QUINTA. -</strong> RESCISIÓN DE CONTRATO.</p>
                                                <p>Son causales de rescisión del presente contrato:</p>
                                                <ol type="a">
                                                    <li>El incumplimiento de cualquiera de las obligaciones establecidas en el clausulado de este contrato para <strong>“LAS PARTES”;</strong></li>
                                                    <li>El retraso en el pago de dos o más mensualudades establecidas en la cláusula Segunda; y</li>
                                                    <li>Las que contempla la Ley de la materia como tales.</li>
                                                </ol>
                                                <p><strong>DÉCIMA SEXTA. –</strong> OBLIGACIONES DEL “PROMITENTE VENDEDOR”. </p>
                                                <p>El <strong>“PROMITENTE VENDEDOR” </strong>se obliga frente al <strong>“PROMITENTE COMPRADOR”,</strong> al momento de llevar a cabo la escrituración correspondiente, a: </p>
                                                <ol type="a">
                                                    <li>Entregar la documentación requerida para que el Notario Público otorgue la Escritura Pública.</li>
                                                    <li>Obtener todas aquellas licencias o permisos que sean necesarios para el uso del <strong>“DEPARTAMENTO”</strong> y que estén eminentemente relacionados con el presente contrato y dentro de sus actividades.</li>
                                                    <li>Que el <strong>“DEPARTAMENTO”</strong> se encuentre libre de gravamen y al corriente en el pago de contribuciones y servicios contratados en el <strong>“DEPARTAMENTO”</strong> y </li>
                                                    <li>Transmitir al <strong>“PROMITENTE COMPRADOR”</strong> la propiedad del <strong>“DEPARTAMENTO”</strong> en los términos de este contrato”.</li>
                                                </ol>
                                                <p><strong>DÉCIMA SÉPTIMA. –</strong> OBLIGACIONES DEL <strong>“PROMITENTE COMPRADOR”.</strong></p>
                                                <p>Además de las obligaciones que a su cargo se derivan en los términos del presente contrato, el <strong>“PROMITENTE COMPRADOR” </strong>se obliga frente al <strong>“PROMITENTE VENDEDOR”</strong> a:</p>
                                                <ol type="A">
                                                    <li>Una vez entregado el <strong>“DEPARTAMENTO”,</strong> observar las disposiciones que se deriven del régimen interior y políticas del EDIFICIO y cubrir puntualmente con las obligaciones que se deriven del mismo, tales como pago de suministro de agua, cuotas de mantenimiento, servicios de consumo de energía eléctrica, pago de impuesto predial, vigilancia o seguridad y cualquier otro gasto relacionado con EL EDIFICIO;</li>
                                                    <li>Una vez entregado el <strong>“DEPARTAMENTO”,</strong> cubrir cabal y puntualmente por su cuenta, las cuotas, impuestos y demás cargas fiscales, presentes y futuras, que resulten de la celebración del presente contrato o se relacionen con El EDIFICIO y por cuenta propia cubrir el monto del Impuesto Sobre Adquisición de Bienes Inmuebles que a su cargo resulte de la celebración del presente contrato.</li>
                                                    <li>Cubrir los honorarios notariales y demás gastos y derechos que se deriven de la firma de la Escritura en que conste la transmisión de la propiedad del <strong>“DEPARTAMENTO”,</strong> así como la inscripción de la misma en el Registro Público de la Propiedad.</li>
                                                </ol>
                                                <p><strong>DÉCIMA OCTAVA. -</strong> NOTIFICACIONES </p>
                                                <p>Todas las notificaciones y comunicaciones conforme al presente contrato se deberán efectuar por escrito al domicilio o por correo electrónico que a continuación se señala o en cualquier otro domicilio y/o correo que cualquier parte señale mediante notificación por escrito o correo electrónico que se señala en el presente contrato. </p>
                                                <p>Todas las notificaciones y comunicaciones que se entreguen en el domicilio y/o correo electrónico de la parte correspondiente surtirán efecto en la fecha de entrega de los mismos. Las notificaciones de carácter legal se deberán efectuar de conformidad y por los conductos que establecen las disposiciones legales mexicanas aplicables.</p>
                                                <p>El <strong>“PROMITENTE VENDEDOR”: </strong> Señala como su domicilio, para el cumplimiento de las obligaciones derivadas de este Contrato el ubicado en <strong>Camino Real a Cholula, número 6667 (seis mil seiscientos sesenta y siete), Colonia Zavaleta, Puebla, Puebla, C.P. 72150.</strong></p>
                                                <p>Correo: <strong>ccastilla@grupojv.com.mx y/o escrituración@grupojv.com.mx</strong> .</p>
                                                <p>El “PROMITENTE COMPRADOR”: Señala como su domicilio, para el cumplimiento de las obligaciones derivadas de este contrato el ubicado en <strong><span class="text-info contrato-variable" name="campo_direccion_fiscal_1" id="campo_direccion_fiscal_1" style="color: #3bafda"><?php echo (!empty($cliente_row->domicilio_fiscal) ? mb_strtoupper(trim($cliente_row->domicilio_fiscal)) : ''); ?></span></strong>.</p>
                                                <p>Correo: <strong><span class="text-info contrato-variable" name="campo_correo_electronico_1" id="campo_correo_electronico_1" style="color: #3bafda"><?php echo (!empty($cliente_row->correo_electronico) ? trim($cliente_row->correo_electronico) : ''); ?></span></strong>.</p>
                                                <p><strong>“LAS PARTES”</strong> acuerdan que las comunicaciones y notificaciones entre ellas podrán ser realizadas por vía electrónica a través de correo electrónico la cual tendrá valides desde el momento en que salga del correo del remitente según la IP, no siendo necesario el acuse de recibido, con ello se acredita el momento de su remisión, el contenido de la notificación y la identificación del remitente y del destinatario, utilizando sus direcciones de correo electrónico.</p>
                                                <p>Se tendrá como válida al efecto del cómputo de los plazos, la fecha que conste en el sistema utilizado para la remisión de la notificación, independientemente de la fecha a la que haya tenido acceso a ella el destinatario, e, incluso si no ha llegado a acceder a ella, por error en la identificación u otra causa no imputable al remitente.</p>
                                                <p><strong>DÉCIMA NOVENA. –</strong> ANEXOS. </p>
                                                <p>El <strong>“PROMITENTE COMPRADOR”, </strong>en este acto ratificarán todos y cada uno de los anexos que conforman el presente contrato, de los cuales manifiestan conocer su contenido y alcance de todos y cada uno de ellos por lo que el <strong>“PROMITENTE COMPRADOR”,</strong> firmarán el acuse de recibo correspondiente manifestando que conoce y acepta el contenido del mismo. </p>
                                                <p><strong>VIGÉSIMA.-</strong> UNIDAD Y VALIDEZ DEL CONTRATO. </p>
                                                <p>El presente contrato, sus Anexos, consignan el acuerdo íntegro entre <strong>“LAS PARTES”</strong> respecto de las operaciones a que el mismo se refiere y deja sin efectos cualesquiera otros Contratos, compromisos y acuerdos celebrados entre <strong>“LAS PARTES”</strong> con anterioridad, en relación con el objeto de que prevé este contrato.</p>
                                                <p><strong>VIGÉSIMA PRIMERA. -</strong> DIVISIBILIDAD. </p>
                                                <p><strong>“LAS PARTES”</strong> están de acuerdo en que, si cualquier disposición de este contrato es declarada ilegal, inválida, no ejecutable, conforme a cualquier Ley, este contrato será interpretado y ejecutado como si dicha disposición no formase parte del presente contrato y las disposiciones restantes de este contrato seguirán siendo vigentes y con toda su fuerza legal y no serán afectadas por la disposición declarada ilegal, inválida, o no ejecutable, o por la separación de la misma del presente.</p>
                                                <p><strong>VIGÉSIMA SEGUNDA. -</strong> MODIFICACIONES </p>
                                                <p>Las modificaciones o renuncias a lo previsto en el contrato serán válidas cuando consten por escrito y estén firmadas por la parte en contra de la cual pretende hacerse exigible. </p>
                                                <p><strong>VIGÉSIMA TERCERA. -</strong> EJEMPLARES.</p>
                                                <p>Este contrato puede ser celebrado en dos o más ejemplares y cada ejemplar será considerado como si fuera original, y los ejemplares juntos constituirán un solo acuerdo.</p>
                                                <p><strong>VIGÉSIMA CUARTA –</strong> CESIÓN</p>
                                                <p>Los derechos y obligaciones a favor del <strong>“PROMITENTE COMPRADOR” </strong> bajo el contrato podrán ser cedidos por el <strong>“PROMITENTE VENDEDOR”</strong> a una sociedad subsidiaria, afiliada o relacionada con la misma, así como a terceras personas, mediante simple notificación por escrito al <strong> “PROMITENTE COMPRADOR”</strong> en el domicilio señalado en la Cláusula DÉCIMA OCTAVA, situación que solo se podrá verificar antes de la firma de la escritura ante Notario Público. </p>
                                                <p>Igualmente, el <strong>“PROMITENTE COMPRADOR”</strong> manifiesta que no podrá ceder los derechos y obligaciones que se consignan en el presente contrato a ninguna persona, filial o dependencia; para el caso de que lo realice la antes mencionada acepta hacerse acreedora a cubrir a favor del <strong>“PROMITENTE VENDEDOR”</strong> una pena del 10% (diez por ciento) del precio total del presente contrato.</p>
                                                <p><strong>VIGÉSIMA QUINTA. -</strong> El “PROMITENTE COMPRADOR” se obliga a realizar entrega de todos y cada uno de los documentos que se describen en el ANEXO E mismos que sirven para la integración del expediente antilavado de conformidad a la Ley Federal para la Prevención e Identificación de Operaciones con Recursos de Procedencia Ilícita, señalado en el ANEXO F mismos que deberán ser entregados al “PROMITENTE VENDEDOR” y a la notaría a efecto de poder realizar la escrituración correspondiente.</p>
                                                <p><strong>VIGÉSIMA SEXTA. -</strong> PROTECCIÓN DE DATOS PERSONALES.</p>
                                                <p><strong>“LAS PARTES”</strong> reconocen que con motivo de la realización de este contrato pueden llegar a intercambiar datos personales, según dicho término se define en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (“LFPDPPP”), como responsables directos o como encargados por cuenta de la parte opuesta, por lo que en virtud de este acto consienten recíprocamente la obtención, uso, divulgación, almacenamiento, manejo y tratamiento en cualquier forma de dichos datos por la parte opuesta, únicamente para los fines y efectos que se deriven de este Contrato.</p>
                                                <p>En razón de lo anterior, <strong>“LAS PARTES”</strong> se obligan a otorgar tratamiento confidencial a la totalidad de los datos personales que obtengan o lleguen a obtener por virtud del presente contrato de la parte opuesta, para lo cual deberán tomar las medidas necesarias de seguridad para garantizar el manejo legítimo, controlado e informado de cualquier dato personal por sí o sus empleados, dependientes, asociados, afiliados o cualquier otra persona con la que tengan relación y en virtud de la cual el dato personal pudiera ser obtenido, como si se tratara de información propia.</p>
                                                <p><strong>“LAS PARTES”</strong> reconocen que por ningún motivo podrán asumir la titularidad o propiedad de los datos personales que obtengan de la parte opuesta, ni podrán hacer uso de los datos personales obtenidos para finalidades distintas a las que se deriven del presente contrato.</p>
                                                <p><strong>“LAS PARTES”</strong> no podrán difundir, comunicar, transferir o divulgar por cualquier medio los datos personales contenidos en el presente contrato o que lleguen a obtener por la celebración del mismo de la otra parte, a cualquier tercero, excepto cuando dicha difusión, comunicación, transferencia o divulgación sea inherente o necesaria para el cumplimiento de los fines de este contrato, o sea requerida por mandamiento de autoridad competente, sujetándose en caso de incumplimiento a las sanciones que para el caso establecen los artículos 63, 64, 65 y 66 de LFPDPPP.</p>
                                                <p>En caso de duda respecto del tratamiento que pueda o no darse a cualquier dato personal de alguna de <strong>“LAS PARTES”,</strong> la parte dudosa deberá solicitar aclaración y autorización para el tratamiento del mismo a la otra. En tanto no sea resuelta la duda, se entenderá que la parte dudosa no está autorizada para tratar el dato personal en cuestión.</p>
                                                <p>Al término de la vigencia de este contrato por cualquier causa, <strong>“LAS PARTES”</strong> destruirán cualquier información que contenga datos personales de la parte opuesta, con sujeción a las sanciones mencionadas.</p>
                                                <p><strong>“LAS PARTES”</strong> están de acuerdo en que esta cláusula constituye el Aviso de Privacidad a que se refiere la LFPDPPP, por lo que renuncian expresamente al ejercicio de cualquier acción legal derivada de la falta de dicho aviso.</p>
                                                <p><strong>VIGÉSIMA SÉPTIMA. -</strong> TÍTULOS Y ENCABEZADOS </p>
                                                <p>Los encabezados que se citan en cada una de las cláusulas del contrato sólo tendrán efectos de referencia, por lo que no se afecta su interpretación ni se consideran parte de las mismas. </p>
                                                <p><strong>VIGÉSIMA OCTAVA. -</strong> CONTENIDO Y ALCANCE LEGAL.</p>
                                                <p>Convienen expresamente <strong>“LAS PARTES”</strong> en que al firmar el presente documento supieron del contenido y alcance legal de las disposiciones que lo rigen, quedando debidamente enterados de las obligaciones y fuerza legal que se desprenden de las mismas, por lo que aceptan plenamente que en el presente contrato no media error, dolo, lesión, mala fe, renuncia improcedente de derechos o cualquier otro vicio de la voluntad que pudiera invalidarlo, y ratifican que todo lo convenido es la expresión fiel de sus voluntades.</p>
                                                <p><strong>VIGÉSIMA NOVENA. -</strong> JURISDICCIÓN Y COMPETENCIA </p>
                                                <p><strong>“LAS PARTES”</strong> en común acuerdo señalan que, para la interpretación, cumplimiento y ejecución del presente contrato, <strong> “LAS PARTES”</strong> se someterán expresamente a las leyes y tribunales de esta ciudad de Puebla, renunciando al fuero de otros tribunales que, por motivo de su domicilio, presente o futuro, o por cualquier otra causa, llegase a corresponderles.</p>
                                                <p><strong>ESTANDO ENTERADOS El “PROMITENTE VENDEDOR” Y EL “PROMITENTE COMPRADOR” DEL CONTENIDO Y FUERZA LEGAL DEL CONTRATO, LO FIRMAN POR DUPLICADO EN LA CIUDAD DE PUEBLA, ESTADO DE PUEBLA CON EFECTOS A PARTIR DEL 28 (VEINTIOCHO) DE JUNIO DEL AÑO 2023 (DOS MIL VEINTITRÉS).</strong></p class="fin">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="width: 50%;">
                                                            <p style="text-align: center;"><strong>“PROMITENTE VENDEDOR”</strong></p>
                                                            <br><br><br>
                                                            <hr style="border-color: black;">
                                                            <p style="text-align: center;">PERSONA MORAL DENOMINADA
                                                                “2820 CONSTRUCTORA PUEBLA”, S.A. DE C.V.
                                                            </p>
                                                            <p style="text-align: center;">(A través de su Administrador único) <br>
                                                                FRANCISCO JAVIER BARRANCO ZUÑIGA
                                                            </p>
                                                        </td>
                                                        <td style="width: 50%;">
                                                            <p style="text-align: center;"><strong>“PROMITENTE COMPRADOR”</strong></p>
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