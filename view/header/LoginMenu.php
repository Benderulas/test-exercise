<?php

if (!$this->userId)
{
    echo ("<a class='nav-link' href='/login'>Login</a>");
}
else
{
    echo
    (" 
        <form action='/login' method='POST'>
        <input type='text' name='request' value='logout' hidden>
        <input class='nav-link' type='submit' value='Logout' />
        </form>
    ");
}