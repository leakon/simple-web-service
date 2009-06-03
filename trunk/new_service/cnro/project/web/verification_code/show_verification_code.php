<?php
/****************************************************************************
 * DRBImageVerification
 * http://www.dbscripts.net/imageverification/
 *
 * Copyright © 2007 Don Barnes
 ****************************************************************************/

	require_once(dirname(__FILE__) . '/challenge.inc.php');

	// Create challenge string
	createChallengeString();

	// Output challenge image to user
	outputChallengeImage();
