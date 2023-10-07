<?php
function addToPlaylistModals($playlist)
{
  ?>
  <div id="add-modal" class="modal">
    <!-- Modal content -->
    <div class="add-modal-content">
      <div class="banner">
        <div>
          <p id="close-add" class="close">&times;</p>
        </div>
        <header>Add to Playlist</header>
      </div>
      <form id="modal-form">
        <label for="modal_select">
          Select a Playlist
        </label>
        <select id="modal-select" name="modal-select">
          <option value="">--Choose a Playlist--</option>
          <?php foreach ($playlist as $pl): ?>
            <option value="<?= $pl->playlist_id ?>"><?= $pl->title ?></option>
          <?php endforeach; ?>
        </select>
        <p id="playlist-alert" class="alert hidden"></p>

        <div class="button-div">
          <button id="cancel-add" type="button" class="button cancel">Cancel</button>
          <input type="submit" class="button add" value="Add Recipe to Playlist">
        </div>
      </form>

      <p id="result-alert" class="alert hidden">Recipe successfully added!</p>
      </div>
    </div>
  </div>
  <?php
}
?>
