<div data-product_id='<?= htmlspecialchars($product->id) ?>' class="rating-area">
    <input type="radio" value="5" <?php if($userProductRating->rating == 5) echo("checked"); ?>>
    <label data-rating="5" title="rating"></label>
    <input type="radio" value="4" <?php if($userProductRating->rating == 4) echo("checked"); ?>>
    <label data-rating="4" title="rating"></label>
    <input type="radio" value="3" <?php if($userProductRating->rating == 3) echo("checked"); ?>>
    <label data-rating="3" title="rating"></label>
    <input type="radio" value="2" <?php if($userProductRating->rating == 2) echo("checked"); ?>>
    <label data-rating="2" title="rating"></label>
    <input type="radio" value="1" <?php if($userProductRating->rating == 1) echo("checked"); ?>>
    <label data-rating="1" title="rating"></label>
</div>