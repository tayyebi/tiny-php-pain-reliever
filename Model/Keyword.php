<?php

class Keyword extends Model{

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Keywords`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
            CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Keyword/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
            Id
            ,`Title`
            FROM `Keywords`';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Keyword`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}