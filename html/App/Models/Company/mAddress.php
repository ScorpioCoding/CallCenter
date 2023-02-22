<?php


namespace App\Models\Company;

use PDO;
use PDOException;

use App\Core\Database;

use App\Core\NewException;



class mAddress extends Database
{

  public function __construct()
  {
    parent::__construct();
  }


  public static function setTable()
  {
    try {
      $query = "CREATE TABLE IF NOT EXISTS Address (
        id SERIAL PRIMARY KEY,
        comType ENUM('customer','vendor'),  
        comName VARCHAR(255),
        addType ENUM('location','billing','warehouse'),
        addLine1 VARCHAR(255),
        addLine2 VARCHAR(255),
        addPostal VARCHAR(50),
        addCity VARCHAR(255),
        addState VARCHAR(255),
        addCountry VARCHAR(255),
        companyId BIGINT UNSIGNED,
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

      $query = "INSERT INTO `Address` ( 
      `comType`, 
      `comName`, 
      `addType`,
      `addLine1`, 
      `addLine2`, 
      `addPostal`,
      `addCity`,
      `addState`,
      `addCountry`,
      `companyId`,
      `userId`
      )
      VALUES ( 
      :comType, 
      :comName, 
      :addType, 
      :addLine1, 
      :addLine2,
      :addPostal,
      :addCity,
      :addState,
      :addCountry,
      :companyId 
      :userId
      )";


      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':addType', $args['addType'], PDO::PARAM_STR);
      $stmt->bindValue(':addLine1', $args['addLine1'], PDO::PARAM_STR);
      $stmt->bindValue(':addLine2', $args['addLine2'], PDO::PARAM_STR);

      $stmt->bindValue(':addPostal', $args['addPostal'], PDO::PARAM_STR);
      $stmt->bindValue(':addCity', $args['addCity'], PDO::PARAM_STR);

      $stmt->bindValue(':addState', $args['addState'], PDO::PARAM_STR);
      $stmt->bindValue(':addCountry', $args['addCountry'], PDO::PARAM_STR);

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
        "UPDATE `Address` SET 
        `comType`=:comType, 
        `comName`=:comName, 
        `addType`=:addType,
        `addLine1`=:addLine1, 
        `addLine2`=:addLine2, 
        `addPostal`=:addPostal, 
        `addCity`=:addCity, 
        `addState`=:addState, 
        `addCountry`=:addCountry, 
        `companyId`=:companyId, 
        `userId`=:userId
      WHERE `id`=:id ";

      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':id', $args['id'], PDO::PARAM_INT);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':addType', $args['addType'], PDO::PARAM_STR);
      $stmt->bindValue(':addLine1', $args['addLine1'], PDO::PARAM_STR);
      $stmt->bindValue(':addLine2', $args['addLine2'], PDO::PARAM_STR);

      $stmt->bindValue(':addPostal', $args['addPostal'], PDO::PARAM_STR);
      $stmt->bindValue(':addCity', $args['addCity'], PDO::PARAM_STR);

      $stmt->bindValue(':addState', $args['addState'], PDO::PARAM_STR);
      $stmt->bindValue(':addCountry', $args['addCountry'], PDO::PARAM_STR);

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

    if ($args['addLine1'] == "")
      $errorList[] = 'Address Line 1 Required !';

    if ($args['addPost'] == "")
      $errorList[] = 'Address Postal Required !';

    if ($args['addCity'] == "")
      $errorList[] = 'Address City Required !';

    if ($args['addState'] == "")
      $errorList[] = 'Address State/Province Required !';

    if ($args['addCountry'] == "")
      $errorList[] = 'Address Country Required !';

    return $errorList;
  }

  //
  //END CLASS
}
