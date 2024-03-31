<?php

include_once 'Helper.php';
include_once 'Utilities/Environment.php';

use Recipes\Helper;
use Recipes\Utilities\Environment;

$env = new Environment(wp_environment);
$directory = $env->get();

Helper::entry($directory);
