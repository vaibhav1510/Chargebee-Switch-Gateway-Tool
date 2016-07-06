<?php

/**
 * Chargebee Environment Setup
 */
require_once(dirname(__FILE__) . '/config.php');
require_once($CLIENT_LIB_PATH);

//ChargeBee_Environment::$scheme = "http";
//ChargeBee_Environment::$chargebeeDomain = "localcb.in:8080";

/**
 * Below are the configuration setting our customers will use to connect to our production server.
 */
ChargeBee_Environment::configure($SITE_NAME, $API_KEY);


