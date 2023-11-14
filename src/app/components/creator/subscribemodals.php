<?php
function subscribeModals()
{
  ?>
  <div id="subs-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-text-header">Subscribe Creator</p>
        <p id="close-subs" class="close"><i class="fa fa-close fa-lg"></i></p>
      </div>

      <div>
        <form id="modal-form">
          <label for="modal-select">
            Your email to be notified
          </label>
          <input id="modal-input" type="text" name="modal-input" placeholder="Insert your email...">
          <p id="subs-alert" class="alert hidden"></p>

          <div class="mini-hdivider"></div>
          <div class="button-modal-div">
            <button id="cancel-subs" type="button" class="modal-button white">Cancel</button>
            <div class="divider"></div>
            <input type="submit" class="modal-button green" value="Subscribe">
          </div>
        </form>

        <p id="result-alert" class="alert hidden">Subscription request sent</p>
      </div>
    </div>
  </div>
  <?php
}
?>
