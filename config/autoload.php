<?php
include 'db.php';
function loadClass($classe)
{
    require_once ('class/'.$classe.'php');
}
spl_autoload_register('loadClass');