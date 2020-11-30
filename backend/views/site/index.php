<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
$this->title = 'Jitsi App';
?>

<script>
    // clear out tye local storage
    localStorage.removeItem("hasToBeModified");
</script>

<div class="wrapper">

    <!-- Showcase -->
    <div class="jumbotron">
        <h1 class="text-center mb-5">Jitsi Integration App</h1>

        <div id="links" class="container" style="display: flex; justify-content: space-between; align-items: center">
            <div>
                <a style="margin-right: 20px;" class="btn btn-primary btn-large m-2 p-2" href="<?= Url::base('http') ?> . /index.php?r=site%2Fcreate">Create a Meet </a>
                <a class="btn btn-outline-primary btn-large m-2 p-2" href="<?= Url::base('http') ?> . /index.php?r=site%2Fmeets">Join meet</a>
                <button style="margin-right: 20px;" class="btn btn-danger btn-large m-2 p-2" disabled>Hide meet</button>
                <a class="btn btn-outline-success btn-large m-2 p-2" href="<?= Url::base('http') ?> . /index.php?r=site%2Fmeets">List all Meets</a>
            </div>
        </div>

        <!-- Embedded iframe -->
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 30px;" id="meet"></div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-primary py-3">
    <p class="text-center">Built with <i class="fas fa-heart"></i> - HENDEL SAMY</p>
    <p class="text-center">&copy; 2020</p>
</footer>

<!-- The Jitsi External API -->
<script src='https://meet.jit.si/external_api.js'></script>