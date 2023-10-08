const form = document.querySelector("#modal-form");
const res = document.querySelector("#result-alert");

const title_input = document.querySelector("#modal-input");
const title_alert = document.querySelector("#playlist-alert");
let title_validate = false;

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
    const title_value = title_input.value.trim();

    if (!title_value) {
      title_alert.innerText = "Playlist title cannot be empty.";
      title_alert.className = "alert shown-error";
      title_validate = false;
    } else {
      title_alert.innerText = "";
      title_alert.className = "alert hidden";
      title_validate = true;
    }
    if (!title_validate) {
      res.className = "alert hidden";
      res.innerText = "";
      return;
    }

    const xhr = new XMLHttpRequest();

    const data = new FormData();
    data.append("title", title_value);

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 201) {
          const payload = JSON.parse(this.responseText);
          location.replace(payload.url);
        } else {
          res.innerText = "An error occured.";
          res.className = "alert shown-error";
        }
      } else {
        res.className = "alert hidden";
        res.innerText = "";
      }
    };

    xhr.open("POST", `/public/playlist/`, true);
    xhr.send(data);
  });

