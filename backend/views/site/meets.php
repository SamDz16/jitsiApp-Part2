<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
$this->title = 'Jitsi App';
?>

<script type="text/javascript">
    //Meet class
    class Meet {
        constructor(domain, options) {
            this.domain = domain;
            this.options = options;
        }
    }

    class utila {
        static getMeets() {
            if (localStorage.getItem("meets") === null) return [];

            return JSON.parse(localStorage.getItem("meets"));
        }

        static targetedMeet(room) {
            return this.getMeets().filter(
                (meet) => meet.options.room === room
            )[0];
        }

        static deleteFromDb(url, type, room){
            $.ajax
            ({
                url: url,
                type : type,
                cache : false,
                data : `room_name=${room}`,
                success: function(response)
                {
                    // Meeting is successfully added to database
                },
                error: function(){
                    // Error while inserting to database
                }
            });
        }
    }
    // Adding the click event for meetings
    function embedMeet(target){
        "use strict";
        // Retrieve the roomName

        const room = target.children[1].textContent.trim();

        // Retrieve the targeted meet base on the roomName
        const targetedMeet = utila.targetedMeet(room);

        // Save the targeted meet to the local storage
        localStorage.setItem("hasToBeEmbeded", JSON.stringify(targetedMeet));

        // Construct the url to the home
        location.href = "<?php Url::base('http') ?>./index.php";
    }

    // delete a meet
    function deleteMeet(target) {
        "use strict";
        // Has to be deleted from database
        const room = target.children[1].textContent;

        // Delete from local Storage
        const meets = utila
            .getMeets()
            .filter((meet) => meet.options.room !== room);
        localStorage.setItem("meets", JSON.stringify(meets));

        // Delete from DB
        utila.deleteFromDb("./db/delete.php", "POST", room);

        location.href = "<?php Url::base('http') ?>./index.php?r=site%2Fmeets";

        // Refreshing the UI
        listMeets();
    }

    // edit a meet
    function editMeet(target) {
        "use strict";
        // Retrieve the roomName
        const room = target.children[1].textContent;

        // Retrieve the specific meet
        const targetedMeet = utila.targetedMeet(room);

        // Save the specific meet to the localStorage
        localStorage.setItem("hasToBeModified", JSON.stringify(targetedMeet));

        // Construct the targeted url to the create.html in order to make modifications
        location.href = "<?php Url::base('http') ?>./index.php?r=site%2Fcreate";
    }

    // Listing out all the meets
    function listMeets() {
        "use strict";
        <?php
        $html_table = array_map(function ($meet){
            $room_name = $meet["room_name"];
            $real_room_name = $meet["real_room_name"];
            $password = $meet["password"];
            $created_at = $meet["created_at"];

            return "<div class=\"card text-white bg-info mb-3\" style=\"max-width: 20rem;\">
                <div class=\"card-header text-center\"><h5 class=\"card-title\">Click Down to Join</h5></div>
                <div onclick=\"embedMeet(this)\" class=\"card-body\">
                    <i style=\"color: #000; margin-right: 5px\" class=\"fas fa-angle-right text-white\"></i> Room Name: <strong>$room_name</strong> <br />
                    <i style=\"color: #000; margin-right: 5px\" class=\"fas fa-angle-right text-white\"></i> Real Room Name: <strong>$real_room_name</strong> <br />
                    <i style=\"color: #000; margin-right: 5px\" class=\"fas fa-angle-right text-white\"></i> Password: <strong>$password</strong> <br />
                    <i style=\"color: #000; margin-right: 5px\" class=\"fas fa-angle-right text-white\"></i> Last Modification: <strong>$created_at</strong>
                </div>
                <div class=\"card-footer text-center\">
                    <button onclick=\"editMeet(this)\" class=\"btn btn-success m-2\"><i class=\"fas fa-edit\"></i> Edit<span style=\"display: none\">$room_name</span></button>
                    <button onclick=\"deleteMeet(this)\" class=\"btn btn-danger m-2\"><i class=\"fas fa-trash-alt\"></i> Delete<span style=\"display: none\">$room_name</span></button>
                </div>
            </div>";
        }, $meets);
        $html = implode("", $html_table);
        ?>
    }

    listMeets();

    $(document).ready(() => {
        const HtmlMeets = $("#meet-list").children();
        const meets = [];
        for(let i = 0; i < HtmlMeets.length; i++){
            const HtmlMeet = HtmlMeets[i];
            const HtmlContent = HtmlMeet.children[1];

            const room = HtmlContent.children[1].textContent;
            const roomName = HtmlContent.children[4].textContent;
            const password = HtmlContent.children[7].textContent;
            const createdAt = HtmlContent.children[10].textContent;

            const meetObj = {room, roomName, password, createdAt};

            const meet = new Meet("meet.jit.si", meetObj);
            meets.push(meet);
        }
        // Set to local Storage
        localStorage.setItem("meets", JSON.stringify(meets));

    })
</script>

<!-- Meet view -->
<div class="wrapper">

    <!-- Showcase -->

    <div class="jumbotron">
        <h1 class="text-center">List all Meets</h1>
    </div>

    <div id="meet-list"> <?php echo $html ?></div>

</div> <!-- End wrapper -->

<!-- Footer -->
<footer class="bg-primary py-3">
    <p class="text-center">Built with <i class="fas fa-heart"></i> - HENDEL SAMY</p>
    <p class="text-center">&copy; 2020</p>
</footer>