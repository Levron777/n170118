<?php
    require_once "../config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title;?></title>
	    <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 	<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/style.css">
	</head>
	<body>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	<?php require_once('header.php');?>

	<div class="container-fluid">
        <div class="jumbotron" style="max-width: 100%; max-height: 150px;">
            <?php require_once('../add/mainTitle.php'); ?>
        </div>

        <?php 

        if (isset($_POST['do_registration'])) {
            $errors = array();
            if (trim($_POST['login']) == '') {
                $errors[] = 'Введите логин!';
            }
        
            if (trim($_POST['email']) == '') {
                $errors[] = 'Введите email!';
            }
            
            if ($_POST['password'] == '') {
                $errors[] = 'Введите пароль!';
            }
            
            if ($_POST['RePassword'] !== $_POST['password']) {
                $errors[] = 'Проверочный пароль введен неверно!';
            }
            $count_login = $pdo->prepare('SELECT * FROM `user` WHERE `login` =  :login');
            $count_login->execute(array(':login' => $_POST['login']));
            $count_reg_login = $count_login->rowCount();
            if ($count_reg_login > 0) {
                $errors[] = 'Пользователь с таким логином уже зарегистрирован!';
            }

            $count_email = $pdo->prepare('SELECT * FROM `user` WHERE `email` = :email');
            $count_email->execute(array(':email' => $_POST['email']));
            $count_reg_email = $count_email->rowCount();
            if ($count_reg_email > 0) {
                $errors[] = 'Пользователь с таким email уже зарегистрирован!';
            }
         
            if (empty($errors)) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $signup = $pdo->prepare('INSERT INTO `user`(`login`, `email`, `password`, `create_date`) VALUES(:login, :email, :password, NOW())');
                $signup->execute(array(':login' => $_POST['login'], ':email' => $_POST['email'], ':password' => $password));
                
                echo '<span class="text-info" style="text-align: center; font-weight: bold; margin-bottom: 20px; display: block; ">Вы успешно зарегистрированы! Можете войти на <a href="/">главную</a> страницу.</span>';
            }else {
                echo '<div style="color:red; text-align: center;">' . array_shift($errors) . '</div><hr>';
            }
        }
    ?>

        <div class="row">
            <div class="col-md-8">
                <h3 class="text-center text-info">Регистрация</h3>
                <br>
                <form action="" method="POST" class="needs-validation" style="padding-left: 20px;" id="form">
                <div class="form-row">
                    <div class="col-md-6 mb-6 text-info">
                        <label for="validationCustom01">Ваше имя</label>
                        <input type="text" name="login" class="form-control" id="validationCustom01" placeholder="Имя">
                        <div class="valid-feedback">
                            Отлично!
                        </div>
                    </div>
                    <div class="col-md-6 mb-6 text-info">
                        <label for="validationCustom02">Ваш e-mail</label>
                        <input type="email" name="email" class="form-control" id="validationCustom02" placeholder="E-mail">
				        <div class="valid-feedback">
                            Отлично!
				        </div>
                    </div>
                    <div class="col-md-6 mb-6 text-info">
                        <label for="validationCustom01">Ваш пароль</label>
                        <input type="password" name="password" class="form-control" id="validationCustom01" placeholder="Введите пароль">
                        <div class="valid-feedback">
				            Отлично!
                        </div>
                    </div>
                    <div class="col-md-6 mb-6 text-info">
                        <label for="validationCustom02">Проверка пароля</label>
                        <input type="password" name="RePassword" class="form-control" id="validationCustom02" placeholder="Введите пароль еще раз">
                        <div class="valid-feedback">
                            Отлично!
                        </div>
                    </div>
                </div>
                <br>
                <button name="do_registration" class="btn btn-info" type="submit" >Зарегистрироваться</button>
                </form>
            </div>

            <div class="col-sm-4 border border-top-0 border-right-0 border-bottom-0">
                <p class="text-center">Реклама</p>
                <?php require_once('addBlock.php'); ?>
            </div>
        </div>
    </div>
    <br><br>
    <?php require_once('footer.php');?>
	</body>
</html>





<!--<script type="text/javascript">
                    function valid (form) {
                        var fail = false;
                        var login = form.login.value;
                        var password = form.password.value;
                        var RePassword = form.RePassword.value;
                        var email = form.email.value;
                        var adr_pattern = /[0-9a-z_-]+@[0-9a-z_-]+\.[a-z]{2,5}/i; 
                    
                        if(login == "" || login == " ") {
                            fail = 'Вы не ввели свое имя';
                        } else if (password == "") {
                            fail = 'Вы не ввели пароль'
                        } else if (RePassword !== password) {
                            fail = 'Пароли не совпадают!'
                        } else if (adr_pattern.test(email) == false) {
                            fail = 'Вы ввели email не правильно!'
                        }
                        if(fail) {
                            alert(fail);
                        } else {
                            //window.location = "../index.php";
                            alert('Вы успешно зарегистрировались!');
                            
                        }
                    }
                </script>-->