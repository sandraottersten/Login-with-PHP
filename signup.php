<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h1>Login</h1>
    <form action="login.php" method="POST">
      <input type="text" name="loginUserName">
      <input type="password" name="loginPassword">
      <button type="submit" name="button">Login</button>
    </form>
  </body>
</html>

<?php

try{

  if(!empty($_POST["userName"]) and !empty($_POST["password"])){

    $userNameInput = $_POST["userName"];
    $passwordInput = $_POST["password"];
    $saltStart = "j9";
    $saltEnd = "k0";

    $bcryptedPassword = password_hash($saltStart.$passwordInput.$saltEnd, PASSWORD_BCRYPT);

    $currentData = file_get_contents('loginData.json');
    $arrayData = json_decode($currentData, true);
    $jsonArray= array("userName" => $userNameInput, "password" => $bcryptedPassword);
    $arrayData[] = $jsonArray;
    $finalData = json_encode($arrayData);

    if(file_put_contents('loginData.json', $finalData)) {
      echo 'Du är registrerad, dags att logga in';
    }


  } else {
    echo "Värdena är inte satta, du är inte registrerad";
  }

} catch(Exception $error) {
  echo("Fel" . $error->getMessage());
}

?>
