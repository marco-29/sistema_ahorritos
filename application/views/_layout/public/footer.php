    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <footer class="footer fixed-bottom">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; <script>
                    document.write(new Date().getFullYear());
                </script> <a class="text-bold-800 grey darken-2" href="<?php echo site_url('nosotros'); ?>" target="_blank"><?php echo nombre_fiscal(); ?> </a>, Todos los derechos reservados. </span>
            <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block"><a class="text-bold-800 grey darken-2" href="<?php echo site_url('terminos_y_condiciones'); ?>" target="_blank" rel="noopener noreferrer">Términos y condiciones</a> | <a class="text-bold-800 grey darken-2" href="<?php echo site_url('politica_de_privacidad'); ?>" target="_blank" rel="noopener noreferrer">Política de privacidad</a></span>
        </p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url('app-assets/vendors/js/vendors.min.js'); ?>"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?php echo base_url('app-assets/vendors/js/ui/jquery.sticky.js'); ?>"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url('app-assets/js/core/app-menu.js'); ?>"></script>
    <script src="<?php echo base_url('app-assets/js/core/app.js'); ?>"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->

    <?php if (isset($scripts) && is_array($scripts)) : ?>
        <?php foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?php echo !$script['es_rel'] ? $script['src'] : base_url() . 'assets/js/' . $script['src']; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>