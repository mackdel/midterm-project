<?php
    function isValid($id, $model) {
        // set id on the model
        $model->id = $id;
        // call read_single from model
            // holds the statement
        $result = $model->read_single();
        // return results
            // true if there were 1+ rows affected by
        return ($result->rowCount() > 0);

        // return ($result != null); // use if return $model in read_single()
    }