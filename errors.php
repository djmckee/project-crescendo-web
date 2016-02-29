<?php
    /*
        A PHP file to generate JSON encoded HTTP error info to send back to the
        app from the API, for the Project Crescendo team project web back-end.

        Author: Dylan McKee
        Date: 28/02/2016

    */

    // A simple function to send a generic database error if an SQL connection/query fails, to avoid code duplication.
    function send_generic_database_error() {
        $response['error'] = 'Database error.';

        // Set a server error
        header('HTTP/1.0 500 Internal Server Error');

        // Convert to JSON
        $json_response = json_encode($response);

        // Respond with json error and exit the program
        exit($json_response);

        // Ensure we do not continue.
        die();

    }

    // A function to send an invalid composition ID error and quit.
    function send_invalid_composition_error() {
        // Display error
        echo "Invalid Composition ID - please check the URL and try again.";

        // End.
        die();
    }

    // A function to send an error to tell the user that the composition they want doesn't exist, and then quit.
    function send_no_composition_error() {
        // Display error
        echo "Composition not found, sorry.";

        // Set a server error
        header('HTTP/1.0 404 Not Found');

        // End.
        die();
    }

?>
