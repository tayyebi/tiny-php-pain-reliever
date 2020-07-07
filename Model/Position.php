<?php
class Position extends Model {
    function GetActive(){
        $Query = "SELECT *
        FROM `Positions`
        WHERE `IsActive` = 1";
        return $this->DoSelect($Query);
    }
    
    // === Based on a position ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Positions`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
        CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Positions&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
        Id
        ,`Title`
        ,`IsPaid`
        ,`Salary`
        FROM `Positions`';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Positions`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}