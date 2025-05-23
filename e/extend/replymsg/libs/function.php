<?php
function checksql($sql){
    $connDb = conn_Db();
    $stmt = $connDb->prepare($sql);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>