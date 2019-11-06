<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Tienda de Tennis</title>
        <link rel="stylesheet" href="assets/css/styles.css"/>
    </head>

    <body>
        <div id="container">
            <!--Cabecera -->
            <header id="header">
                <div id="logo">
                    <img src ="assets/img/tenis.png" alt="tenis logo"/>
                    <a href="index.php">
                        Tienda de tennis  
                    </a>
                </div>
            </header>
            <!--menu -->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="#">Inicio</a>
                    </li>
                    <li>
                        <a href="#">Categoria 1</a>
                    </li>
                    <li>
                        <a href="#">Categoria 2</a>
                    </li>
                    <li>
                        <a href="#">Categoria 3</a>
                    </li>
                    <li>
                        <a href="#">Categoria 4</a>
                    </li>                
                </ul>
            </nav>

            <div id="content">
                <!--barra lateral -->             
                <aside id="lateral"> 
                    <div id="login" class="block_aside">
                        <form action="#" method="post">
                            <label for="email">Email</label>
                            <input type="email" name="email"/>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password"/>                         
                            <input type="submit" value="Enviar"/>
                        </form>
                        <ul>
                            <li><a href="#">Mis pedidos</a></li>
                            <li> <a href="#">Gestionar pedidos</a>  </li>  
                            <li> <a href="#">Gestionar categorias</a></li>
                        </ul>
                    </div>  
                </aside>

                <!--contenido central -->
                <div id="central">
                    <div class="product">
                        <img src="assets/img/tenis.png"/>
                        <h2>tenis sin pintar jaja</h2>
                        <p>8000 pesos</p>
                        <a href="" class = "button">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/tenis.png"/>
                        <h2>tenis sin pintar jaja</h2>
                        <p>8000 pesos</p>
                        <a href="" class = "button">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/tenis.png"/>
                        <h2>tenis sin pintar jaja</h2>
                        <p>8000 pesos</p>
                        <a href="">Comprar</a>
                    </div>
                </div>
            </div>
            <!--Pie de página -->
            <footer id="footer">
                <p> Por JoGio &copy; <?= date('Y') ?></p>
            </footer>
        </div>
    </body>

</html>
