<?php
class StringFunctions {
    // Function to prevent SQL injection
    static function injection_prevent($query_input)
    {
        $search = array("\\", "\x00", "\n", "\r", "\'", '"', "\x1a");
        $replace = array("\\\\","\0","\n", "\r", "\\'", '\"', "\Z");
        return str_replace($search, $replace, $query_input);
    }

    // Function to generate GUID (Generic Unique IDentifiers)
    static function generate_guid()
    {
        return
        sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ));
    }

    // Function to remove all symbols from text
    static function remove_all_non_alpha_numeric($input)
    {
        return
        preg_replace('/[^A-Za-zابپتثجچحخدذرزسشصضطذعقفقکلمنوهی0-9_ ۱۲۳۴۵۶۷۸۹۰]/', '', $input);
    }
}
?>