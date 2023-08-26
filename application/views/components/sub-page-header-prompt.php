<?php 
function index($prop){
   echo ' <div class="d-flex align-items-center justify-content-between">
   <h4 class="page-header">'.$prop.'</h4>
   <a href="#"  onclick="history.back()" class="p-2"><span class="fa fa-times text-white"></span></a>

</div>';
}
