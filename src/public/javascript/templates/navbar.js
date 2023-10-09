// SELECTOR
const profilebar = document.querySelector("#profilebar");
const profilemodals = document.querySelector("#profileModals");
const logout = document.querySelector("#profileModals #logout");
const searchtext = document.querySelector("#searchtext");

const cardContainer = document.querySelector("#card-container");
const paginationWrapper = document.querySelector("#pagination-wrapper");

// INIT
profilebar.classList.add("inactive");

let preventDebouncedSearch = true;

!preventDebouncedSearch &&
searchtext &&
searchtext.addEventListener("keyup", 
    debounce(() => {
        xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/recipe/search?search=${searchtext.value}`
        );

        xhr.send();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    console.log(this.responseText)
                    const data = JSON.parse(this.responseText);
                    
                    updateCardContainer(data)
                } else {
                    console.log("error!")
                }
            }
        };
    }, 300)
)

const updateCardContainer = (data) => {
    const recipes = data["recipes"]
    const curPages = data["curPages"]
    const totPages = data["pages"] ?? 0

    let newInnerHTML = ``

    if(recipes.length > 0) {
        recipes.map((item) => {
            newInnerHTML += 
            `
            <a href="/recipe/watch/${item.recipe_id}">
                <div class="card-item">
                    <div id="duration" >
                        ${item.duration}
                    </div>
                    <img id="thumb" src="/storage/images/${item.image_path}" alt="recipe-${item.recipe_id}" />
                    
                    <div id="title">${item.title}</div>
                    <div id="created">
                        ${item.created_at}
                    </div>
                </div>
            </a> 
    
            `
        })
    } else {
        newInnerHTML = "resep kosong"
    }
    
                
    cardContainer.innerHTML = newInnerHTML



    let newPaginationInnerHTML = 
    `
    <div id="pagination-wrapper">
            <div id="pagination" style="grid-template-columns: 
                        ${curPages-1}fr
                        1fr
                        ${totPages - curPages}fr
                    ;">
                <div id="backscroller" class="bgscroller"></div>
                <div class="scroller"></div>
                <div id="nextscroller" class="bgscroller" ></div>
            </div>
            <div id="pagination-info">
                page ${curPages} of ${totPages}
            </div>
    </div> 
  `

  paginationWrapper.innerHTML = newPaginationInnerHTML

    // const bScroller = document.querySelector("#backscroller");
    // const nScroller = document.querySelector("#nextscroller");

    // bScroller.addEventListener("click", (e) => movePage(-1))
    // nScroller.addEventListener("click", (e) => movePage(1))

}

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