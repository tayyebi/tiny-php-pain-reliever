<?php

class Support extends Model{

    function GetAll () {
    	$Query = 'SELECT * FROM `Supports`;';
	return $this->DoSelect($Query);
    }

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Supports`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
                CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Supports&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
                Id
                ,`Name`
                ,`Url`
                ,`IsAuthor`
                ,`IsFan`
                ,`IsContributer`
                ,`IsCoach`
                ,`IsDonater`
                ,`IsMedia`
                FROM `Supports`';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Supports`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}
