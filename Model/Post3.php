<?php

include_once 'Post.php';
class Post3 extends Post {

    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
        CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Post3/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
        CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Home/View/\', id , \'">\', \'View\', \'</a>\') as View,
        Id
        , Submit
        ,`Title`
        ,`Publisher`
        FROM `Posts`
        WHERE `IsVerified` = 0
        ORDER BY `Id` DESC';

        return $this->DoSelect($Query);
    }
}