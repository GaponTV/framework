<!doctype html>
<?php if(!defined("CORE_CONNECTION") || CORE_CONNECTION !== true) die(); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $this->pager->addCss("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css")
    ?>
    <?php $this->pager->ShowHead();?>
</head>

<body>

