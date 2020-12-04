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

<!-- Handle Form submission -->

<!-- Showcase -->

<?php

?>

<div class="jumbotron">
    <h1 class="text-center">Create a Meet</h1>
</div>

<!-- Form Submission -->
<div class="container wrapper">
    <form style="width: 70%; margin: 0 auto;" method="POST">
        <div class="form-group">
            <label for="domain">Domain</label>
            <input type="text" class="form-control" id="domain" value="meet.jit.si" readonly>
        </div>
        <div class="form-group">
            <label for="roomName">Room Name</label>
            <input type="text" name="room_name" class="form-control" id="roomName" placeholder="Enter room name" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password"placeholder="Enter password" required>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
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
    //Meet class
    class Meet {
        constructor(domain, options) {
            this.domain = domain;
            this.options = options;
        }
    }

    // Utility class
    class utile {
        static verifyMeet(meet) {
            const meets = this.getMeets();
            let result = false;
            meets.forEach(({ options }) => {
                const { roomName } = options;
                if (roomName === meet.options.roomName) {
                    result = true;
                }
            });

            return result;
        }

        static verifyMeetForModification(meet, meetToModify) {
            if(meet.options.room === meetToModify.options.room && meet.options.password === meetToModify.options.password ){
                return true;
            }

            return false;
        }

        static getMeets() {
            if (localStorage.getItem("meets") === null) return [];

            return JSON.parse(localStorage.getItem("meets"));
        }

        static hashCode(str) {
            let hash = 0,
                i,
                chr;
            for (i = 0; i < str.length; i++) {
                chr = str.charCodeAt(i);
                hash = (hash << 5) - hash + chr;
                hash |= 0; // Convert to 32bit integer
            }
            return hash;
        }

        static targetedMeet(roomName) {
            return this.getMeets().filter(
                (meet) => meet.options.roomName === roomName
            )[0];
        }

        static addToDb(url, type, data){
            $.ajax
            ({
                url: url,
                type : type,
                cache : false,
                data : `room_name=${data.options.room}&real_room_name=${data.options.roomName}&password=${data.options.password}`,
                success: function(response)
                {
                    // Meeting is successfully added to database
                },
                error: function(){
                    // Error while inserting to database
                }
            });
        }

        static modifyInDb(url, type, data){
            $.ajax
            ({
                url: url,
                type : type,
                cache : false,
                data : `old_room_name=${JSON.parse(localStorage.getItem("hasToBeModified")).options.room}&room_name=${data.options.room}&real_room_name=${data.options.roomName}&password=${data.options.password}`,
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

    // Handle submition
    const roomName = $("#roomName");
    const password = $("#password");
    // const submitBtn = $("button[type='submit']");
    const form = $(".container form");

    // Now meet is accessible everywhere in this document
    let meet = null;

    form.submit((e) => {
        "use strict";
        // prevent default form submission behaviour
        e.preventDefault();

        // Get the meet creation time
        const createdAt = new Date();

        // Instantiate a new meet
        meet = new Meet($("#domain").val(), {
            room: roomName.val(),
            roomName: roomName.val() + utile.hashCode(roomName.val()),
            password: password.val(),
            createdAt: `${createdAt.toLocaleDateString()} - ${createdAt.toLocaleTimeString()}`,
        });

        if(localStorage.getItem("hasToBeModified") !== null) {
            if(utile.verifyMeetForModification(meet, JSON.parse(localStorage.getItem(("hasToBeModified"))))){
                // Their is no modification
                $(".jumbotron").after(
                    $(
                        "<div style='width: 80%; margin: 20px auto;' class='alert alert-danger'><strong>Alert! </strong>A meet with this room name already exists</div>"
                    )
                        .delay(2000)
                        .fadeOut(3000)
                );
            } else {
                // Their is a modification
                const meets = utile.getMeets();

                // get the meet to be modified
                const meetToModify = JSON.parse(localStorage.getItem("hasToBeModified"));

                // The new list of rooms (meetings) - Remove the old meet
                const newList = meets.filter(room => room.options.roomName !== meetToModify.options.roomName);

                // Add the modified meet to the list of meets
                newList.push(meet);

                // Modify the local storage
                localStorage.setItem("meets", JSON.stringify(newList));

                // modify the targeted meeting in the database
                utile.modifyInDb("./db/modify.php", "POST", meet);

                // Remove the meet from localStorage
                localStorage.removeItem("hasToBeModified");

                $(".jumbotron").after(
                    $(
                        "<div style='width: 80%; margin: 20px auto;' class='alert alert-success'><strong>Alert! </strong>This meeting has been successfully modified</div>"
                    )
                        .delay(1000)
                        .fadeOut(2000, () => {
                            // Redirect to the meets
                            location.href = "<?php Url::base('http') ?>./index.php?r=site%2Fmeets";
                        })
                );
            }
        } else {
            // Create the meet
            //Verify if the room doesn't exist in the local storage
            const exists = utile.verifyMeet(meet);

            // Save in localStorage
            if (!exists) {
                let meets = utile.getMeets();
                meets.push(meet);
                localStorage.setItem("meets", JSON.stringify(meets));

                // Pop up a success alert to the user
                $(".jumbotron").after(
                    $(
                        "<div style='width: 80%; margin: 20px auto;' class='alert alert-success'><strong>Alert! </strong>This meeting was added successfully</div>"
                    )
                        .delay(2000)
                        .fadeOut(3000)
                );

                //Pop up the suggestion
                $("form + div").slideDown("slow");

                // Clear out the fields
                roomName.val("");
                password.val("");

                // Add to database
                utile.addToDb("./db/insert.php", "POST", meet);

            } else {
                // Pop up an alert to the user
                $(".jumbotron").after(
                    $(
                        "<div style='width: 80%; margin: 20px auto;' class='alert alert-danger'><strong>Alert! </strong>This meeting already exists</div>"
                    )
                        .delay(2000)
                        .fadeOut(3000)
                );
            }
        }
    });

    // To do if their is a meet to modify
    $(document).ready(() => {
        "use strict";
        if (localStorage.getItem("hasToBeModified") !== null) {
            // Means that their is a meet to be modified

            // Retrieve the meet
            const meet = JSON.parse(localStorage.getItem("hasToBeModified"));

            // Fill in the fields with the old values
            roomName.val(meet.options.room);
            password.val(meet.options.password);

            // Remove the meet from localStorage
            // localStorage.removeItem("hasToBeModified");
        }
    });

    // Handling the suggestion
    function yes() {
        "use strict";
        // Popping off the suggestion
        $("form + div").slideUp("slow");

        // Save the meet to the local storage
        localStorage.setItem("hasToBeEmbeded", JSON.stringify(meet));

        location.href = "<?= Url::base('http') ?>./index.php";
    }

    function no() {
        "use strict";
        // Popping off the suggestion
        $("form + div").slideUp("slow");
    }
</script>