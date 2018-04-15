<?php require_once('config/db.php'); 

# Connection to Database. 

$page = 1;
$per_page = 10;
if (isset($_GET['page'])){
	$page = ($_GET['page'] ? intval(htmlentities(trim($_GET['page']))) : 1);
} 	

$total_articles = $pdo->query("SELECT COUNT(`id`) AS `total_count` FROM `articles`");
$total_count = $total_articles->fetch();
$total_count = $total_count['total_count'];
$total_pages = ceil($total_count/$per_page);

if ($page <= 1 || $page > $total_pages) {
	$page = 1;
}
$art = ($page * $per_page) - $per_page;

$articles = $pdo->prepare("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT ?, ?");
$articles->bindValue(1, $art, PDO::PARAM_INT);
$articles->bindValue(2, $per_page, PDO::PARAM_INT);
$articles->execute();
$articles_page = $articles->fetchAll();
$articles_exist = true;

# Upper pagination block

if ($articles_page <= 0) {
	echo "Статьи не обнаружены!";
	$articles_exist = false;
}

if ($articles_exist == true) {
	echo '<nav aria-label="Search results pages"><ul class="pagination">';
	if ($page > 1) {
		echo '<li class="page-item">';
		echo '<a class="page-link text-info" tabindex="-1" href="/index.php?page=' . ($page - 1) . '">← Назад </a>';
		echo '</li>';
    }

    if ($total_pages > 2) {

    	if ($page == 1) {
    		echo '<li class="page-item active text-info"><a class="page-link" href="/index.php?page='. $page .'">1</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page + 1) . '">2</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page + 2) . '">3</a></li>';
    	}else if ($page == 2) {
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page - 1) . '">1</a></li>';
    		echo '<li class="page-item active text-info"><a class="page-link" href="/index.php?page=' . $page . '">2</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page + 1) . '">3</a></li>';
    	}else if ($page == 3) {
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page - 2) . '">1</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page - 1) . '">2</a></li>';
    		echo '<li class="page-item active text-info"><a class="page-link" href="/index.php?page=' . $page . '">3</a></li>';
    	}
    }

    if ($page < $total_pages) {
    	echo '<li class="page-item">';
      echo '<a class="page-link text-info" href="/index.php?page=' . ($page + 1) . '">Вперед  → </a>';
      echo '</li>';
   	}
  echo '</ul></nav>';
}
?>

<!-- Add all articles and jpg's to the page-->

<table class="table">
	<tbody>
		<?php foreach($articles_page as $art) { ?>

		<tr>
			<td>
				<a href="../add/oneArticle.php?id=<?php echo $art['id'];?>">
					<img class="d-inline-block rounded " style="max-width: 300px; max-height: 300px;" src="../images/<?php echo $art['id'];?>.jpg">
				</a>
				<img src="/images/views.png" class="float-left" style="max-height: 23px; max-width: 23px;">
					<p style="font-size: 15px;"><?php echo $art['views'];?></p>
			</td>

			<td class="lead">
        <a href="add/oneArticle.php?id=<?php echo $art['id'];?>" class="text-dark" style="text-decoration: none;">
          <?php echo mb_substr(strip_tags($art['text']), 0, 200, 'utf-8') . " ..." ;?>
        </a>
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg" style="padding-left: 0px;">
							<a href="add/oneArticle.php?id=<?php echo $art['id'];?>" class="btn btn-info btn-sm">Далее... &raquo;</a>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<?php } ?>

	</tbody>
</table>

<!-- Downer pagination block-->

<?php 

if ($articles_page <= 0) {
	echo "Статьи не обнаружены!";
	$articles_exist = false;
}

if ($articles_exist == true) {
	echo '<nav aria-label="Search results pages"><ul class="pagination">';

	if ($page > 1) {
		echo '<li class="page-item">';
		echo '<a class="page-link text-info" tabindex="-1" href="/index.php?page=' . ($page - 1) . '">← Назад </a>';
		echo '</li>';
    }

    if ($total_pages > 2) {

    	if ($page == 1) {
    		echo '<li class="page-item active text-info"><a class="page-link" href="/index.php?page='. $page .'">1</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page + 1) . '">2</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page + 2) . '">3</a></li>';
    	}else if ($page == 2) {
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page - 1) . '">1</a></li>';
    		echo '<li class="page-item active text-info"><a class="page-link" href="/index.php?page=' . $page . '">2</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page + 1) . '">3</a></li>';
    	}else if ($page == 3) {
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page - 2) . '">1</a></li>';
    		echo '<li class="page-item text-info"><a class="page-link" href="/index.php?page=' . ($page - 1) . '">2</a></li>';
    		echo '<li class="page-item active text-info"><a class="page-link" href="/index.php?page=' . $page . '">3</a></li>';
    	}
    }

    if ($page < $total_pages) {
    	echo '<li class="page-item">';
      echo '<a class="page-link text-info" href="/index.php?page=' . ($page + 1) . '">Вперед  → </a>';
      echo '</li>';
   	}
  echo '</ul></nav>';
}
?>









<!-- other style 
<ul class="list-unstyled">
  <li class="media border border-top-0 border-right-0 border-left-0">
    <img class="mr-3" style="max-width: 120px; max-height: 120px;" src="../images/saudiArabia.jpg" alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">List-based media object</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>
  <li class="media my-4 border border-top-0 border-right-0 border-left-0">
    <img class="mr-3" style="max-width: 120px; max-height: 120px;" src="../images/apple.jpg" alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">List-based media object</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>
  <li class="media border border-top-0 border-right-0 border-left-0">
    <img class="mr-3" style="max-width: 120px; max-height: 120px;" src="../images/merkel.jpg" alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">List-based media object</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>
</ul>-->



