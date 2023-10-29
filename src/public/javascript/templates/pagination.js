const bScroller = document.querySelector("#backscroller");
const nScroller = document.querySelector("#nextscroller");


const movePage = (change) => {
    searchFilters.page = (Number(searchFilters.page ?? 1)) + Number(change);

    fetchRecipe();
}


bScroller.addEventListener("click", (e) => movePage(-1))
nScroller.addEventListener("click", (e) => movePage(1))
