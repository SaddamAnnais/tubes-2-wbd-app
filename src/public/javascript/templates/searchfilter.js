const diffFilters = document.querySelectorAll("#searchfilter .badge.diffCard");
const tagFilters = document.querySelectorAll("#searchfilter .badge.tagCard");

diffFilters.forEach((e) => {
    e.addEventListener("click", (item) => {
        if (item.target.classList.contains("active")) {
            item.target.classList.remove("active");

            return;
        } 

        diffFilters.forEach((i) => {
            i.classList.remove("active");
        })

        item.target.classList.add("active");
    })
})

tagFilters.forEach((e) => {
    e.addEventListener("click", (item) => {
        if (item.target.classList.contains("active")) {
            item.target.classList.remove("active");

            return;
        } 

        tagFilters.forEach((i) => {
            i.classList.remove("active");
        })

        item.target.classList.add("active");
    })
})