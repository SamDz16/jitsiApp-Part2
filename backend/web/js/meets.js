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
    <div class="card-header text-center"><h5 class="card-title">Click Down to Join</h5></div>
    <div onclick="embedMeet(this)" class="card-body">
      <i style="color: #000; margin-right: 5px" class="fas fa-angle-right text-white"></i> Room Name: <strong>${meet.options.room}</strong> <br />
      <i style="color: #000; margin-right: 5px" class="fas fa-angle-right text-white"></i> Real Room Name: <strong>${meet.options.roomName}</strong> <br />
      <i style="color: #000; margin-right: 5px" class="fas fa-angle-right text-white"></i> Password: <strong>${meet.options.password}</strong> <br />
      <i style="color: #000; margin-right: 5px" class="fas fa-angle-right text-white"></i> Last Modification: <strong>${meet.options.createdAt}</strong>
    </div>
    <div class="card-footer text-center">
      <button onclick="editMeet(this)" class="btn btn-success m-2"><i class="fas fa-edit"></i> Edit<span style="display: none">${meet.options.roomName}</span></button>
      <button onclick="deleteMeet(this)" class="btn btn-danger m-2"><i class="fas fa-trash-alt"></i> Delete<span style="display: none">${meet.options.roomName}</span></button>
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

listMeets();
