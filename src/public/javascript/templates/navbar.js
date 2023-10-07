// SELECTOR
const profilebar = document.querySelector("#profilebar");






// INIT
profilebar.classList.add("inactive");














profilebar.addEventListener("click", (e) => {
    console.log(profilebar.id)
    if (profilebar.classList.contains("inactive")) {
        profilebar.classList.add("active");
        profilebar.classList.remove("inactive");
        
    } else {
        profilebar.classList.add("inactive");
        profilebar.classList.remove("active");  
    }
})