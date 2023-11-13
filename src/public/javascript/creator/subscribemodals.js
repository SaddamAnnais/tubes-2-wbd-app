const form = document.querySelector("#modal-form");
const res = document.querySelector("#result-alert");

const email_input = document.querySelector("#modal-input");
const email_alert = document.querySelector("#subs-alert");
let email_validate = false;

var subsModal = document.getElementById("subs-modal");
var subsXBtn = document.getElementById("close-subs");
var subsCloseBtn = document.getElementById("cancel-subs");

var emailRegex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

let selectedId = null;
let subsBtns = document.getElementsByName("subs-button");

for (let i = 0; i < subsBtns.length; i++) {
  subsBtns[i].onclick = function () {
    subsModal.style.display = "flex";
    selectedId = subsBtns[i].id;
  };
}

// close modal
subsXBtn.onclick = function () {
  subsModal.style.display = "none";
  selectedId = null;
};
subsCloseBtn.onclick = function () {
  subsModal.style.display = "none";
  selectedId = null;
};
window.onclick = function (event) {
  if (event.target == subsModal) {
    subsModal.style.display = "none";
  }
};

form &&
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    if (!selectedId) {
      email_alert.innerText = "Please select an ID.";
      email_alert.className = "alert shown-error";
      return;
    }

    const email_value = email_input.value.trim();

    if (!email_value) {
      email_alert.innerText = "Email cannot be empty.";
      email_alert.className = "alert shown-error";
      email_validate = false;
    } else if (!email_value.match(emailRegex)) {
      email_alert.innerText = "Invalid email.";
      email_alert.className = "alert shown-error";
      email_validate = false;
    } else {
      email_alert.innerText = "";
      email_alert.className = "alert hidden";
      email_validate = true;
    }

    if (!email_validate) {
      res.className = "alert hidden";
      res.innerText = "";
      return;
    }

    const xhr = new XMLHttpRequest();

    const data = new FormData();
    data.append("email", email_value);
    data.append("creator_id", selectedId);

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

    xhr.open("POST", `/public/creator/subscribe/`, true);
    xhr.send(data);
  });
