<?php

class Db_object {

    public static function get_all() {

        return static::execute_query("SELECT * FROM " . static::$db_table);

    }

    public static function get_by_id($id) {

         $result = static::execute_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");

         return !empty($result) ? array_shift($result) : false;

    }

    public static function execute_query($sql) {

        global $db;

        $result = $db->query($sql);

        $obj_array = [];

        while($row = mysqli_fetch_array($result)) {

            $obj_array[] = static::map_array_to_object($row);

        }

        return $obj_array;

    }

    public static function map_array_to_object($array) {

        //$obj = new self;

        $called_class = get_called_class();

		$obj = new $called_class;

        foreach($array as $key => $value) {

            if($obj->has_attribute($key)) {

                $obj->$key = $value;

            }

        }

        return $obj;

    }

    private function has_attribute($attribute) {

        $obj_properties = get_object_vars($this);

        return array_key_exists($attribute, $obj_properties);

    }

    public function save() {

        return isset($this->id) ? $this->update() : $this->create();
    
    }

    public function create() {

        global $db;

        $properties = $this->get_clean_properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ") ";
		$sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

        if($db->query($sql)) {

            //get the last auto-created ID in database
            $this->id = $db->insert_id();

            return true;

        }

        return false;

    }

    public function update() {

		global $db;

		$properties = $this->clean_properties();

		$properties_pairs = [];

		foreach ($properties as $key => $value) {
			$properties_pairs[] = "{$key}='{$value}'";
		}

		$sql = "UPDATE  " . static::$db_table . "  SET ";
		$sql .= implode(", ", $properties_pairs);
		$sql .= " WHERE id= " . $db->escape_string($this->id);

		$db->query($sql);

		return (mysqli_affected_rows($db->connection) == 1) ? true : false;

	}

    protected function get_properties() {

        $properties = [];

        foreach(static::$db_table_fields as $field) {

            if(property_exists($this, $field)) {

                $properties[$field] = $this->$field;

            }

        }

        return $properties;

    }

    protected function get_clean_properties() {

        global $db;


		$clean_properties = [];


		foreach ($this->get_properties() as $key => $value) {
			
			$clean_properties[$key] = $db->escape_string($value);

		}

		return $clean_properties;

    }    

}

?>