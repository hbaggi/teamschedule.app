<?php
  if(isset($_SESSION['success_message']))
  {
    echo '<div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">';
    echo '<strong></strong>'.$_SESSION['success_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['success_message']);
  }

  if(isset($_SESSION['error_message']))
  {
    echo '<div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">';
    echo '<strong></strong>'.$_SESSION['error_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['error_message']);
  }
?>