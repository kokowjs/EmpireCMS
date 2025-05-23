<?php
function _PAGEFT($num, $perpage, $mpurl){
    global $page, $firstcount, $pagenav;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $perpage = intval($perpage);
    if($page<1) $page=1;
    $pages = ceil($num/$perpage);
    if($page>$pages) $page=$pages;
    $offset = ($page-1)*$perpage;
    $firstcount = $offset;
    $pagenav = '';
    if($num>$perpage) {
        $mpurl .= strpos($mpurl,'?')!==false ? '&amp;' : '?';
        $pagenav = '第 <select onchange="window.location=\''.$mpurl.'page=\'+this.value">';
        for($i=1;$i<=$pages;$i++) {
            if($i==$page) {
                $pagenav .= '<option value="'.$i.'" selected>'.$i.'</option>';
            } else {
                $pagenav .= '<option value="'.$i.'">'.$i.'</option>';
            }
        }
        $pagenav .= '</select> 页，共 '.$pages.' 页';
    }
}
?>