<?php
    session_start();
    session_destroy();
    header("location: ../owner_login.php");