<?php
$data = json_decode(file_get_contents("http://localhost/scraper/api/tshirt/".$_GET['id'])); 
ob_start();
?>
<div b-2bny3kbu4g="" class="container">
        <div b-2bny3kbu4g="" role="main" class="pb-3">
            

<h1 class="display-4"><?= $data->title ?></h1>
<hr>
<div class="d-flex">
    <img src="<?= $data->img ?>">
    <div class="p-1">
        <div class="d-flex">
            <h3>
            <?= $data->price ?>
                    <span style="color: green;"><?= $data->priceDescription ?></span>
            </h3>
            
        </div>

        <p><?= $data->description ?>
</p>
        <button class="btn btn-success">Order !</button>
    </div>
    
    
</div>


</dib>
    </div>
<?php
$content = ob_get_clean();
require_once("template.php");