<?php

class Roadmap extends Model{

    function GetLeadLagItemIds($Values)
    {
        $Query = 'SELECT \'Location\', \'PostId\'
        
        UNION

        SELECT * FROM (SELECT \'Previous\', `PostId` FROM Roadmaps
        WHERE RoadId = :RoadId
        AND PostId <> :PostId
        AND
        (
            `Priority` < ( SELECT `Priority` From Roadmaps WHERE RoadId = :RoadId AND PostId = :PostId )
            OR
            (
                `Priority` = ( SELECT `Priority` From Roadmaps WHERE RoadId = :RoadId AND PostId = :PostId )
                AND
                PostId < PostId
            )
        )
        ORDER BY `Priority` DESC LIMIT 1) SELECT1

        UNION

        SELECT * FROM (SELECT \'Next\', `PostId` FROM Roadmaps
        WHERE RoadId = :RoadId
        AND PostId <> :PostId
        AND
        (
            `Priority` > ( SELECT `Priority` From Roadmaps WHERE RoadId = :RoadId AND PostId = :PostId )
            OR
            (
                `Priority` = ( SELECT `Priority` From Roadmaps WHERE RoadId = :RoadId AND PostId = :PostId )
                AND
                PostId > PostId
            )
        )
        ORDER BY `Priority` ASC LIMIT 1) SELECT2
        ';

        return $this->DoSelect($Query, $Values);
    }

    function GetPostsByRoadId($Values) {

        $Query = 'SELECT
            Roadmaps.Id, Posts.*
            FROM `Roadmaps`
            INNER JOIN `Posts` ON Roadmaps.PostId = Posts.Id
            WHERE RoadId = :Id
            ORDER BY Roadmaps.`Priority` ASC, Posts.Submit ASC';

        return $this->DoSelect($Query, $Values);
    }

    // === Based on a pattern ===
    function DescribeTable() {
        return $this->DoSelect("DESCRIBE `Roadmaps`");
    }
    function GetAdminPanelItems($Values = null) {

        $Query = 'SELECT
            CONCAT(\'<a class="btn btn-sm btn-default" href="' . _Root . 'Admin/Items/Roadmap/\', Roadmaps.Id , \'">\', \'Edit\', \'</a>\') as Edit,
            Roadmaps.Id, Roadmaps.Priority, Posts.Title as PostTitle, Roads.Title as RoadTitle
            FROM `Roadmaps`
            INNER JOIN `Posts` ON Roadmaps.PostId = Posts.Id
            INNER JOIN `Roads` ON Roadmaps.RoadId = Roads.Id
            ORDER BY Roadmaps.`Id` DESC';

        return $this->DoSelect($Query);
    }
    function GetItemByIdentifier($Values) {
        $Query = "SELECT *
        FROM `Roadmaps`
        WHERE `Id` = :Id
        LIMIT 1";

        return $this->DoSelect($Query, $Values);
    }
}