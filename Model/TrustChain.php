<?php

class TrustChain extends Model{
    function GetItems($Values = null) {
        $Query = 'SELECT
        Id
        ,`Value`
        ,`Hash`
        FROM `TrustChain`
        ORDER BY `Id` ASC';

        return $this->DoSelect($Query);
    }
    function GetLastHash() {
        $Query = 'SELECT `Hash` FROM `TrustChain` ORDER BY Id DESC LIMIT 1;';
        return $this->DoSelect($Query);
    }
    function InsertItem($Values) {

        $this->GetConnection()->beginTransaction();

        try {
            $InsertQuery = 'INSERT INTO `TrustChain`
            (`Value`, `Hash`)
            VALUES
            (:Value, :Hash)
            ';

            $this->DoQuery($InsertQuery, $Values);
            
            $result = [true, $this->GetConnection()->lastInsertId()];

            $this->GetConnection()->commit();
            
            return $result;

        } catch(PDOExecption $e) {
            $this->GetConnection()->rollback();
            return [false, $e->getMessage()];
        }


    }
}