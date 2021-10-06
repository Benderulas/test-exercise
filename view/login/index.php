<link rel="stylesheet" type="text/css" href="/public/css/loginPage.css">

<body>

    <div>
        <span><?= htmlspecialchars($this->errorMessage) ?></span>
    </div>

    <form class="login-form" action="/login" method="POST">
        <input type="text" name="request" value="login" hidden>
        <div>
            <div class="login-form-labels">
                <label for="login">Login:</label><br>
                <label for="password">Password:</label>
            </div>
            <div class="login-form-inputs">
                <input type="text" id="login" name="login" value="<?= htmlspecialchars($this->login) ?>">
                <input type="password" id="password" name="password">
            </div>
        </div>
        <div class="login-form-submit">
            <input  type="submit" value="LogIn">
        </div>
    </form>

</body>
