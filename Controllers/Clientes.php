<?php
//Clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Cargador automatico del composer
require 'vendor/autoload.php';

class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //Para abrir la sesión
        session_start();
    }

    public function index()
    {
        //Si no existe la sesión muestra la pagina de inicio
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        //Si la sesión existe muestra el perfil del cliente
        $data['perfil'] = 'si';
        $data['title'] = 'Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }
    //Obtiene los datos ingresados en el formulario de registro
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
            //Comprueba que se rellenen los campos del registro, de no ser asi muestra un mensaje
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                $mensaje = array('msg' => '¡Todos los campos son requeridos!', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);
                //Verifica que no se ingrese un correo repetido
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => '¡Registro exitoso!', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'Error al registrarse', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => '¡El correo ya se encuentra registrado!', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    //Permite utilizar y configurar el phpmailer
    public function enviarCorreo()
    {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = PASS_SMTP;                              //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Destinatarios
                $mail->setFrom('marielakmpbell@gmail.com', TITLE);
                $mail->addAddress($_POST['correo']);

                //Contenido del correo a enviar
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Mensaje de: ' . TITLE;
                $mail->Body    = 'Para completar la configuración de su cuenta en nuestra tienda <a href="' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">Click aquí</a>';
                $mail->AltBody = '!Gracias por preferirnos!';

                $mail->send();
                $mensaje = array('msg' => '¡Correo enviado, revisa tu bandeja de entrada o de spam!', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'Error al enviar correo: ' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Para verificar los correos electronicos
    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }
    //Obtiene los datos ingresados en el formulario de inicio de sesión
    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            //Comprueba que se rellenen los campos del registro, de no ser asi muestra un mensaje
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje = array('msg' => '¡Todos los campos son requeridos!', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);
                //Revisa que el correo ha sido verificado
                if (!empty($verificar)) {
                    //Verifica que el correo y el nombre se corrrespondan
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => '¡Inicio de sesión exitoso!', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => '¡Contraseña incorrecta!', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => '¡El correo no se encuentra registrado!', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    //Obtiene los datos del pago de la compra para registrar los pedidos
    //Obtiene los datos de los productos comprados para registrar el detalle de los pedidos
    public function registrarPedido()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $pedidos = $json['pedidos'];
        $productos = $json['productos'];
        //Toma los datos del pago para registrar el pedido
        if (is_array($pedidos) && is_array($productos)) {
            $id_transaccion = $pedidos['id'];
            $monto = $pedidos['purchase_units'][0]['amount']['value'];
            $estado = $pedidos['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $pedidos['payer']['email_address'];
            $nombre = $pedidos['payer']['name']['given_name'];
            $apellido = $pedidos['payer']['name']['surname'];
            $direccion = $pedidos['purchase_units'][0]['shipping']['address']['address_line_1'];
            $ciudad = $pedidos['purchase_units'][0]['shipping']['address']['admin_area_2'];
            $email_user = $_SESSION['correoCliente'];
            $data = $this->model->registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, 
                                        $nombre, $apellido, $direccion, $ciudad, $email_user);
            //Si se ha registrado un pago, toma los datos de los productos
            //del pedido para registrarlos en el detalle de los pedidos
            if ($data > 0) {
                foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $data);
                }
                $mensaje = array('msg' => '¡El pedido ha sido registrado existosamente!', 'icono' => 'success');
            } else {
                $mensaje = array('msg' => 'Error al registrar el pedido', 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error al registrar su pago', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }
    //Listar prooductos pendientes
    public function listarPendientes()
    {
        //Para buscar los pedidos pendientes
        $data = $this->model->getPedidos(1);
        //Muestra un boton al lado de cada pedido pendiente para ver el detalle
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['accion'] = 
            '<div class="text-center">
                <button class="btn btn-primary" type="button" onclick="verPedido('.$data[$i]['id'].')"><i class="fas fa-eye"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    //Obtiene los detalles de los pedidos pendientes
    public function verPedido($idPedido)
    {
        $data['productos'] = $this->model->verPedido($idPedido);
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }
    //Permite la cerrar sesión
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}