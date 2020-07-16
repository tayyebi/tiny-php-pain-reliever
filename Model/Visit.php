<?php

class Visit extends Model {
    
    function GroupedVisitCount() {
        $Query = 'SELECT
        CONCAT(\'هفته \', WeekNumber) as WeekNumber,
        COUNT(*) as TotalRequests
        FROM
        (
            SELECT
            DATEDIFF(`Submit`, NOW()) AS WeekNumber
            FROM `Visits`
            WHERE `Submit` > DATE_ADD(NOW(), INTERVAL -90 DAY) -- Limit for three monthes
        ) as AliasOfFirstSelect
        GROUP BY
        WeekNumber';
        $Result = $this->DoSelect($Query);
        return $Result;
    }

    function GroupedVisitCountByAgent() {
        $Query = 'SELECT
        COUNT(*) as TotalRequests,
        HTTP_USER_AGENT as Agent
        FROM `Visits`
        WHERE `Submit` > DATE_ADD(NOW(), INTERVAL -90 DAY) -- Limit for three monthes
        GROUP BY `HTTP_USER_AGENT`
        ';
        $Result = $this->DoSelect($Query);
        return $Result;
    }
    
    function PostsVisitCountByAddress() {
        $Query = 'SELECT
        COUNT(*) as TotalRequests,
        REQUEST_URI as Uri
        FROM `Visits`
        WHERE `Submit` > DATE_ADD(NOW(), INTERVAL -90 DAY) -- Limit for three monthes
        AND `REQUEST_URI` LIKE \'%HOME/REDIRECT%\'
        GROUP BY `REQUEST_URI`
        ORDER BY TotalRequests DESC, Uri DESC
        LIMIT 100
        ';
        $Result = $this->DoSelect($Query);
        return $Result;
    }
}