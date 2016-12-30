
*In Developing Process*


# Roles Admin Application

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)]


The idea behind this Roles Admin Application is to have an isolate application from the Main Business Application your are developing.

This Roles Admin Application will allows you to store (in a database) the modules names, transactions name and the security access level for the users. The modules names normally will be the Main Menu Options and the transactions will be the Sub Menu Options.

Based on how you organized your modules and transactions from your Main Business Application you can read the database and display or enable/dispable the Main Menu Options and Sub Menu Option dependieng on User Access Right that you defined in the Roles Admin Applicaton.

From you Business Application, you can store actions like query, create, update, delete, export, import, etc in the Roles Admin Database and based on that, you can followup via a Dashboard who accessed the Business Aplication dairly and monthly, how many times, which modules, transactions or actions were excecuted and how many times.


<!--[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)-->


##What is included in this web application?

1. Allows to add modules names which normally are those which belongs to the Main Menu of an Web Application.

2. Allows to add transactions names which are the options for each module, some times the Web Applications display them on a Left Side Panel.

3. Allows to add roles name and roles description.

4. Allows to add users with the basic information username, user fullname and email.

5. Allows to add access rights which based on roles that are related with modules, transactions and actions (read only access, no access allowed, read and write access).

6. Allows to assign a role to a user to give him application permissions.

7. Allows to follow up the application uses with a Dashboard. The Dashboard shows statistics (Daily, Monthly) like user logged, module used, transacctions used and actions executed (ex. create, add, delete and others)

##What are the frameworks used?

* Vue.js v1.0.11 with Bootstrap v3.2.0  - Used for the frontend 
```
Vue Custom Componentes
Vue Router
Vue Resoruces
```
* Highcharts JS v4.1.7 - Used in the dashboad
```
Vue Custom Component to handle Charts.
```
* Laravel v5.1 with MySQL Database - Used for the backend 
```
Repositories pattern applied.
```
* jQuery v1.11.1 Used to Manipulate HTML Tables
```
Used to Remove Row Tables in only one Vue Custom Component
```
##What are the next development tasks?

- Eliminate files that were used for testing vue and laravel functionalities.
- Integrate a Login Form to access the Role Admin Application with an admin user account.
- Replace vue-resource for axios.
- Review options to eliminate JQuery because it is used just in one componet to remove rows of a table. 
- An API to used by the Main Business Applications to know the access right (modules-transaction-security action level) of a user.
- Learn and Choose the Testing Tools to make the functional test files.
- Migrate vue to vue 2.0 and decide to used Vuex or Events to handle the compoments communicatione instead Bradcast method.
- Migrate to Laravel 5.3
- New functionalities to Support Multiple Business Applications for One Roles Admin Database.

