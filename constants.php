<?php
    /**
     *  A PHP file to hold constants that are shared between the other PHP files
     *  within the Project Crescendo API - i.e. database logins and client IDs.
     *
     *  I looked up the use of the define() function at
     *  https://secure.php.net/manual/en/function.define.php
     *
     *  Author: Dylan McKee
     *  Date: 28/02/2016
     *
     */

    /**
     * The MySQL Database Host Address
     */
    define("DATABASE_HOST", "localhost");

    /**
     * The MySQL Database name
     */
    define("DATABASE_NAME", "crescendo");

    /**
     * The MySQL Database Username
     */
    define("DATABASE_USER", "SUPER_SECRET_USERNAME_HERE");

    /**
     * The super secret MySQL Database Password
     */
    define("DATABASE_PASSWORD", "SUPER_SECRET_PASSWORD_HERE");

    /**
     * The client ID - this value must be sent by the client when interacting
     * with this API, as a 'client_id' value in the JSON body posted to this API.
     *
     * If we ever develop the mobile client app on another platform, this value
     * will have to be stored in the database and associted with the relevant
     * secret for that particular app, but for now, it's fine to just define
     * this as a one-off constant.
     */
    define("CLIENT_ID", "VJyR29hQKnwG3R8CjbN6");

    /**
     * The client secret - this value must be sent by the client when interacting
     * with this API, as a 'client_secret' value in the JSON body posted to this API.
     *
     * If we ever develop the mobile client app on another platform, this value
     * will have to be stored in the database and associted with the relevant
     * id for that particular app, but for now, it's fine to just define
     * this as a one-off constant.
     */
    define("CLIENT_SECRET", "HgNzSKYJqQKyNT2mGVSUr4cUvMcGs2Ym7x3U5dHA");

?>
