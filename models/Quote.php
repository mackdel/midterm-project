<?php 
    class Quote {
        // DB 
        private $conn;
        private $table = 'quotes';
        
        // Quote Properties 
        public $id;
        public $quote;
        public $author;
        public $category;
        public $author_id;
        public $category_id;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get all Quotes
        public function read(){
            // Create query
            $query = 'SELECT 
                    authors.author as author,
                    categories.category as category,
                    quotes.id as id,
                    quotes.quote as quote
                FROM
                    '.$this->table .' 
                LEFT JOIN
                    authors ON quotes.author_id = authors.id
                LEFT JOIN
                    categories ON quotes.category_id = categories.id
                ORDER BY quotes.id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Quote
        public function read_single(){
            if ($this->author_id && $this->category_id) {
                $where_condition = 'quotes.author_id ='.$this->author_id . ' AND quotes.category_id='.$this->category_id;
            }else if ($this->author_id){
                $where_condition = 'quotes.author_id ='.$this->author_id;
            } else if ($this->category_id){
                $where_condition = 'quotes.category_id ='.$this->category_id;
            } else {
                $where_condition = 'quotes.id ='.$this->id;
            }

            $query = 'SELECT 
                    authors.author as author,
                    categories.category as category,
                    quotes.id as id,
                    quotes.quote as quote
                FROM
                    '.$this->table .' 
                LEFT JOIN
                    authors ON quotes.author_id = authors.id
                LEFT JOIN
                    categories ON quotes.category_id = categories.id
                WHERE 
                    '.$where_condition .'
                ORDER BY quotes.id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);
            
            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        // Create Quote
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id)
                VALUES (:quote, :author_id, :category_id)';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind Data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Quote
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . '
                SET 
                    quote = :quote,
                    author_id = :author_id,
                    category_id = :category_id
                    WHERE 
                        id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
            
            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is soemthing goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }


        // Delete Quote
        public function delete(){
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
