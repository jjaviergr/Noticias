<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edicion</title>

        <!-- Boostrap -->
        <link rel="stylesheet" href="..//scss/bootstrap.min.css" >
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

        <!-- Tema opcional -->
        <link rel="stylesheet" href="..//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

        <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="..//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Demo stuff -->
        <link rel="stylesheet" href="../css/jq.css">
        <link href="../css/prettify.css" rel="stylesheet">
        <script src="../js/prettify.js"></script>
        <script src="../js/docs.js"></script>

        <!-- Tablesorter: required -->
        <link rel="stylesheet" href="../css/color/theme.green.css">
        <script src="../js/jquery.tablesorter.js"></script>
        <script src="../js/jquery.tablesorter.widgets.js"></script>

        <!-- Tablesorter: optional -->
        <link rel="stylesheet" href="../css/jquery.tablesorter.pager.css">
        <style>
            .left { float: left; }
            .right {
                float: right;
                -webkit-user-select: none;
                -moz-user-select: none;
                -khtml-user-select: none;
                -ms-user-select: none;
            }
            .pager .prev, .pager .next, .pagecount { cursor: pointer; }
            .pager a {
                text-decoration: none;
                color: black;
            }
            .pager a.current {
                color: #0080ff;
            }
        </style>
        <script src="../js/jquery.tablesorter.pager.js"></script>
        <script src="../js/pager-custom-controls.js"></script>
        <script src="../js/function.js"></script>
    </head>
    <body id="pager-demo">
        <div id="main">

            <!-- pager -->
            <div class="pager">
                <span class="pagedisplay"></span> 
            </div>

            <table class="tablesorter">
                <thead>
                    <tr><th>Título</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Usuario</th><th class="imputHiden"></th></tr>
                </thead>
                <tfoot>
                    <tr><th>Título</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Usuario</th><th></th></tr>
                    <tr>
                        <td colspan="7">
                            <div class="pager"> 
                                <span class="left">
                                    # por página:
                                    <a href="#" class="current">10</a> |
                                    <a href="#">25</a> |
                                    <a href="#">50</a> |
                                    <a href="#">100</a>
                                </span>
                                <span class="right">
                                    <span class="prev">
                                        <img src="../icons/prev.png" /> Siguiente&nbsp;
                                    </span>
                                    <span class="pagecount"></span>
                                    &nbsp;<span class="next">Anterior
                                        <img src="../icons/next.png" />
                                    </span>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    include ('conectar.php');
                    try {
                        $con = conectar();
                        $query = $con->query("SELECT id, titulo, fecha_inicio, fecha_fin, usuarios_login from noticias");
                        while ($value = $query->fetch()) {
                            $id = $value['id'];
                            $titulo = $value['titulo'];
                            $f_inicio = $value['fecha_inicio'];
                            $f_fin = $value['fecha_fin'];
                            $usuario = $value['usuarios_login'];
                            //$descripcion = $value[4];
                            ?>
                            <tr align="center">
                                <td><?php echo"$titulo"; ?></td>
                                <td><?php echo"$f_inicio"; ?></td>
                                <td><?php echo"$f_fin"; ?></td>
                                <td><?php echo"$usuario"; ?></td>
                                <td align="center">
                                    <button type="button" name="editar" title="Editar" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                                    <button type="button" name="borrar" title="Borrar" id="<?php echo $id ?>" class="btn btn-default btn-xs delete"><span class="glyphicon glyphicon-remove" ></span></button>    
                                </td>
                            </tr>
                            <?php
                            $sql = $con->exec("delete from noticias where id=" . 2);
                        }
                    } catch (Exception $e) {
                        echo "Fallo:$e";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>

