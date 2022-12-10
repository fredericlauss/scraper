<?php
$data = json_decode(file_get_contents("http://localhost/scraper/api/tshirts/1")); 
ob_start();
?>
<h1 class="display-4">Products</h1>
<div class="d-grid grid-4" style="grid-template-columns: repeat(4, 1fr)">
    <?php foreach ($data->data as $tshirt) : ?>
        <div class="card" style="width: 18rem;">
            <img src="<?= $tshirt->img ?>" class="card-img-top" alt="...">
            <div class="card-body">
                    <span class="badge bg-success"> <?= $tshirt->priceDescription ?></span>
                <h5 class="card-title"><?= $tshirt->title ?> - <?= $tshirt->price ?></h5>
                <a href="/product/8d89fecd-26ff-4dac-a0a8-9fe4c4a8cfe6" class="btn btn-primary">Go to page !</a>
            </div>
        </div>
        <?php endforeach; ?>
</div>
<div>
    <?php 
    $nextPage = $data->nextPage;
    $previousPage = $data->previousPage;
    if($previousPage != 0) {?>
        <a class="" href="tshirtsparpages.php?page=<?php echo($previousPage) ?>"><</a>
        <?php } else { ?>
            <a class="" href="">X</a>
        <?php  };
    if($nextPage != 0) {?>
    <a class="" href="tshirtsparpages.php?page=<?php echo($nextPage) ?>">></a>
    <?php } else { ?>
        <a class="" href="">X</a>
    <?php  }?>
</div>
<?php
$content = ob_get_clean();
require_once("template.php");