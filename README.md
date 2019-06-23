# LaravelBasicChatApp

## Prerequisites

Before cloning the repo, make sure that you have the following things installed

1. [Composer](https://getcomposer.org/) - PHP Package Manager

2. [Node.js & NPM](https://nodejs.org/en/) - Node.JS and Node Package Manager

3. Laravel Command line

        - composer global require "laravel/installer
    
    To make sure that you can invoke Laravel command line directly, make sure that it is in the system path.
    
    For Windows you can perform the following commands to add it to the system path
    
    setx /M path “%path%;%appdata%Composer\vendor\bin”
    
    set PATH=%PATH%;%USERPROFILE%AppDataRoamingComposer\vendor\bin
    
    where USERPROFILE is the Windows user name
    

## Installation

After cloning the repository perform the following steps

### Install Dependencies

1. Install dependencies for Laravel backend

    -   composer install
    
2. Install dependencies for Vue frontend

    -   npm install
    
### Configure 

1. Open the .ENV file and update the following

    -   Line 10: Replace the placeholder <DB_HOST_IP> with your database host IP
    -   Line 11: Replace the placeholder <DB_PORT_NUM> with your database port name
    -   Line 12: Replace the placeholder <DB_NAME> with your database name
    -   Line 13: Replace the placeholder <DB_USERNAME> with your database username
    -   Line 14: Relpace the placeholder <DB_PASSWORD> with your database password
    -   Line 46: Replace the placeholder <PUBNUB_PUBLISH_KEY> with your PubNub publish key
    -   Line 47: Replace the placeholder <PUBNUB_SUBSCRIBE_KEY> with your PubNub subscribe key
    
2. Open the file [PubnubConfig.php](/app/PubnubConfig.php) and update the following

    -   Line 19: Replace the placeholder <PUBNUB_PUBLISH_KEY> with your PubNub publish key
    -   Line 20: Replace the placeholder <PUBNUB_SUBSCRIBE_KEY> with your PubNub subscribe key
    -   Line 21: Replace the placeholder <PUBNUB_SECRET_KEY> with your PubNub secret key

3. Open the [domainconfig.js](resources/js/domainconfig.js) file and update the following

    -   Line 1: Replace the placeholder <HOST_OR_IP> with your web servers root address
    
4. Open the [pubnubconfig.js](resources/js/pubnubconfig.js) file and update the following

    -   Line 3: Replace the placeholder <PUBNUB_PUBLISH_KEY> with your PubNub publish key
    -   Line 4: Replace the placeholder <PUBNUB_SUBSCRIBE_KEY> with your PubNub subscribe key
    -   Line 5: Replace the placeholder <PUBNUB_SECRET_KEY> with your PubNub secret key
     
## Run

1. Generate autoload.php to aggregate all vendor dependencies

    -   composer dump-autoload
    
2. Compile the run Vue application 

    -   npm run watch
    
3. Launch the web server


4. Launch the chat app via your web browser by pointing to the URL 

    http://<HOST_OR_IP>/LaravelBasicChatApp/public
    
    where <HOST_OR_IP> is your web server's root address
    
    Also make sure that the cloned repo is within the web root folder of your web server
