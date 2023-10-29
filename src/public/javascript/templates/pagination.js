const bScroller = document.querySelector("#backscroller");
const nScroller = document.querySelector("#nextscroller");


const movePage = (change) => {
    console.log(searchFilters.page)
    console.log(Number(searchFilters.page ?? 1))
    searchFilters.page = (Number(searchFilters.page ?? 1)) + Number(change);
    console.log(searchFilters.page)

    fetchRecipe();
}


bScroller.addEventListener("click", (e) => movePage(-1))
nScroller.addEventListener("click", (e) => movePage(1))
