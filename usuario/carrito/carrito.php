

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../imagenes/logo/logo.jpg">
    <link rel="stylesheet" href="../../css/tabla.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="peticion2.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Papeleria Pop</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../../imagenes/logo/logo.jpg" alt="">
            </div>

            <span class="logo_name">Papeleria Pop</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../inventario/inventario.html">
                    <i class="uil uil-box"></i>
                    <span class="link-name">Inventario</span>
                </a></li>
                <li><a href="../punto_de_venta/punto_venta.html">
                    <i class="uil uil-shop"></i>
                    <span class="link-name">Productos</span>
                </a></li>
                <li><a href="carrito.php">
                    <i class="uil uil-shopping-cart-alt"></i>
                    <span class="link-name">Carrito</span>
                </a></li>
            </ul>

            
            
            <ul class="logout-mode">
                <li><a href="../../login/formulario.html">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Cerrar Sesion</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Modo Oscuro</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>
                
                <img src="images/blanco.png" alt="">
            </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-shopping-cart-alt"></i>
                    <span class="text">Carrito</span>
                </div>

            
            </div>

            <div class="activity">
                <div class="title">
                </div>

                
                <div class="activity-data">
                <?php
                error_reporting(0);
                session_start();
                $total=0;


                        if (isset($_SESSION["carrito"])) {
                            
                $tabla="";
                $tabla.= 
                    '<table class="table" class="table-data>
                        <tr class="data names">
                                <th class="data-title">Id</th>
                            <th class="data-title">Nombre</th>
                            <th class="data-title">Marca</th>
                            <th class="data-title">Descripcion</th>
                            <th class="data-title">P/U</th>
                            <th class="data-title">Cantidad</th>
                            <th class="data-title">Imagen</th>
                        </tr>';

                        echo $tabla;

                            foreach ($_SESSION["carrito"] as $indice => $arreglo) {
                              $total += $arreglo["precio_uni"] * $arreglo["cantidad"];
                        echo "<tr>";
                          foreach ($arreglo as $key => $value) {
                        
                            echo "<td>";
                            echo $value;
                            echo "</td>";
                          }
                        
                        
                            }
                            if($total>499 && $total<1000){
                                echo "</tr><tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>";
                                echo "Total";
                                echo "</td>";
                                echo "<td>";
                                echo $total;
                                echo "</td>";
                                echo "<td></td>";
                                echo "</tr><tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>4% Descuento</td>";
                                $descuento=4*($total/100);
                                echo "<td>$descuento</td>";
                                echo "<td></td>";
                                echo "</tr><tr>";
                                echo "<td><button type='submit' class='seguir' name='eliminar' id='eliminar' value='$indice'><a href='carrito.php?vaciar=true'>Vaciar Carrito</a></button></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>Precio Final</td>";
                                $final=$total-$descuento;
                                echo "<td>$final</td>";
                                echo '<td><form action="pagar/pagar.php" method="post"><input type="number" name="cantidad" id="cantidad" placeholder="Dinero recibido" min="'.ceil($final).'" required>';
                                echo "<button type='submit' class='seguir' name='pagar' id='pagar' value='$final'>Pagar</button></form></td>";
                            } else if($total>999){
                                echo "</tr><tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>";
                                echo "Total";
                                echo "</td>";
                                echo "<td>";
                                echo $total;
                                echo "</td>";
                                echo "<td></td>";
                                echo "</tr><tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>8% Descuento</td>";
                                $descuento=8*($total/100);
                                echo "<td>$descuento</td>";
                                echo "<td></td>";
                                echo "</tr><tr>";
                                echo "<td><button type='submit' class='seguir' name='eliminar' id='eliminar' value='$indice'><a href='carrito.php?vaciar=true'>Vaciar Carrito</a></button></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>Precio Final</td>";
                                $final=$total-$descuento;
                                echo "<td>$final</td>";
                                echo '<td><form action="pagar/pagar.php" method="post"><input type="number" name="cantidad" id="cantidad" placeholder="Dinero recibido" min="'.ceil($final).'" required>';
                                echo "<button type='submit' class='seguir' name='pagar' id='pagar' value='$final'>Pagar</button></form></td>";
                            } else{
                                echo "</tr><tr>";
                                echo "<td><button type='submit' class='seguir' name='eliminar' id='eliminar' value='$indice'><a href='carrito.php?vaciar=true'>Vaciar Carrito</a></button></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>";
                                echo "Total";
                                echo "</td>";
                                echo "<td>";
                                echo $total;
                                echo "</td>";
                                $final=$total;
                                echo '<td><form action="pagar/pagar.php" method="post"><input type="number" name="cantidad" id="cantidad" placeholder="Dinero recibido" min="'.ceil($final).'" required>';
                                echo "<button type='submit' class='seguir' name='pagar' id='pagar' value='$final'>Pagar</button></form></td>";
                            }
                            
                          }else {
                            echo "<script>alert('El carrito esta vacio');</script>";
                            echo "<meta http-equiv='refresh' content='0;url=../punto_de_venta/punto_venta.html' />";
                          }


                          echo "</table>";
                          echo "</div>";
                        
                          if (isset($_REQUEST["vaciar"])) {
                            unset($_SESSION["carrito"]);
                            echo "<meta http-equiv='refresh' content='0;url=carrito.php' />";
                          }
                          if (isset($_REQUEST["eliminar"])) {
                            $producto = $_REQUEST["eliminar"];
                            unset($_SESSION["carrito"][$producto]);
                            echo "<script>alert('Se ha eliminado el producto: $producto');</script>";
                            echo "<meta http-equiv='refresh' content='0;url=carrito.php' />";
                          }
                        echo "</form>";


                ?>
                </div>
            </div>
        </div>
    </section>

    <script src="../script.js"></script>
</body>
</html>