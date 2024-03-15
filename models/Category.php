<?php
    class Category {
         // DB stuff
         private $conn;
         private $table = 'categories';
 
         // Category Properties
         public $id;
         public $category;
 
         // Constructor with DB
         public function __construct($db){
             $this->conn = $db;
         }

         // Get All Category
        public function read(){
            // Create query
            $query = 'SELECT 
                    id,
                    category
                FROM
                    '.$this->table.'
                ORDER BY id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Category
        public function read_single(){
            // Create query
            $query = 'SELECT 
                    id,
                    category
                FROM
                    '.$this->table .'
                WHERE 
                    id ='.$this->id;
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        // Create Category
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' (category)
                VALUES (:category)';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind Data
            $stmt->bindParam(':category', $this->category);
            
            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Category
        public function update(){
            // Create Query
            $query = 'UPDATE ' . $this->table . '
                SET 
                category = :category
                    WHERE 
                        id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':id', $this->id);
            
            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Category
        public function delete() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':id', $this->id);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
}