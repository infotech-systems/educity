<?php
session_start();
class Session
{
    var $SessionName='Default';
    function __constructor($SessionName)
    {
        $this->SessionName=$SessionName;
    }
    function Set($Setting,$Value)
    {
        $_SESSION[$this->SessionName][$Setting]=$Value;
    }
    function Get($Setting,$Default='')
    {
        if(isset($_SESSION[$this->SessionName][$Setting]) && !empty($_SESSION[$this->SessionName][$Setting]))
            return $_SESSION[$this->SessionName][$Setting];
        else
            return $Default;
    }
}
?> 