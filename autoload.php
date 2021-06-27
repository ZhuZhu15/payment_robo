<?php
include('vendor/autoload.php');

spl_autoload_register(function($name)
{
    include 'classes/'.strtolower($name) .'.class.php';
});