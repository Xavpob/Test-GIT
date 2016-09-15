<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');

if( isset($_FILES['file']) && !empty($_FILES['file']) &&
	isset($_POST['title']) && !empty($_POST['title'])){
	
	$file = $_FILES['file'];

	// Si le "fichier" reçu est bien un fichier
		$ext = strtolower(substr(strrchr($file['name'], '.')  ,1));
		// Vérification des extentions
		if (preg_match('/\.(mp3|ogg)$/i', $file['name'])) {
			$filename = md5(uniqid(rand(), true));
			$destination = "musics/{$filename}.{$_SESSION['id']}.{$ext}";

			$title = htmlspecialchars($_POST["title"]);

			$request = $db->prepare("
                INSERT INTO musics (user_id, title, file, created_at) 
                VALUES (:user_id, :title, :file, NOW())"
			);
			$request->execute( array("title" => $title, "file" => $file, "user_id" => $_SESSION["user_id"]));
			header ("Location:dashboard.php");
		}

		} else {
			$error = 'Error, the file is not an authorized extension!';
		}


include 'view/_header.php';
include 'view/add_music.php';
include 'view/_footer.php';
?>