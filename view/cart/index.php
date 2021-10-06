<link rel="stylesheet" type="text/css" href="/public/css/cartPage.css">


<body>
<div class="cart">
    <div class="column-titles">
        <span>Title</span>
        <span>Amount</span>
        <span>Price</span>
        <span>SubTotal</span>
    </div>
    <?php
    $total = 0;
    foreach($this->cartProducts as $cartProduct)
    {
        require("view/cart/product.php");
        $total += $cartProduct->cost * $cartProduct->amount;
    }
    ?>
    <div>
        <label>Total: </label>
        <span name="total"><?= htmlspecialchars($total) ?></span>
        <span>$</span>
    </div>
    <form action="/cart" method="POST">
        <input type="text" name="request" value="createOrder" hidden>
        <select name="shippingId" onChange="calculateTotal()" required>
            <option data-cost="0" value="">Select Shipping</option>
            <?php

            foreach ($this->shippings as $shipping)
            {
                require("view/cart/shipping.php");
            }
            ?>
        </select>
        <input type="submit">
    </form>

    <div>
        <span><?= htmlspecialchars($this->errorMessage) ?></span>
    </div>
</div>

