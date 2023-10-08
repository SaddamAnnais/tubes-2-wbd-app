<?php
function addToPlaylistModals($playlist)
{
  ?>
  <div id="add-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-text-header">Add to Playlist</p>
        <p id="close-add" class="close"><i class="fa fa-close fa-lg"></i></p>
      </div>

      <div>
        <form id="modal-form">
          <label for="modal-select">
            Select a Playlist
          </label>
          <select id="modal-select" name="modal-select">
            <option value="">--Choose a Playlist--</option>
            <?php foreach ($playlist as $pl): ?>
              <option value="<?= $pl->playlist_id ?>"><?= $pl->title ?></option>
            <?php endforeach; ?>
          </select>
          <p id="playlist-alert" class="alert hidden"></p>

          <div class="button-modal-div">
            <button id="cancel-add" type="button" class="modal-button white">Cancel</button>
            <div class="divider"></div>
            <input type="submit" class="modal-button green" value="Add to Playlist">
          </div>
        </form>

        <p id="add-result-alert" class="alert hidden">Recipe successfully added!</p>
      </div>
    </div>
  </div>
  <?php
}
?>
