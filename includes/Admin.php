<?php

namespace  WPPool\QS;

/**
 * The Admin Class Handeler
 */
class Admin{

    public function __construct()
    {
        new Admin\Menu();
        new Admin\Notice();
    }
}