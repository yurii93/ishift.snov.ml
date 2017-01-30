<?php

namespace Model;

class PeopleModel extends BaseModel
{
    protected $table = 'ishift_people';

	// validation data
    protected $validations = array(
        'surname' => array(
            'min' => 1,
            'max' => 30,
        ),
        'name' => array(
            'min' => 1,
            'max' => 30,
        ),
        'phone' => array(
            'min' => 9,
            'max' => 13,
        ),
        'age' => array(
            'min' => 1,
            'max' => 2,
        ),
        'country' => array(
            'min' => 1,
            'max' => 30,
        ),
        'city' => array(
            'min' => 1,
            'max' => 30,
        ),
    );

    /*
     * Inserts new guest
     */
    public function add($data)
    {
        $data['surname'] = $this->db->escape($data['surname']);
        $data['name'] = $this->db->escape($data['name']);
        $data['email'] = $this->db->escape($data['email']);
        $data['phone'] = $this->db->escape($data['phone']);
        $data['age'] = $this->db->escape($data['age']);
        $data['country'] = $this->db->escape($data['country']);
        $data['city'] = $this->db->escape($data['city']);
        if (isset($data['childrenInfo'])) {
            $data['childrenInfo'] = $this->db->escape($data['childrenInfo']);
        }

        //SPECIAL
        $surname = htmlspecialchars($data['surname']);
        $name = htmlspecialchars($data['name']);
        $email = htmlspecialchars($data['email']);
        $phone = htmlspecialchars($data['phone']);
        $age = htmlspecialchars($data['age']);
        $country = htmlspecialchars($data['country']);
        $city = htmlspecialchars($data['city']);
        if (isset($data['childrenInfo'])) {
            $childrenInfo = htmlspecialchars($data['childrenInfo']);
        } else {
            $childrenInfo = null;
        }

        //INT
        if (isset($data['children'])) {
            $children = (int)1;
        } else {
            $children = (int)0;
        }
        if (isset($data['breakfast'])) {
            $breakfast = (int)1;
        } else {
            $breakfast = (int)0;
        }
        if (isset($data['breakfastSaturday'])) {
            $breakfastSaturday = (int)1;
        } else {
            $breakfastSaturday = (int)0;
        }
        if (isset($data['breakfastSunday'])) {
            $breakfastSunday = (int)1;
        } else {
            $breakfastSunday = (int)0;
        }
        if (isset($data['oportunity'])) {
            $oportunity = (int)1;
        } else {
            $oportunity = (int)0;
        }

        //SQL
        $sql = "INSERT INTO `{$this->table}`
                    SET `surname` = '{$surname}',
                        `name` = '{$name}',
                        `email` = '{$email}',
                        `phone` = '{$phone}',
                        `age` = '{$age}',
                        `country` = '{$country}',
                        `city` = '{$city}',
                        `children` = {$children},
                        `childrenInfo` = '{$childrenInfo}',
                        `breakfast` = {$breakfast},
                        `breakfastSaturday` = {$breakfastSaturday},
                        `breakfastSunday` = {$breakfastSunday},
                        `oportunity` = {$oportunity};
        ";

        if ($this->db->query($sql)) {
            return $this->db->lastId();
        }

        return false;
    }

    /*
     * Selects user by comparing data
     */
    public function login($data)
    {
		
		// escaping data
        $data['password'] = $this->db->escape($data['password']);
        //SALT
        $data['password'] = md5(SALT . $data['password']);
        $data['name'] = $this->db->escape($data['name']);

        $sql = "SELECT * FROM `ishift_user` 
                  WHERE `password` = '{$data['password']}' 
                  AND `name` = '{$data['name']}';
        ";

        if ($result = $this->db->query($sql)) {
            return $result[0];
        }

        return false;
    }

    /*
     * Selects guests by status
     */
    public function oportunity()
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `oportunity` = 1";
        $result = $this->db->query($sql);

		// verification
        $this->ifNot($result);
        return $result;
    }
}