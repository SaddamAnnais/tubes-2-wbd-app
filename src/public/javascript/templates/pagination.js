const bScroller = document.querySelector("#backscroller");
const nScroller = document.querySelector("#nextscroller");


const movePage = (change) => {
    const params = new URLSearchParams(window.location.search);
    
    params.set("page", Number(params.get("page") ?? 1) + Number(change));

    window.location.href = window.location.href.split('?')[0] + "?" + params.toString();
}


bScroller.addEventListener("click", (e) => movePage(-1))
nScroller.addEventListener("click", (e) => movePage(1))
