<?php
require_once 'models/pedido.php';
class pedidoController
{
    
    public function hacer()
    {
        require_once 'views/pedido/hacer.php';
    }
    
    public function add()
    {
        //confirmar si se está logeado
        if(isset($_SESSION['identity']))
        {
            $usuario_id = $_SESSION['identity']->id;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            
            if($estado && $ciudad && $direccion)
            {
                //guardar datos en la BD
                $pedido = new Pedido();
                $pedido ->setUsuario_id($usuario_id);
                $pedido ->setEstado($estado);
                $pedido ->setCiudad($ciudad);
                $pedido ->setDireccion($direccion);
                $pedido ->setCoste($coste);
                
                $save = $pedido ->save();
                
                //Guardar linea pedido
                $save_linea = $pedido->save_linea();
                if($save && $save_linea)
                {

                    $_SESSION['pedido'] = "complete";
                }
                else
                    {
                        $_SESSION['pedido'] = "failed";
                    }

            }
            else
                {
                    $_SESSION['pedido'] = "failed";
                }
                     $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'pedido/confirmado"'.';'
        . '</script>';
        echo $redi;  
        }
        else
            {
                //redirigir a index
                        $redi = '<script type='
        .'"text/javascript">'
        .'window.location='
        .'"'.base_url.'pedido/confirmado"'.';'
        . '</script>';
        echo $redi; 
            }
    }
    
    public function confirmado()
    {
        //si existe una sesión actual, guardala en una variable para poder obtener todos sus propiedads (propiedades del usuario que está en la sesión)
    if(isset($_SESSION['identity']) ){
        $identity = $_SESSION['identity'];
        $pedido = new Pedido();
        $pedido->setUsuario_id($identity->id);
        $pedido = $pedido->getOneByUser();
        $pedido_productos = new Pedido();
        $productos = $pedido_productos->getProductosByPedido($pedido->id); //la id está especificada por el método getOneByUser
        
    }
        require_once 'views/pedido/confirmado.php';
    }
    
    public function mis_pedidos()
    {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        //sacar los pedidos del usuario
        $pedido ->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function mis_compras()
    {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        //sacar los pedidos del usuario
        $pedido ->setUsuario_id($usuario_id);
        $compras = $pedido->getAllByCompra();
        require_once 'views/pedido/compras.php';
    }
    //método para cargar una vista para mostrar los detalles de un pedido
    public function detalle()
    {
        Utils::isIdentity();
        if(isset($_GET['id']) )
        {
            $id = $_GET['id'];
            //sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);     
            $pedido = $pedido->getOne();
            
            //sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);
            
            require_once 'views/pedido/detalle.php';
        }
        else
            {
                header("Location:".base_url.'pedido/mis_pedidos');
            }       
    }
    
    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';  
    }
    
    public function estado()
    {
        Utils::isAdmin();

        if(isset($_POST['pedido_id']) && isset($_POST['estado']) )
        {
            //Recoger los parámetros del formulario
            $id = $_POST['pedido_id'];
            $estadop = $_POST['estado'];

            //update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstadop($estadop);
            $pedido->edit();
           // header("Location:".base_url.'pedido/detalle&id='.$id);
                $redi = '<script type='
                .'"text/javascript">'
                .'window.location='
                .'"'.base_url.'pedido/detalle&id='.$id.'"'.';'
                . '</script>';
        echo $redi;
        }
        else
            {
                $redi = '<script type='
                .'"text/javascript">'
                .'window.location='
                .'"'.base_url.'"'.';'
                . '</script>';
                echo $redi;
            }
    }
}
