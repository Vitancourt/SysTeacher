<?php

/**
 * SysTeacher Version
 *
 * @var	string
 *
 */
const SYSTEACHER_VERSION = '0.0.1';

/**
 * System name
 *
 * @var	string
 *
 */
const SYSTEM_NAME = 'SYSTEACHER';

/*
 * ------------------------------------------------------
 *  Load directory separator
 * ------------------------------------------------------
 */
const DS = DIRECTORY_SEPARATOR;

/*
 * ------------------------------------------------------
 *  Load defined path
 * ------------------------------------------------------
 */
const BASEPATH = "http://localhost/";

/*
 * ------------------------------------------------------
 *  Load defined system assets path
 * ------------------------------------------------------
 */
const ASSETS_SYSTEM = "http://localhost/assets/system/";

/*
 * ------------------------------------------------------
 *  Load defined landing page assets path
 * ------------------------------------------------------
 */
const ASSETS_LANDING = "http://localhost/assets/landing/";

/*
 * ------------------------------------------------------
 *  Load defined landing page assets path
 * ------------------------------------------------------
 */
const ASSETS = "http://localhost/assets/";

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 * CONTAINS MODEL, CONTROLLER, VIEW
 *---------------------------------------------------------------
 */
const APPLICATION = './application/';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 * TO UPLOADS
 *---------------------------------------------------------------
 */
const UPLOADS = './uploads/';


/*
 *---------------------------------------------------------------
 * SET LOCALE AND TIMEZONE
 *---------------------------------------------------------------
 */
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');


/*
 *---------------------------------------------------------------
 * SET CHARSET
 *---------------------------------------------------------------
 */
mb_internal_encoding("utf-8"); 
mb_http_output( "utf-8" );  
ob_start("mb_output_handler");   
header("Content-Type: text/html; charset=UTF-8",true);

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT)
	{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')){
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}else{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR

}