<?php
function deleteModals()
{
  ?>
  <div id="delete-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-text-header">Warning</p>
        <p id="close-delete" class="close"><i class="fa fa-close fa-lg"></i></p>
      </div>

      <div>
        <p class="text">Are you sure you want to delete this recipe? This action can't be undone.</p>
        <div class="button-modal-div">
          <input id="cancel-delete" type="button" class="modal-button white" value="Cancel">
          <div class="divider"></div>
          <input id="delete-btn" type="button" class="modal-button red" value="Delete">
        </div>
        <p id="delete-result-alert" class="alert hidden"></p>
      </div>
    </div>
  </div>
  <?php
}
?>
