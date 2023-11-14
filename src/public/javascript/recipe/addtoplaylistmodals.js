const form = document.querySelector("#modal-form");
const addRes = document.querySelector("#add-result-alert");

const playlist_input = document.querySelector("#modal-select");
const playlist_alert = document.querySelector("#playlist-alert");
let playlist_validate = false;

var addModal = document.getElementById("add-modal");
var addOpenBtn = document.getElementById("add-button");
var addXBtn = document.getElementById("close-add");
var addCloseBtn = document.getElementById("cancel-add");

// open modal
addOpenBtn.onclick = function () {
  addModal.style.display = "flex";
};

// close modal
addXBtn.onclick = function () {
  addModal.style.display = "none";
};
addCloseBtn.onclick = function () {
  addModal.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == addModal) {
    addModal.style.display = "none";
  }
};

form &&
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const playlist_value = playlist_input.value;

    if (!playlist_value) {
      playlist_alert.innerText = "Please choose a playlist";
      playlist_alert.className = "alert shown-error";
      playlist_validate = false;
    } else {
      playlist_alert.innerText = "";
      playlist_alert.className = "alert hidden";
      playlist_validate = true;
    }

    if (!playlist_validate) {
      addRes.className = "alert hidden";
      addRes.innerText = "";
      return;
    }

    const url = (window.location.href).split("/");
    const recipe_id = url[5];
    const xhr = new XMLHttpRequest();

    const data = new FormData();
    data.append("recipe_id", recipe_id);
    data.append("playlist_id", playlist_value);

    xhr.onreadystatechange = function () {
      if (this.readyState !== XMLHttpRequest.DONE) {
        addRes.className = "alert hidden";
        addRes.innerText = "";
      } else {
        if (this.status === 201) {
          addRes.className = "alert shown-success";
          addRes.innerText = "Recipe added to playlist successfully";
        } else if (this.status === 400) {
          addRes.innerText = "Invalid input.";
          addRes.className = "alert shown-error";
        } else if (this.status === 500) {
          addRes.innerText = "Recipe already exists in that playlist!";
          addRes.className = "alert shown-error";
        } else {
          addRes.innerText = "An error occured.";
          addRes.className = "alert shown-error";
        }
      }
    };

    xhr.open("POST", `/public/recipe/addtoplaylist/`, true);
    xhr.send(data);
  });

