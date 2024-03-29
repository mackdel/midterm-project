<?php  
    // Get Author
    $result = $author->read_single();

    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Set Properties
    $author->author = $row['author'];

    // Create Author Array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    // Display JSON of Author Array
    print_r(json_encode($author_arr));