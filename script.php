<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form action="login.php" method="POST">
      <input type="text" name="userName" placeholder="Name">
      <input type="password" name="password" placeholder="Password">
      <button type="submit" name="button">Login</button>
    </form>
  </body>
</html>



<?php

try{

  if(isset($_POST["userName"]) and isset($_POST["password"])){

    $userNameInput = $_POST["userName"];
    $passwordInput = $_POST["password"];
    $saltStart = "j92h8fw";
    $saltEnd = "k0hr4hy";

    $bcryptedPassword = password_hash($saltStart.$passwordInput.$saltEnd, PASSWORD_BCRYPT);

    $jsonArray= array("userName" => $userNameInput, "password" => $bcryptedPassword);

    $fp = fopen("loginData.json", "a");

    fwrite($fp, json_encode($jsonArray));

    fclose($fp);

  } else {
    echo "Värdena är inte satta";
  }

} catch(Exception $error) {
  echo("Fel" . $error->getMessage());
}

?>
