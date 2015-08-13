<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 */
 CakePlugin::loadAll(); // Loads all plugins at once
 //CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

function vdump()
{
    $args = func_get_args();
    $bt = debug_backtrace();
    
    while(count($bt) && !isset($bt[0]['file']))
    {
        array_shift($bt);
    }
    
    $file = str_replace(dirname(ROOT).'/','',$bt[0]['file']);
    $line = $bt[0]['line'];
    
    echo "\nVARS(".count($args).") >> $file($line):\n";
    $i=1;
    foreach($args as $arg)
    {
        echo '<pre class="dump">';
        echo "[$i] ".htmlentities(print_r($arg,true), ENT_COMPAT, Configure::read('App.encoding'));
        echo '</pre>';
        $i++;
    }
    
    return;
}

function ddump()
{
    $args = func_get_args();
    vdump($args);
    exit(0);
}

function edump()
{
    $args = func_get_args();
    $bt = debug_backtrace();
    
    while(count($bt) && !isset($bt[0]['file']))
    {
        array_shift($bt);
    }
    
    $file = str_replace(dirname(ROOT).'/','',$bt[0]['file']);
    $line = $bt[0]['line'];
    
    $log = "VARS(".count($args).") >> $file($line):\n";
    
    $i=1;
    
    foreach($args as $arg)
    {
        $log .= "[$i] ".print_r($arg,true)."\n";
        $i++;
    }
    
    error_log($log);
    
    return;
}

function btdump()
{
    $log='';
    $bt = debug_backtrace();
    
    while(count($bt) && !isset($bt[0]['file']))
    {
        array_shift($bt);
    }
    
    foreach($bt as $i => $b)
    {
        $class = isset($b['class']) ? ' '.$b['class'].'{' : null;
        $classEnd = isset($b['class']) ? '}' : null;
        $func = isset($b['function']) ? ' function '.$b['function'].'(' : '';
        $funcEnd = isset($b['function']) ? ')' : '';
        $args = (count($b['args'])) ? "\n".print_r($b['args'],true) : '';
        $file = (isset($b['file'])) ? $b['file'] : null;
        $line = (isset($b['line'])) ? $b['line'] : null;
        $log .= "[$i] ".str_replace(dirname(ROOT).'/','',$file).'('.$line.') >> '.$class.$func.$args.$funcEnd.$classEnd."\n";
    }
    
    error_log("BACKTRACE(".count($bt)."):\n".$log);
    
    return;
}
