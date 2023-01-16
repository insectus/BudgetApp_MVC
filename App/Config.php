<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'mvclogin';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'mvcUser';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '1234';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
	
	const SECRET_KEY = 'QWERTY1234';
	
	const PHP_MAILER_HOST = 'smtp.gmail.com';
	
	const PHP_MAILER_USERNAME = 'damian.krzaszcz.programista@gmail.com';
	
	const PHP_MAILER_PASSWORD = 'twfgmwgthlpzlzpu';
	
	
}
