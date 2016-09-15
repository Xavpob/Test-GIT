<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');

if( isset($_FILES['music']) && !empty($_FILES['music']) && 
	isset($_POST['title']) && !empty($_POST['title'])){
	
	$file = $_FILES['music'];
	$title = $_POST['title'];
	//$user_id = $_SESSION["id"];

	// Si le "fichier" reçu est bien un fichier
		$ext = strtolower(substr(strrchr($file['name'], '.')  ,1));
		// Vérification des extentions
		if (preg_match('/\.(mp3|ogg)$/i', $file['name'])) {
			$filename = md5(uniqid(rand(), true));
			$destination = "musics/{$filename}.{$_SESSION['id']}.{$ext}";

			//debut

			$request = $db->prepare("
                    INSERT INTO musics (id, user_id, title, file, created_at) VALUES ('', :user_id, :title, :file, NOW())"
                );

                $request->execute([
                    ':user_id' => $user_id,
                    ':title' => $title,
                    ':file' => $file,
                ]);

            //fin

		} else {
			$error = 'Error, the file is not an authorized extension!';
		}
	// }
}

include 'view/_header.php';
include 'view/add_music.php';
include 'view/_footer.php';