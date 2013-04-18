<?php

// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once('user.php');

class DAOUser {

    private $database;

    function __construct($db) {
        $this->database = $db;
    }

    public function find_all() {
        return self::find_by_sql("SELECT * FROM users");
    }

    public function find_by_id($id = 0) {
        $result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public function find_by_sql($sql = "") {
        $result_set = $this->database->query($sql);
        $object_array = array();
        while ($row = $this->database->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    private function instantiate($record) {
        // Could check that $record exists and is an array
        $object = new User();

        // Simple, long-form approach:
        $object->setId($record['id']);
        $object->setUsername($record['username']);
        $object->setPassword($record['password']);
        $object->setFirst_name($record['first_name']);
        $object->setLast_name($record['last_name']);

        // More dynamic, short-form approach:
        //        foreach ($record as $attribute => $value) {
        //            if ($object->has_attribute($attribute)) {
        //                $object->$attribute = $value;
        //            }
        //        }

        return $object;
    }

}

?>