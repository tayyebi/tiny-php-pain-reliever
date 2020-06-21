<?php

class Post extends Model{
    function GetHome($Values) {
        $Query = "SELECT *
        FROM `Posts`
        WHERE `Meta` LIKE :q
        OR `Title` LIKE :q
        ORDER BY `Submit` DESC
        LIMIT 100";

        return $this->DoSelect($Query, $Values);
    }
    function GetArchive() {

    }
}