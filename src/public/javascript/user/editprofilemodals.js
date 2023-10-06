var modal = document.getElementById("myModal");
var openBtn = document.getElementById("modals-button");
var span = document.getElementsByClassName("close")[0];
var closeBtn = document.getElementsByClassName("cancel")[0];
var delBtn = document.getElementById("delete-account-btn");

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


console.log(delBtn)
// delete account
delBtn.onclick = function () {
  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      console.log(this.status);
      if (this.status === 201) {
        const payload = JSON.parse(this.responseText);
        location.replace(payload.url);
      }
    }
  };

  xhr.open("POST", "/public/user", true);
  const data = new FormData();

  data.append("type", "delete");
  xhr.send(data);
};
