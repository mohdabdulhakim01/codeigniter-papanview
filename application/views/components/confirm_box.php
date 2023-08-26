<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark  text-white">
                <h5 class="modal-title" id="modal-title">Modal title</h5>
                <a href="#">
                    <span class="fas fa-multiply text-dark"  onclick="$('#confirmModal').modal('hide');"></span>
                </a>
            </div>
            <div class="modal-body" id="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="$('#confirmModal').modal('hide');">Batal</button>
                <button type="button" class="btn" id="modal-confirm-action" ><span id="modal-action-title"></span></button>
            </div>
        </div>
    </div>
</div>
<script>
    let is_confirm = false;
    let lastBtnColor = '';
    function confirmBox(title,action,actionTitle,btnColor,text) {
        $("#modal-body").html(text);
        $("#modal-title").html(title);
        $("#modal-confirm-action").attr('onclick',action);
        $("#modal-action-title").html(actionTitle);
        $("#modal-confirm-action").removeClass(lastBtnColor);
        $("#modal-confirm-action").addClass(btnColor);
        lastBtnColor = btnColor;
        $("#confirmModal").modal("show");

    }
</script>