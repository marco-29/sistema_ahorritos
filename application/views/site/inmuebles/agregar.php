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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/inmuebles'); ?>">Inmuebles</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
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

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="desarrollo">A que desarrollo pertenece:</label>
                                                            <div class="col-lg-12">
                                                                <select id="desarrollo" name="desarrollo" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('desarrollo', '', set_value('desarrollo') ? false : '' == $this->session->flashdata('desarrollo')); ?>>Seleccione un desarrollo…</option>
                                                                    <?php foreach ($desarrollos_list as $key => $desarrollo_row) : ?>
                                                                        <option value="<?php echo $desarrollo_row->identificador; ?>" <?php echo set_select('desarrollo', $desarrollo_row->identificador, set_value('desarrollo') ? false : $desarrollo_row->identificador == $this->session->flashdata('desarrollo')); ?>><?php echo trim($desarrollo_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar un desarrollo válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

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

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="tipo_inmueble">Tipo de inmueble</label>
                                                            <div class="col-lg-12">
                                                                <select id="tipo_inmueble" name="tipo_inmueble" class="form-control select2 custom-select">
                                                                    <option value="" <?php echo set_select('tipo_inmueble', '', set_value('tipo_inmueble') ? false : '' == $this->session->flashdata('tipo_inmueble')); ?>>Seleccione una tipo de inmueble…</option>
                                                                    <?php foreach (select_tipo_inmueble() as $key => $tipo_inmueble_row) : ?>
                                                                        <option value="<?php echo $tipo_inmueble_row->valor; ?>" <?php echo $tipo_inmueble_row->activo == false ? '' : 'selected'; ?> <?php echo set_select('tipo_inmueble', $tipo_inmueble_row->valor, set_value('tipo_inmueble') ? false : $tipo_inmueble_row->valor == $this->session->flashdata('tipo_inmueble')); ?>><?php echo trim($tipo_inmueble_row->nombre); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere seleccionar una tipo de inmueble válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="precio">Precio</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio" value="<?php echo set_value('precio') == false ? $this->session->flashdata('precio') : set_value('precio'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere una precio válido.
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