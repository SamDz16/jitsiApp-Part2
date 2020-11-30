<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
$this->title = 'Jitsi App';
?>

<h1><?= $meets ?></h1>
<!-- Meet view -->
<div class="wrapper">

    <!-- Showcase -->

    <div class="jumbotron">
        <h1 class="text-center">List all Meets</h1>
    </div>

    <div id="meet-list"></div>

</div> <!-- End wrapper -->

<!-- Footer -->
<footer class="bg-primary py-3">
    <p class="text-center">Built with <i class="fas fa-heart"></i> - HENDEL SAMY</p>
    <p class="text-center">&copy; 2020</p>
</footer>

<script>
    // Adding the click event for meetings
    function embedMeet(target){
        "use strict";
        // Retrieve the roomName
        const targetCard = target;
        const roomName = targetCard.children[4].textContent.trim();

        // Retrieve the targeted meet base on the roomName
        const targetedMeet = utila.targetedMeet(roomName);

        // Save the targeted meet to the local storage
        localStorage.setItem("hasToBeEmbeded", JSON.stringify(targetedMeet));

        // Construct the url to the home
        location.href = "<?= Url::base('http') ?> . /index.php";
    }

    function editMeet(target) {
        "use strict";
        // Retrieve the roomName
        const roomName = target.children[1].textContent;

        // Retrieve the specific meet
        const targetedMeet = utila.targetedMeet(roomName);

        // Save the specific meet to the localStorage
        localStorage.setItem("hasToBeModified", JSON.stringify(targetedMeet));

        // Construct the targeted url to the create.html in order to make modifications
        location.href = "<?= Url::base('http') ?> . /index.php?r=site%2Fcreate";
    }
</script>