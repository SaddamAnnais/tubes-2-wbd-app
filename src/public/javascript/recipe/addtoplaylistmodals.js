const form = document.querySelector("#modal-form");
const res = document.querySelector("#result-alert");

const playlist_input = document.querySelector("#modal-select");
const playlist_alert = document.querySelector("#playlist-alert");
let playlist_validate = false;

var modal = document.getElementById("add-modal");
var openBtn = document.getElementById("add-button");
var span = document.getElementById("close-add");
var closeBtn = document.getElementById("cancel-add");

// open modal
openBtn.onclick = function () {
  modal.style.display = "block";
};

// close modal
span.onclick = function () {
  modal.style.display = "none";
};
closeBtn.onclick = function () {
  modal.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
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
    console.log(playlist_value);
    if (!playlist_validate) {
      res.className = "alert hidden";
      res.innerText = "";
      return;
    }

    const url = (window.location.href).split("/");
    const recipe_id = url[6];
    const xhr = new XMLHttpRequest();

    const data = new FormData();
    data.append("recipe_id", recipe_id);
    data.append("playlist_id", playlist_value);

    console.log(recipe_id, playlist_value);
    xhr.onreadystatechange = function () {
      if (this.readyState !== XMLHttpRequest.DONE) {
        // remove the result statement when sending
        res.className = "alert hidden";
        res.innerText = "";
      } else {
        console.log(this.status);
        if (this.status === 201) {
          res.className = "alert shown-success";
          res.innerText = "Recipe added to playlist successfully";
        } else if (this.status === 400) {
          res.innerText = "Bad request!";
          res.className = "alert shown-error";
        } else if (this.status === 405) {
          res.innerText = "Method not allowed!";
          res.className = "alert shown-error";
        } else if (this.status === 500) {
          res.innerText = "Recipe already exists in that playlist!";
          res.className = "alert shown-error";
        }
      }
    };

    xhr.open("POST", `/public/recipe/addtoplaylist/`, true);
    xhr.send(data);
  });

