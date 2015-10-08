<?php

namespace model;

class UsersDAL{
    private static $fileName = "registeredUsers.User";

    public function getUsers(){
        $fileContent = file_get_contents(self::fileName);

        if($fileContent !== FALSE){
            return unserialize($fileContent);
        }
        return null;

        /*$this->users = new UserArray();

        $stmt = $this->dataBase->prepare("SELECT * FROM " . self::$table);
        if($stmt === FALSE){
            throw new \Exception($this->dataBase->error);
        }
        $stmt->execute();
        $stmt->bind_result($username, $password);

        while($stmt->fetch()){
            $user = new User($username, $password);
            $this->users->addUser($user);
        }

        return $this->users;*/
    }
    public function addUser(User $toBeAdded){

        $content = serialize($toBeAdded);

        file_put_contents(self::$fileName, $content);
        /*$stmt = $this->dataBase->prepare("INSERT INTO 'login'.'Users'('username', 'password')VALUES(?, ?)");

        $username = $toBeAdded->getName();
        $password = $toBeAdded->getPassword();
        $stmt->bind_param('ss', $username, $password);

        $stmt->execute();*/
    }
}


//$stmt = $this->database->prepare("INSERT INTO  `store`.`Products` (`pk` , `title` , `description` , `price` )VALUES (?, ?, ?, ?)");