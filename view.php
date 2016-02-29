<?php
    /*
        A simple web API to allow MusicXML to be retrived and downloaded from a
        MySQL database; written for PHP5.3 with MySQLi, as part of the
        Project Crescendo team project app.

        Author: Dylan McKee
        Date: 28/02/2016

        API REFERENCE
        Endpoint: GET view.php
        Input: A GET parameter called 'id', containing the id number of the composition you want to download.
               (e.g. /view?id=1 - would display a composition with the id of 1)
        Output: If a composition with that id number exists, then a MusicXML file is downloaded containing the composition.
                Otherwise, a plaintext error is returned.

    */

    // Import constants so we can access the databse
    require 'constants.php';

    // Import error handling code
    require 'errors.php';

    // Get ID for composition...
    $composition_id = $_GET["id"];

    // Ensure the ID is valid...
    if (empty($composition_id)) {
        // No ID, so not valid. Send error accordingly...
        send_invalid_composition_error();
    }

    // Open a databse connection
    // I looked up the MySQLi SELECT at http://www.w3schools.com/php/php_mysql_select.asp
    $connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);

    // Ensure connection exists before continuing...
    if (mysqli_connect_errno()) {
        // Connection failed, send database error and give up
        send_generic_database_error();

    }

    // Escape the ID to an integer, just in-case...
    $id_number = intval($composition_id);

    // Formulate the query to get the desired composition to the database
    $sql_query = "SELECT * FROM `compositions` WHERE `id` =  $id_number";

    // Perform query....
    $result = mysqli_query($connection, $sql_query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Get composition content out of the result
        $composition_data = $row["composition_content"];


        // Check there's some data there...
        if (empty($composition_data)) {
            // No compostion data, send error...
            send_no_composition_error();

        }


        // We're returning MusicXML, set the content type header accordingly...
        // I looked up the MusicXML MIME type at https://www.ietf.org/mail-archive/web/xml-mime/current/msg00061.html
        header('Content-Type: application/vnd.recordare.musicxml+xml');

        // Ensure this is classed as a download....
        // I looked this up at http://www.media-division.com/the-right-way-to-handle-file-downloads-in-php/
        header("Content-Disposition: attachment; filename=\"composition.xml\"");

        // Send MusicXML content...
        echo $composition_data;


    } else {
        // None found.
        send_no_composition_error();

    }

    // Close database connection now that we have the composition.
    mysqli_close($connection);

?>
