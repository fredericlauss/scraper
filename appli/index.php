<?php
$data = json_decode(file_get_contents("http://localhost/scraper/api/tshirts/1")); 
ob_start();
?>
<h1 class="display-4">Products</h1>
<div class="d-grid grid-4" style="grid-template-columns: repeat(4, 1fr)">
    <?php foreach ($data->data as $tshirt) : ?>
        <div class="card" style="width: 18rem;">
            <img src="https://12ax7web.s3.amazonaws.com/accounts/1/products/imported/reading-is-magical-teeturtle-teeturtle-500x500.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                    <span class="badge bg-success">Sale!</span>
                <h5 class="card-title">Reading is Magical - $12</h5>
                
                <a href="/product/8d89fecd-26ff-4dac-a0a8-9fe4c4a8cfe6" class="btn btn-primary">Go to page !</a>
            </div>
        </div>
        <?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
require_once("template.php");