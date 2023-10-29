// SELECTOR
const profilebar = document.querySelector("#profilebar");
const profilemodals = document.querySelector("#profileModals");
const logout = document.querySelector("#profileModals #logout");
const searchtext = document.querySelector("#searchtext");

const cardContainer = document.querySelector("#card-container");
// const paginationWrapper = document.querySelector("#pagination-wrapper");

// INIT
var searchFilters = {
    title     : "",
    tag       : "",
    diff      : "",
    page      : "",
    totalPage : ""
}

profilebar.classList.add("inactive");

searchtext &&
searchtext.addEventListener("keyup", 
    function() {
        searchFilters.title = searchtext.value;
        fetchRecipe();
    }
)

// uses of "var" is a bad practice
var fetchRecipe = 
    debounce(() => {
        xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            `/recipe/search?` + 
                (searchFilters.title && `search=${searchFilters.title}`) + 
                (searchFilters.tag && `&filter_by_tag=${searchFilters.tag}`) +
                (searchFilters.diff && `&filter_by_diff=${searchFilters.diff}`) +
                (searchFilters.page && `&page=${searchFilters.page}`)
        );

        console.log(`/recipe/search?` + 
        (searchFilters.title && `search=${searchFilters.title}`) + 
        (searchFilters.tag && `&filter_by_tag=${searchFilters.tag}`) +
        (searchFilters.diff && `&filter_by_diff=${searchFilters.diff}`) +
        (searchFilters.page && `&page=${searchFilters.page}`))

        xhr.send();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    console.log(this.responseText)
                    const data = JSON.parse(this.responseText);

                    // update page values
                    searchFilters.page = data["curPages"]
                    searchFilters.totalPage = data["pages"]
                    
                    updateCardContainer(data)
                } else {
                    console.log("error!")
                }
            }
        };
    }, 300)

const updateCardContainer = (data) => {
    // bind recipes
    const recipes = data["recipes"]

    let curPages = searchFilters.page;
    let totPages = searchFilters.totalPage;

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
        // change this appropriate
        newInnerHTML = "resep kosong"
    }
    
                
    cardContainer.innerHTML = newInnerHTML



//     let newPaginationInnerHTML = 
//     `
//     <div id="pagination-wrapper">
//             <div id="pagination" style="grid-template-columns: 
//                 ${(curPages > 1) ? 1 : 0}fr
//                 1fr
//                 ${(totPages > curPages) ? 1 : 0}fr
//             ;">
//                 <div id="backscroller" class="bgscroller"></div>
//                 <div class="scroller"></div>
//                 <div id="nextscroller" class="bgscroller" ></div>
//             </div>
//             <div id="pagination-info">
//                 page ${curPages} of ${totPages}
//             </div>
//     </div> 
//   `

//   paginationWrapper.innerHTML = newPaginationInnerHTML

    const paginationItem = document.querySelector("#pagination");
    const paginationInfo = document.querySelector("#pagination-info")

    paginationItem.setAttribute("style", `grid-template-columns: 
                    ${(curPages > 1) ? 1 : 0}fr
                    1fr
                    ${(totPages > curPages) ? 1 : 0}fr
                ;`)

    paginationInfo.innerHTML = `page ${curPages} of ${totPages}`
    

        // TODO: later make this have a singular init point

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