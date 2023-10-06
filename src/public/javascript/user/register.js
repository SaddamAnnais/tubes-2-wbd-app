const form = document.querySelector("#form");
const res = document.querySelector("#result-alert");

const uname_input = document.querySelector("#username");
const name_input = document.querySelector("#name");
const pass_input = document.querySelector("#password");
const retype_input = document.querySelector("#retype-password");

const uname_alert = document.querySelector("#username-alert");
const name_alert = document.querySelector("#name-alert");
const pass_alert = document.querySelector("#password-alert");
const retype_alert = document.querySelector("#retype-alert");

let uname_validate = false;
let name_validate = false;
let pass_validate = false;
let retype_validate = false;

const regex = /^[\w]+$/;

form &&
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const username_value = uname_input.value.trim();
    const name_value = name_input.value.trim();
    const password_value = pass_input.value;
    const retype_value = retype_input.value;

    if (!username_value) {
      uname_alert.innerText = "Username cannot be empty!";
      uname_alert.className = "alert shown";
      uname_validate = false;
    } else if (!regex.test(username_value)) {
      uname_alert.innerText = "Username can only consist of a-z, 0-9 or _";
      uname_alert.className = "alert shown";
      uname_validate = false;
    } else if (username_value.length < 5) {
      uname_alert.innerText = "Username must be at least 5 characters!";
      uname_alert.className = "alert shown";
      uname_validate = false;
    } else {
      uname_alert.innerText = "";
      uname_alert.className = "alert hidden";
      uname_validate = true;
    }

    if (!name_value) {
      name_alert.innerText = "Name cannot be empty!";
      name_alert.className = "alert shown";
      name_validate = false;
    } else if (!regex.test(name_value)) {
      name_alert.innerText = "Name can only consist of a-z, 0-9 or _";
      name_alert.className = "alert shown";
      name_validate = false;
    } else if (name_value.length < 5) {
      name_alert.innerText = "Name must be at least 5 characters!";
      name_alert.className = "alert shown";
      name_validate = false;
    } else {
      name_alert.innerText = "";
      name_alert.className = "alert hidden";
      name_validate = true;
    }

    if (!password_value) {
      pass_alert.innerText = "Password cannot be empty!";
      pass_alert.className = "alert shown";
      pass_validate = false;
    } else if (password_value.length < 6) {
      pass_alert.innerText = "Password must be at least 6 characters!";
      pass_alert.className = "alert shown";
      pass_validate = false;
    } else {
      pass_alert.innerText = "";
      pass_alert.className = "alert hidden";
      pass_validate = true;
    }

    if (!retype_value) {
      retype_alert.innerText = "Retype password cannot be empty!";
      retype_alert.className = "alert shown";
      retype_validate = false;
    } else if (password_value !== retype_value) {
      retype_alert.innerText = "Retype password did not match!";
      retype_alert.className = "alert shown";
      retype_validate = false;
    } else {
      retype_alert.innerText = "";
      retype_alert.className = "alert hidden";
      retype_validate = true;
    }

    if (
      !uname_validate ||
      !name_validate ||
      !pass_validate ||
      !retype_validate
    ) {
      res.className = "alert hidden";
      res.innerText = "";
      return;
    }

    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (this.readyState !== XMLHttpRequest.DONE) {
        // remove the result statement when sending
        res.className = "alert hidden";
        res.innerText = "";
      } else {
        if (this.status === 201) {
          // if password is correct
          res.className = "alert hidden";
          res.innerText = "";
          const payload = JSON.parse(this.responseText);
          location.replace(payload.url);
        } else if (this.status === 500) {
          // if password is incorrect
          res.innerText = "Username is taken!";
          res.className = "alert shown";
        } else if (this.status === 405) {
          // if method not allowed
          res.innerText = "Method not allowed!";
          res.className = "alert shown";
        }
      }
    };

    xhr.open("POST", "/public/user/register", true);

    const data = new FormData();
    data.append("username", username_value);
    data.append("name", name_value);
    data.append("password", password_value);

    xhr.send(data);
  });
