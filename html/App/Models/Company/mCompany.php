<?php


namespace App\Models\Company;

use PDO;
use PDOException;

use App\Core\Database;

use App\Core\NewException;



class mCompany extends Database
{

  public function __construct()
  {
    parent::__construct();
  }


  public static function setTable()
  {
    try {
      $query = "CREATE TABLE IF NOT EXISTS Company (
        id SERIAL PRIMARY KEY,
        comType ENUM('customer','vendor'),
        comName VARCHAR(50),  
        comEmail VARCHAR(255),
        comPhone VARCHAR(20),
        comVat VARCHAR(20),
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

      $query = "INSERT INTO `Company` ( 
      `comType`, 
      `comName`, 
      `comEmail`,
      `comPhone`, 
      `comVat`, 
      `userId`
      )
      VALUES ( 
      :comType, 
      :comName, 
      :comEmail, 
      :comPhone, 
      :comVat, 
      :userId
      )";


      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);
      $stmt->bindValue(':comEmail', $args['comEmail'], PDO::PARAM_STR);
      $stmt->bindValue(':comPhone', $args['comPhone'], PDO::PARAM_STR);
      $stmt->bindValue(':comVat', $args['comVat'], PDO::PARAM_STR);
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
        `comEmail`=:comEmail,
        `comPhone`=:comPhone, 
        `comVat`=:comVat, 
        `userId`=:userId
      WHERE `id`=:id ";

      $dB = static::getdb();
      $stmt = $dB->prepare($query);

      $stmt->bindValue(':id', $args['id'], PDO::PARAM_INT);

      $stmt->bindValue(':comType', $args['comType'], PDO::PARAM_STR);
      $stmt->bindValue(':comName', $args['comName'], PDO::PARAM_STR);

      $stmt->bindValue(':comEmail', $args['comEmail'], PDO::PARAM_STR);
      $stmt->bindValue(':comPhone', $args['comPhone'], PDO::PARAM_STR);
      $stmt->bindValue(':comVat', $args['comVat'], PDO::PARAM_STR);
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

    if ($args['comName'] == "")
      $errorList[] = 'Company Name Required !';

    if (filter_var($args['comEmail'], FILTER_VALIDATE_EMAIL) === false)
      $errorList[] = 'Email Invalid!';

    if ($args['comVat'] == "")
      $errorList[] = 'Company VAT Required !';

    return $errorList;
  }

  //
  //END CLASS
}
