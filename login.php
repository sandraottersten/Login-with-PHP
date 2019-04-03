
<?php

try{
  if(!empty($_POST["loginUserName"]) and !empty($_POST["loginPassword"])){

  function checkInlog(){
  $userNameInput = $_POST["loginUserName"];
  $passwordValue = $_POST["loginPassword"];
  $saltStart = "j9";
  $saltEnd = "k0";
  $isLoggedIn = "";

  $data = file_get_contents('loginData.json');
  $userDatas = json_decode($data);

  foreach ($userDatas as $userData) {
    if(password_verify($saltStart . $passwordValue . $saltEnd, $userData->password) && $userNameInput == $userData->userName){
      $isLoggedIn = "Yey, du är inloggad";
      break;
    } else {
      $isLoggedIn = "Sorry, inloggning misslyckades";
    }
  }
  echo $isLoggedIn;
  }
  checkInlog();

  } else {
    echo "Värdena är inte satta";
  }

} catch(Exception $error) {
  echo("Fel" . $error->getMessage());
}

?>
