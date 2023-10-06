<?php
function modals()
{
  ?>
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="banner">
        <div>
          <p class="close">&times;</p>
        </div>
        <header>Warning</header>
      </div>
      <div class="modals-body">
        <p class="text">Are you sure you want to delete your account? You can't retrieve your account after deleting it.</p>
        <div class="group-button">
          <input type="button" class="btn delete" value="Delete" id="delete-account-btn">
          <input type="button" class="btn save cancel" value="Cancel">
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>