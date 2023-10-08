const form = document.querySelector("#form");
const res = document.querySelector("#result-alert");

const title_input = document.querySelector("#title");
const desc_input = document.querySelector("#desc");
const tag_input = document.querySelector("#tag");
const difficulty_input = document.querySelector("#difficulty");
const video_input = document.querySelector("#video");
const image_input = document.querySelector("#image");

const title_alert = document.querySelector("#title-alert");
const desc_alert = document.querySelector("#desc-alert");
const tag_alert = document.querySelector("#tag-alert");
const difficulty_alert = document.querySelector("#difficulty-alert");

let title_validate = false;
let desc_validate = false;
let tag_validate = false;
let difficulty_validate = false;

var editModal = document.getElementById("edit-modal");
var editOpenBtn = document.getElementById("edit-button");
var editXBtn = document.getElementById("close-edit");
var editCloseBtn = document.getElementById("cancel-edit");
var editEditBtn = document.getElementById("edit-btn");


// close modal
editXBtn.onclick = function () {
  editModal.style.display = "none";
};
editCloseBtn.onclick = function () {
  editModal.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == editModal) {
    editModal.style.display = "none";
  }
};

editOpenBtn.onclick = function (e) {
  e.preventDefault();
  const title_value = title_input.value.trim();
  const desc_value = desc_input.value.trim();
  const tag_value = tag_input.value.trim();
  const difficulty_value = difficulty_input.value.trim();

  if (!title_value) {
    title_alert.innerText = "Title cannot be empty!";
    title_alert.className = "alert shown-error";
    title_validate = false;
  } else {
    title_alert.innerText = "";
    title_alert.className = "alert hidden";
    title_validate = true;
  }

  if (!desc_value) {
    desc_alert.innerText = "Description cannot be empty!";
    desc_alert.className = "alert shown-error";
    desc_validate = false;
  } else {
    desc_alert.innerText = "";
    desc_alert.className = "alert hidden";
    desc_validate = true;
  }

  if (!tag_value) {
    tag_alert.innerText = "Tag cannot be empty!";
    tag_alert.className = "alert shown-error";
    tag_validate = false;
  } else {
    tag_alert.innerText = "";
    tag_alert.className = "alert hidden";
    tag_validate = true;
  }

  if (!difficulty_value) {
    difficulty_alert.innerText = "Difficulty cannot be empty!";
    difficulty_alert.className = "alert shown-error";
    difficulty_validate = false;
  } else {
    difficulty_alert.innerText = "";
    difficulty_alert.className = "alert hidden";
    difficulty_validate = true;
  }

  if (
    !title_validate ||
    !desc_validate ||
    !tag_validate ||
    !difficulty_validate
  ) {
    res.className = "alert hidden";
    res.innerText = "";
    return;
  }

  editModal.style.display = "flex";
};

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const title_value = title_input.value.trim();
  const desc_value = desc_input.value.trim();
  const tag_value = tag_input.value.trim();
  const difficulty_value = difficulty_input.value.trim();
  const video_value = video_input.files[0];
  const image_value = image_input.files[0];

  const url = (window.location.href).split("/");
  const recipe_id = url[6];
  const xhr = new XMLHttpRequest();

  const data = new FormData();
  data.append("title", title_value);
  data.append("desc", desc_value);
  data.append("tag", tag_value);
  data.append("difficulty", difficulty_value)
  data.append("video", video_value);
  data.append("image", image_value);

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
        console.log(this.status);
        if (this.status === 201) {
          const payload = JSON.parse(this.responseText);
          location.replace(payload.url);
        }
      }
  };

  xhr.open("POST", `/public/recipe/edit/${recipe_id}`, true);
  xhr.send(data);
})
