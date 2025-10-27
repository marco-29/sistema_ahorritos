<?php $this->load->view('site/modals/archivos/ver_archivo'); ?>
<?php $this->load->view('site/modals/archivos/eliminar_archivo'); ?>

<div class="app-content content center-layout">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos">
                    <h3 class="text-white"><strong><?php echo $pagina_titulo; ?>: <?php echo $inmueble_nodo_row->nombre; ?></strong></h3>
                    <p class="text-white">Identificador de venta: <span name="identificador" id="identificador"></span></p>
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
                            <li class="">&nbsp;&nbsp;&nbsp;&nbsp;<small><em><span name="mensaje_proceso_venta" id="mensaje_proceso_venta" class="info"></span></em></small></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                </div>
            </div>

        </div>
        <div class="content-detached content-right">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <?php echo form_open_multipart(site_url('site/desarrollos/cargar_archivo/' . $inmueble_nodo_row->identificador), array('class' => 'needs-validation', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>
                                    <div class="project-search-content">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-lg-12">Cargar archivo</label>
                                                <div class="col-lg-6">
                                                    <fieldset class="form-group">
                                                        <div class="custom-file">
                                                            <label class="custom-file-label" for="cargar_archivo">Cargar archivo</label>
                                                            <input type="file" class="custom-file-input" name="cargar_archivo" id="cargar_archivo" placeholder="Archivo de expediente" value="<?php echo set_value('cargar_archivo') == false ? $this->session->flashdata('cargar_archivo') : set_value('cargar_archivo'); ?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requiere un archivo válido.
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-2">
                                                    <button type="submit" class="btn btn-outline-secondary btn-min-width mr-1 mb-1 btn-block"><i class="fa fa-check-circle"></i>&nbsp;Cargar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>

                                <div class="card-body">
                                    <?php
                                    $carpeta_de_archivos = FCPATH . 'almacenamiento/archivos/' . $inmueble_nodo_row->identificador;
                                    ?>
                                    <?php if (is_dir($carpeta_de_archivos)) : ?>
                                        <?php $map = array_diff(scandir($carpeta_de_archivos), array('..', '.')); ?>
                                        <?php foreach ($map as $key => $value) : ?>
                                            <?php if (substr($value, 0, 1) !== '.') : ?>
                                                <?php
                                                $tipo_extension = pathinfo($value, PATHINFO_EXTENSION);

                                                if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                    $tipo_extension = 'archivo';
                                                } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                    $tipo_extension = 'imagen';
                                                }
                                                ?>
                                                <p class=""><a href="javascript:ver_archivo('<?php echo site_url('almacenamiento/archivos/' . $inmueble_nodo_row->identificador . '/' . $value); ?>', '<?php echo $tipo_extension; ?>');"><i class="fa fa-file-o"></i>&nbsp;<?php echo $value; ?></a></p>
                                                <hr>

                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p class="">Aún no hay archivos</p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
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
                                            <li><a class="" href="<?php echo site_url('site/desarrollos/ver/' . $inmueble_nodo_row->identificador); ?>">Ver desarrollo</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/documentos' . $inmueble_nodo_row->identificador); ?>"><b>Documentos</b></a></li>
                                        </ul>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-12">
                                    <h4>Datos del inmueble:</h4><br>
                                    <p>Nombre del Inmueble<br>
                                        <b><?php echo $inmueble_nodo_row->nombre; ?></b>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>Identificador<br><b><?php echo $inmueble_nodo_row->identificador; ?></b></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tipo de inmueble</b><br><?php echo ucfirst($inmueble_nodo_row->tipo_inmueble); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de construcción</b><br><?php echo $inmueble_nodo_row->tamanho_construccion . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de la terraza</b><br><?php echo $inmueble_nodo_row->tamanho_terraza . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño del total</b><br><?php echo $inmueble_nodo_row->tamanho_total . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Prototipo</b><br><?php echo $inmueble_nodo_row->prototipo; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Modalidad</b><br><?php echo ucfirst($inmueble_nodo_row->modalidad); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Estatus del inmueble</b><br><?php echo ucfirst($inmueble_nodo_row->estatus); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Predefined Views -->
                </div>
            </div>
        </div>
    </div>
</div>