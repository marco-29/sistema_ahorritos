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
                            <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>inicio/index">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active">Registros del sistema
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!--div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-info round dropdown-toggle dropdown-menu-right px-2" id="btnGroupDrop1"
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Cards</a><a class="dropdown-item"
                    href="component-buttons-extended.html">Buttons</a></div>
                </div>
            </div-->
        </div>
        <div class="content-body">
            <!-- Change Log -->
            <div class="card">
                <div class="card-header card-header-vista">
                    <h4 id="v10" class="card-title">Registros del sistema</h4>
                    <!--p><?php //echo date('Y-m-d'); ?></p-->
                </div>
                <div class="card-content" aria-expanded="true">
                    <div class="card-body">
                    <div class="card-text">
                        <ul>
                            <?php foreach($logs_list as $logs_row): ?>
                                <li>
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-12">
                                            No. y Fecha de registro:<br>
                                            Tipo:<br>
                                            ¿Quien?<br><br>
                                            Concepto:<br>
                                            Columna:<br>
                                            Valor nuevo:<br>
                                            Datos: <br>
                                        </div>
                                        <div class="col-xl-9 col-lg-12">
                                            <?php echo $logs_row->id ?>  -  <?php echo $logs_row->fecha_registro ?><br>
                                            
                                            <?php if($logs_row->tipo == "Actualizacion"):?>
                                                <span class="green"><?php echo $logs_row->tipo ?></span><br>
                                            <?php endif; ?>
                                            
                                            <?php echo $logs_row->identificador_usuario?> <br> <?php echo $logs_row->correo; ?><br>
                                            <?php echo $logs_row->concepto ?><br>
                                            <?php echo $logs_row->columna ?><br>
                                            <?php echo $logs_row->valor_nuevo ?><br>
                                            <?php echo $logs_row->datos ?><br>
                                        </div>
                                    </div>
                                    <br>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
            <!--/ Change Log -->
        </div>
    </div>
</div>