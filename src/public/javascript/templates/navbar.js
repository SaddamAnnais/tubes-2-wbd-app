// SELECTOR
const profilebar = document.querySelector("#profilebar");
const profilemodals = document.querySelector("#profileModals");
const logout = document.querySelector("#profileModals #logout");


// INIT
profilebar.classList.add("inactive");


// EVENT LOGIC
const toggleProfile = (isActive) => {
        profilebar.classList.add(isActive ? "active" : "inactive");
        profilebar.classList.remove(isActive ? "inactive" : "active");

        profilemodals.classList.add(isActive ? "active" : "inactive");
        profilemodals.classList.remove(isActive ? "inactive" : "active");
}
profilebar.addEventListener("click", (e) => {
    if (profilebar.classList.contains("inactive")) {
        toggleProfile(true);
    } else {
        toggleProfile(false);
    }
})

document.addEventListener("click", (e) => {
    if(!profilemodals.contains(e.target) && !profilebar.contains(e.target)) {
        toggleProfile(false);
    }
})

logout &&
logout.addEventListener("click", () => {
    // console.log("logout clicked");
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
          location.replace('/home');
        } 
      };

    xhr.open("POST", "/user/logout", true);
    xhr.send();
  });