const form = document.querySelector("#form");
const res = document.querySelector("#result-alert");

const uname_input = document.querySelector("#username");
const pass_input = document.querySelector("#password");

const uname_alert = document.querySelector("#username-alert");
const pass_alert = document.querySelector("#password-alert");

let uname_validate = false;
let pass_validate = false;

const regex = /^[\w]+$/;

form &&
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const username_value = uname_input.value.trim();
    const password_value = pass_input.value;

    if (!username_value) {
      uname_alert.innerText = "Username cannot be empty!";
      uname_alert.className = "alert shown";
      uname_validate = false;
    } else if (!regex.test(username_value)) {
      uname_alert.innerText = "Username can only consist of a-Z, 0-9 or _";
      uname_alert.className = "alert shown";
      uname_validate = false;
    } else {
      uname_alert.innerText = "";
      uname_alert.className = "alert hidden";
      uname_validate = true;
    }

    if (!password_value) {
      pass_alert.innerText = "Password cannot be empty!";
      pass_alert.className = "alert shown";
      pass_validate = false;
    } else {
      pass_alert.innerText = "";
      pass_alert.className = "alert hidden";
      pass_validate = true;
    }
    if (!uname_validate || !pass_validate) {
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
        } else if (this.status === 401) {
          // if password is incorrect
          res.innerText = "Wrong username or password!";
          res.className = "alert shown";
        } else if (this.status === 405) {
          // if method not allowed
          res.innerText = "Method not allowed!";
          res.className = "alert shown";
        }
      }
    };

    xhr.open("POST", "/public/user/login", true);

    const data = new FormData();
    data.append("username", username_value);
    data.append("password", password_value);

    xhr.send(data);
  });
