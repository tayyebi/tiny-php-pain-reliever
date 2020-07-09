<?php

class Road extends Model{
    function GetHome() {
        $Query = 'SELECT *
        FROM `Roads` Order By `Priority` ASC';

        return $this->DoSelect($Query);
    }

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Roads`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
            CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Road/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
            Id
            ,`Title`, Priority
            FROM `Roads`
            ORDER BY `Priority` DESC';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Roads`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}