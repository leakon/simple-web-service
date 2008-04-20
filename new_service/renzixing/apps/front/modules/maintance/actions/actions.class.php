<?php
// auto-generated by sfPropelCrud
// date: 2008/04/20 13:43:24
?>
<?php

/**
 * maintance actions.
 *
 * @package    renzixing
 * @subpackage maintance
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class maintanceActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('maintance', 'list');
  }

  public function executeList()
  {
    $this->maintances = MaintancePeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->maintance = MaintancePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->maintance);
  }

  public function executeCreate()
  {
    $this->maintance = new Maintance();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->maintance = MaintancePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->maintance);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $maintance = new Maintance();
    }
    else
    {
      $maintance = MaintancePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($maintance);
    }

    $maintance->setId($this->getRequestParameter('id'));
    $maintance->setUserId($this->getRequestParameter('user_id'));
    $maintance->setMaintanceDetail($this->getRequestParameter('maintance_detail'));

    $maintance->save();

    return $this->redirect('maintance/show?id='.$maintance->getId());
  }

  public function executeDelete()
  {
    $maintance = MaintancePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($maintance);

    $maintance->delete();

    return $this->redirect('maintance/list');
  }
}
