<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
$this->title = 'Jitsi App';
?>
<!-- JQuery CDN - Content Delevery Network -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<!-- Create view -->

<!-- Showcase -->

<div class="jumbotron">
    <h1 class="text-center">Create a Meet</h1>
</div>

<!-- Form Submission -->
<div class="container wrapper">
    <form style="width: 70%; margin: 0 auto;">
        <div class="form-group">
            <label for="domain">Domain</label>
            <input type="text" class="form-control" id="domain" value="meet.jit.si" readonly>
        </div>
        <div class="form-group">
            <label for="roomName">Room Name</label>
            <input type="text" class="form-control" id="roomName" placeholder="Enter room name" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password"placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- The suggestion -->
    <div style="display: none; margin: 10px auto; padding: 20px; border-radius: 10px;" class="bg-secondary container text-center text-white">Do you want to join the recently created meet ?
        <button onclick="yes()" style="margin-right: 10px; margin-left: 20px;" class="btn btn-success">Yes</button>
        <button onclick="no()" class="btn btn-danger">No</button>
    </div>
</div>

<!-- Footer -->
<footer class="bg-primary py-3">
    <p class="text-center">Built with <i class="fas fa-heart"></i> - HENDEL SAMY</p>
    <p class="text-center">&copy; 2020</p>
</footer>

<script>
    // Handling the suggestion
    function yes() {
        "use strict";
        // Popping off the suggestion
        $("form + div").slideUp("slow");

        // Save the meet to the local storage
        localStorage.setItem("hasToBeEmbeded", JSON.stringify(meet));

        location.href = "<?= Url::base('http') ?> . /index.php";
    }

    function no() {
        "use strict";
        // Popping off the suggestion
        $("form + div").slideUp("slow");
    }
</script>