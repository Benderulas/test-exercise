async function requestPOST(_path, _data)
{

    let response = await fetch(_path, {
        method: 'POST',
        credentials: 'same-origin',
        body: _data
    });

    return await response.text();
}

function calculateTotal()
{
    let subTotals = document.getElementsByName('subTotal');
    let total = 0;

    for (let i = 0; i < subTotals.length; i++)
    {
        total += Number($(subTotals[i]).text());
    }

    total += $(document.getElementsByName('shippingId')[0]).find(":selected").data("cost");

    $(document.getElementsByName('total')[0]).text(total);
}


async function addProductToCart(_this)
{
    let product = new FormData();
    product.append("request", "setProductToCart");
    product.append("product_id", $(_this).data("product_id"));
    product.append("amount", _this.parentNode.querySelector('[name="amount"]').value);


    let path = "/cart";
    let response = await requestPOST(path, product);

    if ($(_this).data('cart'))
    {
        let cost = $(_this).parent().next().children().first().text();
        let subTotal = product.get('amount') * cost;
        $(_this).parent().next().next().children().first().text(subTotal);
        calculateTotal();
    }
}


async function removeProductFromCart(_this)
{
    let product = new FormData();
    product.append("request", "removeProductFromCart");
    product.append("product_id", $(_this).data("product_id"));

    let path = "/cart";
    let response = await requestPOST(path, product);

    $(_this).siblings("input").val('');

    if ($(_this).data('cart'))
    {
        console.log($(_this).data('cart'));
        $(_this).parent().parent().remove();
        calculateTotal();
    }
}

async function setRating(_this)
{
    let userProductRating = new FormData();
    userProductRating.append("request", "addUserProductRating");
    userProductRating.append("product_id", $(_this).parent().data("product_id"));
    userProductRating.append("rating", $(_this).data("rating"));


    let input = _this.parentNode.querySelector('input[value="' + userProductRating.get('rating') + '"]');
    input.checked = "checked";

    $(_this).parent().removeClass("rating-area-hover");
    $(_this).parent().children('label').each(
        function()
        {
            $(this).removeAttr('onclick');
        }
        );

    let path = "/products"
    let response = JSON.parse(await requestPOST(path, userProductRating));

    $(_this).parent().parent().children().last().text(response['rating']);
}