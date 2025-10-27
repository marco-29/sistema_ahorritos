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
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
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

                                    <div class="row match-height">
                                        <div class="col-xl-6 col-md-6 col-sm-12">
                                            <div class="row">

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <h4 class="text-bold-800 grey darken-2">Desarrollo</h4>
                                                    <hr>
                                                </div>
                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="nombre">Nombre</label>
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo set_value('nombre') == false ? $this->session->flashdata('nombre') : set_value('nombre'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una nombre válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12 mt-2 mb-2">
                                                    <h4 class="text-bold-800 grey darken-2">Inmuebles</h4>
                                                    <hr>
                                                    <small class="text-muted"><em>"Complete los datos del inmueble según sea posible; son opcionales y podrán modificarse más adelante."</em></small>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="no_inmuebles">No. inmuebles</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="no_inmuebles" id="no_inmuebles" placeholder="No. inmuebles" value="<?php echo set_value('no_inmuebles') == false ? $this->session->flashdata('no_inmuebles') : set_value('no_inmuebles'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una No. inmuebles válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-8 col-md-8 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="tipo_inmueble">Tipo inmuebles</label>
                                                            <div class="col-lg-12">
                                                                <select id="tipo_inmueble" name="tipo_inmueble" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('tipo_inmueble', '', set_value('tipo_inmueble') ? false : '' == $this->session->flashdata('tipo_inmueble')); ?>>Seleccione un tipo inmuebles…</option>
                                                                    <?php foreach (select_tipo_inmueble() as $key => $tipo_inmueble_row) : ?>
                                                                        <option value="<?php echo $tipo_inmueble_row->valor; ?>" <?php echo $tipo_inmueble_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('tipo_inmueble', $tipo_inmueble_row->valor, set_value('tipo_inmueble') ? false : $tipo_inmueble_row->valor == $this->session->flashdata('tipo_inmueble')); ?>><?php echo trim($tipo_inmueble_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un tipo inmuebles válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="modalidad">Modalidad</label>
                                                            <div class="col-lg-12">
                                                                <select id="modalidad" name="modalidad" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('modalidad', '', set_value('modalidad') ? false : '' == $this->session->flashdata('modalidad')); ?>>Seleccione un modalidad…</option>
                                                                    <?php foreach (select_modalidad() as $key => $modalidad_row) : ?>
                                                                        <option value="<?php echo $modalidad_row->valor; ?>" <?php echo $modalidad_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('modalidad', $modalidad_row->valor, set_value('modalidad') ? false : $modalidad_row->valor == $this->session->flashdata('modalidad')); ?>><?php echo trim($modalidad_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un modalidad válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="prototipo">Prototipo recurrente</label>
                                                            <div class="col-lg-12">
                                                                <select id="prototipo" name="prototipo" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('prototipo', '', set_value('prototipo') ? false : '' == $this->session->flashdata('prototipo')); ?>>Seleccione un prototipo recurrente…</option>
                                                                    <?php foreach (select_prototipo() as $key => $prototipo_row) : ?>
                                                                        <option value="<?php echo $prototipo_row->valor; ?>" <?php echo $prototipo_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('prototipo', $prototipo_row->valor, set_value('prototipo') ? false : $prototipo_row->valor == $this->session->flashdata('prototipo')); ?>><?php echo trim($prototipo_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un prototipo recurrente válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tamanho_construccion">Tamaño construcción recurrente</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" step="0.01" name="tamanho_construccion" id="tamanho_construccion" placeholder="Tamaño construcción" value="<?php echo set_value('tamanho_construccion') == false ? $this->session->flashdata('tamanho_construccion') : set_value('tamanho_construccion'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una tamaño construcción recurrente válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tamanho_terraza">Tamaño terraza recurrente</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" step="0.01" name="tamanho_terraza" id="tamanho_terraza" placeholder="Tamaño terraza" value="<?php echo set_value('tamanho_terraza') == false ? $this->session->flashdata('tamanho_terraza') : set_value('tamanho_terraza'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una tamaño terraza recurrente válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tamanho_total">Tamaño total recurrente</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" step="0.01" name="tamanho_total" id="tamanho_total" placeholder="Tamaño total" value="<?php echo set_value('tamanho_total') == false ? $this->session->flashdata('tamanho_total') : set_value('tamanho_total'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una tamaño total recurrente válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="precio">Precio recurrente</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" step="0.01" name="precio" id="precio" placeholder="precio recurrente" value="<?php echo set_value('precio') == false ? $this->session->flashdata('precio') : set_value('precio'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una precio recurrente válido.
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