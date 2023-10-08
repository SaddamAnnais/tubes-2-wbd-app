<?php
function deleteModals()
{
  ?>
  <div id="delete-modal" class="modal">
    <!-- Modal content -->
    <div class="delete-modal-content">
      <div class="banner">
        <div>
          <p id="close-delete" class="close">&times;</p>
        </div>
        <header>Warning</header>
      </div>
      <div class="modals-body">
        <p class="text">Are you sure you want to delete this recipe? This action can't be undone.</p>
        <div class="group-button">
          <input type="button" class="btn delete" value="Delete" id="delete-btn">
          <input id="cancel-delete" type="button" class="btn save cancel" value="Cancel">
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
