<?php
function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>
    window.location.href='index.php'
    </script>";
    }
    session_regenerate_id(true);
}
function redirect($url)
{
    echo "<script>
    window.location.href='$url'
    </script>";
}

function alertMess($type, $mess)
{
    $bs_class = ($type == 'success') ? ' alert-success' : ' alert-warning';
    echo '<div class="alert ' . $bs_class . ' alert-dismissible fade show alert-custom" role="alert">
  <strong>' . $mess . '</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
