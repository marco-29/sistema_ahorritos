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

                <h3 class="content-header-title mb-0"><?php echo $pagina_titulo; ?></h3>

                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/inicio'); ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/leads'); ?>">Leads</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
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

                                    <?php echo form_open_multipart(uri_string(), array('class' => 'needs-validation p-2', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>

                                    <input type="hidden" class="form-control" name="identificador" id="identificador" placeholder="identificador" value="<?php echo $inmueble_row->identificador; ?>" readonly required>

                                    <div class="row match-height">
                                        <div class="col-xl-6 col-md-6 col-sm-12">

                                            <div class="row">

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="nombre">Nombre del inmueble</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" value="<?php echo $inmueble_row->nombre; ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="telefono">Tipo de inmubele</label>
                                                            <div class="col-lg-12">
                                                                <select class="form-control select2 custom-select" name="tipo_inmueble" id="tipo_inmueble">
                                                                    <option value="" <?php echo set_select('tipo_inmueble', '', set_value('tipo_inmueble') ? false : '' == (!empty($this->session->flashdata('tipo_inmueble')) ? $this->session->flashdata('tipo_inmueble') : (!empty($inmueble_row->tipo_inmueble) ? $inmueble_row->tipo_inmueble : set_value('tipo_inmueble')))); ?>>Seleccione un prototipo…</option>
                                                                    <?php foreach (select_tipo_inmueble() as $prototipo_row) : ?>
                                                                        <option value="<?php echo $prototipo_row->valor; ?>" <?php echo set_select('tipo_inmueble', $prototipo_row->valor, set_value('tipo_inmueble') ? false : $prototipo_row->valor == (!empty($this->session->flashdata('tipo_inmueble')) ? $this->session->flashdata('tipo_inmueble') : (!empty($inmueble_row->tipo_inmueble) ? $inmueble_row->tipo_inmueble : set_value('tipo_inmueble')))); ?>><?php echo trim($prototipo_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un prototipo válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="precio">Precio</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio" value="<?php echo set_value('precio') == false ? (!empty($this->session->flashdata('precio')) ? $this->session->flashdata('precio') : (!empty($inmueble_row->precio) ? $inmueble_row->precio : set_value('precio'))) : set_value('precio'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una precio válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tamanho_construccion">Tamaño de construcción</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="tamanho_construccion" id="tamanho_construccion" placeholder="Tamaño de construcción" value="<?php echo set_value('tamanho_construccion') == false ? (!empty($this->session->flashdata('tamanho_construccion')) ? $this->session->flashdata('tamanho_construccion') : (!empty($inmueble_row->tamanho_construccion) ? $inmueble_row->tamanho_construccion : set_value('tamanho_construccion'))) : set_value('tamanho_construccion'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un tamaño de construcción válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tamanho_construccion">Tamaño de terraza</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="tamanho_construccion" id="tamanho_construccion" placeholder="Tamaño de construcción" value="<?php echo set_value('tamanho_construccion') == false ? (!empty($this->session->flashdata('tamanho_construccion')) ? $this->session->flashdata('tamanho_construccion') : (!empty($inmueble_row->tamanho_terraza) ? $inmueble_row->tamanho_terraza : set_value('tamanho_construccion'))) : set_value('tamanho_construccion'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un tamaño de construcción válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tamanho_total">Tamaño de total</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="tamanho_total" id="tamanho_total" placeholder="Tamaño de total" value="<?php echo set_value('tamanho_total') == false ? (!empty($this->session->flashdata('tamanho_total')) ? $this->session->flashdata('tamanho_total') : (!empty($inmueble_row->tamanho_total) ? $inmueble_row->tamanho_total : set_value('tamanho_total'))) : set_value('tamanho_total'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un tamaño de total válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="prototipo">Prototipo</label>
                                                            <div class="col-lg-12">
                                                                <select id="prototipo" name="prototipo" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('prototipo', '', set_value('prototipo') ? false : '' == (!empty($this->session->flashdata('prototipo')) ? $this->session->flashdata('prototipo') : (!empty($inmueble_row->prototipo) ? $inmueble_row->prototipo : set_value('prototipo')))); ?>>Seleccione un prototipo…</option>
                                                                    <?php foreach (select_prototipo() as $prototipo_row) : ?>
                                                                        <option value="<?php echo $prototipo_row->valor; ?>" <?php echo set_select('prototipo', $prototipo_row->valor, set_value('prototipo') ? false : $prototipo_row->valor == (!empty($this->session->flashdata('prototipo')) ? $this->session->flashdata('prototipo') : (!empty($inmueble_row->prototipo) ? $inmueble_row->prototipo : set_value('prototipo')))); ?>><?php echo trim($prototipo_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un prototipo válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="mascotas">Modalidad</label>
                                                            <div class="col-lg-12">
                                                                <select id="modalidad" name="modalidad" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('modalidad', '', set_value('modalidad') ? false : '' == (!empty($this->session->flashdata('modalidad')) ? $this->session->flashdata('modalidad') : (!empty($inmueble_row->modalidad) ? $inmueble_row->modalidad : set_value('modalidad')))); ?>>Seleccione un prototipo…</option>
                                                                    <?php foreach (select_modalidad() as $prototipo_row) : ?>
                                                                        <option value="<?php echo $prototipo_row->valor; ?>" <?php echo set_select('modalidad', $prototipo_row->valor, set_value('modalidad') ? false : $prototipo_row->valor == (!empty($this->session->flashdata('modalidad')) ? $this->session->flashdata('modalidad') : (!empty($inmueble_row->modalidad) ? $inmueble_row->modalidad : set_value('modalidad')))); ?>><?php echo trim($prototipo_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar una modalidad válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="estatus_lead">Estatus del inmueble</label>
                                                            <div class="col-lg-12">
                                                                <select id="estatus" name="estatus" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('estatus', '', set_value('estatus') ? false : '' == (!empty($this->session->flashdata('estatus')) ? $this->session->flashdata('estatus') : (!empty($inmueble_row->estatus) ? $inmueble_row->estatus : set_value('estatus')))); ?>>Seleccione un prototipo…</option>
                                                                    <?php foreach (select_estatus() as $prototipo_row) : ?>
                                                                        <option value="<?php echo $prototipo_row->valor; ?>" <?php echo set_select('estatus', $prototipo_row->valor, set_value('estatus') ? false : $prototipo_row->valor == (!empty($this->session->flashdata('estatus')) ? $this->session->flashdata('estatus') : (!empty($inmueble_row->estatus) ? $inmueble_row->estatus : set_value('estatus')))); ?>><?php echo trim($prototipo_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un estatus del inmueble válido.
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

<?php print_r($inmueble_row); ?>