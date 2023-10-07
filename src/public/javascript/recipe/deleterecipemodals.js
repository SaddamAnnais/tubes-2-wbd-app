var modal = document.getElementById("delete-modal");
var openBtn = document.getElementById("delete-button");
var span = document.getElementById("close-delete");
var closeBtn = document.getElementById("cancel-delete");
var delBtn = document.getElementById("delete-btn");

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

delBtn.onclick = function () {
  const url = (window.location.href).split("/");
  const recipe_id = url[6];
  console.log("woi");

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

  xhr.open("POST", `/public/recipe/delete/${recipe_id}`, true);
  xhr.send();
};
