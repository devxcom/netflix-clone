<?php
require_once('includes/header.php');

if (!isset($_GET['id'])) {
    ErrorMessage::show("No id passed into page");
}

$entityId = $_GET['id'];

$entity = new Entity($con, $entityId);

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreview($entity);

$seasonProvider = new SeasonProvider($con, $userLoggedIn);
echo $seasonProvider->create($entity);

$categoryContainers = new CategoryContainers($con, $userLoggedIn);
echo $categoryContainers->showCategory($entity->getCategoryId(),"You Might Also Like");


?>