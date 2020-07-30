<?php

class Visit extends Model {

    function TopUsers() {
        $Query = 'SELECT
        COUNT(*) as TotalRequests, `CLIENT_TRACK`, `HTTP_USER_AGENT`
        FROM `Visits`
        WHERE `Submit` > DATE_ADD(NOW(), INTERVAL -7 DAY) -- LIMIT FOR 7 DAYS
        GROUP BY `CLIENT_TRACK`, `HTTP_USER_AGENT`
        ORDER BY TotalRequests DESC
        LIMIT 10';
        $Result = $this->DoSelect($Query);
        return $Result;
    }

    function UserStory($Values) {
        $Query = 'SELECT `Submit`, REQUEST_URI as Uri,
        `PHP_AUTH_USER`, `PHP_AUTH_USER`, `HTTP_USER_AGENT`,
        `HTTP_REFERER`, `HTTP_CLIENT_IP`
        FROM `Visits`
        -- TODO: Difference with prev step (To determine waiting time)
        WHERE CLIENT_TRACK=:CLIENT_TRACK
        AND `Submit` > DATE_ADD(NOW(), INTERVAL -7 DAY) -- LIMIT FOR 7 DAYS
        ORDER BY `Id` DESC';
        $Result = $this->DoSelect($Query, $Values);
        return $Result;
    }

    function DailyGroupedVisitCount() {
        $Query = 'SELECT
        CONCAT(\'ساعت \', HourNumber) as HourNumber,
        COUNT(*) as TotalRequests
        FROM
        (
            SELECT
            HOUR(`Submit`) AS HourNumber
            FROM `Visits`
            WHERE `Submit` > DATE_ADD(NOW(), INTERVAL -23 HOUR) -- Limit for 1 days
        ) as AliasOfFirstSelect
        GROUP BY
        HourNumber
        order by (HourNumber % (HOUR(Now())+1))';
        $Result = $this->DoSelect($Query);
        return $Result;
    }

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
        ORDER BY TotalRequests DESC
        LIMIT 5
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
        LIMIT 50
        ';
        $Result = $this->DoSelect($Query);
        return $Result;
    }
}