<?php

namespace App\Controllers\Calls;

use App\Core\Controller;
use App\Core\View;
use App\Core\Translation;

use App\Utils\Meta;
use App\Utils\Auth;
use App\Utils\Functions;

use App\Models\mCommon;

/**
 *  Calls Dashboard
 */
class Calls extends Controller
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
    $data['user_permission'] = Auth::getSession('user_permission');
    $data['user_id'] = Auth::getSession('user_id');

    if (mCommon::testForTable('Calls')) {
      $calls = mCommon::readTable('Calls');
    }



    $args['template'] = 'Backend';
    View::render($args, $meta, $trans, [
      'data' => $data,
      'calls' => $calls,
    ]);
  }



  protected function after()
  {
  }

  //END-Class
}
