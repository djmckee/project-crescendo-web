<?php
    /*
        A simple web API to allow MusicXML to be uploaded and stored in a
        MySQL database; written for PHP5.3 with MySQLi, as part of the
        Project Crescendo team project app.

        Author: Dylan McKee
        Date: 28/02/2016

        API REFERENCE
        Endpoint: POST upload.php
        Input: A MusicXML string, set to 'musicxml_content' in the POST request body
        Output: If successful, a JSON object containing a URL and URL component that point to the uploaded composition

    */

    // Import constants so we can access the databse
    require 'constants.php';

    // Import error handling code
    require 'errors.php';


    // The upload API returns only JSON
    header('Content-Type: application/json');

    // Get content from POST variable
    $content = $_POST["musicxml_content"];

    // Check content is not null
    if (empty($content)) {
        send_no_content_error();

    }

    // If we got to this point, we have a valid composition - get it saved.

    // Open a databse connection
    // I looked up MySQLi at http://www.w3schools.com/php/func_mysqli_real_escape_string.asp
    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);

    // Ensure connection exists before continuing...
    if (mysqli_connect_errno()) {
        // Connection failed, send database error and give up
        echo mysqli_connect_errno();
        echo mysqli_connect_error();

        send_generic_database_error();

    }

    // Escape composition to avoid SQL injection attack!
    $escaped_content = mysqli_real_escape_string($connection, $content);

    // Formulate the query to add the composition to the database
    $sql_query = "INSERT INTO compositions (composition_content) VALUES ('$escaped_content')";


    // Run the query, and see if it succeeds...
    if (!mysqli_query($connection, $sql_query)) {
        // Something went wrong...

        mysqli_close($connection);

        send_generic_database_error();

    } else {
        // Success, get ID of new composition...
        // I looked up how to do this at http://www.w3schools.com/php/php_mysql_insert_lastid.asp
        $composition_id = mysqli_insert_id($connection);

        // Close connection now that we're done
        mysqli_close($connection);

        // Respond with a JSON dict containing the ID, the ID attached to the view endpoint, and a full URI string to view the composition too...
        $response['composition_id'] = $composition_id;

        // Add in view endpoint
        $response['composition_view_endpoint'] = ('view.php?id='.$composition_id);

        // Add in view URL
        $response['composition_view_url'] = ('http://homepages.cs.ncl.ac.uk/2015-16/csc2022_team13/view.php?id='.$composition_id);

        // Convert to JSON
        $json_response = json_encode($response);

        // Respond with json object and exit the program.
        exit($json_response);

    }


?>
