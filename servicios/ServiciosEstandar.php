<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
require __DIR__ . "/../security/security.php";
require __DIR__ . "/../util/Validate.php";

class ServiciosEstandar {

    public function __construct() {
        session_start();
    }

    public function doLogin($params) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();
        $usuario = R::findOne('usuario', ' nick = "' . $username . '" AND activo = 1');

        if ($usuario == NULL || !password_verify($password . "pimienta_de_la_buena", $usuario->password)) {
            echo "Mal";
            $_SESSION["login-error"] = "Usuario o contraseña incorrectos";
            return "index.php";
        }

        R::close();

        if ($usuario->tipo == 1) {
            apunteaSec\startUsuarioSession($usuario);
            return "usuario/inicio.php";
        } else if ($usuario->tipo == 2) {
            apunteaSec\startUsuarioSession($usuario);
            return "admin/inicio.php";
        } else {
            apunteaSec\logout();
        }
    }

    public function registrarse() {

        require __DIR__ . "/../util/CropAvatar.php";

        if (isset($_SESSION["fbid"])) {

            $this->setUpDatabase();

            $alias = filter_var($_SESSION["alias"], FILTER_SANITIZE_MAGIC_QUOTES);
            $nombre = filter_var($_SESSION["nombre"], FILTER_SANITIZE_MAGIC_QUOTES);
            $apellidos = filter_var($_SESSION["apellidos"], FILTER_SANITIZE_MAGIC_QUOTES);
            $fbid = filter_var($_SESSION["fbid"], FILTER_SANITIZE_NUMBER_INT);
            $fbavatar = $_SESSION["avatar"];
            $fbcover = $_SESSION["cover"];

            $usuario = R::dispense('usuario');
            $usuario->nombre = $nombre;
            $usuario->apellidos = $apellidos;
            $usuario->nick = $alias;
            $usuario->fbid = $fbid;

            $avatar = imagecreatefromjpeg($fbavatar);
            $avatarname = $alias . "_" . rand(0, 2048);
            imagejpeg($avatar, '../img/usuarios/perfil/' . $avatarname . '.jpg');
            $usuario->avatar = $avatarname . '.jpg';

            $portada = imagecreatefromjpeg($fbcover);
            $portadaname = $alias . "_" . rand(0, 2048);
            imagejpeg($portada, '../img/usuarios/portada/' . $portadaname . '.jpg');
            $usuario->imagenportada = $portadaname . '.jpg';


            R::store($usuario);
            $_SESSION["exito"] = "Registro completado. Enra en la página a través de la sección \"Acceder\" del panel lateral.";
            return "index.php";
        } else {
            $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcTwgcTAAAAAAIYyE8EBBWc1A4k8OPFIQfzVw8i&response=" . $_POST['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);

            if ($response["success"] == 1) {

                $fields = array(
                    "alias" => array($_POST, "texto", true),
                    "apellidos" => array($_POST, "texto", true),
                    "email" => array($_POST, "email", true),
                    "password" => array($_POST, "texto", true),
                    "password2" => array($_POST, "texto", true),
                    "carrera" => array($_POST, "entero", true),
                    "nombre" => array($_POST, "texto", true));
                $validate = new Validate($fields);
                if (!$validate->validate()) {
                    $_SESSION["error"] = $validate->getErrorMessage();
                    return "registrarse.php";
                }
                $alias = filter_input(INPUT_POST, "alias", FILTER_SANITIZE_MAGIC_QUOTES);
                $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
                $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_MAGIC_QUOTES);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_MAGIC_QUOTES);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_MAGIC_QUOTES);
                $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_MAGIC_QUOTES);
                $carrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT);
                $imgPerfil = $_FILES["img-perfil"];
                $perfilData = filter_input(INPUT_POST, "img-perfil-data", FILTER_SANITIZE_MAGIC_QUOTES);
                $perfilSrc = filter_input(INPUT_POST, "img-perfil-src", FILTER_SANITIZE_MAGIC_QUOTES);
                $imgPortada = $_FILES["img-portada"];
                $portadaData = filter_input(INPUT_POST, "img-portada-data", FILTER_SANITIZE_MAGIC_QUOTES);
                $portadaSrc = filter_input(INPUT_POST, "img-portada-src", FILTER_SANITIZE_MAGIC_QUOTES);


                if ($password != $password2) {

                    $_SESSION["error"] = "Error. Las contraseñas deben coincidir";
                    header("location: ../registrarse.php");
                    exit();
                }

                $this->setUpDatabase();

                $usuario = R::dispense('usuario');

                $usuario->carrera_id = $carrera;
                $usuario->ultimaconexion = date("Y-m-d H:i:s", time());
                $usuario->nombre = $nombre;
                $usuario->apellidos = $apellidos;
                $usuario->nick = $alias;
                $usuario->password = password_hash($password . "pimienta_de_la_buena", PASSWORD_DEFAULT);
                $usuario->email = $email;


                $crop = new CropAvatar($perfilSrc, $perfilData, $imgPerfil, "usuarios/perfil");
                $response = array(
                    'state' => 200,
                    'message' => $crop->getMsg(),
                    'result' => $crop->getResult()
                );

                $namearr = explode("/", $crop->getResult());
                $usuario->avatar = $namearr[4];

                $crop2 = new CropAvatar($portadaSrc, $portadaData, $imgPortada, "usuarios/portada");
                $response2 = array(
                    'state' => 200,
                    'message' => $crop2->getMsg(),
                    'result' => $crop2->getResult()
                );

                $namearr2 = explode("/", $crop2->getResult());
                $usuario->imagenportada = $namearr2[4];

                $codigo = md5(openssl_random_pseudo_bytes(32));
                $usuario->codigoactivacion = $codigo;
                R::store($usuario);


                $params["id"] = $usuario->id;
                $params["codigo"] = $codigo;
                $this->sendEmail($email, $nombre . " " . $apellidos, "../util/emailConfirmacion.php", $params);

                $_SESSION["exito"] = "Registro completado. Revisa tu email para activar tu cuenta.";

                return "index.php";
            } else {
                $_SESSION["error"] = "Error al registrar usuario.";
                return "registrarse.php";
            }
        }
    }

    public function confirmarEmail() {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $codigo = filter_input(INPUT_GET, "codigo", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->setUpDatabase();
        $usuario = R::findOne("usuario", 'id = ?', [$id]);

        if ($usuario->codigoactivacion == $codigo) {
            $usuario->activo = 1;
            R::store($usuario);
            $_SESSION["exito"] = "Enhorabuena. Has activado tu cuenta en Apuntea. Utiliza el formulario de login para entrar en tu perfil.";
        } else {
            $_SESSION["error"] = "Error. Código de activación incorrecto.";
        }

        return "index.php";
    }

    public function getCarreras() {
        $idUni = filter_input(INPUT_POST, "idUniversidad", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $carreras = R::findAll("carrera", " universidad_id = ? ORDER BY nombre", [$idUni]);
        R::close();

        $arrCar = array();
        foreach ($carreras as $car) {
            $arrCar[] = $car->export();
        }

        return

                json_encode($arrCar);
    }

    public function getAsignaturas() {
        $id = filter_input(INPUT_POST, "idCarrera", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $asignaturas = R:: findAll('asignatura', ' carrera_id = ?', [$id]);

        R::close();

        return json_encode(R::

                exportAll($asignaturas));
    }

    public function notFound() {

        return "404.php";
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig:: $dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        R::freeze(TRUE);
    }

    private function sendEmail($emailDest, $destinatario, $cuerpo, $params) {
        require __DIR__ . '/../util/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'apuntea.info@gmail.com';                 // SMTP username
        $mail->Password = 'apunteamolamas';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->From = 'apuntea.info@gmail.com';
        $mail->FromName = 'Apuntea';
        $mail->addAddress($emailDest, $destinatario);
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Confirmación de cuenta en Apuntea';

        ob_start();
        require $cuerpo;
        $body = ob_get_clean();
        $mail->Body = $body;

        if (!$mail->send()) {
            return false;
        } else {

            return true;
        }
    }

    function userNameExist() {

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();
        $n = R::count('usuario', 'nick = ?', [$name]);
        if ($n == 0) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

}
