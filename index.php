<?php
require_once 'includes/header.php';

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreview(null);


$containers = new CategoryContainers($con, $userLoggedIn);
echo $containers->showAllCategories();
