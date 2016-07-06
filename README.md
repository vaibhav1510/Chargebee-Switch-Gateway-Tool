# Chargebee-Switch-Gateway-Tool
Switching Credit Cards from one gateway to Another for all the Chargebee customers. It usage Chargsbee's [switch gateway API](https://apidocs.chargebee.com/docs/api/cards#switch_gateway).


Change the following variables [config.php](https://github.com/vaibhav1510/chargebee-switch-gateway-tool/blob/master/cb-switch-gw-tool/config.php) file.

* SITE_NAME - Your domain name
* API_KEY - Get it from Chargbee console
* CLIENT_LIB_PATH - path_to ChargeBee.php


Specify the source and destination gateway variables [SwitchGateway.php](https://github.com/vaibhav1510/chargebee-switch-gateway-tool/blob/master/SwitchGateway.php) file. Then execute [SwitchGateway.php](https://github.com/vaibhav1510/chargebee-switch-gateway-tool/blob/master/SwitchGateway.php) file to switch the gateway from one gateway to another.






