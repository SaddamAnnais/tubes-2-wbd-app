const bScroller = document.querySelector("#backscroller");
const nScroller = document.querySelector("#nextscroller");

const movePage = (page) => {
  const urlParams = new URLSearchParams(window.location.search);
  let newPage = 1;
  if (urlParams.has("page")) {
    newPage = Number(urlParams.get("page"));  
  }
  newPage += page;
  urlParams.set("page", newPage);
  window.location.search = urlParams;
};

bScroller.addEventListener("click", (e) => movePage(-1));
nScroller.addEventListener("click", (e) => movePage(1));

const paginationItem = document.querySelector("#pagination");
const paginationInfo = document.querySelector("#pagination-info")