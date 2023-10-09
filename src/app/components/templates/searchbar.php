<?php
    function searchbar() {

?>
        <div id="searchbar">
            <form id="searchform" action="/home" method="get">
                <input type="text" id="searchtext" placeholder="Cari resep ..." spellcheck="false" name="search" />
                <button type="submit" id="searchsubmit"> 
                    <img id="searchsubmit_icon" src="<?php echo BASE_URL ?>/static/icon/search.svg" alt="search"/>
                </button>
                <input type="hidden" id="filter_by_tag" name="filter_by_tag"  />
                <input type="hidden" id="filter_by_diff" name="filter_by_diff"  />
            </form>
        </div>
<?php
    }
?>