const diffFilters = document.querySelectorAll("#searchfilter .badge.diffCard");
const tagFilters = document.querySelectorAll("#searchfilter .badge.tagCard");


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

        fetchRecipe();
    })
}) 