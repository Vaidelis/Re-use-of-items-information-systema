<?php
if(Auth::user() != null){
$count = Auth::user()->newThreadsCount();
}
else{
    $count = 0;
}
?>

@if ($count > 0)
    <span class="ml-1">({{ $count }})</span>
@endif
