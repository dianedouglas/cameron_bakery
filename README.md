# Cameron's Bakery
##### A business website.

#### By Ryan Brown

## Description

A website for Cameron's coffee and bakery shop!  Utilizes a Zen sub-theme and a custom theme from scratch, made with Drupal 7.

## Setup

* Clone repository from `https://github.com/browneryan/cameron_bakery` and navigate to directory
* Open MAMP (or WAMP) application, select preferences, change document root to the cameron_bakery folder
* A browser window should open upon success (if not click open start webpage), then click the tools tab and select phpMyAdmin
* Choose import tab, click choose file button and select the database zip file within sites/db-backup folder named `bakery.sql.zip`
* The database name is `bakery`
* Click on database name and select privileges tab, then select add user
* Set username to `cameron`, host to `localhost`, and set password to `cameron` as well
* Make sure 'grant all privileges on database' is checked, then click go
* Open a new browser tab to `localhost:8888`
* Login username and password are both `cameron`
* Reviewer role username and password are both `cameron`

## Technologies Used

* Drupal 7
* PHP

## Known issues

* Failed attempt at integrating Zen grids into myzen theme.

### Legal

Copyright (c) 2016, Ryan Brown

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
