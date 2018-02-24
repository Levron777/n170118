<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-info rounded">
		<a class="navbar-brand mb-0 h1" href="../index.php">Новости финансов</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Новое <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Интересное</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Еще...</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">О ETF</a>
						<a class="dropdown-item" href="#">Об акциях </a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Обо всем</a>
					</div>
				</li>
				<!-- Здесь будет поиск на сайте-->

			</ul>
            <div>
                <img src="../images/search.png" class="float-right rounded" 
                     style="max-height: 25px; max-width: 25px;">
            </div>
            <div class="dropdown">
                <button class="btn btn-info btn-sm border btn-secondary dropdown-toggle" type="button" 
                        id="dropdownMenu2" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
                    Войти
                </button>
                <form class="dropdown-menu p-4">
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2">Email адрес</label>
                    <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormPassword2">Пароль</label>
                    <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                    <label class="form-check-label" for="dropdownCheck2">
                        Запомнить
                    </label>
                </div>
                    <button type="submit" class="btn btn-info btn-sm border">Войти</button>
                </form>
            </div>
            
            <form name="form_register" action="../add/registration.php">
                <button name="btn_register" type="submit" class="btn btn-info btn-sm border">Зарегистрироваться</button>
			</form>
		</div>
	</nav>			
</header>		

