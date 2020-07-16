<?php

/**
 * 
 * Controller class for authentiction pages
 * 
 */
class UserController extends Controller {

    /**
     * LogoutGET
     *
     * Does logout action
     * 
     * @return void
     */
    function LogoutGET() {
        $this->CheckAuth($_COOKIE); // Check login

        throw new UnauthException();
        
    }

}