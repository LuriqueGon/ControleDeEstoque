<script>
    function delToast() {
        setTimeout(() => {
            apagarToast()
        }, 3500);
    }

    function apagarToast() {
        $('#toast').remove()
    }
</script>

<div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true" style=" position: absolute; top: 5rem; right: 8rem; opacity: 1;">
    <div class="toast-header">
        <strong class="mr-auto text-<?php echo $this->view->type ?>"><?php echo $this->view->type ?></strong>
        <small class="text-muted"><?php echo $this->view->time ?></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true" onclick="apagarToast()">×</span>
        </button>
    </div>
    <div class="toast-body">
        <?php echo $this->view->msg?>
    </div>
</div>



