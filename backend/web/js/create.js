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
    if(meet.options.roomName === meetToModify.options.roomName){
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
}

// Handle submition
const roomName = $("#roomName");
const password = $("#password");
// const submitBtn = $("button[type='submit']");
const form = $(".container form");

// Now meet is accessible everywhere in this documnet
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

        // Remove the meet from localStorage
        localStorage.removeItem("hasToBeModified");

        $(".jumbotron").after(
            $(
                "<div style='width: 80%; margin: 20px auto;' class='alert alert-success'><strong>Alert! </strong>This meeting has been successfully modified</div>"
            )
                .delay(1000)
                .fadeOut(2000, () => {
                  // Redirect to the meets
                  location.href = "http://localhost/jitsiApp/backend/web/index.php?r=site%2Fmeets";
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

// form.submit((e) => {
//   "use strict";
//   // prevent default form submission behaviour
//   e.preventDefault();
//
//   // Get the meet creation time
//   const createdAt = new Date();
//
//   // Instantiate a new meet
//   meet = new Meet($("#domain").val(), {
//     room: roomName.val(),
//     roomName: roomName.val() + utile.hashCode(roomName.val()),
//     password: password.val(),
//     createdAt: `${createdAt.toLocaleDateString()} - ${createdAt.toLocaleTimeString()}`,
//   });
//
//   //Verify weather the action is not for modifying the meet or for creating it
//   if(localStorage.getItem("hasToBeModified") !== null) {
//     const existForModification = utile.verifyMeetForModification(meet, JSON.parse(localStorage.getItem("hasToBe")));
//
//     if (existForModification) {
//
//     } else {
//
//     }
//
//   }
//
//
//   if(!existForModification){
//     //Verify weather the action is not for modifying the meet or for creating it
//     if(localStorage.getItem("hasToBeModified") !== null){
//       // Their is a meeting to be modified
//       const meets = utile.getMeets();
//
//       // get the meet to be modified
//       const meetToModify = JSON.parse(localStorage.getItem("hasToBeModified"));
//
//       // The new list of rooms (meetings) - Remove the old meet
//       const newList = meets.filter(room => room.options.roomName !== meetToModify.options.roomName);
//
//       // Add the modified meet to the list of meets
//       newList.push(meet);
//
//       // Modify the local storage
//       localStorage.setItem("meets", JSON.stringify(newList));
//
//       // Remove the meet from localStorage
//       localStorage.removeItem("hasToBeModified");
//
//       // Redirect to the meets
//       location.href = "http://localhost/jitsiApp/backend/web/index.php?r=site%2Fmeets";
//     }
//   } else {
//     // Verify if the room doesn't exist in the local storage
//     const exists = utile.verifyMeet(meet);
//
//     // Save in localStorage
//     if (!exists) {
//       let meets = utile.getMeets();
//       meets.push(meet);
//       localStorage.setItem("meets", JSON.stringify(meets));
//
//       // Pop up a success alert to the user
//       $(".jumbotron").after(
//           $(
//               "<div style='width: 80%; margin: 20px auto;' class='alert alert-success'><strong>Alert! </strong>This meeting was added successfully</div>"
//           )
//               .delay(2000)
//               .fadeOut(3000)
//       );
//
//       //Pop up the suggestion
//       $("form + div").slideDown("slow");
//     }
//   }
//   // Clear out the fields
//   roomName.val("");
//   password.val("");
//   } else {
//     // Pop up an alert to the user
//     $(".jumbotron").after(
//       $(
//         "<div style='width: 80%; margin: 20px auto;' class='alert alert-danger'><strong>Alert! </strong>This meeting already exists</div>"
//       )
//         .delay(2000)
//         .fadeOut(3000)
//     );
//   }
// });

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

  location.href =
    "http://localhost/jitsiApp/backend/web/index.php?r=site%2Findex";
}

function no() {
  "use strict";
  // Popping off the suggestion
  $("form + div").slideUp("slow");
}
