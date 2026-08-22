<?php

require_once __DIR__ . "/../backend/getData.php";

$currPage = 1;

if (isset($_GET['page']) && $_GET['page'] > 1)
    $currPage = $_GET['page'];

$li = "";
$number = ceil(getCount()/10);

for($i = 0; $i <= $number + 1; $i++){
    if($i == 0){
        $isDisabled = ($currPage == 1) ? 'disabled' : '';
        $previous = ($currPage == 1) ? 1 : $currPage-1;
        $li .= "<li class='page-item'><a class='page-link {$isDisabled}' onclick='changePage({$previous})'>Previous</a></li>";
    }
    else if($i == $number + 1){
        $isDisabled = ($currPage == $number) ? 'disabled' : '';
        $next = ($currPage == $number) ? $number : $currPage+1;
        $li .= "<li class='page-item'><a class='page-link {$isDisabled}' onclick='changePage({$next})'>Next</a></li>";
    }
    else{
        $isActive = ($i == $currPage) ? 'active' : '';
        $li .= "<li class='page-item'><a class='page-link {$isActive}' onclick='changePage({$i})'>{$i}</a></li>";
    }
}

echo $li;