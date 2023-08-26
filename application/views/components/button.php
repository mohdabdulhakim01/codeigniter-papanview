<?php
function index($prop){
    echo '<a href="'.$prop->href.'"
    class="btn '.$prop->class.' btn-xs" title="'.$prop->title.'"><span class="fas '.$prop->icon.'"></span></a>';
}

?>