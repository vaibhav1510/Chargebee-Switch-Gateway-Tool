<?php

require_once(dirname(__FILE__) . '/setup.php');

function switchGatewayBatch($srcGw, $destGw, $offset) {
    $params = array(
        "limit" => 50,
        "sortBy[asc]" => "created_at"
    );
    if (isset($offset)) {
        $params["offset"] = $offset;
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
    foreach ($custList as $custId) {
        switchGwOper($custId, $destGw);
        sleep(5);
    }
    return $offset;
}

function switchGwOper($custId, $destGw) {
    try {
        $result = ChargeBee_Card::switchGatewayForCustomer($custId, array(
                    "gateway" => $destGw));
//        $destCard = $result->card();
//        $destPm = $result->customer()->paymentMethod();
        performAction($custId, $result, null);
    } catch (Exception $e) {
        performAction($custId, null, $e);
    }
}

function switchGatewayForCustomers($srcGw, $destGw) {
    do {
        $offset = switchGatewayBatch($srcGw, $destGw, $offset);
    } while (isset($offset));
}
