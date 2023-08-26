<div class="modal fade" id="smart-box" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg rounded" role="document" id="smart-box-extra-class">
        <div class="modal-content rounded bg-transparent">
            <div class="modal-header bg-dark rounded">
                <div class="d-flex justify-content-between w-100 ">
                <h5 class="modal-title text-white d-flex align-items-center h5" id="smart-box-modal-title">Modal title</h5>
               <a href="#" onclick="$('#smart-box').modal('hide');"><span class="fas fa-times text-white"></span></a>
                </div>
               
            </div>
            <div class="modal-body bg-white" id="smart-box-modal-body">

            </div>
           
        </div>
    </div>
</div>
<script>
 let oldSize = 'lg';
 let oldPosition = 'centered';
    function smartBox(url, title,size,position) {
        fetch(url).then(res => res.text()).then((res) => {
            $("#smart-box-modal-body").html(res);
            $("#smart-box-modal-title").html(title);
            $("#smart-box-extra-class").removeClass('modal-'+oldSize);
            $("#smart-box-extra-class").addClass('modal-'+size);

            $("#smart-box-extra-class").removeClass('modal-dialog-'+oldPosition);
            $("#smart-box-extra-class").addClass('modal-dialog-'+position);

            $("#smart-box").modal("show");
            oldSize = size;
            oldPosition = position;
        });

    }
</script>