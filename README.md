# Major_Project
This repo is for major project of college. In this project, we build a project allocation and management system which helps an organization to maintain and allocate a project in an efficient way. An administrator can create a project workspace and can add managers and developers in the project. A manager can create a task under a workspace and can add a developer in it and a developer will provide a time logs according to percentage they have completed.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them

```
PHP 6.0.15 or newer
Tomcat server
MySQL Database
```

### Installing 
###Installing Apache

A step by step series of examples that tell you have to get a development env running

 A package manager allows us to install most software pain-free from a repository maintained by Ubuntu. 

 For our purposes, we can get started by typing these commands:

```
sudo apt-get update
sudo apt-get install apache2
```
###Installing MySQL
Now that we have our web server up and running, it is time to install MySQL. MySQL is a database management system. Basically, it will organize and provide access to databases where our site can store information.

Again, we can use apt to acquire and install our software. This time, we'll also install some other "helper" packages that will assist us in getting our components to communicate with each other:

```
sudo apt-get install mysql-server
```
###Installing PHP
PHP is the component of our setup that will process code to display dynamic content. It can run scripts, connect to our MySQL databases to get information, and hand the processed content over to our web server to display.

We can once again leverage the apt system to install our components. We're going to include some helper packages as well, so that PHP code can run under the Apache server and talk to our MySQL database:
```
sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql
```

For more references of installation, visit: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04
## Running the Application

you need to paste the project in
```
/var/www/html
```
and you can access it by using
```
http://localhost/Major_Project
```
## Built With

* [PHP](http://php.net/docs.php) - The Backend Language
* [MaterializeCSS](http://materializecss.com/) - CSS Boilerplate
* [jQuery](https://api.jquery.com/) - jQuery frontend

## Contributing

Please contact [mhtsharma948@gmail.com]for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [Github](https://github.com) for versioning.

## Authors

* **Mohit Sharma** - *Initial work* - [mhtsharma948](https://github.com/mhtsharma948)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
