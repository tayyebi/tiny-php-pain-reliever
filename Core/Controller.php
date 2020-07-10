<?php
/**
 * Master class of controllers
 */
class Controller {

    protected $ViewDirectory;

        /**
     * __construct
     *
     * Responsible for statistics
     * 
     * 
     * @return void
     */
    function __construct() {

        // If system was configured to disable statistics
        if (!_Statistics)
            return;

        // Set a cookie for tracking
        if (!isset($_COOKIE['CLIENT_TRACK']))
        {
            $value = StringFunctions::generate_guid();
            setcookie('CLIENT_TRACK', $value, time() + (86400 * 30), "/"); // 86400 = 1 day
            $_COOKIE['CLIENT_TRACK'] = $value;
        }

        // Call the model
        $Model = $this->CallModel("Statistics");
        
        // Bind values
        $Values = [
            "CLIENT_TRACK" => $_COOKIE['CLIENT_TRACK'],
            "CONTEXT_DOCUMENT_ROOT" => isset($_SERVER["CONTEXT_DOCUMENT_ROOT"]) ? $_SERVER["CONTEXT_DOCUMENT_ROOT"] : "",
            "CONTEXT_PREFIX" => isset($_SERVER["CONTEXT_PREFIX"]) ? $_SERVER["CONTEXT_PREFIX"] : "",
            "DOCUMENT_ROOT" => isset($_SERVER["DOCUMENT_ROOT"]) ? $_SERVER["DOCUMENT_ROOT"] : "",
            "HTTP_ACCEPT" => isset($_SERVER["HTTP_ACCEPT"]) ? $_SERVER["HTTP_ACCEPT"] : "",
            "HTTP_ACCEPT_ENCODING" => isset($_SERVER["HTTP_ACCEPT_ENCODING"]) ? $_SERVER["HTTP_ACCEPT_ENCODING"] : "",
            "HTTP_ACCEPT_LANGUAGE" => isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? $_SERVER["HTTP_ACCEPT_LANGUAGE"] : "",
            "HTTP_CACHE_CONTROL" => isset($_SERVER["HTTP_CACHE_CONTROL"]) ? $_SERVER["HTTP_CACHE_CONTROL"] : "",
            "HTTP_CONNECTION" => isset($_SERVER["HTTP_CONNECTION"]) ? $_SERVER["HTTP_CONNECTION"] : "",
            "HTTP_COOKIE" => isset($_SERVER["HTTP_COOKIE"]) ? $_SERVER["HTTP_COOKIE"] : "",
            "HTTP_HOST" => isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : "",
            "HTTP_REFERER" => isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "",
            "HTTP_SEC_FETCH_DEST" => isset($_SERVER["HTTP_SEC_FETCH_DEST"]) ? $_SERVER["HTTP_SEC_FETCH_DEST"] : "",
            "HTTP_SEC_FETCH_MODE" => isset($_SERVER["HTTP_SEC_FETCH_MODE"]) ? $_SERVER["HTTP_SEC_FETCH_MODE"] : "",
            "HTTP_SEC_FETCH_SITE" => isset($_SERVER["HTTP_SEC_FETCH_SITE"]) ? $_SERVER["HTTP_SEC_FETCH_SITE"] : "",
            "HTTP_SEC_FETCH_Person" => isset($_SERVER["HTTP_SEC_FETCH_Person"]) ? $_SERVER["HTTP_SEC_FETCH_Person"] : "",
            "HTTP_UPGRADE_INSECURE_REQUESTS" => isset($_SERVER["HTTP_UPGRADE_INSECURE_REQUESTS"]) ? $_SERVER["HTTP_UPGRADE_INSECURE_REQUESTS"] : "",
            "HTTP_Person_AGENT" => isset($_SERVER["HTTP_Person_AGENT"]) ? $_SERVER["HTTP_Person_AGENT"] : "",
            "PATH" => isset($_SERVER["PATH"]) ? $_SERVER["PATH"] : "",
            "PATH_INFO" => isset($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : "",
            "PATH_TRANSLATED" => isset($_SERVER["PATH_TRANSLATED"]) ? $_SERVER["PATH_TRANSLATED"] : "",
            "PHP_SELF" => isset($_SERVER["PHP_SELF"]) ? $_SERVER["PHP_SELF"] : "",
            "QUERY_STRING" => isset($_SERVER["QUERY_STRING"]) ? $_SERVER["QUERY_STRING"] : "",
            "REDIRECT_STATUS" => isset($_SERVER["REDIRECT_STATUS"]) ? $_SERVER["REDIRECT_STATUS"] : "",
            "REDIRECT_URL" => isset($_SERVER["REDIRECT_URL"]) ? $_SERVER["REDIRECT_URL"] : "",
            "REMOTE_ADDR" => isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "",
            "REMOTE_PORT" => isset($_SERVER["REMOTE_PORT"]) ? $_SERVER["REMOTE_PORT"] : "",
            "REQUEST_METHOD" => isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "",
            "REQUEST_SCHEME" => isset($_SERVER["REQUEST_SCHEME"]) ? $_SERVER["REQUEST_SCHEME"] : "",
            "REQUEST_TIME" => isset($_SERVER["REQUEST_TIME"]) ? $_SERVER["REQUEST_TIME"] : "",
            "REQUEST_TIME_FLOAT" => isset($_SERVER["REQUEST_TIME_FLOAT"]) ? $_SERVER["REQUEST_TIME_FLOAT"] : "",
            "REQUEST_URI" => isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "",
            "SCRIPT_FILENAME" => isset($_SERVER["SCRIPT_FILENAME"]) ? $_SERVER["SCRIPT_FILENAME"] : "",
            "SCRIPT_NAME" => isset($_SERVER["SCRIPT_NAME"]) ? $_SERVER["SCRIPT_NAME"] : "",
            "HTTP_CLIENT_IP" => isset($_SERVER["HTTP_CLIENT_IP"]) ? $_SERVER["HTTP_CLIENT_IP"] : "",
            "HTTP_X_FORWARDED_FOR" => isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : "",
        ];

        // Insert rows
        $Model->InsertVisit($Values);
    }

    /**
     * SetViewDirectory
     *
     * A simple setter for $ViewDirectory
     * which we call it from App.php
     * 
     * @param  mixed $Value
     *
     * @return void
     */
    function SetViewDirectory(string $Value){
        $this->ViewDirectory = $Value;
    }

    /**
     * CallModel
     *
     * Sets, calls, and loads the model
     * 
     * @param string $Entity
     *
     * @return void
     */
    function CallModel(string $Entity, bool $UsePDO = true){
        include('Model/' . $Entity . '.php');
        return new $Entity($UsePDO);
    }

    /**
     * GetPayload
     *
     * Returns the payload/tail of view file
     * 
     * @param  mixed $ViewFile
     * @param  mixed $ExcludePayload
     *
     * @return void
     */
    private function GetPayload($ViewFile, $ExcludePayload = false){
        $Separator = '<!--PAYLOAD_CONTENT_END-->';
        $TextInsideFile = file_get_contents($ViewFile);
        // If text does not contains the payload pointer
        if (strpos($TextInsideFile, $Separator) == false)
            if ($ExcludePayload)
            return $TextInsideFile;
            else return "";
        // If head
        if (!$ExcludePayload and (strpos($TextInsideFile, $Separator) !== false))
        $TextInsideFile = substr($TextInsideFile, 0, strpos($TextInsideFile, $Separator));
        // If separator does not exist
        else if (!$ExcludePayload and !(strpos($TextInsideFile, $Separator) !== false))
        $TextInsideFile = '';
        // If tail
        else
        $TextInsideFile = substr($TextInsideFile,
        strpos($TextInsideFile, $Separator) + strlen($Separator));
        return $TextInsideFile;
    }


    /**
     * RenderBody
     *
     * Returns header and footer of the layout file
     * 
     * @param  mixed $LayoutFile
     * @param  mixed $Head
     *
     * @return void
     */
    private function RenderBody($LayoutFile, $Head){
        $Separator = '<!--VIEW_CONTENT-->';
        $TextInsideFile = file_get_contents($LayoutFile);
        // If head
        if ($Head and (strpos($TextInsideFile, $Separator) !== false) )
        $TextInsideFile = substr($TextInsideFile, 0, strpos($TextInsideFile, $Separator));
        // If separator does not exist
        else if ($Head and !(strpos($TextInsideFile, $Separator) !== false))
        $TextInsideFile = '';
        // If tail
        else
        $TextInsideFile = substr($TextInsideFile,
        strpos($TextInsideFile, $Separator) + strlen($Separator));
        return $TextInsideFile;
    }

    /**
     * Evaluate
     *
     * An `include`-based equivalent to php eval code
     * 
     * @param  mixed $Code
     *
     * @return void
     */
    private function Evaluate($Code, $Data = []) {

        // Algorithm
        // 1. Create a temp file from payload
        // 2. Include the payload
        $TempPointer = tmpfile();
        fwrite($TempPointer, $Code);
        $MetaData = stream_get_meta_data($TempPointer);
        $TempFileName = $MetaData['uri'];
        chmod($TempFileName, 775);
        include($TempFileName);
        fclose($TempPointer);
    }

    /**
     * Render
     *
     * Renders the view
     * 
     * @param  mixed $View
     * @param  mixed $Data
     *
     * @return void
     */
    function Render($View, $Data = [], $IsPartial = false)
    {
        // The current view file
        $CurrentViewFile = 'View/' . $this->ViewDirectory . '/' . $View . '.php';
        // Run the payload for current file
        $this->Evaluate($this->GetPayload($CurrentViewFile, false), $Data);
        // Get master layout head
        if (!$IsPartial)
            $this->Evaluate($this->RenderBody('View/_Layout.php', true), $Data);
        // Get slave layout head
        if (!$IsPartial)
            if (file_exists('View/' . $this->ViewDirectory . '/_Layout.php'))
                $this->Evaluate($this->RenderBody('View/' . $this->ViewDirectory . '/_Layout.php', true),
                $Data);
        // Render the view body
        $this->Evaluate($this->GetPayload($CurrentViewFile, true), $Data);
        // Get slave layout tail
        if (!$IsPartial)
            if (file_exists('View/' . $this->ViewDirectory . '/_Layout.php'))
                $this->Evaluate($this->RenderBody('View/' . $this->ViewDirectory . '/_Layout.php', false),
                $Data);
        // Get master layout tail
        if (!$IsPartial)
            $this->Evaluate($this->RenderBody('View/_Layout.php', false), $Data);

    }


    /**
     * RedirectResponse
     *
     * Sets the header to redirect
     * 
     * @param  mixed $Route
     *
     * @return void
     */
    function RedirectResponse($Route)
    {
        header("Location: " . $Route);
    }


    /**
     * CheckAuth
     *
     * Renders the view
     * 
     * @param  mixed $Cookies
     * @param  mixed $Data
     *
     * @return void
     */
    function CheckAuth($Cookies, $LoginRequired = true)
    {
        if ($LoginRequired)
        {
            return true;       
        }
    }
}