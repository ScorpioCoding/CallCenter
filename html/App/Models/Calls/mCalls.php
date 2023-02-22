<?php


namespace App\Models\Calls;

use PDO;
use PDOException;

use App\Core\Database;

use App\Core\NewException;



class mCalls extends Database
{

  public function __construct()
  {
    parent::__construct();
  }


  public static function setTable()
  {
    try {
      $query = "CREATE TABLE IF NOT EXISTS Calls (
        id SERIAL PRIMARY KEY,
        comType ENUM('customer','vendor'),
        comName VARCHAR(255),
        conFullName VARCHAR(255),
        callStatus VARCHAR(50),
        callLastDate DATE,
        callNextDate Date,
        callLog TEXT,
        contactId BIGINT UNSIGNED,
        userId BIGINT UNSIGNED
      )";

      $dB = static::getDb();


      return $dB->exec($query);
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  public static function create(array $args)
  {
    try {

      $query = "INSERT INTO `Calls` ( 
      `comType`, 
      `comName`, 
      `conFullName`,
      `callStatus`, 
      `callLastDate`,   
      `callNextDate`,   
      `callLog`,   
      `contactId`,
      `userId`
      )
      VALUES ( 
      :comType, 
      :comName, 
      :conFullName, 
      :callStatus, 
      :callLastDate,
      :callNextDate,
      :callLog,
      :companyId, 
      :userId
      )";


      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':conFullName', $args['conFullName'], PDO::PARAM_STR);

      $stmt->bindValue(':callStatus', $args['callStatus'], PDO::PARAM_STR);
      $stmt->bindValue(':callLastDate', $args['callLastDate'], PDO::PARAM_STR);
      $stmt->bindValue(':callNextDate', $args['callNextDate'], PDO::PARAM_STR);
      $stmt->bindValue(':callLog', $args['callLog'], PDO::PARAM_LOB);

      $stmt->bindValue(':companyId', $args['companyId'], PDO::PARAM_INT);
      $stmt->bindValue(':userId', $args['userId'], PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      print_r($e);
      return false;
    }
  }


  public static function update($args = array())
  {
    try {
      $query =
        "UPDATE `Company` SET 
        `comType`=:comType, 
        `comName`=:comName, 
        `conFullName`=:conFullName,
        `callStatus`=:callStatus, 
        `callLastDate`=:callLastDate, 
        `callNextDate`=:callNextDate, 
        `callLog`=:callLog, 
        `companyId`=:companyId, 
        `userId`=:userId
      WHERE `id`=:id ";

      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':id', $args['id'], PDO::PARAM_INT);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':conFullName', $args['conFullName'], PDO::PARAM_STR);

      $stmt->bindValue(':callStatus', $args['callStatus'], PDO::PARAM_STR);
      $stmt->bindValue(':callLastDate', $args['callLastDate'], PDO::PARAM_STR);
      $stmt->bindValue(':callNextDate', $args['callNextDate'], PDO::PARAM_STR);
      $stmt->bindValue(':callLog', $args['callLog'], PDO::PARAM_LOB);

      $stmt->bindValue(':companyId', $args['companyId'], PDO::PARAM_INT);
      $stmt->bindValue(':userId', $args['userId'], PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }


  public static function validate(array $args)
  {
    $errorList = array();

    if ($args['callLastDate'] == "")
      $errorList[] = 'Call Last Date Required !';


    if ($args['callNextDate'] == "")
      $errorList[] = 'Call Next Date Required !';

    if ($args['callLastDate'] > $args['callNextDate'])
      $errorList[] = 'Call Next Date is in the Past !';

    return $errorList;
  }










  //
  //END CLASS
}
