<?php

/**
 * Chargebee Environment Setup
 */
require('./config.php');
require($CLIENT_LIB_PATH);

//ChargeBee_Environment::$scheme = "https";
//ChargeBee_Environment::$chargebeeDomain = "chargebee.com";

/**
 * Below are the configuration setting our customers will use to connect to our production server.
 */
ChargeBee_Environment::configure($SITE_NAME, $API_KEY);


