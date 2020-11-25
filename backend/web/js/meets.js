//Utility class
class utila {
  static getMeets() {
    if (localStorage.getItem("meets") === null) return [];

    return JSON.parse(localStorage.getItem("meets"));
  }

  static targetedMeet(roomName) {
    return this.getMeets().filter(
      (meet) => meet.options.roomName === roomName
    )[0];
  }
}

// Listing out all the meets
function listMeets() {
  "use strict";
  const meets = utila.getMeets();
  let html = meets
    .map((meet) => {
      return `
  <div class="card text-white bg-info mb-3" style="max-width: 20rem;" wfd-id="83">
    <div class="card-header text-center"><h5 class="card-title">Click to join</h5></div>
    <div class="card-body">
      <i style="color: #000; margin-right: 5px" class="fas fa-hand-point-right"></i> Room Name: <strong>${meet.options.room}</strong> <br />
      <i style="color: #000; margin-right: 5px" class="fas fa-hand-point-right"></i> Real Room Name: <strong>${meet.options.roomName}</strong> <br />
      <i style="color: #000; margin-right: 5px" class="fas fa-hand-point-right"></i> Password: <strong>${meet.options.password}</strong> <br />
      <i style="color: #000; margin-right: 5px" class="fas fa-hand-point-right"></i> Last Modification: <strong>${meet.options.createdAt}</strong>
    </div>
    <div class="card-footer text-center">
      <button onclick="editMeet(this)" class="btn btn-success"><i class="fas fa-edit"></i><span style="display: none">${meet.options.roomName}</span></button>
      <button onclick="deleteMeet(this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i><span style="display: none">${meet.options.roomName}</span></button>
    </div>
  </div>
  `;
    })
    .join("");
  $("#meet-list").html(html);
}

// delete a meet
function deleteMeet(target) {
  "use strict";
  const roomName = target.children[1].textContent;
  const meets = utila
    .getMeets()
    .filter((meet) => meet.options.roomName !== roomName);
  localStorage.setItem("meets", JSON.stringify(meets));

  // Refreshing the UI
  listMeets();
}

// Edit a meet
function editMeet(target) {
  "use strict";
  // Retrieve the roomName
  const roomName = target.children[1].textContent;

  // Retrieve the specific meet
  const targetedMeet = utila.targetedMeet(roomName);

  // Save the specific meet to the localStorage
  localStorage.setItem("hasToBeModified", JSON.stringify(targetedMeet));

  // Construct the targeted url to the create.html in order to make modifications
  location.href =
    "http://localhost/jitsiApp/backend/web/index.php?r=site%2Fcreate";
}
// List all the meets
listMeets();

// Adding the click event for meetings
$(".card-body").click(function () {
  "use strict";
  // Retrieve the roomName
  const targetCard = this;
  const roomName = targetCard.children[4].textContent.trim();

  // Retrieve the targeted meet base on the roomName
  const targetedMeet = utila.targetedMeet(roomName);

  // Save the targeted meet to the local storage
  localStorage.setItem("hasToBeEmbeded", JSON.stringify(targetedMeet));

  // Construct the url to the home
  location.href =
    "http://localhost/jitsiApp/backend/web/index.php?r=site%2Findex";
});
