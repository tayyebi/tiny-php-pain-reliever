<?php

class Post extends Model{
    function GetHome($Values) {
        $Query = "SELECT *
        FROM `Posts`
        WHERE
        (`Meta` LIKE :q
        OR `Title` LIKE :q
        OR :q LIKE '')
        AND `IsExternalWriter` = 0
        AND `IsVerified` = 1
        ORDER BY `Submit` DESC
        LIMIT 150";

        return $this->DoSelect($Query, $Values);
    }
    function GetVerifiedItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Posts`
        WHERE `Id` = :Id
        AND `IsVerified` = 1
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Posts`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
        CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Post/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
        CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Home/View/\', id , \'">\', \'View\', \'</a>\') as View,
        Id
        , Submit
        ,`Title`
        ,`Publisher`
        FROM `Posts`
        WHERE `IsExternalWriter` = 0
        AND `IsVerified` = 1
        ORDER BY `Id` DESC';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Posts`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}