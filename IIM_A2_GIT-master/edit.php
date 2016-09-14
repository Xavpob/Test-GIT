<?php

session_start();

require('config/config.php');
require('model/functions.fn.php');

/*===============================
	Edit
===============================*/
$music_id = $_GET['id'];
$music = selectMusic($db, $music_id);

if(isset($_POST) && !empty($_POST)){
	if(!empty($_POST['title'])){
		$edit = updateMusic($db, $_GET['id'], $_POST['title'], $_SESSION['id']);
		if($edit == true){
			header('Location: dashboard.php');
		}
		else{
			$error = 'The music is not yours !';
		}
	}
	else{
		$error = 'Incomplete forms !';
	}
}

include 'view/_header.php';
include 'view/edit.php';
include 'view/_footer.php';