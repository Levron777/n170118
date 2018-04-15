<?php
    require_once "../config/db.php";
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <?php require_once('../add/header.php');?>
        <div class="container-fluid">

            <?php
            if (isset($_POST['do_publish'])) {
                $errors = array();

                if (trim($_POST['title']) == '') {
                    $errors[] = 'Введите название!';
                }
                
                if (trim($_POST['text']) == '') {
                    $errors[] = 'Введите контент!';
                }
                
                if (trim($_POST['category']) == '') {
                    $errors[] = 'Введите название категории!';
                }

                if (empty($errors)) {
                    $publish = $pdo->prepare('INSERT INTO `articles`(`title`, `text`, `date`, `category`) VALUES(:title, :text, NOW(), :category)');
                    $publish->execute(array(':title' => $_POST['title'], ':text' => $_POST['text'], ':category' => $_POST['category']));
                        
                        echo '<span class="text-info" style="font-weight: bold; margin-bottom: 20px; display: block; ">Информация успешно добавлена! Можете войти на <a href="/">главную</a> страницу. Либо продолжить ввод <a href="../add/admin.php">новой</a> информации.</span>';
                    }else {
                        echo '<div style="color:red;">' . array_shift($errors) . '</div><hr>';
                }
            }
            ?>

            <form action="admin.php" method="POST">
                <div class="dws_input">
                    <p>
                        <p class="text-info"><strong>Добавление контента на сайт</strong></p>
                        <p class="text-info"><strong>Название статьи:</strong></p>
                        <input type="text" name="title" placeholder="Название" value="<?php echo @$_POST['title']; ?>" required>
                    </p>
                    <p>
                        <p class="text-info"><strong>Содержание:</strong></p>
                        <textarea type="text" name="text" placeholder="Содержание" value="<?php echo @$_POST['text']; ?>" required></textarea>
                    </p>
                    <p>
                        <p class="text-info"><strong>Категория статьи:</strong></p>
                        <input type="text" name="category" placeholder="Категория статьи" value="<?php echo @$_POST['category']; ?>" required>
                    </p>
                    <p>
                        <input type="submit" class="dws_submit" name="do_publish" value="Опубликовать">
                    </p>
                </div>
            </form>
        </div>
        <br>

        <?php 
        $isset_art = $pdo->prepare('SELECT * FROM `articles`');
        $isset_art->execute();
        $isset_articles = $isset_art->fetchAll();

        if (isset($isset_articles)) {
        ?>
            <h5 class="text-center text-info">Все статьи</h5>
            <br>
            <table class="table">
                <tbody>

                <?php foreach($isset_articles as $articles) { ?>

                <tr>
                    <td>
                        ID: <?php echo $articles['id'];?>
                    </td>
                    <td>
                        Название: <?php echo $articles['title'];?>
                    </td>
                    <td>
                        Дата: <?php echo $articles['date'];?>
                    </td>
                    <td>
                        <?php echo $articles['text'];?>
                    </td>
                    <td>
                        Лайки: <?php echo $articles['likes'];?>
                    </td>
                    <td>
                        Просмотры: <?php echo $articles['views'];?>
                    </td>
                    <td>
                        Категория: <?php echo $articles['category'];?>
                    </td>
                </tr>

                <?php } ?>

                </tbody>
            </table>

        <?php } ?>

        <div id="toTop" class="btn btn-outline-info"> ^ Наверх </div>

        <?php require_once('../add/footer.php');?>

    </body>
</html>