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
        <div class="button-div">
          <input id="cancel-delete" type="button" class="button white" value="Cancel">
          <div class="divider"></div>
          <input id="delete-btn" type="button" class="button red" value="Delete">
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
