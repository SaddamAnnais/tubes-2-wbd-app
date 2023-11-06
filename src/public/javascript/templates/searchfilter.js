// selectors
const diffFilters = document.querySelectorAll("#searchfilter .badge.diffCard");
const tagFilters = document.querySelectorAll("#searchfilter .badge.tagCard");

const searchtext = document.querySelector("#searchtext");

const cardContainer = document.querySelector("#card-container");

// global filter values
var searchFilters = {
    title     : "",
    tag       : "",
    diff      : "",
    page      : "",
    totalPage : ""
}

// searchbar keyup event
searchtext &&
searchtext.addEventListener("keyup", 
    function() {
        searchFilters.title = searchtext.value;
        resetPagination();

        fetchRecipe();
    }
)

// refresh recipe search/fetch
//      use of "var" is a bad practice
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

// update card container children elements
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

    const paginationItem = document.querySelector("#pagination");
    const paginationInfo = document.querySelector("#pagination-info")

    paginationItem.setAttribute("style", `grid-template-columns: 
                    ${(curPages > 1) ? 1 : 0}fr
                    1fr
                    ${(totPages > curPages) ? 1 : 0}fr
                ;`)

    paginationInfo.innerHTML = `page <input id="pagination-select" type="text" value="${curPages}" spellcheck="false" /> of ${totPages}`

    const paginationSelect = document.querySelector("#pagination-select")

    paginationSelect.addEventListener("keyup",
        function() {
            let target = paginationSelect.value;

            target = target > 0 ? target : 1;                                               // min clamp 
            target = target < searchFilters.totalPage ? target : searchFilters.totalPage;   // max clamp

            searchFilters.page =  target;

            fetchRecipe();
        }
    )

}

// difficulty filter
diffFilters.forEach((e) => {
    e.addEventListener("click", (item) => {
        let wasActive = item.target.classList.contains("active");

        diffFilters.forEach((i) => {
            i.classList.remove("active");
        })

        if(!wasActive) {
            searchFilters.diff = item.target.innerText;

            item.target.classList.add("active");
        } else {
            searchFilters.diff = "";
        }

        resetPagination();
        fetchRecipe();
    })
})


//tag filter
tagFilters.forEach((e) => {
    e.addEventListener("click", (item) => {
        let wasActive = item.target.classList.contains("active")

        tagFilters.forEach((i) => {
            i.classList.remove("active");
        })

        if(!wasActive) {
            searchFilters.tag = item.target.innerText;

            item.target.classList.add("active");           
        } else {
            searchFilters.tag = "";
        }

        resetPagination();
        fetchRecipe();
    })
}) 

const resetPagination = () => {
    searchFilters.page = 1; // making sure the page resets to one everytime we make a new search
}

// init refresh on first page open
fetchRecipe();