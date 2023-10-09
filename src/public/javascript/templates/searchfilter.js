const diffFilters = document.querySelectorAll("#searchfilter .badge.diffCard");
const tagFilters = document.querySelectorAll("#searchfilter .badge.tagCard");

const diffInput = document.querySelector("#filter_by_diff");
const tagInput = document.querySelector("#filter_by_tag");

diffFilters.forEach((e) => {
    e.addEventListener("click", (item) => {
        let wasActive = item.target.classList.contains("active");

        diffInput.value = null;
        diffFilters.forEach((i) => {
            i.classList.remove("active");
        })

        if(!wasActive) {
            diffInput.value = item.target.innerText;

            item.target.classList.add("active");
        }
        
    })
})

tagFilters.forEach((e) => {
    e.addEventListener("click", (item) => {
        let wasActive = item.target.classList.contains("active")

        tagInput.value = null;
        tagFilters.forEach((i) => {
            i.classList.remove("active");
        })

        if(!wasActive) {
            tagInput.value = item.target.innerText;

            item.target.classList.add("active");           
        }
    })
}) 