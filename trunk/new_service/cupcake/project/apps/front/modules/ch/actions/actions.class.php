<?php

/**
 * ch actions.
 *
 * @package    cupcake
 * @subpackage ch
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class chActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function XXexecuteIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  


	public function executeIndex(sfWebRequest $request)
	{
	}

	public function executeMenu(sfWebRequest $request)
	{
	}

	public function executeFaq(sfWebRequest $request)
	{
	}

	public function executePolicy(sfWebRequest $request)
	{
	}

	public function executeFindUs(sfWebRequest $request)
	{
	}

	public function executeCupcakes(sfWebRequest $request)
	{
	}

	public function executePanini(sfWebRequest $request)
	{
	}
  
  
}
