<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');

if( isset($_FILES['music']) && !empty($_FILES['music']) && 
	isset($_POST['title']) && !empty($_POST['title'])){
	
	$file = $_FILES['music'];
	// Si le "fichier" reçu est bien un fichier
		$ext = strtolower(substr(strrchr($file['name'], '.')  ,1));
		// Vérification des extentions
		if (preg_match('/\.(mp3|ogg)$/i', $file['name'])) {
			$filename = md5(uniqid(rand(), true));
			$destination = "musics/{$filename}.{$_SESSION['id']}.{$ext}";

			function addMusic(PDO $db, $user_id, $title, $file){
		$sql = "
			INSERT INTO
				musics
			SET
				user_id = :user_id,
				title = :title,
				file = :file
		";

		$req = $db->prepare($sql);
		$req->execute(array(
			':user_id' => $user_id,
			':title' => $title,
			':file' => $file,
		));

		return true;
	}


		} else {
			$error = 'Error, the file is not an authorized extension!';
		}
	// }
}

include 'view/_header.php';
include 'view/add_music.php';
include 'view/_footer.php';