<?php

namespace model;

class RegisterCredentialsDAL {

    public function load($userName) {
        if ( file_exists(self::getFileName($userName)) ) {
            $fileContent = file_get_contents(self::getFileName($userName));
            if ($fileContent !== FALSE)
            {
                return unserialize($fileContent);
            }
        }
        return null;
    }

    public function save(RegisterCredentials $rc) {
        $password = password_hash($rc->getUserPassword(), PASSWORD_DEFAULT);
        file_put_contents( self::getFileName($rc->getUserName()), serialize($password) );
    }
    private function getFileName($userName) {
        //TODO: replace the addslashes with something that makes username safe for use in filesystem
        return \Settings::DATAPATH . addslashes($userName);
    }
}