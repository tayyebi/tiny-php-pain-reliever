<?php
class Position extends Model {
    function GetActive(){
        $Query = "SELECT *
        FROM `Positions`
        WHERE `IsActive` = 1";
        return $this->DoSelect($Query);
    }
}