
<?php
    #Eliminar todos los usuarios
    #eliminarTodosUsuarios();
                              
    #Eliminar usuario
    if(isset($_POST['eliminar'])){
       $IdUsuario = $_POST['idUsuario'];
       eliminarUsuario($IdUsuario);
    }
    
    #Sentencia de datos
    $result = consultarUsuarios($filtro);
?>

<table class="table table-data2">
    
    <!-- Cabecera de la tabla -->
    <thead><tr>
            
    <!--1--><!---------------------2---------------------------------><!------3--------><!-------4--------><!------5------><!--------6--------><!---------7---------><!--8--->
    <th></th><th><i class="fab fa-twitter"></i> Nombre de usuario</th><th>Influencia</th><th>Seguidores</th><th>Cantidad</th><th>Analizando</th><th>Monitorizando</th><th></th>
            
    </tr></thead>

    <!-- Cuerpo de la tabla -->
    <tbody>
    
    <?php
        if($result){
            while($row = mysqli_fetch_array($result)){
               $nickname = $row['nickname'];
               $followers = $row['followers'];
               $seleccionado = $row['seleccionado'];
               $verificado = $row['verificado'];
               $influencia = $row['influencia'];
               $post = $row['post'];
               $idP = $row['id'];
               $padre = consultarPadreUsuario($idP);
         
         
         
               $cantidad = $row['tweetstotal']; #Cantidad por defecto
               if ($filtro == 1 ){ $cantidad = $row['tweets']; }
               if ($filtro == 2 ){ $cantidad = $row['tweetstres']; }
               if ($filtro == 3 ){ $cantidad = $row['tweetssemana']; }
               
               if ($cantidad > 1){?>
                    <tr class='tr-shadow'>
                    <!--1-->
                    <td>

                        <?php if ($post == 0){?>   
                            <form method="post" action="posteadores.php">
                                <input type="hidden" name="nombreUsuario" value="<?php echo $row['nickname'] ?>">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['id'] ?>">
                                <button type="submit" name='nuevaregla' class="item" style="color:#ffffff; display: block;height: 30px;width: 30px;position: relative;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Monitorizar">
                                    <i class="zmdi zmdi-upload"></i>
                                </button>
                            </form>
                        <?php }?>

                    </td>
                    <!--2-->
                    <td>

                        <?php if ($padre != "0"){?>
                            <a style="font-size: 12px;    background: #fff;" href='https://twitter.com/hashtag/<?php echo $padre?>' target="_blank" class='block-email'>#<?php echo $padre?></a><i class="fas fa-angle-right"></i>
                        <?php }?>
                        <a href='https://twitter.com/<?php echo $nickname?>' target="_blank" class='block-email'>@<?php echo $nickname?></a>
                        <?php if ($verificado == 1){?>
                            <span class='status--blue'><i class="fas fa-check-circle" style="color: #1da1f2;"></i></span>
                        <?php }?>

                    </td>
                    <!--3-->
                    <td>
                        <?php echo $influencia ?>
                    </td>
                    <!--4-->
                    <td>
                        <?php echo $followers ?>
                    </td>
                    <!--5-->
                    <td>
                        <?php echo $cantidad ?>
                    </td>
                    <!--6-->
                    <td>
                        
                        <?php if ($seleccionado == 1){?>
                            <span class='status--process'><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                        <?php } else { ?>
                            <span class='status--denied'><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                        <?php }?>

                    </td>
                    <!--7-->
                    <td>

                        <?php if ($post == 1){?>
                            <span class='status--primary' style="color:#4272d7;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                        <?php } else { ?>
                            <span class='status--secondary'><i class="fas fa-eye-slash"></i></span>
                        <?php }?>

                    </td>
                    <!--8-->
                    <td>
                        <div class='table-data-feature'>
                            
                            <!-- Control de grafica -->
                            <form method="post" action="posteadores.php">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['id'] ?>">
                                <?php if ($seleccionado == 1){?>
                                    <button type="submit" name='deseleccionar' class="item" style="color:#ffffff; display: block;height: 30px;width: 30px;position: relative;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Quitar de analizar">
                                        <i class="zmdi zmdi-download"></i>
                                    </button>
                                <?php } else { ?>
                                    <button type="submit" name='seleccionar' class="item" style="color:#ffffff; display: block;height: 30px;width: 30px;position: relative;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analizar">
                                        <i class="zmdi zmdi-upload"></i>
                                    </button>
                                <?php }?> 
                            </form>

                            <!-- Control de jerarquia -->
                            <form method="post" action="jerarquiap.php">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['id'] ?>">
                                <button type="submit" name='verposteadores' class="item" style="display: block;height: 30px;width: 30px;position: relative;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="" data-original-title=" Ver Jerarquia">
                                    <i style="font-size: 15px;"class="fas fa-sitemap"></i>
                                </button>
                            </form> 

                            <!-- Control de informacion -->
                            <form method="post" action="infoposteadores.php">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['id'] ?>">
                                <button type="submit" name='verposteadores' class="item" style="display: block;height: 30px;width: 30px;position: relative;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;margin-right: 5px;"  data-toggle="tooltip" data-placement="top" title="" data-original-title=" Ver datos">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </form> 
                            <!-- Control de eliminacion -->
                            <form method="post" action="posteadores.php">
                                <input type="hidden" name="idUsuario" value="<?php echo $row['id'] ?>">
                                <button type="submit" name='eliminar'class="item" style="display: block;height: 30px;width: 30px;position: relative;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    </tr>
                    <tr class='spacer'></tr>
        <?php }}}?>
    </tbody>
</table>