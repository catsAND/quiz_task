<?php

declare(strict_types = 1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

require './vendor/autoload.php';

use Api\Settings;
use Api\Provider\Doctrine;

define('APP_ROOT', __DIR__);

$settings = new Settings();

$em = new Doctrine($settings->get('doctrine'));
