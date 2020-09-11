<?php

class Proclamation extends Model{

    function GetBlog () {
    	$Query = 'SELECT * FROM `Proclamations`
        ORDER BY `Submit` DESC;';
        
	    return $this->DoSelect($Query);
    }

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Proclamations`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
                CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Proclamation/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
                Id
                ,`Submit`
                ,`Title`
                FROM `Proclamations`';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Proclamations`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}
