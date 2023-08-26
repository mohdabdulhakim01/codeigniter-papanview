<div class="modal"  id="loadingBox" tabindex="-1" role="dialog" aria-labelledby="loadingBox" aria-hidden="true">
    <div class="w-100 d-flex justify-content-center align-items-center h-100">
        <div class="w-auto h-auto bg-transparent border-transparent">

            <div class="d-flex justify-content-center align-items-center ">
                <div style="font-size: 5rem;"> <span class="fas fa-circle-notch fa-spin   text-white"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function loadingBox() {

        $("#loadingBox").modal("show");

    }
</script>