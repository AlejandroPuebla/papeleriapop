<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/tabla6.css">
    <link rel="icon" href="../../imagenes/logo/logo.jpg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="peticion3.js"></script>
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
                <li><a href="gestion_usuarios.html">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Empleados</span>
                </a></li>
                <li><a href="../historial/historial.html">
                    <i class="uil uil-file-check"></i>
                    <span class="link-name">Historial De Ventas</span>
                </a></li>
                <li><a href="../corte_dia/corte.html">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Corte Del Dia</span>
                </a></li>
                <li><a href="../corte_mes/corte.html">
                    <i class="uil uil-calender"></i>
                    <span class="link-name">Corte Del Mes</span>
                </a></li>
                <li><a href="../productos_mas_vendidos/reporte.html">
                    <i class="uil uil-shopping-bag"></i>
                    <span class="link-name">P. Mas Vendidos</span>
                </a></li>
                <li><a href="../descuentos/descuentos.html">
                    <i class="uil uil-pricetag-alt"></i>
                    <span class="link-name">R. Descuentos</span>
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

                <div class="search-box">
                    <i class="uil uil-search"></i>
                    <input type="text" id="busqueda" name="busqueda" placeholder="Buscar aqui...">
                </div>
                
                <img src="images/blanco.png" alt="">
            </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-user"></i>
                    <span class="text">Gestion De Empleados</span>
                </div>

                
                <div class="boxes">
                    <div class="box box1">
                        <a href="agregar_usuario/agregar_usuario.php">
                            <i class="uil uil-plus"></i>
                            <span class="number">Agregar Empleado</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                </div>

                
                <div class="activity-data">
                    <section id="tabla_resultado" >

                    </section>
                </div>
            </div>
        </div>
    </section>

    <script src="../script.js"></script>

</body>
</html>