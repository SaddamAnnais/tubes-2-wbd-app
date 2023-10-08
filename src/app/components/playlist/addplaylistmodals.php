<?php
function addPlaylistModals()
{
  ?>
  <div id="add-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-text-header">Add New Playlist</p>
        <p id="close-add" class="close"><i class="fa fa-close fa-lg"></i></p>
      </div>

      <div>
        <form id="modal-form">
          <label for="modal-select">
            Title
          </label>
          <input id="modal-input" type="text" name="modal-input">
          <p id="playlist-alert" class="alert hidden"></p>

          <div class="button-div">
            <button id="cancel-add" type="button" class="button white">Cancel</button>
            <div class="divider"></div>
            <input type="submit" class="button green" value="Create Playlist">
          </div>
        </form>

        <p id="result-alert" class="alert hidden">Playlist successfully created!</p>
      </div>
    </div>
  </div>
  <?php
}
?>
