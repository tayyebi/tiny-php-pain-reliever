<?php
class Feedback extends Model{

    function FeedbackInsert ($Values) {
    	$Query = 'INSERT INTO `Feedbacks` 
        (`Url`, `Meta`, `Contact`, `Message`, `Status`) 
        VALUES
        (:Url, :Meta, :Contact, :Message, :Status)';
        $this->DoQuery($Query, $Values);
    }

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Feedbacks`");
    }
    function GetAdminPanelItems($Values = null) {
        $Query = 'SELECT
                CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Feedback/\', id , \'">\', \'Edit\', \'</a>\') as Edit,
                Id
                ,`Contact`
                ,`Meta`
                FROM `Feedbacks`';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Feedbacks`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}

?>