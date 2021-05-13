# Debugging in PHP using xdebug and Webgrind

## What is Xdebug:
- profiling and debugging tool used on profiling(tracks each part of the script required to execute) servers
- remote debugging

## Installation: 
- echo ```phpinfo()```
- copy the entire page
- put it in https://xdebug.org/wizard
- it will give you dll file
- place it in ```C:\xampp\php\ext\``` (if there's already a file with name php_xdebug.dll, delete it and replace it with our newly downloaded file)
- make a dedicated folder in which your cachegrinds will be stored => ```C:\xampp\htdocs\logs\cachegrind```
- go to php.ini and add following block of code,
```
	[XDebug]
	zend_extension="C:\xampp\php\ext\php_xdebug.dll"
	xdebug.mode=develop,debug,profile
	xdebug.start_with_request = trigger
	xdebug.client_host=127.0.0.1
	xdebug.client_port=9003
	xdebug.output_dir="C:\xampp\htdocs\logs\cachegrind"
	xdebug.profiler_output_name="cachegrind.out.%p-%H-%R"
```
- Now restart your server
- For processing cachegrind files, you need a client => https://github.com/jokkedk/webgrind
Put this in a folder which is accessible by server so that you can access it using URL


## Displaying variables
- you need ```html_errors``` to be ```On``` in your ```php.ini``` for this
- ```xdebug_debug_zval```
    Shows,
	1. type
	2. value
	3. ref count(when variable is passed to function by ref)
- How to use it in a program,
```
<?php
    function a($arg){
        xdebug_debug_zval('arg');
        b($arg);
    }
    
    function b(&$arg){
        xdebug_debug_zval('arg');
        d('delta');
    }
    
    function d($arg){
        xdebug_debug_zval('arg');
        trigger_error('custom notice', E_USER_NOTICE);
        trigger_error('custom warning', E_USER_WARNING);
        trigger_error('custom error', E_USER_ERROR);
    }

    a('alpha');
?>
```
- get all the variable declared in the current scope
	- this needs a little bit more configuration in php.ini
		```
        xdebug.collect_vars=1
		xdebug.show_local_vars=1
		xdebug.collect_params=4
		```
- ```var_dump(xdebug_get_declared_vars());```
- If you get the error: "Fatal error: Uncaught Error: Call to undefined function"

## Configure Xdebug in VS Code: https://youtu.be/LNIvugvmCyQ

## Profiling:
- Whatever endpoint needs to be profiled can be appended with ```<url>?XDEBUG_PROFILE=1```
- this lets the xdebugger know that this particular URL needs to be profiled and recorded
- Xdebug does this using cachegrind file which is stores at the location given by you in ```xdebug.output_dir``` in ```php.ini```
- Once this file is stored it can be automatically detected by your cachegrind client (in this case webgrind) and anylysed
- go to ```localhost/webgrind```(this can be different based your installation)
- select the cachegrind file from the dropdown
- select ```coverage```(how much function calls you want webgrind to display) and  ```%ge/ms/micros``` according to your need
- Intricacies of webgrind dashboard:
	- columns:
		1. type of call(procedural/internal)
		2. Function and its path
		3. link to code
		4. Invocation count: number of times the function has been invoked
		5. Total self cost(aggregate cost of the function itself)(by default webgrind sorts results using this column)
		6. Total Inclusion code(how long does the function takes to execute including every function call in it)
	- Show call graph(flow chart of script execution)
	- incase you want to hide php core fucntions click in checkbox -> hide PHP functions
	- when self cost ~= inclusive code ==> focus on that 

