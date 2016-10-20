# Requirements and Code Quality
A simple authentication module

## Requirements
• PHP 7
• MySQL


## Setup
Create a settings.php file in the directory outside the public html. Configure it like the example below:

```php
<?php
class config {
	public static $SERVERNAME = "Server name";
	public static $USERNAME = "Username";
	public static $PASSWORD = "Password";
	public static $DBNAME = "Database name";
}
```

## How to test the application
An automated test can be found [here](http://http://csquiz.lnu.se:82/)

## Not currently implemented but is on my todo list
* Cookies
* Security issues like session hijacking and SQL injections
* Passwords not being hashed and salted

## Implement to your project
You can use this module to your project, all you need to do is import all files and call the init method in the RoutingController class.

## Live demo application
[Here you can find the live demo](http://php.lokecarlsson.se/)
