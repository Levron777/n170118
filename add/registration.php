<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Узнай больше</title>
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
			<?php require_once('mainTitle.php'); ?>
		</div>

		<!--<h1>Важные новости!</h1>-->

		<div class="row">
			<div class="col-md-8">
                <h3 class="text-center text-info">Регистрация</h3>
                <br>
                <form action="" method="POST" class="needs-validation" style="padding-left: 20px;" 
                      id="form">
				<div class="form-row">
					<div class="col-md-6 mb-6 text-info">
						<label for="validationCustom01">Ваше имя</label>
                        <input type="text" name="name" 
                               class="form-control" id="validationCustom01" 
                               placeholder="Имя">
						<div class="valid-feedback">
							Отлично!
						</div>
					</div>
					<div class="col-md-6 mb-6 text-info">
						<label for="validationCustom02">Ваш e-mail</label>
                        <input type="email" name="email" class="form-control" 
                               id="validationCustom02" placeholder="E-mail">
						<div class="valid-feedback">
						Отлично!
						</div>
					</div>
                    <div class="col-md-6 mb-6 text-info">
						<label for="validationCustom01">Введите пароль</label>
                        <input type="password" name="password" class="form-control" id="validationCustom01" placeholder="Пароль">
						<div class="valid-feedback">
							Отлично!
						</div>
					</div>
					<div class="col-md-6 mb-6 text-info">
						<label for="validationCustom02">Проверка пароля</label>
                        <input type="password" name="RePassword" 
                               class="form-control" id="validationCustom02" placeholder="Пароль">
						<div class="valid-feedback">
                            Отлично!
						</div>
					</div>
				</div>
                    <br>
                    <button class="btn btn-info" type="button" onclick="valid(document.getElementById('form'))">Зарегистрироваться</button>
			</form>

            <script type="text/javascript">
                function valid (form) {
                    var fail = false;
                    var name = form.name.value;
                    var password = form.password.value;
                    var RePassword = form.RePassword.value;
                    var email = form.email.value;
                    if(name == "" || name == " ") {
                        fail = 'Вы не ввели свое имя';
                    } else if (password == "") {
                        fail = 'Вы не ввели пароль'
                    } else if (RePassword !== password) {
                        fail = 'Пароли не совпадают!'
                    } else if (email == "" || email == " ") {
                        fail = 'Вы не ввели email!'
                    }
                    if(fail) {
                        alert(fail);
                    }
                }
			</script>
			</div>

			<div class="col-sm-4 border border-top-0 border-right-0 border-bottom-0">
				<p class="text-center">Реклама</p>
				<?php require_once('addBlock.php'); ?>
			</div>
		</div>
	</div>
	<div></br></br></div>
		<?php require_once('footer.php');?>
	</body>
</html>