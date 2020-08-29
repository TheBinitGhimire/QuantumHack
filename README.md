# Medical Response System for Smart City
## Solo Nepal | QuantumHack

This project is all about a Emergency Medical Response System that can be implemented in a Smart City. Using this project, when someone is facing an emergency situation, the person nearby can send a notification to the nearest hospital.

With the help of WebSockets, the nearest hospital receives the request from the person with his/her geolocation, and if the hospital has any available ambulances available, the hospital responds to the system with "**Receive**" signal, and if not, the hospital can forward the signal to the next nearest hospital.

For the implementation of this project in real world, every hospital should be using our system so that there can be a large number of hospitals available where requests can be sent from users and forwarded to other hospitals from one hospital.

Users don't have to select the hospital on their own. Our algorithm automatically determines the nearest hospital in our database from the user's geolocation, and the request is passed to that hospital.

This is all about our Medical Response System works.

## Setup
1. Clone the repository
2. Set up a database as in the **system.sql** file
3. Set up the database connections in the **includes/conn.php** file
4. Set up your SMTP email configuration in **create.php** file
5. Start using! 

## Web Application
All the codes in this repository excluding the one of a compressed ZIP file are different parts of our web application.

The overall functionality of our project is included in the web application, including the major objective of our project related with the emergency medical response system to let the nearest hospital know about a victim requiring emergency medical care and treatment.

## Android Application
The source code of our Android application is available in the **AndroidApplication.zip** file.

In our Android application, we can track people based upon their geolocation every 2 minutes and then enable them to find out whether other people they have met recently are victims of COVID-19 or not. In this way, they can decide whether to go for a COVID-19 test or not and whether to meet the respective people or not in the meantime. This makes it possible for us to aware people in case someone with whom they have met or are willing to meet have been infected with COVID-19 or not.

## Usage
The user login panel is available at the homepage, and you can either login or create an account, whereas the hospital control panel is available at **/hospital**.

## Technologies used in this Project:
	* PHP
	* JavaScript
	* Java
	* MariaDB (MySQL)

### Third-party Technologies used in this Project:
  * PHPmailer, for sending account verification emails
  * Bootstrap, for the web interface of the project
  * FontAwesome, for amazing icons being used in the web application
