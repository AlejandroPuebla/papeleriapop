<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../imagenes/logo/logo.jpg">
    <link rel="stylesheet" href="../../../css/tabla4.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="peticion.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Papeleria Pop</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../../../imagenes/logo/logo.jpg" alt="">
            </div>

            <span class="logo_name">Papeleria Pop</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../../gestion_usuarios/gestion_usuarios.html">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Empleados</span>
                </a></li>
                <li><a href="../../inventario/inventario.html">
                    <i class="uil uil-box"></i>
                    <span class="link-name">Inventario</span>
                </a></li>
                <li><a href="../../punto_de_venta/punto_venta.html">
                    <i class="uil uil-shop"></i>
                    <span class="link-name">Productos</span>
                </a></li>
                <li><a href="../../carrito/carrito.php">
                    <i class="uil uil-shopping-cart-alt"></i>
                    <span class="link-name">Carrito</span>
                </a></li>
                <li><a href="../historial.html">
                    <i class="uil uil-file-check"></i>
                    <span class="link-name">Historial De Ventas</span>
                </a></li>
                <li><a href="../../corte_dia/corte.html">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Corte Del Dia</span>
                </a></li>
                <li><a href="../../corte_mes/corte.html">
                    <i class="uil uil-calender"></i>
                    <span class="link-name">Corte Del Mes</span>
                </a></li>
                <li><a href="../../productos_mas_vendidos/reporte.html">
                    <i class="uil uil-shopping-bag"></i>
                    <span class="link-name">Productos Mas Vendidos</span>
                </a></li>
                <li><a href="../../descuentos/descuentos.html">
                    <i class="uil uil-pricetag-alt"></i>
                    <span class="link-name">Reporte De Descuentos</span>
                </a></li>
            </ul>

            
            
            <ul class="logout-mode">
                <li><a href="../../../login/formulario.html">
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

                <div class="search-box">
   
                </div>
                
                <img src="images/blanco.png" alt="">
            </div>

        <div class="dash-content">
            <div class="overview">
            <div class="title">
                    <i class="uil uil-clipboard-alt"></i>
                    <?php
                        include("../../../conexion.php");
                        $fecha = $_POST['fecha'];
                        echo '<span class="text">'.$fecha.'</span>';
                    ?>
                    
                </div>

                
                <div class="boxes">
                    
                </div>
            </div>

            <div class="activity">
                <div class="title">
                </div>

                
                <div class="activity-data">
                    <?php


                    $folio = $_POST['id_valor'];
                    $final = 0;

                    $tabla="";
                    $tabla.= 
                        '<table class="table" class="table-data>
                            <tr class="data names">
                                <th class="data-title">Id</th>
                                <th class="data-title">Nombre</th>
                                <th class="data-title">Marca</th>
                                <th class="data-title">Descripcion</th>
                                <th class="data-title">Cantidad</th>
                                <th class="data-title">P/U</th>
                                <th class="data-title">Imagen</th>
                                <th class="data-title">Total</th>
                            </tr>';
    
                    echo $tabla;   
                                         
                            
                    $query = mysqli_query($conexion, "SELECT i.id_producto,i.nombre_producto,i.marca_producto,i.descripcion_producto,v.cantidad,i.precio_unitario,i.imagen, SUM(v.cantidad*i.precio_unitario) as total
                                                        FROM ventas v, inventario i 
                                                        WHERE i.id_producto=v.id_producto
                                                        AND v.folio_venta='$folio'
                                                        GROUP BY i.id_producto");

                    while ($inv = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        $id=$inv['0'];
                        $nom=$inv['1'];
                        $mar=$inv['2'];
                        $desc=$inv['3'];
                        $cant=$inv['4'];
                        $pu=$inv['5'];
                        $img=$inv['6'];
                        $total=$inv['7'];
                        echo "<td>$id</td>";
                        echo "<td>$nom</td>";
                        echo "<td>$mar</td>";
                        echo "<td>$desc</td>";
                        echo "<td>$cant</td>";
                        echo "<td>$pu</td>";
                        echo "<td><img src=../../../imagenes/productos/$img></td>";
                        echo "<td>$total</td>";
                        echo "</tr>";
                        $final=$final+$total;
                    }
                                
                    if($final>499 && $final<1000){
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Total";
                        echo "</td>";
                        echo "<td>".$final;
                        echo "</td>";
                        echo "</tr><tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Descuento";
                        echo "</td>";
                        $descuento=($final/100)*4;
                        echo "<td>".$descuento;
                        echo "</td>";
                        echo "</tr><tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Precio final";
                        echo "</td>";
                        $final=$final-($final/100)*8;
                        echo "<td>".$final;
                        echo "</td>";
                    }elseif($final>1000){
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Total";
                        echo "</td>";
                        echo "<td>".$final;
                        echo "</td>";
                        echo "</tr><tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Descuento";
                        echo "</td>";
                        $descuento=($final/100)*8;
                        echo "<td>".$descuento;
                        echo "</td>";
                        echo "</tr><tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Precio final";
                        echo "</td>";
                        $final=$final-($final/100)*8;
                        echo "<td>".$final;
                        echo "</td>";
                    }else{
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>";
                        echo "Total";
                        echo "</td>";
                        echo "<td>".$final;
                        echo "</td>";
                    }
                                
                                
                            
    
                              echo "</table>";
                              echo "</div>";
                            
                              
                            echo "</form>";
    
    
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script src="../../script.js"></script>
</body>
</html>