<?php session_start();

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('model/functions.fn.php');


/********************************
			PROCESS
********************************/

if(isset($_POST['email']) && isset($_POST['password'])){ 
  if(!empty($_POST['email']) && !empty($_POST['password'])){ 

     $email = htmlspecialchars($_POST["email"]);
     $password = htmlspecialchars($_POST["password"]);

     $request = $db->prepare("
      SELECT id
      FROM users 
      WHERE email = :email AND password = :password"
    );

      $request->execute(array("email" => $email, "password" => $password));

      $members = $request->fetchALL(); 
  
      if (sizeof($members)>0){
        $id_user = $members[0]["id"]; 
        $_SESSION["id_user"] = $id_user;
        header('Location: dashboard.php');
       }else{
        $error = "Error : Erreur dans le pseudo/mot de passe"; 
      }
  }else{ 
    $error = 'Required fields !'; 
  }
}

/******************************** 
			VIEW 
********************************/
include 'view/_header.php';
include 'view/login.php';
include 'view/_footer.php';