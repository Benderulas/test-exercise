

<div class="product">

    <div>
        <img class="product-image" src="<?= htmlspecialchars($product->image) ?>">
    </div>
    <div>
        <?php

        $ratingBlocked = false;

        foreach ($this->userProductRatings as $userProductRating)
        {
            if ($userProductRating->product_id == $product->id)
            {
                require("view/products/ratingVotedAlready.php");
                $ratingBlocked = true;
                break;
            }
        }

        if (!isset($this->userId))
        {
            require("view/products/ratingDisabled.php");
            $ratingBlocked = true;
        }

        if ($ratingBlocked == false)
        {
            require("view/products/ratingEnabled.php");
        }

        ?>

        <span class="rating-amount"> <?= htmlspecialchars($product->rating) ?></span>
    </div>

    <div class="product-title">
        <span> <?= htmlspecialchars($product->title) ?> </span>
        <span> <?= htmlspecialchars($product->cost) ?>$</span>
        <span> <?= htmlspecialchars($product->storage_type) ?></span>
    </div>
    <div class="product-amount">
        <input type='number' min="0" name='amount'>
        <button type='button' data-product_id='<?= htmlspecialchars($product->id) ?>' onclick='addProductToCart(this);'>Add</button>
        <button type='button' data-product_id='<?= htmlspecialchars($product->id) ?>' onclick='removeProductFromCart(this);'>Remove</button>
    </div>
</div>