<?

require_once(dirname(__FILE__) . '/cb-switch-gw-tool/helper.php');

$srcGW = "pin";
$destGw = "stripe";

switchGatewayForCustomers($srcGW, $destGw);

/**
 * This function will be invoked in loop. If you want to perform any action on the result you can do so. 
 * The $result is the response provided by the switch gateway API. Reference: https://apidocs.chargebee.com/docs/api/cards#switch_gateway
 * You can also create a list of this result and perform the operation later.
 * @param type $result
 */
function performAction($result) {
    // print_r($destCard);
}
