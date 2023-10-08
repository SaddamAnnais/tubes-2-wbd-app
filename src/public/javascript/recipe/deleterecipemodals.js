var deleteModal = document.getElementById("delete-modal");
var deleteOpenBtn = document.getElementById("delete-button");
var deleteXBtn = document.getElementById("close-delete");
var deleteCloseBtn = document.getElementById("cancel-delete");
var deleteDelBtn = document.getElementById("delete-btn");

// open modal
deleteOpenBtn.onclick = function () {
  deleteModal.style.display = "flex";
};
// close modal
deleteXBtn.onclick = function () {
  deleteModal.style.display = "none";
};
deleteCloseBtn.onclick = function () {
  deleteModal.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == deleteModal) {
    deleteModal.style.display = "none";
  }
};

deleteDelBtn.onclick = function () {
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
