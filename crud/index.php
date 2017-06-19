<?PHP
$id_perfil = $_GET['id_perfil'];

if ($id_perfil == '1' || $id_perfil == '2') {
    ?>
    <html>
        <head>
            <title>Crud</title>
            <meta charset="UTF-8">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        </head>
        <div style="text-align: center;width: 50%;padding-top: 15%;"><h1></h1></div>
        <a href="indexPf.php"><button type="button" class="btn btn-large" style="width: 50%;padding-top:50px;float: left;background-color: #BEBEC5;"><b>PF</b></button></a>
        <a href="indexPj.php"><button type="button" class="btn btn-large" style="width: 50%;padding-top:50px;background-color: burlywood;"><b>PJ</b></button></a>

    <?php } else {
        ?>
        <div class="content-wrapper2"  >
            <div class="register-box" >
                <div class="register-box">
                    <div class="">
                        <div class="wrap" >
                            <div class="box-header with-border" style="float: left;width: 50%;">
                                Área Restrita
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
        <?php
    }
    ?>

