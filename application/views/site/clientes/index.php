<div class="app-content content center-layout">
    <div class="content-wrapper">

        <!-- <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos ">
                    <h3 class="text-white"><strong><?php echo $pagina_titulo; ?></strong></h3>
                </div>
            </div>
        </div> -->

        <div class="content-header row px-1 my-1">

            <div class="content-header-left col-md-6 col-12">

                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/inicio'); ?>">Inicio</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group float-md-right mr-1 mb-1">
                        <div id="buttons"></div>
                    </div>

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/clientes/agregar'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</a>
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
                                <h4 class="card-title">Registro de <?php echo $pagina_titulo; ?></h4>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="row mb-2">

                                        <div class="col-xl-2 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-12" for="filtro_estatus_cliente"><i class="ft-filter"></i> Estatus del cliente</label>
                                                    <div class="col-12">
                                                        <select name="filtro_estatus_cliente" id='filtro_estatus_cliente' class="select2 form-control" multiple="multiple">
                                                            <option value=''>-- Selecciona un estatus --</option>
                                                            <?php
                                                            foreach ($estatus as $estatus) {
                                                                if (!empty($estatus->estatus_cliente)) {  // Verificar si el valor no está vacío
                                                                    echo "<option value='" . $estatus->estatus_cliente . "'>" . mb_strtoupper($estatus->estatus_cliente) . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-12" for="filtro_desarrollo_interes"><i class="ft-filter"></i> Desarrollo de interés</label>
                                                    <div class="col-12">
                                                        <select name="filtro_desarrollo_interes" id='filtro_desarrollo_interes' class="select2 form-control" multiple="multiple">
                                                            <option value=''>-- Selecciona un desarrollo --</option>
                                                            <?php
                                                            foreach ($desarrollos as $desarrollo) {
                                                                if (!empty($desarrollo->desarrollo_interes_identificador)) {  // Verificar si el valor no está vacío
                                                                    echo "<option value='" . $desarrollo->desarrollo_interes_identificador . "'>" . mb_strtoupper($desarrollo->nombre_desarrollo) . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-12" for="filtro_como_se_entero"><i class="ft-filter"></i> Cómo se enteró</label>
                                                    <div class="col-12">
                                                        <select name="filtro_como_se_entero" id='filtro_como_se_entero' class="select2 form-control" multiple="multiple">
                                                            <option value=''>-- Selecciona un medio --</option>
                                                            <?php
                                                            foreach ($medio as $medio) {
                                                                if (!empty($medio->como_se_entero)) {  // Verificar si el valor no está vacío
                                                                    echo "<option value='" . $medio->como_se_entero . "'>" . mb_strtoupper($medio->como_se_entero) . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-12" for="filtro_interes_semanal"><i class="ft-filter"></i> Interes semanal</label>
                                                    <div class="col-12">
                                                        <select name="filtro_interes_semanal" id='filtro_interes_semanal' class="select2 form-control" multiple="multiple">
                                                            <option value=''>-- Selecciona un interes semanal --</option>
                                                            <?php
                                                            foreach (select_interes_semanal() as $asesor) {
                                                                if (!empty($asesor->valor)) {  // Verificar si el valor no está vacío
                                                                    echo "<option value='" . $asesor->valor . "'>" . mb_strtoupper($asesor->nombre) . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-2 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-12" for="filtro_medio_contacto"><i class="ft-filter"></i> Medio de contacto</label>
                                                    <div class="col-12">
                                                        <select name="filtro_medio_contacto" id='filtro_medio_contacto' class="select2 form-control" multiple="multiple">
                                                            <option value=''>-- Selecciona un medio de contacto --</option>
                                                            <?php
                                                            foreach (select_medio_contacto() as $asesor) {
                                                                if (!empty($asesor->valor)) {  // Verificar si el valor no está vacío
                                                                    echo "<option value='" . $asesor->valor . "'>" . mb_strtoupper($asesor->nombre) . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <p name="mensaje_en_pantalla" id="mensaje_en_pantalla"></p>

                                    <div class="table-responsive">

                                        <!-- <?php echo 'rol: ' . $this->session->userdata('user_rol_identificador'); ?> -->

                                        <table name="table" id="table" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                            <thead>
                                                <tr>
                                                    <th>Opciones</th>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Desarrollo de interés</th>
                                                    <th>Estatus</th>
                                                    <th>Interés semanal</th>
                                                    <th>¿Cómo se enteró?</th>
                                                    <th>Medio de contacto</th>
                                                    <th>Correo</th>
                                                    <th>Teléfono</th>
                                                    <th>Última nota</th>
                                                    <th>Persona fiscal</th>
                                                    <th>Nombre del representante legal</th>
                                                    <th>Domicilio fiscal</th>
                                                    <th>Fecha de nacimiento</th>
                                                    <th>Estado civil</th>
                                                    <th>CURP</th>
                                                    <th>INE</th>
                                                    <th>RFC</th>
                                                    <th>Identificador</th>
                                                    <th>Asesor</th>
                                                    <th>Fecha registro</th>
                                                    <th>Fecha actualización</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

            </section>
        </div>

    </div>

</div>

<!-- Modal HTML -->
<div id="comentarioModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="tituloModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenedor para mostrar información de la fila seleccionada -->
                <!-- <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div id="infoClienteTitulo" class="col-6">
                            </div>
                            <div id="infoCliente" class="col-6">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4>Notas agregadas:</h4>
                        <div id="notas">
                            Aquí se llenará la información del cliente
                        </div>
                    </div>
                </div> -->

                <!-- Campo para ingresar el comentario -->
                <label class="required-field"><b>Nota:</b></label>
                <textarea id="comentario" class="form-control" rows="4" placeholder="Escribe un comentario..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info" id="guardarComentario">Guardar</button>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h4><b>Información del cliente:</b></h4>
                        <div class="row">
                            <div id="infoClienteTitulo" class="col-6">
                            </div>
                            <div id="infoCliente" class="col-6">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4><b>Notas agregadas:</b></h4>
                        <div id="notas">
                            <!-- Aquí se llenará la información del cliente -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>