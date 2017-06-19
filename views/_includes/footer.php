<?php if (!defined('ABSPATH')) exit; ?>
<!--
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0 Beta
    </div>
    <strong>Copyright &copy; 2015 <a href="http://http://datamailing.com.br/">DataWeb - Datamailing</a>.</strong> All rights reserved.
</footer>

-->

<div class="pull-right hidden-xs">
    <strong>Copyright &copy; 2015 <a href="http://http://datamailing.com.br/">DataWeb - Datamailing</a>.</strong> All rights reserved.
    <b>Version</b> 1.0 Beta
</div>
</div><!-- ./wrapper -->
<link rel='shortcut icon' href='<?php echo HOME_URI ?>/favicon.ico'/>

<!-- jQuery 2.1.3 -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    //$.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo HOME_URI ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
<script src="<?php echo HOME_URI ?>/bootstrap/js/bootstrap-multiselect.js" type="text/javascript"></script>    



<!-- Morris.js charts -->
<script src="<?php echo HOME_URI ?>/dist/js/raphael-min.js"></script>

<!-- Morris.js charts -->
<script src="<?php echo HOME_URI ?>/dist/js/novosEnviados.js"></script>



<script src="<?php echo HOME_URI ?>/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo HOME_URI ?>/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo HOME_URI ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo HOME_URI ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo HOME_URI ?>/plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo HOME_URI ?>/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo HOME_URI ?>/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo HOME_URI ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo HOME_URI ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo HOME_URI ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo HOME_URI ?>/plugins/fastclick/fastclick.min.js'></script>

<!-- AdminLTE App -->
<script src="<?php echo HOME_URI ?>/dist/js/app.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo HOME_URI ?>/dist/js/pages/dashboard.js" type="text/javascript"></script>

<!-- FUNCTIONS -->
<script src="<?php echo HOME_URI ?>/dist/js/functions.js" type="text/javascript"></script>

<!-- VALIDATE -->


<!-- MASK -->
<script src="<?php echo HOME_URI ?>/plugins/jQuery-Mask/jquery.mask.js" type="text/javascript"></script>
<script src="<?php echo HOME_URI ?>/plugins/select-multiple-bootstrap/dist/js/bootstrap-select.js"></script>



<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-65191922-1', 'auto');
    ga('send', 'pageview');

</script>



<script src="<?php echo HOME_URI ?>/dist/js/validate.js" type="text/javascript"></script>
<script rel="shortcut icon" src="<?php echo HOME_URI ?>/favicon.ico" type="image/x-icon" ></script>
    
<input class="btn btn-primary btn-block btn-flat" style="width: 50%;"type="hidden" name="cnpjEmpresa"  id="cnpjEmpresa" value="<?php echo ($_SESSION['userdata']['tb_usuario_cnpj_empresa']) ?>"/>
                            <input class="btn btn-primary btn-block btn-flat" style="width: 50%;"type="hidden" name="idtbUsuario" id="idtbUsuario" value="<?php echo ($_SESSION['userdata']['idtb_usuario']) ?>"/>
                            <input class="btn btn-primary btn-block btn-flat" style="width: 50%;"type="hidden" name="userEmail" id="userEmail" value="<?php echo ($_SESSION['userdata']['tb_usuario_username_email']) ?>"/>