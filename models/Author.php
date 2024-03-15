<?php
    class Author {
         // DB stuff
         private $conn;
         private $table = 'authors';
 
         // Author Properties
         public $id;
         public $author;
 
         // Constructor with DB
         public function __construct($db){
             $this->conn = $db;
         }

         // Get All Authors
        public function read(){
            // Create query
            $query = 'SELECT 
                    id,
                    author
                FROM
                    '.$this->table .'
                ORDER BY id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);
            
            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Author
        public function read_single(){
            // Create query
            $query = 'SELECT 
                    id,
                    author
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

        // Create Author
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' (author)
                VALUES (:author)';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind Data
            $stmt->bindParam(':author', $this->author);
            
            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Author
        public function update(){
            // Create Query
            $query = 'UPDATE ' . $this->table . '
                SET 
                    author = :author
                    WHERE 
                        id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':id', $this->id);
            
            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Author
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