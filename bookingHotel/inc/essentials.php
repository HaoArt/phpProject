<?php
function alertMess($type, $mess)
{
    $bs_class = ($type == 'success') ? 'bg-success text-white' : 'bg-warning text-dark';

    echo '
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        <div class="toast align-items-center ' . $bs_class . ' border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>' . htmlspecialchars($mess) . '</strong>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    ';
}
