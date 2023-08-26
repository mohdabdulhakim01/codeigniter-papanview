<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModal" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="alert-modal-title">Modal title</h5>
                <a href="#">
                    
                    <span class="fas fa-multiply text-dark"  onclick="$('#alertModal').modal('hide');"></span>
                </a>
        </div>
            <div class="modal-body" id="alert-modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" onclick="$('#alertModal').modal('hide');">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
  
    function alertBox(title,text) {
        $("#alert-modal-body").html(text);
        $("#alert-modal-title").html(title);
        $("#alertModal").modal("show");

    }
</script>