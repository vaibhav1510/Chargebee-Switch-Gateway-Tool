<?php

require_once(dirname(__FILE__) . '/setup.php');

$offset = "";

function retrieveCustomersWithSourceGateway($srcGw) {
    $params = array(
        "limit" => 5,
        "sortBy[asc]" => "created_at"
    );
    if (isset($offset)) {
        array_push($params, "offset", $offset);
    }

    $all = ChargeBee_Customer::all($params);
    $offset = $all->nextOffset();

    $custList = array();
    foreach ($all as $res) {
        $customer = $res->customer();
        $pm = $customer->paymentMethod;
        if (is_null($pm)) {
            continue;
        }
        if ($pm->gateway == $srcGw) {
            array_push($custList, $customer->id);
        }
    }
    return $custList;
}

function switchGatewayBatch($srcGw, $destGw) {
    $custList = retrieveCustomersWithSourceGateway($srcGw, $destGw);
    foreach ($custList as $custId) {
        switchGwOper($custId, $destGw);
        sleep(2);
    }
}

function switchGwOper($custId, $destGw) {
    try {
        $result = ChargeBee_Card::switchGatewayForCustomer($custId, array(
                    "gateway" => $destGw));
//        $destCard = $result->card();
        $destPm = $result->customer()->paymentMethod();
        performAction($result);
        echo 'cust_id: ' . $custId . ', oper_status: SUCCESSFUL, card_gateway: ' . $destPm->gateway . ', reference_id' . $destPm->referenceId . "\n";
    } catch (Exception $e) {
        echo 'cust_id: ' . $custId . ', oper_status: FAILURE' . ', error_message:' . $e->getMessage() . "\n";
    }
}

function switchGatewayForCustomers($srcGw, $destGw) {
    do {
        switchGatewayBatch($srcGw, $destGw);
    } while (isset($offset));
}
