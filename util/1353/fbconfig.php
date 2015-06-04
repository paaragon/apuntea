<?php

session_start();
// added in v4.0.0
require_once 'autoload.php';
require_once '../../DB/rb.php';
require_once '../../DB/DbConfig.php';
require_once '../../security/security.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

// init app with app id and secret
FacebookSession::setDefaultApplication('916873211704966', 'a4f1c3f6b2fa69297ea6f18f1ac3fd17');
// login helper with redirect_uri
if (!isset($_GET["registrarse"])) {
    $helper = new FacebookRedirectLoginHelper('http://localhost/apuntea/util/1353/fbconfig.php');
} else {
    $helper = new FacebookRedirectLoginHelper('http://localhost/apuntea/util/1353/fbconfig.php?registrarse=1');
}
try {
    $session = $helper->getSessionFromRedirect();
} catch (FacebookRequestException $ex) {
    // When Facebook returns an error
} catch (Exception $ex) {
    // When validation fails or other local issues
}
// see if we have a session
if (isset($session)) {

    $request = new FacebookRequest($session, 'GET', '/me?fields=id,first_name,last_name,email,cover,picture.width(380).height(380).type(square)');
    $response = $request->execute();

    $graphObject = $response->getGraphObject(GraphUser::className());

    $fbid = $graphObject->getProperty('id');
    /* ---- Session Variables ----- */

    if (!isset($_GET["registrarse"])) {
        apunteaSec\startFbUserSession($fbid);
    } else {

        $fbnombre = $graphObject->getProperty('first_name');
        $fbapellidos = $graphObject->getProperty('last_name');
        $fbemail = $graphObject->getProperty('email');
        $fbcover = $graphObject->getProperty('cover');
        $fbimg = $graphObject->getProperty('picture');

        $_SESSION["nombre"] = $fbnombre;
        $_SESSION["apellidos"] = $fbapellidos;
        $_SESSION["fbid"] = $fbid;
        $_SESSION["alias"] = $fbnombre . "_" . rand(0, 2048);
        $_SESSION["email"] = $fbemail;
        $_SESSION["cover"] = $fbcover->getProperty('source');
        $_SESSION["avatar"] = $fbimg->getProperty('url');
        header("location: ../../servicios/standarHandler.php?action=registrarse");
        exit();
    }

    /* ---- header location after session ---- */
    header("Location: ../../usuario/inicio.php");
} else {

    $loginUrl = $helper->getLoginUrl();
    header("Location: " . $loginUrl);
}    