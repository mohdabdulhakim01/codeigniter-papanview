<?php 
function index($prop){
   echo ' 
   <title>'.$prop.'</title>
   <div class="shadow rounded bg-dark text-white p-2">
   <div class="d-flex align-items-center justify-content-between">
   <h5 class="page-header">'.$prop.'</h5>
   <button href="#"  onclick="history.back()" class="btn btn-danger btn-sm text-white">Back</button>
   </div>

</div>';
}
