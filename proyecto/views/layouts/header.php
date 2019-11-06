<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>VergiA2 Shop</title>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/css/fontello.css">
    </head>
    
    <body>
        <div class="MenuNavegacion sticky-top">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
              <a class="navbar-brand" href="<?=base_url?>" style="color: #FFF"><!--<h1>VergiA2 Shop</h1>--><img src="<?=base_url?>assets/img/logo.png" height="100px" width="350px"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">


                  <li class="nav-item Navegador">
                    <a class="nav-link" href="<?=base_url?>" style="color: #FFF"><b>Inicio </b><span class="sr-only">(current)</span></a>
                  </li>



                  <li class="nav-item Navegador">
                    <a class="nav-link" href="#FinalPagina" style="color: #FFF"><b>Contacto </b><span class="sr-only">(current)</span></a>
                  </li>

                  <li class="nav-item dropdown Navegador">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #FFF">
                      <b>Carrito</b>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php $stats = Utils::statsCarrito(); ?>
                        <a class="dropdown-item" href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a>
                        <a class="dropdown-item" href="<?=base_url?>carrito/index">Total: <?=$stats['total']?> cocoins</a>
                        <a class="dropdown-item" href="<?=base_url?>carrito/index">Ver carrito</a>
                    </div>
                  </li>
 <!--//////////////////////////////-->
                    <?php if(isset($_SESSION['identity']) ): ?>
                        <li class="nav-item dropdown Navegador">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #FFF">
                         <b><?=$_SESSION['identity']->nombre?> </b>  
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <?php if(isset($_SESSION['admin'] ) ): //Si está activa una sesión administrador
                       //entonces sólo a los admins les aparecerán estas categorías?>
                            <a class="dropdown-item" href="<?=base_url?>categoria/index">Gestionar categorias</a>
                            <a class="dropdown-item" href="<?=base_url?>producto/gestion">Gestionar productos</a>
                            <a class="dropdown-item" href="<?=base_url?>pedido/gestion">Gestionar pedidos</a>              
                        <?php endif; ?>
                       
                        <?php if(isset($_SESSION['identity']) ): //si se identifica un usuario registrado
                            //aparece su lista de pedidos y la opción de cerrar sesión?>
                        <a class="dropdown-item" href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a>
                        <a class="dropdown-item" href="<?=base_url?>pedido/mis_compras">Historial de compras</a>
                        <?php endif; ?>

                    </div>
                  </li>
                  <?php endif; ?>

<!--//////////////////-->
                  <li class="nav-item Navegador">
                    <?php if(!isset($_SESSION['identity'])):?> 
                    <a class="nav-link" href="#"><b data-toggle="modal" data-target="#loginModal" style="color: #FFF">Iniciar Sesión </b><span class="sr-only" >(current)</span></a>
                    <?php else: ?>
                    <a href="<?=base_url?>usuario/logout" class="nav-link"><b  style="color: #FFF">Cerrar Sesión</b><span class="sr-only" >(current)</span></a>
                       
                    <?php endif; ?>
                  </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder=" En mantenimiento" aria-label="Search">
                  <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">... Permanente :P </button>
                </form>
              </div>
            </nav>
        </div>
        
        
        <header>
            <div id="contorno">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?=base_url?>assets/img/tenis.jpg" alt="First slide" style="height: 800px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?=base_url?>assets/img/head1.png" alt="Second slide" style="height: 800px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?=base_url?>assets/img/tenis3.jpg" alt="Third slide" style="height: 800px;">
                        </div>
                    </div>
                </div>
            </div> 
        </header>
        <!--<div id ="container">
        Cabecera -->

        
        <!--menu -->
        <?php $categorias = Utils::showCategorias(); //sql para tener todas las categorias en la variable ?>
        <nav id="menu">
            <ul>
                <?php while($cat = $categorias->fetch_object()): //Devuelve la fila actual (sql) en un conjunto de resultados como objeto, dicho objeto es $cat?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"> <?=$cat->nombre?> </a>
                    </li>
                <?php endwhile; ?>         
            </ul>
        </nav>
<!--        modal login-->
            <div class="modal fade" role="dialog" id="loginModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Login</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url ?>usuario/login" method="post">
                        <div class="modal-body">
                                <label for="email">Email</label>
                                <input type="email" name="email"/>
                                <label for="password">Contraseña</label>
                                <input type="password" name="password"/>                         
                        </div>
                            <div style="text-align: center;">
                                <center>
                                    <input type="submit" value="Enviar"/>
                                    <h5 style="margin-top: 10px">¿No tienes cuenta? </h5>
                                    <a href=""data-toggle="modal" data-target="#RegistroModal" data-dismiss="modal">Registrate aquí</a> 
                                
                                </center>
                            </div>
                        </form> 
                    </div>
                    
                </div>
            </div>
        
        
<!--        modal registro-->
 <div class="modal fade" role="dialog" id="RegistroModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Registro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action = "<?=base_url?>usuario/save" method = "POST">
                    <label for = "nombre"> Nombre </label>
                    <input type = "text" name="nombre" required />

                    <label for = "apellidos"> Apellidos </label>
                    <input type = "text" name="apellidos" required />

                    <label for = "email"> Email </label>
                    <input type = "text" name="email" required />

                    <label for = "password"> Contraseña </label>
                    <input type = "password" name="password" required />

                    <input type ="submit" value="Registrarse"/>
                </form>
            </div>
        </div>
    </div>
</div>

        <div id="content">