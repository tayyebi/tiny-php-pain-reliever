<?php

class Podcast extends Model{
    function GetHome() {
        $Query = 'SELECT *
        FROM `Podcasts`
        ORDER BY Id DESC LIMIT 1';

        return $this->DoSelect($Query);
    }
    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Podcasts`");
    }
    function GetAdminPanelItems($Values = null) {
        $Query = 'SELECT
        CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Podcast/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
        Id
        ,`Title`
        ,`EpisodeNumber`
        ,`PublishDate`
        FROM `Podcasts`
        ORDER BY `Id` DESC';

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