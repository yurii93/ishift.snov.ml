<?php

namespace Model;


use Common\DB;
use Common\DbCache;

class BaseModel
{
    protected $db;
    protected $table;
    protected $validations = array();

    public function __construct()
    {
        $this->db = new DB();
    }

    /*
    * Checks if there is user with certain email & returns his id
    */
    public function check($email)
    {
        $sql = "SELECT `id` FROM `{$this->table}` 
                  WHERE `email` = '{$email}';
        ";

        if ($result = $this->db->query($sql)) {
            return $result[0];
        }

        return false;
    }

    /*
     * Validation
     */
    public function validate($array)
    {
        $errors = array();
        foreach ($this->validations as $field => $rules) {
                if (isset($array[$field]) && (iconv_strlen($array[$field]) < $rules['min'] || iconv_strlen($array[$field]) > $rules['max'])) {
                    $errors[$field] = true;
                }
        }

        if($errors) {
            return $errors;
        } else {
            return false;
        }
    }


    /*
     * Email validation
     */
    public function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Selects all guests
     */
    public function all()
    {
        $sql = "SELECT * FROM `{$this->table}`";
        $result = $this->db->query($sql);

		// verification
        $this->ifNot($result);
        return $result;
    }

    /*
     * Selects guests by status
     */
    public function status($alias)
    {
		// setting status
        if ($alias[0] == 'on') {
            $status = 1;
        } elseif ($alias[0] == 'un') {
            $status = 0;
        }

        $sql = "SELECT * FROM `{$this->table}` WHERE `status` = {$status};";
        $result = $this->db->query($sql);

		// verification
        $this->ifNot($result);
        return $result;
    }

    /*
     * Deletes guest by id
     */
    public function delete($id)
    {
        $sql = "DELETE FROM `{$this->table}` WHERE `id` = {$id};";
        return $this->db->query($sql);
    }

    /*
     * Edits status by id
     */
    public function editStatus($id)
    {
		// setting integer variables
        $guestId = (int)$id[0];
        $statusId = (int)$id[1];

        $sql = "UPDATE `{$this->table}` SET `status` = {$statusId} WHERE `id` = {$guestId};";
        return $this->db->query($sql);
    }


    /*
    * Checks if there is a result
    */
    protected function ifNot($result)
    {
        if (!$result) {
            return array();
        }
    }
}