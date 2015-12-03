<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edicion</title>

        <link type="text/css" href="../css/estilos.css">
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <script src="../js/bootstrap.js"></script>

        <!-- Tablesorter: required -->
        <link rel="stylesheet" href="../css/theme.green.css">
        <script src="../js/jquery.tablesorter.js"></script>
        <script src="../js/pager-custom-controls.js"></script>
        <script src="../js/jquery.tablesorter.pager.js"></script>
        <script src="../js/jquery.tablesorter.widgets.js"></script>

        <!-- Funciones java -->
        <script src="../js/function.js"></script>
        <script src="../js/jquery.confirm.js"></script>
    </head>
    <body id="pager-demo">
        <header>
            <div class="overlay" id="overlay" style="display:none;"></div>
            <div class="box" id="box">

                <a class="boxclose" id="boxclose"></a>
                <h1>Noticia</h1>

                <div class="container">
                    <form action="insertar_noticias.php" method="post">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="form-group  col-xs-4 col-sm-5 col-md-5 col-vmd-5 col-lg-5 col-vlg-5 col-lg-offset-1 col-vlg-offset-0">
                                <label for="titulo">Titulo:</label>
                                <input class="form-control" name="titulo" id="titulo" type="text" placeholder="Titulo:" value="" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-sm-5 col-md-5 col-vmd-5 col-lg-5 col-vlg-5 col-lg-offset-1 col-vlg-offset-0">
                                <label for="fechainicio">Fecha inicio y hora: </label>
                                <input class="form-control" name="fecha_inicio" id="fecha_inicio" type="datetime-local" value="2015-09-15 T08:00" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-sm-5 col-md-5 col-vmd-5 col-lg-5 col-vlg-5 col-lg-offset-1 col-vlg-offset-0">
                                <label for="fechainicio">Fecha fin y hora: </label>
                                <input class="form-control" name="fecha_fin" id="fecha_fin" type="datetime-local" value="2015-06-15 T23:59" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5 col-md-5 col-vmd-5 col-lg-5 col-vlg-5 col-lg-offset-1 col-vlg-offset-0">
                                <label for="cuerpo">Escriba el cuerpo:</label>
                                <textarea rows="7" class="form-control" name="cuerpo" id="cuerpo" placeholder="Escriba el cuerpo de la noticia:" value="Cuerpo" required></textarea>
                            </div>
                        </div>
<!--                        <div class="row">
                            <div class="form-group col-sm-5 col-md-5 col-vmd-5 col-lg-5 col-vlg-5 col-lg-offset-1 col-vlg-offset-0">
                                <label for="imagen">Imagen:</label>
                                <input type="file" id="imagen">
                                <p class="help-block">Maximo 1MB </p>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="form-group col-sm-5 col-md-5 col-vmd-5 col-lg-5 col-vlg-5  col-lg-offset-1 col-vlg-offset-0">
                                <button class="btn btn-info btn-sm" type="reset" ><span class="glyphicon glyphicon-refresh"></span></button>
                                <button class="btn btn-success btn-sm" type="submit" name="enviar" ><span class="glyphicon glyphicon-ok"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </header>

        <div class="container">
            <section id="main" class="main row">
                <!-- pager -->

                <article class="col-md-12">
                    <div class="pager">
                        <span class="pagedisplay"></span>
                        <span class="plus"></span>
                        <button type="button" name="añadir" title="Añadir" class="activator pull-right btn btn-success btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Añadir</span></button>
                        <br>
                        <br>
                    </div>
                </article>
                <article class="col-md-12">
                    <table class="tablesorter">
                        <thead>
                            <tr><th>Título</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Usuario</th><th></th></tr>
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
                            session_start();
                            include('libreria.php');
                            try {
                                $con = conectar();
                                $query = $con->query("SELECT id, titulo,fecha_inicio, fecha_fin, usuarios_login from noticias where usuario_login = '".$_SESSION['usuario']."'");
                                if($query){
                                    while ($value = $query->fetch()) {
                                        $id = $value[0];
                                        $titulo = $value[1];
                                        $f_inicio = $value[2];
                                        $f_fin = $value[3];
                                        $usuario = $value[4];
                                    ?>
                                    <tr align="center">
                                        <td><?php echo"$titulo"; ?></td>
                                        <td><?php echo"$f_inicio"; ?></td>
                                        <td><?php echo"$f_fin"; ?></td>
                                        <td><?php echo"$usuario"; ?></td>
                                        <td align="center">
                                            <button type="button" name="editar" title="Editar" id="<?php echo $id ?>" onclick="editar(this.id)" class="activator btn btn-primary2 btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>
                                            <button type="button" name="borrar" title="Borrar" id="<?php echo $id ?>" class="btn btn-danger2 btn-xs delete" ><span class="glyphicon glyphicon-remove" ></span></button>    
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                }
                            } catch (Exception $e) {
                                echo "Fallo:$e";
                            }
                            ?>
                        </tbody>
                    </table>
                </article>
            </section>
        </div>
        <div id="ids">

        </div>
        <script>
            function editar(id) {
                $.ajax({
                    type: "POST",
                    url: "./actualizar.php",
                    data: {info: id},
                    success: function () {
                    }
                }).done(function (result) {
                    var titulo = $("#a").html();
//                    alert(titulo);
                    $("#ids").html(result);
//                    $("#id").attr("value",result);
//                    $("#titulo").attr("value", result);
                    $("#cuerpo").val(result);
//                    $("#fecha_inicio").attr("value", data.fecha_inicio);
//                    $("#fecha_fin").attr("value", data.fecha_fin);
//                    $("#id").html(result.titule);
                      //split() para separar str y remplace para las fechas
                });


            }
        </script>
    </body>
</html>

