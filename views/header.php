<!doctype html>
<html lang="en">

<?php include __DIR__ . '/head.php'; ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-blue bg-light">
        <a class="navbar-brand" href="/"> TO DO LIST</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/tasks/create"> 	&#9997 ADD TASK</a>
                </li>
                <?php if (!\Session::isAuth()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">&#128276 LOGIN ADMIN</a>
                </li>
                <?php endif ?>
                <?php if (\Session::isAuth()): ?>
                <li class="nav-item">
                    <span style="display: none">
                        <form action="/logout" method="post" id="logout"></form>
                    </span>
                    <a class="nav-link" href="#" onclick="document.getElementById('logout').submit()">EXIT</a>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <div class="container" style="padding-top: 20px">

        <?php include_once __DIR__ . '/errors.php' ?>
        <?php include_once __DIR__ . '/messages.php' ?>
