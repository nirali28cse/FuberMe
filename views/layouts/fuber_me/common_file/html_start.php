
<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;


$asset=app\assets\FuberMeAsset::register($this);
$baseUrl=$asset->baseUrl;

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

