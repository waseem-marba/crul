<?php
session_start();
include_once 'Http/Http.php';
include_once 'resources/AccountValidationResource.php';
include_once 'resources/RiskIndexResource.php';
include_once 'resources/RiskIndividualResource.php';

if(isset($_POST['submit'])){
  /**
   * Here we have to get api end points from database, but for now i just put them in array to get specified api on the
   * basis of user selection
   */
    $api_endpoints = [
        'Validifiv3-fi-risk-index' => 'https://de20dc0b-4015-431e-ae42-0dbc6260eee3.mock.pstmn.io/validifiv3-fi-risk-index',
        'Validifiv3-account-validation' => 'https://de20dc0b-4015-431e-ae42-0dbc6260eee3.mock.pstmn.io/validifiv3-account-validation',
        'Validifiv3-pi-risk4-individual' => 'https://de20dc0b-4015-431e-ae42-0dbc6260eee3.mock.pstmn.io/validifiv3-pi-risk4-individual'
    ];

    $api = $_POST['api'];
    
    // Check if api value send by user doesnot exists
    if(!isset($api_endpoints[$api])){
        $_SESSION['response']['error'] = 'Invalid API Request';
        header("Location: index.php");
    }

    
    $http = new Http();
    $result = $http->get($api_endpoints[$api]);
    $response = [];

    // Parsing api response, Every api has separate parser
    if(empty($result['error'])){
        switch ($api) {
            case "Validifiv3-fi-risk-index":
              $response['data'] = RiskIndexResource::jsonResponse($result['response']);
              break;
            case "Validifiv3-account-validation":
                $response['data'] = AccountValidationResource::jsonResponse($result['response']);
              break;
            case "Validifiv3-pi-risk4-individual":
                $response['data'] = RiskIndividualResource::jsonResponse($result['response']);
              break;
            default:
              $response['error'] = 'Invalid API Request';
        }
    }else{
        $response['error'] = $result['error'];
    }

    $_SESSION['response'] = $response;
    header("Location: index.php");
}



?>