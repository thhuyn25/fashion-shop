<?php
function formatPrice($price) {
    return number_format($price) . ' VNĐ';
}

function getCurrentDate() {
    return date('Y-m-d H:i:s');
}
?>