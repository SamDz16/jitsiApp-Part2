// JS for the home page

let myApi = null;

function launchMeet(meet) {
  "use strict"
  const domain = "meet.jit.si";
  const options = {
    roomName: meet.options.roomName,
    width: "100%",
    height: 700,
    parentNode: document.querySelector("#meet"),
  };
  myApi = new JitsiMeetExternalAPI(domain, options);

  setTimeout(() => {
    // set new password for channel -  for the first user
    myApi.on("participantRoleChanged", function (event) {
      if (event.role === "moderator") {
        myApi.executeCommand("password", meet.options.password);
      }
    });
    // join a protected channel - for the gusts
    myApi.on("passwordRequired", function () {
      myApi.executeCommand("password", meet.options.password);
    });
  }, 10);
}

// Check if their is a meet to embed
$(document).ready(() => {
  "use strict"
  if (localStorage.getItem("hasToBeEmbeded") !== null) {
    // Means their is a meet to embed
    const meet = JSON.parse(localStorage.getItem("hasToBeEmbeded"));

    // Show the disabled button
    $("button.btn-danger").prop("disabled", false);

    // launch effectively the meet
    launchMeet(meet);
  }
});

$("button.btn-danger").click(() => {
  "use strict"
  // Disable back the button
  $("button.btn-danger").prop("disabled", true);

  // Remove the meet from localStorage
  localStorage.removeItem("hasToBeEmbeded");

  // Hide the meet
  $("#meet").css("display", "none");
});

// myApi.participantKicckedOut((res) => {
//   console.log(res);
// });

// myApi.videoConferenceLeft((res) => alert("VIDEO CONFERENCE LEFT", res));

// myApi.videoConferenceJoined((res) => alert("VIDEO CONFERENCE JOINED", res));

// myApi.participantLeft((res) => alert("PARTICIPANT LEFT", res));
