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
        $this->CheckAuth(); // Check login

        throw new UnauthException();
        
    }

}