<?php
require_once "view/FooterView.php";

class FooterController
{
    public function showFooter()
    {
        $footerView = new FooterView();

        $footerView->constructFooter();
    }
}