<?php
if(!isset($_SESSION['user'])) {
    header("Location: ./?page=login&layout=html");
    exit;
}
