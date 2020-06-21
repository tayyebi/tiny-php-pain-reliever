<?php

class Support extends Model {
    function GetAll() {
        $Query = "SELECT * FROM Supports";
        return $this->DoSelect($Query);
    }
}

?>