// SELECTOR
const profilebar = document.querySelector("#profilebar");
const profilemodals = document.querySelector("#profileModals");


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