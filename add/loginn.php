<?php
if(isset($_SESSION['logged_user'])) { 
    echo "Вы вошли как: " . $_SESSION['logged_user']['login'] . "," . "&nbsp"; 
    if($_SESSION['logged_user']['login'] == 'admin') {
        echo "<a class=\"navigation_admin text-white\" href='../add/admin.php'> Админка!&nbsp </a>";
    }
    ?>
    <br>
    <a class="text-white" href="../add/logout.php" class="logout">Выйти?</a>
    <?php 
        }else { 

        if (isset($_POST['do_login'])){
            $errors = array();
            $login = $pdo->prepare('SELECT * FROM `user` WHERE `email` =  :email');
            $login->execute(array(':email' => $_POST['email']));
            $login_inn = $login->fetch();
            if ($login_inn){

                if (password_verify($_POST['password'], $login_inn['password'])) {
                    $_SESSION['logged_user'] = $login_inn;
                    echo '<span style="color: #fff; text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 20px; display: block; ">Вы успешно авторизованы! <a href="/">Обновить</a> страницу.</span>';
                }else {
                    $errors[] = 'Пароль неверно введен!';
                }
            }else {
                $errors[] = 'Пользователь с таким логином не найден!';
            }

            if (!empty($errors)) {
                echo '<div style="color:red; text-align: center;">' . array_shift($errors) . '</div><hr>';
            }
        }
    ?>
    <div class="dropdown">
        <button class="btn btn-info btn-sm border btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Войти
        </button>
        <form class="dropdown-menu p-4" method="POST">
            <div class="form-group">
                <label for="exampleDropdownFormEmail2">
                    Email адрес
                </label>
                <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com" required>
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormPassword2">
                    Пароль
                </label>
                <input name="password" type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password" required>
            </div>
            <button type="submit" name="do_login" class="btn btn-info btn-sm border">
                Войти
            </button>
        </form>
    </div>
    <form name="form_register" action="../add/registration.php">
        <button name="btn_register" type="submit" class="btn btn-info btn-sm border">
            Зарегистрироваться
        </button>
    </form>
    <?php
        } 
    ?>