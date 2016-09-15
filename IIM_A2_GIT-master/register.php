<?php 
    session_start();
    require('config/config.php');


    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])){ 
            
            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);
            $email = htmlspecialchars($_POST["email"]);
    
            $request = $db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");

            $request->execute( array("username"=> $username, "email"=> $email));

            $users = $request->fetchAll(); 
                    
            if (!count($users)){
                $request = $db->prepare("
                    INSERT INTO users (username, email, password, picture, created_at)
                    VALUES (:username, :email, :password, 'test',  NOW())"
                );
                
                $request->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => $password,
                ]);
                
                //parti login
                $request = $db->prepare("
                    SELECT id 
                    FROM users 
                    WHERE username 
                    LIKE :username AND password = :password"
                ); 
                $request->execute(array("username"=> $username,"password"=> $password));
            
                $users = $request->fetchALL(); 
            
                if (sizeof($users)>0){
                    $user_id = $users[0]["id"]; 
                
                    $_SESSION["user_id"] = $user_id; 
                    header('Location:dashboard.php');
                }
            
            else{ 
                echo "Error : This username already exists.";
            }
            }
        }
 

include 'view/_header.php';
include 'view/register.php';
include 'view/_footer.php';
   ?>