<?php


namespace App\Models\Company;

use PDO;
use PDOException;

use App\Core\Database;

use App\Core\NewException;



class mContacts extends Database
{

  public function __construct()
  {
    parent::__construct();
  }


  public static function setTable()
  {
    try {
      $query = "CREATE TABLE IF NOT EXISTS Contacts (
        id SERIAL PRIMARY KEY,
        comType ENUM('customer','vendor'),
        comName VARCHAR(255),
        conFullName VARCHAR(255),
        conGender ENUM('male','female','other'),
        conFName VARCHAR(255),
        conLName VARCHAR(255),  
        conEmail VARCHAR(255),
        conPhone VARCHAR(255),
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

      $query = "INSERT INTO `Contacts` ( 
      `comType`, 
      `comName`, 
      `conFullName`,
      `conGender`, 
      `conFName`, 
      `conLName`,
      `conEmail`,
      `conPhone`,
      `companyId`,
      `userId`
      )
      VALUES ( 
      :comType, 
      :comName, 
      :conFullName, 
      :conGender, 
      :conFName,
      :conLName,
      :conEmail,
      :conPhone,
      :companyId, 
      :userId
      )";


      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':conFullName', $args['conFullName'], PDO::PARAM_STR);
      $stmt->bindValue(':conGender', $args['conGender'], PDO::PARAM_STR);
      $stmt->bindValue(':conFName', $args['conFName'], PDO::PARAM_STR);
      $stmt->bindValue(':conLName', $args['conLName'], PDO::PARAM_STR);

      $stmt->bindValue(':conEmail', $args['conEmail'], PDO::PARAM_STR);
      $stmt->bindValue(':conPhone', $args['conPhone'], PDO::PARAM_STR);

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
        "UPDATE `Contacts` SET 
        `comType`=:comType, 
        `comName`=:comName, 
        `conFullName`=:conFullName,
        `conGender`=:conGender, 
        `conFName`=:conFName, 
        `conLName`=:conLName,
        `conEmail`=:conEmail,
        `conPhone`=:conPhone,
        `companyId`=:companyId,
        `userId`=:userId
      WHERE `id`=:id ";

      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':id', $args['id'], PDO::PARAM_INT);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':conFullName', $args['conFullName'], PDO::PARAM_STR);
      $stmt->bindValue(':conGender', $args['conGender'], PDO::PARAM_STR);
      $stmt->bindValue(':conFName', $args['conFName'], PDO::PARAM_STR);
      $stmt->bindValue(':conLName', $args['conLName'], PDO::PARAM_STR);

      $stmt->bindValue(':conEmail', $args['conEmail'], PDO::PARAM_STR);
      $stmt->bindValue(':conPhone', $args['conPhone'], PDO::PARAM_STR);

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

    if ($args['conFName'] == "")
      $errorList[] = 'First Name Required !';

    if ($args['conLName'] == "")
      $errorList[] = 'Last Name Required !';

    if (filter_var($args['conEmail'], FILTER_VALIDATE_EMAIL) === false)
      $errorList[] = 'Email Invalid!';

    if ($args['conPhone'] == "")
      $errorList[] = 'Phone/Mobile Required !';

    return $errorList;
  }

  //
  //END CLASS
}
