<?php
    require_once "config/db.php";
    /*if (password_verify($_POST['password'], $login_inn['password'])) {
        $_SESSION['logged_user'] = $login_inn;
        echo '<span style="color: #fff; text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 20px; display: block; ">Вы успешно авторизованы! Можете <a href="/">обновить</a> страницу.</span>';
        header('Location: ../index.php', 5000);}*/
?>

<!DOCTYPE html>
<html lang="ru">
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 
    <script type="text/javascript">
        $(function() {
            $(window).scroll(function() {

                if($(this).scrollTop() > 100) {
                    $('#toTop').fadeIn();
                } else {
                    $('#toTop').fadeOut();
                }
            });
            $('#toTop').click(function() {
                $('body,html').animate({scrollTop:0}, 800);
            });
        });
    </script>

	<?php require_once('add/header.php');?>
	<div class="container-fluid">
		<div class="jumbotron" style="max-width: 100%; max-height: 150px;">
			<?php require_once('add/mainTitle.php'); ?>
		</div>

		<!--<h1>Важные новости!</h1>-->
		
		<div class="row">
			<div class="col-md-8">
				<?php require_once('add/articlesFirst.php'); ?>
			</div>

			<div class="col-sm-4 border border-top-0 border-right-0 border-bottom-0"><p class="text-center">Реклама</p>
				<?php require_once('add/addBlock.php'); ?>
			</div>
		</div>
	</div>
	<br>

	<div id="toTop" class="btn btn-outline-info"> ^ Наверх </div>

	<?php require_once('add/footer.php');?>

	</body>
</html>