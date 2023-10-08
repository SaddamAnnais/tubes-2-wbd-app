<?php
function editModals()
{
  ?>
  <div id="edit-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-text-header">Warning</p>
        <p id="close-edit" class="close"><i class="fa fa-close fa-lg"></i></p>
      </div>

      <div>
        <p class="text">Are you sure you want to edit this recipe?</p>
        <div class="button-div">
          <input id="cancel-edit" type="button" class="button white" value="Cancel">
          <div class="divider"></div>
          <input id="edit-btn" type="submit" class="button red" value="Edit" form="form">
        </div>

        <p id="edit-result-alert" class="alert hidden"></p>
      </div>

    </div>
  </div>
  <?php
}
?>
