<link rel="stylesheet" type="text/css" href="/public/css/billPage.css">

<body>
<div class="bill">
    <div class="bill-info">
        <span>Your balance was: <?= htmlspecialchars($this->previousBalance) ?>$</span>
        <span>Purchase total: <?= htmlspecialchars($this->totalCost) ?>$</span>
        <span>Current Balance: <?= htmlspecialchars($this->currentBalance) ?>$</span>
    </div>
</div>

</body>

