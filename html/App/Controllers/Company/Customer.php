<?php

namespace App\Controllers\Company;

use App\Core\Controller;
use App\Core\View;
use App\Core\Translation;

use App\Utils\Meta;
use App\Utils\Auth;
use App\Utils\Functions;

use App\Models\mCommon;
use App\Models\Company\mCompany;

/**
 *  Customer Dashboard
 */
class Customer extends Controller
{
  protected function before()
  {
    if (!Auth::sessionValide())
      self::redirect('/admin');
  }

  public function indexAction($args = array())
  {
    //MetaData
    $meta = array();
    $meta = (new Meta($args))->getMeta();
    // Translation
    $trans = array();
    //$trans = Translation::translate($args);
    // Extra data
    $data = array();
    $data['userPermission'] = Auth::getSession('user_permission');
    $data['userId'] = Auth::getSession('user_id');

    if (mCommon::testForTable('Company')) {
      $company = mCommon::readTableByType('Company', 'customer');
    }

    if ($_POST['searchName']) {
      $company = mCommon::searchTableByName('Company', $_POST['searchName']);
      $data['searchName'] = $_POST['searchName'];
    }


    $args['template'] = 'Backend';
    View::render($args, $meta, $trans, [
      'data' => $data,
      'company' => $company,
    ]);
  }

  public function createAction($args = array())
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $method = $_SERVER['REQUEST_METHOD'];
    if ('POST' === $method) {
      $data = json_decode(file_get_contents('php://input'), true);
      if ($data) {
        $res = mCompany::validate($data);
        $response = array();
        if ($res) {
          //There are errors 
          header('HTTP/1.1 200 OK');
          $response = $res;
        } else {
          // THere are no errors thus create user and redirect
          mCompany::create($data);
          header('HTTP/1.1 200 OK');
          $response = "done";
        }
      } else {
        // No movie title was provided, we cannot get the movie
        header('HTTP/1.1 400 Bad Request');
        $response['error'] = "No data was provided!";
      }
    } else {
      header('HTTP/1.1 405 Method not allowed');
      $response['error'] = "Invalid Method";
    }
    // Display Results
    echo (json_encode($response));
  }

  public function updateAction($args = array())
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $method = $_SERVER['REQUEST_METHOD'];
    if ('PUT' === $method) {
      $data = json_decode(file_get_contents('php://input'), true);
      if ($data) {
        $res = mCompany::validate($data);
        $response = array();
        if ($res) {
          //There are errors 
          header('HTTP/1.1 200 OK');
          $response = $res;
        } else {
          // THere are no errors thus create user and redirect
          mCompany::update($data);
          header('HTTP/1.1 200 OK');
          $response = "done";
        }
      } else {
        // No movie title was provided, we cannot get the movie
        header('HTTP/1.1 400 Bad Request');
        $response['error'] = "No data was provided!";
      }
    } else {
      header('HTTP/1.1 405 Method not allowed');
      $response['error'] = "Invalid Method";
    }

    // Display Results
    echo (json_encode($response));
  }


  protected function after()
  {
  }

  //END-Class
}
