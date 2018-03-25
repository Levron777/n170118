<?php 
$page = 1;
$per_page = 11;
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

if ($articles_page <= 0) {
	echo "Статьи не обнаружены!";
	$articles_exist = false;
}

if ($articles_exist == true) {
	echo '<nav aria-label="Search results pages"><ul class="pagination">';
	if ($page > 1) {
		echo '<li class="page-item">';
		echo '<a class="page-link" tabindex="-1" href="/index.php?page=' . ($page - 1) . '">← Previous </a>';
		echo '</li>';
    }

    if ($total_pages > 2) {
    	if ($page == 1) {
    		echo '<li class="page-item active"><a class="page-link" href="/index.php?page='. $page .'">1</a></li>';
    		echo '<li class="page-item"><a class="page-link" href="/index.php?page=' . ($page + 1) . '">2</a></li>';
    		echo '<li class="page-item"><a class="page-link" href="/index.php?page=' . ($page + 2) . '">3</a></li>';
    	}else if ($page == 2) {
    		echo '<li class="page-item"><a class="page-link" href="/index.php?page=' . ($page - 1) . '">1</a></li>';
    		echo '<li class="page-item active"><a class="page-link" href="/index.php?page=' . $page . '">2</a></li>';
    		echo '<li class="page-item"><a class="page-link" href="/index.php?page=' . ($page + 1) . '">3</a></li>';
    	}else if ($page == 3) {
    		echo '<li class="page-item"><a class="page-link" href="/index.php?page=' . ($page - 2) . '">1</a></li>';
    		echo '<li class="page-item"><a class="page-link" href="/index.php?page=' . ($page - 1) . '">2</a></li>';
    		echo '<li class="page-item active"><a class="page-link" href="/index.php?page=' . $page . '">3</a></li>';
    	}
    }
    if ($page < $total_pages) {
    	echo '<li class="page-item">';
        echo '<a class="page-link" href="/index.php?page=' . ($page + 1) . '">Next  → </a>';
        echo '</li>';
   	}
    
    echo '</ul></nav>';
}
foreach($articles_page as $art) {
?>

<div class="row">
	<div class="col-md-4">
		<div class="media d-inline-block">
			<a href="../add/oneArticle.php?id=<?php echo $art['id'];?>"><img class="mr-3 rounded img-fluid" src="../images/<?php echo $art['id'];?>.jpg" alt="Generic placeholder image"></a>
			<div class="media-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
							<img src="/images/views.png" class="float-right" style="max-height: 20px; max-width: 20px;">
						</div>
						<div class="col-auto text-left" style="padding-left: 0px; font-size: 13px;">23
						</div>
						<div class="col-lg" style="padding-right: 0px;">
							<h5 class="text-right text-primary"><?php echo $art['title']; ?></h5>
						</div>
					</div>
				</div>
					<a href="../add/oneArticle.php?id=<?php echo $art['id'];?>" class="text-dark" style="text-decoration: none;">
					<?php echo mb_substr(strip_tags($art['text']), 0, 200, 'utf-8') . " ..." ;?>
					</a>
			</div>
		</div>
	</div>
</div>
		<div></br></br></div>
		<?php
        }
        ?>
		<!--<div class="media d-inline-block">
			<a href="#"><img class="mr-3 rounded img-fluid" src="../images/saudiArabia.jpg" alt="Generic placeholder image"></a>
			<div class="media-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
							<img src="/images/views.png" class="float-right" style="max-height: 20px; max-width: 20px;">
						</div>
						<div class="col-auto text-left" style="padding-left: 0px; font-size: 13px;">23
						</div>
						<div class="col-lg" style="padding-right: 0px;">
							<h5 class="text-right text-primary">Media heading</h5>
						</div>
					</div>
				</div>
					<a href="#" class="text-dark" style="text-decoration: none;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis odio in velit venenatis, at egestas ex euismod. Aenean consectetur sed dolor eget porttitor.
					</a>
			</div>
		</div>
		<div></br></br></div>
	</div>
	<div class="col-sm">
		<div class="media d-inline-block">
			<a href="#"><img class="mr-3 rounded img-fluid" src="../images/apple.jpg" alt="Generic placeholder image"></a>
			<div class="media-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
							<img src="/images/views.png" class="float-right" style="max-height: 20px; max-width: 20px;">
						</div>
						<div class="col-auto text-left" style="padding-left: 0px; font-size: 13px;">23
						</div>
						<div class="col-lg" style="padding-right: 0px;">
							<h5 class="text-right text-primary">Media heading</h5>
						</div>
					</div>
				</div>
					<a href="#" class="text-dark" style="text-decoration: none;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis odio in velit venenatis, at egestas ex euismod. Aenean consectetur sed dolor eget porttitor.
					</a>
			</div>
		</div>
		<div></br></br></div>
		<div class="media d-inline-block">
			<a href="#"><img class="mr-3 rounded img-fluid" src="../images/apple.jpg" alt="Generic placeholder image"></a>
			<div class="media-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
							<img src="/images/views.png" class="float-right" style="max-height: 20px; max-width: 20px;">
						</div>
						<div class="col-auto text-left" style="padding-left: 0px; font-size: 13px;">23
						</div>
						<div class="col-lg" style="padding-right: 0px;">
							<h5 class="text-right text-primary">Media heading</h5>
						</div>
					</div>
				</div>
					<a href="#" class="text-dark" style="text-decoration: none;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis odio in velit venenatis, at egestas ex euismod. Aenean consectetur sed dolor eget porttitor.
					</a>
			</div>
		</div>
		<div></br></br></div>
	</div>
	<div class="col-sm">
		<div class="media d-inline-block">
			<a href="#"><img class="mr-3 rounded img-fluid" src="../images/royal.jpg" alt="Generic placeholder image"></a>
			<div class="media-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
							<img src="/images/views.png" class="float-right" style="max-height: 20px; max-width: 20px;">
						</div>
						<div class="col-auto text-left" style="padding-left: 0px; font-size: 13px;">23
						</div>
						<div class="col-lg" style="padding-right: 0px;">
							<h5 class="text-right text-primary">Media heading</h5>
						</div>
					</div>
				</div>
					<a href="#" class="text-dark" style="text-decoration: none;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis odio in velit venenatis, at egestas ex euismod. Aenean consectetur sed dolor eget porttitor.
					</a>
			</div>
		</div>
		<div></br></br></div>
		<div class="media d-inline-block">
			<a href="#"><img class="mr-3 rounded img-fluid" src="../images/royal.jpg" alt="Generic placeholder image"></a>
			<div class="media-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
							<img src="/images/views.png" class="float-right" style="max-height: 20px; max-width: 20px;">
						</div>
						<div class="col-auto text-left" style="padding-left: 0px; font-size: 13px;">23
						</div>
						<div class="col-lg" style="padding-right: 0px;">
							<h5 class="text-right text-primary">Media heading</h5>
						</div>
					</div>
				</div>
					<a href="#" class="text-dark" style="text-decoration: none;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis odio in velit venenatis, at egestas ex euismod. Aenean consectetur sed dolor eget porttitor.
					</a>
			</div>
		</div>
		<div></br></br></div>
	</div>
</div>-->

