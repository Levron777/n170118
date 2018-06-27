<!-- <?php
    require_once "../config/db.php";
?> -->

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

	<?php require_once('../add/header.php');?>

	<div class="container-fluid">
		<div class="jumbotron" style="max-width: 100%; max-height: 150px;">
			<?php 
				require_once('../add/mainTitle.php');
			?>
		</div>

		<!--<h1>Важные новости!</h1>-->
		<?php
			/* Двойная проверка id*/
			$id = 1;
			if (isset($_GET['id'])){
				$id = ($_GET['id'] ? intval(htmlentities(trim($_GET['id']))) : 1);
			} 	

			$one_article = $pdo->prepare("SELECT * FROM `articles` WHERE `id` = ?");
			$one_article->bindValue(1, $id, PDO::PARAM_INT);
			$one_article->execute();
			$articles_page = $one_article->fetch(PDO::FETCH_ASSOC);
		?>

		<div class="row">
			<div class="col-md-8">
				<div class="card bg-dark text-white">
					<img class="card-img" src="../images/<?php echo $articles_page['id'];?>.jpg" alt="Card image">
					<div class="card-img-overlay">
						<h5 class="card-title"><?php echo $articles_page['title'];?></h5>
						<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
					</div>
				</div>
				<br>
				<p>
					<?php echo $articles_page['text'];?>
				</p>
				<img src="/images/views.png" class="float-left" style="max-height: 23px; max-width: 23px;">
				<p style="font-size: 15px;"><?php echo $articles_page['views'];?></p>

				<br>
				<a name="btn_back" href="../index.php" class="btn btn-info btn-sm">← Назад</a>
                <br><br><br>

                <h5 class="text-center text-info">Добавить комментарий</h5>
                <br>
                
                <?php
                	if (isset($_POST["add_comment"])) {
                		$errors = array();

                		if (trim($_POST['login']) == '') {
                			$errors[] = 'Введите логин!';
            			}

            			if (trim($_POST['comment']) == '') {
                			$errors[] = 'Введите комментарий!';
            			}

            			$isset_log = $pdo->prepare('SELECT login FROM `user` WHERE login = :login');
            			$isset_log->execute(array($_POST['login']));
            			$isset_login = $isset_log->fetchColumn();

            			if (!isset($isset_login)) {
            				$errors[] = 'Только зарегистрированные пользователи могут оставлять комментарии!';
            			}

            			if (empty($errors)) {
            				$add_comment = $pdo->prepare('INSERT INTO `comments` (login, comment, date, article_id) VALUES(:login, :comment, NOW(), :article_id)');
            				$add_comment->execute(array(':login' => $_POST['login'], ':comment' => $_POST['comment'], ':article_id' => $id));

            				echo '<span class="text-info" style="text-align: center; font-weight: bold; margin-bottom: 20px; display: block; ">Комментарий успешно добавлен!</span>';
			            }else {
			                echo '<div style="color:red; text-align: center;">' . array_shift($errors) . '</div><hr>';
			            }
            		}
                ?>

                <form action="" class="needs-validation text-info" method="POST" style="padding-left: 20px;" novalidate>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="validationCustom01">Ваш логин</label>
							<input type="text" name="login" class="form-control" id="validationCustom01" placeholder="login" value="<?php echo $_SESSION['logged_user']['login']; ?>" required>
							<div class="valid-feedback">
								Отлично!
							</div>
						</div>		
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="validationCustom03">Ваш комментарий</label>
							<textarea type="text" name="comment" class="form-control" id="validationCustom03" placeholder="comment" required> 
							</textarea>
							<div class="invalid-feedback">
								Пожалуйста введите комментарий.
							</div>
						</div>
					</div>
					<button name="add_comment" class="btn btn-info" type="submit">Добавить</button>
				</form>
				<br>
				<hr>
				
				<?php 
				$isset_comm = $pdo->prepare('SELECT * FROM `comments` WHERE article_id = :article_id');
				$isset_comm->execute(array($id));
            	$isset_comment = $isset_comm->fetchAll();

				if (isset($isset_comment)) {
				?>
					<h5 class="text-center text-info">Комментарии</h5>
                <br>
				<table class="table">
					<tbody>

						<?php foreach($isset_comment as $comment) { ?>

						<tr>
							<td>
								Автор: <?php echo $comment['login'];?>
							</td>
							<td>
						        Дата: <?php echo $comment['date'];?>
							</td>
							<td>
						        <?php echo $comment['comment'];?>
							</td>
						</tr>

						<?php } ?>

					</tbody>
				</table>

				<?php }	?>

				<script>
				// Example starter JavaScript for disabling form submissions if there are invalid fields
				(function() {
					'use strict';
					window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.getElementsByClassName('needs-validation');
				    // Loop over them and prevent submission
					var validation = Array.prototype.filter.call(forms, function(form) {
						form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
						}, false);
				    });
				  }, false);
				})();
				</script>
			</div>

			<div class="col-sm-4 border border-top-0 border-right-0 border-bottom-0">
				<p class="text-center">Реклама</p>
				<?php require_once('addBlock.php'); ?>
			</div>
		</div>
	</div>
	<div></br></br></div>

	<div id="toTop" class="btn btn-outline-info"> ^ Наверх </div>
	
	<?php require_once('footer.php'); ?>
	</body>
</html>