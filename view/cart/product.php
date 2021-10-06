<div class="cart-product">
    <div>
        <span name="title"> <?= htmlspecialchars($cartProduct->title) ?></span>
    </div>

    <div class="product-amount">
        <input type='number' min='0' name='amount' value="<?= htmlspecialchars($cartProduct->amount) ?>">
        <button type='button' data-product_id='<?= htmlspecialchars($cartProduct->id) ?>' data-cart="1" onclick='addProductToCart(this);'>Add</button>
        <button type='button' data-product_id='<?= htmlspecialchars($cartProduct->id) ?>' data-cart="1" onclick='removeProductFromCart(this);'>Remove</button>
    </div>
    <div>
        <span name="cost"> <?= htmlspecialchars($cartProduct->cost) ?></span>
        <span>$</span>
    </div>
    <div>
        <span name="subTotal"> <?= htmlspecialchars($cartProduct->amount * $cartProduct->cost) ?></span>
        <span>$</span>
    </div>

</div>