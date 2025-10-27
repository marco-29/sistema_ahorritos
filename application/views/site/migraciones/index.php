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
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-6 col-12">
                <div class="media float-right">
                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/clientes/agregar'); ?>">
                                <i class="fa fa-plus-circle"></i>&nbsp;Agregar
                            </a>
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

                                    <!-- Botón para iniciar la migración -->
                                    <button id="start-migration" class="btn btn-secondary">Iniciar Migración Clientes</button>
                                    <button id="crm_usuarios-start-migration" class="btn btn-secondary">Iniciar Migración (CRM Usuarios)</button>

                                    <!-- Mostrar progreso -->
                                    <div id="migration-status" style="margin-top: 20px;">
                                        <p>Progreso de migración: <span id="progress-percentage">0%</span></p>
                                        <div id="progress-bar" style="width: 0%; height: 20px; background-color: green;"></div>
                                    </div>

                                    <!-- Mostrar resultados -->
                                    <div id="migration-results" style="margin-top: 20px;">
                                        <h5>Resultados de la migración:</h5>
                                        <pre id="results-output"></pre>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables generales
        var offset = parseInt(localStorage.getItem('migration_offset')) || 0;
        var startTime;
        var elapsedTimeInterval;

        // Elementos comunes
        var progressPercentage = document.getElementById('progress-percentage');
        var progressBar = document.getElementById('progress-bar');
        var resultsOutput = document.getElementById('results-output');

        var timeCounter = document.createElement('p');
        var rangeCounter = document.createElement('p');
        document.getElementById('migration-status').appendChild(timeCounter);
        document.getElementById('migration-status').appendChild(rangeCounter);

        // --------------- Iniciar Migración Clientes -----------------
        var startButton = document.getElementById('start-migration');

        startButton.addEventListener('click', function() {
            startMigration('clientes');
        });

        function startMigration(type) {
            // Deshabilitar el botón para evitar clics múltiples
            var button = (type === 'clientes') ? startButton : crm_usuarios_startButton;
            button.disabled = true;

            // Reiniciar el progreso
            offset = 0;
            localStorage.setItem('migration_offset', offset);
            progressPercentage.textContent = '0%';
            progressBar.style.width = '0%';
            resultsOutput.textContent = ''; // Limpiar resultados anteriores

            // Iniciar el contador de tiempo
            startTime = Date.now();
            elapsedTimeInterval = setInterval(updateElapsedTime, 1000);

            // Iniciar el proceso de migración
            processBatch(type);
        }

        function processBatch(type) {
            var url = (type === 'clientes') ? '<?php echo site_url('site/migraciones/migrar_datos'); ?>' : '<?php echo site_url('site/migraciones/migrar_usuarios'); ?>';

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: 'offset=' + offset
                })
                .then(response => response.json())
                .then(data => {
                    // Actualizar el offset para el siguiente lote
                    let previousOffset = offset;
                    offset = data.new_offset;
                    localStorage.setItem('migration_offset', offset);

                    // Mostrar el rango de datos procesados en esta ejecución
                    rangeCounter.textContent = `Procesando registros desde ${previousOffset} hasta ${offset}`;

                    // Actualizar la barra de progreso con el progreso actual
                    let progress = data.progress;
                    progressPercentage.textContent = progress + '%';
                    progressBar.style.width = progress + '%';

                    // Reemplazar el contenido del área de resultados con los últimos datos procesados
                    resultsOutput.textContent = data.data_processed.map(item => JSON.stringify(item)).join(',\n') + '\n';

                    if (!data.finished) {
                        // Si no ha terminado, procesar el siguiente lote
                        processBatch(type);
                    } else {
                        // Esperar un pequeño tiempo para que la barra de progreso llegue a 100%
                        setTimeout(() => {
                            // Mostrar alerta de migración completada después de que el progreso haya llegado a 100%
                            alert('Migración completada');
                            // Habilitar el botón de nuevo
                            button.disabled = false;
                            clearInterval(elapsedTimeInterval); // Detener el contador de tiempo
                            localStorage.removeItem('migration_offset'); // Limpiar el offset almacenado
                        }, 500); // Esperar medio segundo (500ms) para que la interfaz termine de actualizarse
                    }
                })
                .catch(error => {
                    console.error('Error en la migración:', error);
                    button.disabled = false;

                    // Permitir la reanudación desde donde se quedó en caso de error
                    if (confirm('Hubo un error en la migración. ¿Deseas reintentar desde donde se quedó?')) {
                        processBatch(type);
                    } else {
                        clearInterval(elapsedTimeInterval); // Detener el contador de tiempo
                    }
                });
        }

        // ---------------- Iniciar Migración CRM Usuarios ----------------
        var crm_usuarios_startButton = document.getElementById('crm_usuarios-start-migration');

        crm_usuarios_startButton.addEventListener('click', function() {
            startMigration('crm_usuarios');
        });

        // --------------- Función para actualizar el tiempo transcurrido -----------------
        function updateElapsedTime() {
            var elapsedTime = Math.floor((Date.now() - startTime) / 1000);
            timeCounter.textContent = `Tiempo transcurrido: ${elapsedTime} segundos`;
        }

    });
</script>