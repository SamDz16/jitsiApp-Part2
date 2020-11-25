<?php

/* @var $this yii\web\View */

$this->title = 'Jitsi App';
?>
<!-- Create view -->

<!-- Showcase -->

<div class="jumbotron">
    <h1 class="text-center">Create a Meet</h1>
</div>

<!-- Form Submission -->
<div class="container wrapper">
    <form>
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
    <div style="display: none; margin: 10px auto; padding: 20px; border-radius: 10px;" class="bg-secondary container text-center">Do you want to join the recently created meet ?
        <button onclick="yes()" style="margin-right: 10px; margin-left: 20px;" class="btn btn-success">Yes</button>
        <button onclick="no()" class="btn btn-danger">No</button>
    </div>
</div>

<!-- Footer -->
<footer class="bg-primary py-3">
    <p class="text-center">Built with <i class="far fa-heart"></i> - HENDEL SAMY</p>
    <p class="text-center">&copy; 2020</p>
</footer>

<!-- Bootswatch - Litera -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


<!-- JQuery CDN - Content Delevery Network -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

