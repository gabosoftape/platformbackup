<?php 
session_start();
unset($_SESSION['nickname']);
unset($_SESSION['nombre']);
unset($logged);

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
} 
session_destroy(); 
$_SESSION = array();
$_COOKIE = array();
echo '<script type="text/javascript">
     document.cookie = "PHPSESSID=;Path=/cv;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
</script>';
ini_set('session.cookie_path', '/');
header("Set-Cookie:PHPSESSID=".session_id()."; expires=Sat, 07-Nov-1999 14:58:07 GMT; path=/cv/");
echo '<script>window.location="index.php"</script>';
?>