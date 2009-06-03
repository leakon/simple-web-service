<?php
/****************************************************************************
 * DRBImageVerification
 * http://www.dbscripts.net/imageverification/
 *
 * Copyright � 2007 Don Barnes
 ****************************************************************************/

// Length of challenge string
$CHALLENGE_STRING_LENGTH = 4;

// Characters that will be used in challenge string
$CHALLENGE_STRING_LETTERS = 'ABCDEFGHJKLMNPQRTUVWXY3678@#$&*+?';
$CHALLENGE_STRING_LETTERS = 'ABCDEFGHJKLMNPQRTUVWXYabcdefghjkmnpqrty1234567890';


$CHALLENGE_STRING_SESSION_NAME = 'cnro2009';

// Name of session variable that will be used by the script.
// You shouldn't need to change this unless it collides with a
// session variable you are using.
$CHALLENGE_STRING_SESSION_VAR_NAME = 'auth_code';

// Font size of challenge string in image
$CHALLENGE_STRING_FONT_SIZE = 5;

// Whether background pattern is enabled
$CHALLENGE_BACKGROUND_PATTERN_ENABLED = TRUE;

// Font size of characters in background pattern
$CHALLENGE_BACKGROUND_STRING_FONT_SIZE = 1;

// Whether image should alternate between dark-on-light and
// light-on-dark
$CHALLENGE_ALTERNATE_COLORS = TRUE;

// How much padding there should be between the edge of the image
// and the challenge string bounds
$CHALLENGE_STRING_PADDING = 4;	// in pixels

// Whether the entered verification code should be converted to upper-case.
// In effect, this makes the verification code case-insensitive.
$CHALLENGE_CONVERT_TO_UPPER = TRUE;
