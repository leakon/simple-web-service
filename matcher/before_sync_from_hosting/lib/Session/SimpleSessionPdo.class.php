<?php

/**
 * SimpleSessionPdo
 *
 */
class SimpleSessionPdo extends sfPDOSessionStorage {

  /**
   * Writes session data.
   *
   * @param  string $id    A session ID
   * @param  string $data  A serialized chunk of session data
   *
   * @return bool true, if the session was written, otherwise an exception is thrown
   *
   * @throws <b>DatabaseException</b> If the session data cannot be written
   */
  public function sessionWrite($id, $data)
  {
    // get table/column
    $db_table    = $this->options['db_table'];
    $db_data_col = $this->options['db_data_col'];
    $db_id_col   = $this->options['db_id_col'];
    $db_time_col = $this->options['db_time_col'];

#    $sql = 'UPDATE '.$db_table.' SET '.$db_data_col.' = ?, '.$db_time_col.' = '.time().' WHERE '.$db_id_col.'= ?';

	$sql		= 'UPDATE '.$db_table.' SET '.$db_data_col.' = ?, '.$db_time_col.' = '.time().', user_id = ?  WHERE '.$db_id_col.'= ?';
	$userObject	= sfContext::getInstance()->getUser();
	$userId		= 0;
	if ($userObject) {
		$userId		= $userObject->getId();
	}

    try
    {
      $stmt = $this->db->prepare($sql);

/*
      $stmt->bindParam(1, $data, PDO::PARAM_STR);
      $stmt->bindParam(2, $id, PDO::PARAM_STR);
*/

	$stmt->bindParam(1, $data, PDO::PARAM_STR);
	$stmt->bindParam(2, $userId, PDO::PARAM_INT);
	$stmt->bindParam(3, $id, PDO::PARAM_STR);


      $stmt->execute();
    }
    catch (PDOException $e)
    {
      throw new sfDatabaseException(sprintf('PDOException was thrown when trying to manipulate session data. Message: %s', $e->getMessage()));
    }

    return true;
  }

}
