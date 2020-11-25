<?php

/* @var $this yii\web\View */

$this->title = 'Jitsi App';
?>
<!-- Index view -->
<!--<nav class="navbar navbar-expand-lg navbar-dark bg-primary">-->
<!--    <div class="container">-->
<!--        <a class="navbar-brand" href="/">Jitsi App</a>-->
<!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->
<!---->
<!--        <div class="collapse navbar-collapse" id="navbarHeader">-->
<!--            <ul class="navbar-nav ml-auto">-->
<!--                <li class="nav-item active">-->
<!--                    <a class="nav-link" href="/">Home-->
<!--                        <span class="sr-only">(current)</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="/create.html">Create</a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="/meets.html">Meets</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->

<div class="wrapper">

    <!-- Showcase -->
    <div class="jumbotron">
        <h1 class="text-center mb-5">Jitsi Integration App</h1>

        <div class="container" style="display: flex; justify-content: space-between; align-items: center">
            <div>
                <a style="margin-right: 20px;" class="btn btn-primary btn-large" href="http://localhost/jitsiApp/backend/web/index.php?r=site%2Fcreate">Create a Meet</a>
                <a class="btn btn-outline-primary btn-large" href="http://localhost/jitsiApp/backend/web/index.php?r=site%2Fmeets">Join meet</a>
            </div>
            <div>
                <button style="margin-right: 20px;" class="btn btn-danger btn-large" disabled>Hide meet</button>
                <a class="btn btn-outline-success btn-large" href="http://localhost/jitsiApp/backend/web/index.php?r=site%2Fmeets">List all Meets</a>
            </div>
        </div>

        <!-- Embedded iframe -->
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 30px;" id="meet"></div>
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

<!-- The Jitsi External API -->
<script src='https://meet.jit.si/external_api.js'></script>


