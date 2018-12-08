<?php

namespace Application\Model;

class Session
{

    /**  
     * Start session with class instance
     */ 
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**  
     * Set value for the session
     * @param int The user identificator          
     * @return boolean true success | false failed
     */ 
    public function setSession($userId = null)
    {
        if (
            $userId != null && 
            $userId != "" &&
            !empty($userId)
        ) {
            $_SESSION["USERID"] = $userId;

            return true;
        }
        return false;
    }

    /**  
     * Get value of the session      
     * @return int user identificator
     * @return false failed
     */
    public function getSession()
    {
        if (
            !empty($_SESSION["USERID"]) &&
            $_SESSION["USERID"] != "" &&
            !empty($_SESSION["USERID"])
        ) {
            return $_SESSION["USERID"];
        }
        return false;        
    }

    /**  
     * Verify Session
     * @return true logged
     * @return false failed
     */
    public function verifySession()
    {
        if (
            isset($_SESSION["USERID"]) &&
            $_SESSION["USERID"] != ""
        ) {
            return true;
        }
        return false;        
    }


    /**  
     * Unser session
     */
    public function unsetSession()
    {
        if (
            !empty($_SESSION["USERID"]) &&
            $_SESSION["USERID"] != "" &&
            !empty($_SESSION["USERID"])
        ) {
            unset($_SESSION["USERID"]);
            return true;
        }
        return false;        
    }

}