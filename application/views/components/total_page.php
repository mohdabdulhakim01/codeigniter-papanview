<?php
function index($prop)
{
    // ["page_total"=>$total]
    $total_pg = $prop / 10;
    $is_more_pg =  (strpos($total_pg, '.') !== false);

    $page_total = ($is_more_pg) ? round($total_pg + 1) : $total_pg;
    $current_page = currentPage(current_url(), 10);
    echo 'Muka Surat ' . $current_page . ' / ' . $page_total;
}
