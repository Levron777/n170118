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

                <h5 class="text-center text-info">Add comment</h5>
                <br>
                
                <form class="needs-validation text-info" style="padding-left: 20px;" novalidate>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="validationCustom01">First name</label>
						<input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
						<div class="valid-feedback">
							Looks good!
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustom02">Last name</label>
						<input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
						<div class="valid-feedback">
						Looks good!
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<label for="validationCustomUsername">Username</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupPrepend">@</span>
							</div>
							<input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
							<div class="invalid-feedback">
								Please choose a username.
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6 mb-3">
						<label for="validationCustom03">City</label>
						<input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
						<div class="invalid-feedback">
							Please provide a valid city.
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom04">State</label>
						<input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
						<div class="invalid-feedback">
							Please provide a valid state.
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="validationCustom05">Zip</label>
						<input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
						<div class="invalid-feedback">
							Please provide a valid zip.
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-check" style="padding-left: 20px;">
						<input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
						<label class="form-check-label" for="invalidCheck">
							Agree to terms and conditions
						</label>
						<div class="invalid-feedback">
							You must agree before submitting.
						</div>
					</div>
				</div>
				<button class="btn btn-info" type="submit">Подтвердить</button>
			</form>

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
		<?php require_once('footer.php');?>
	</body>
</html>