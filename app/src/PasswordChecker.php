<?php

namespace App;

class PasswordChecker
{
    public string $mdp;
    public int $nbr;
    
    public function __construct($mdp)
    {
        $this->mdp = $mdp;
        $this->nbr= 9;
    }

    public function passwordCheck(){
        if (strlen($this->mdp) > $this->nbr){
            return true;
        } else {
            return false;
        }
    }
}

