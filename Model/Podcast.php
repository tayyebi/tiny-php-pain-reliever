<?php

class Podcast extends Model{

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Podcasts`");
    }
    function GetAdminPanelItems($Values = null) {
        $Query = 'SELECT
        CONCAT(\'<a class="btn btn-sm btn-default" href="admin.php?id=crud&table=Podcasts&entry=\', id , \'">\', \'Edit\', \'</a>\') as Edit,
        Id
        ,`Title`
        ,`EpisodeNumber`
        ,`PublishDate`
        FROM `Podcasts`';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Podcasts`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}