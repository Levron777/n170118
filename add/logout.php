<?php
	require_once '../config/db.php';
	unset($_SESSION['logged_user']);
	header('Location: /');