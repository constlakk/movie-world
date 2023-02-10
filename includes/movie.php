<?php

class Movie extends Db_object {

    protected static $db_table = "movies";
    protected static $db_table_fields = ['title', 'description', 'publication_date', 'image_filename', 'user_id'];
    public $id;
    public $title;
    public $description;
    public $publication_date;
    public $image_filename;
    public $total_likes;
    public $total_dislikes;
    public $user_id;

    public $tmp_path;
    public $upload_directory = "uploads";
    public $custom_errors_array = [];
    public $upload_errors_array = [


        UPLOAD_ERR_OK           => "There is no error",
        UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
        UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
                                                    
    
    ];

    public static function get_by_user_id($id) {

      return self::execute_query("SELECT * FROM " . self::$db_table . " WHERE user_id = $id");

    }

    public static function get_all_order_by($order_by) {

      return self::execute_query("SELECT * FROM " . self::$db_table . " ORDER BY $order_by DESC");

    }

    public function get_likes($is_dislikes) {

      return self::execute_query("SELECT * FROM user_likes WHERE movie_id = " . $this->id .  " AND is_dislike = $is_dislikes");
      
    }

    public static function like($user_id, $movie_id, $is_dislike) {

      global $db;
      $sql = "INSERT INTO user_likes (user_id, movie_id, is_dislike) VALUES ({$user_id}, {$movie_id}, {$is_dislike})";

      $db->query($sql);

    }

    public function set_file($file) { 

		if(empty($file) || !$file || !is_array($file) || $file['error'] == 4) {

            // $this->errors[] = "No file has been uploaded.";
            // return false;
            $this->image_filename = "placeholder.jpg";
            $this->tmp_path = INCLUDES_PATH;

		} else if($file['error'] != 0) {

            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;

		} else {

            $this->image_filename =  basename($file['name']);
            $this->tmp_path = $file['tmp_name'];

		}

    }

	public function save() {

		if($this->id) {

			$this->update();
			
		} else {

			if(!empty($this->errors)) {

				return false;

			}

			if(empty($this->image_filename) || empty($this->tmp_path)){
				$this->errors[] = "Unavailable file." . $this->image_filename;
				return false;
			}

			$target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->image_filename;


			if(file_exists($target_path) && $this->image_filename != "placeholder.jpg") {

				$this->errors[] = "The file {$this->image_filename} already exists";
				return false;

			}

			if(move_uploaded_file($this->tmp_path, $target_path) || $this->image_filename == "placeholder.jpg") {

				if($this->create()) {

					unset($this->tmp_path);
					return true;

				}

			} else {

				$this->errors[] = "Could not upload to directory. Please check your permissions.";
				return false;

			}

	   	}
 
	}    
    
}

?>