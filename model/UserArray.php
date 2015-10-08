<?php

namespace model;

//Prepared for more registered users, even though there is only one at the moment. No
//constructor method since it only exists if there is at least one registered user, never
//on its own
class UserArray{
    private $users = array();
    private $dal;

    public function __construct(UsersDAL $dal){
        $this->dal = $dal;
    }

    //Store users in array using the name instead of index
    public function addUser(User $user){
        $this->users[$user->getName()] = $user;
    }
    //Accessor method with name instead of index, if no user exists (is registered) with that name, return null
    public function getUserByName($userName){
        if(isset($this->users[$userName])){
            return $this->users[$userName];
        }
        return null;
    }
}