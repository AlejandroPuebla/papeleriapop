<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/formulario.css">
    <link rel="icon" href="../../../imagenes/logo/logo.jpg">
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
                <li><a href="../inventario.html">
                    <i class="uil uil-box"></i>
                    <span class="link-name">Inventario</span>
                </a></li>
                <li><a href="../punto_de_venta/punto_venta.html">
                    <i class="uil uil-shop"></i>
                    <span class="link-name">Productos</span>
                </a></li>
                <li><a href="../../carrito/carrito.php">
                    <i class="uil uil-shopping-cart-alt"></i>
                    <span class="link-name">Carrito</span>
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

 
                
                <img src="images/blanco.png" alt="">
            </div>

        <div class="dash-content">
        <div class="container">
    <div class="title">Registrar Producto</div>
    <div class="content">
      <form action="new_producto.php" method="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nombre</span>
            <input type="text" name="nombre" placeholder="Ej. Cuaderno Profesional" required>
          </div>
          <div class="input-box">
            <span class="details">Marca</span>
            <input type="text" name="marca" placeholder="Ej. Scribe" required>
          </div>
          <div class="input-box">
            <span class="details">Descripcion</span>
            <input type="text" name="desc" placeholder="Ej. 100 hojas de raya" required>
          </div>
          <div class="input-box">
            <span class="details">Cantidad</span>
            <input type="number" name="cantidad" id="cantidad" placeholder="Ej. 80" required>
          </div>
          <div class="input-box">
            <span class="details">Precio Unitario</span>
            <input type="number" name="pu" placeholder="Ej. 26" required>
          </div>
          <div class="input-box">
            <span class="details">Imagen</span>
            <input type="file" name="uploadfile" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="reg" value="Registrar">
        </div>
      </form>
    </div>
  </div>
    </section>

    <script src="../../script.js"></script>
</body>
</html>





