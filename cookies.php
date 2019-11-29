<?php 
    require_once 'lib/doctrine/vendor/autoload.php';
if(isset($_POST['login']))
    $login = $_POST['login'];
if(isset($_POST['password']))
    $password = $_POST['password'];
if(isset($_POST['password']))
    $password = $_POST['password'];
else {
    header("Location: index.php");
    exit;
}

$userManager = new User\UserManager();
$user = $userManager->signIn($login, $password);
$userInfos = $user['infos'];
$path="/";
$domainName = $_SERVER['SERVER_NAME'];

if($domainName=='localhost')
        $domainName=null;
//$date_of_expiry = time() + (30 * 60);
$date_of_expiry = time() + (40 * 60);
setcookie("userId",strip_tags($userInfos['id']), $date_of_expiry, $path, $domainName,null,true);
setcookie("userLogin",strip_tags($userInfos['login']), $date_of_expiry, $path, $domainName,null,true);
//setcookie("userContactName",strip_tags($userInfos['mom_contact']), $date_of_expiry, $path, $domainName,null,true);
//setcookie("profilId",strip_tags($userInfos['profil_id']), $date_of_expiry, $path, $domainName,null,true);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
  </head>

  <body >
     
    
   <script>
                //$(document).ready(function(){
                    document.location.href='app/kussd/kmenu/';
               // });
   </script>
  </body>
</html>