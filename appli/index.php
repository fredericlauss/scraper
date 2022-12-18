<?php
$data = json_decode(file_get_contents("http://vps-a6ce17b4.vps.ovh.net/scraper/api/?demande=tshirts/1")); 
ob_start();
?>
<h1 class="display-4">Products</h1>
<div class="d-grid grid-4" style="grid-template-columns: repeat(4, 1fr)">
    <?php $curentId = 0; ?>
    <?php foreach ($data->data as $tshirt) : ?>
        <?php $curentId += 1; ?>
        <div class="card" style="width: 18rem;">
            <img src="<?= $tshirt->img ?>" class="card-img-top" alt="...">
            <div class="card-body">
                    <span class="badge bg-success"> <?= $tshirt->priceDescription ?></span>
                <h5 class="card-title"><?= $tshirt->title ?> - <?= $tshirt->price ?></h5>
                <a href="tshirtId.php?id=<?php echo($curentId) ?>" class="btn btn-primary">Go to page !</a>
            </div>
        </div>
        <?php endforeach; ?>
</div>
<div>
    <?php 
    $nextPage = $data->nextPage;
    $previousPage = $data->previousPage;
    if($previousPage != 0) {?>
        <a class="btn btn-primary" href="tshirtsparpages.php?page=<?php echo($previousPage) ?>"><</a>
        <?php } else { ?>
            <p class="btn btn-secondary mb-0">X</p>
        <?php  };
    if($nextPage != 0) {?>
    <a class="btn btn-primary" href="tshirtsparpages.php?page=<?php echo($nextPage) ?>">></a>
    <?php } else { ?>
        <p class="btn btn-secondary mb-0">X</p>
    <?php  }?>
</div>
<?php
$content = ob_get_clean();
require_once("template.php");