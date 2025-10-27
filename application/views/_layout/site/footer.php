    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <footer class="footer footer-transparent">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout">
            <span class="float-md-center d-block d-md-inline-block">Copyright &copy; <script>
                    document.write(new Date().getFullYear())
                </script> <a class="text-bold-800 grey darken-2" href="<?php echo site_url(); ?>"><?php echo nombre_fiscal(); ?></a>, Todos los derechos reservados.</span>
        </p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url(); ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="<?php echo base_url(); ?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url(); ?>app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url(); ?>assets/js/main.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <?php if (isset($scripts) && is_array($scripts)) : ?>
        <?php foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?php echo !$script['es_rel'] ? $script['src'] : base_url() . 'assets/js/' . $script['src']; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>