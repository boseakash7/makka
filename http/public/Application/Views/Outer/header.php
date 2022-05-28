<?php

use Application\Controllers\Mode;
use System\Core\Model;
use System\Helpers\URL;
use System\Models\Language;

$lang = Model::get(Language::class);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang('login'); ?></title>
    <link rel="stylesheet" href="<?php echo URL::asset('Application/Assets/css/main/app.css'); ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('Application/Assets/css/pages/auth.css'); ?>">
    <link rel="shortcut icon" href="<?php echo URL::asset('Application/Assets/images/logo/favicon.svg" type="image/x-icon'); ?>">
    <link rel="shortcut icon" href="<?php echo URL::asset('Application/Assets/images/logo/favicon.png" type="image/png'); ?>">
</head>

<body>
    <div id="auth">

        <div class="row h-100">