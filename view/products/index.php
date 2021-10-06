<link rel="stylesheet" type="text/css" href="/public/css/productsPage.css">

<body>
    <div class="product-list">
        <?php
        foreach($this->products as $product)
        {
            require("view/products/product.php");
        }
        ?>
    </div>
</body>



