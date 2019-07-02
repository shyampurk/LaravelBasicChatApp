# LaravelBasicChatApp

## Prerequisites

Before cloning the repo, make sure that you have the following things installed

1. [XAMPP](https://www.apachefriends.org/download.html) - A popular Apache distribution which also contains MySql and PHP. 

2. [Composer](https://getcomposer.org/) - PHP Package Manager

        Note: Mac users can install composer using homebrew.
        
        brew install composer 

3. [Node.js & NPM](https://nodejs.org/en/) - Node.JS and Node Package Manager

4. Laravel

        To install Laravel CLI, perform the following commands from your terminal
        
        Step 1: Install Laravel CLI
        
            composer global require "laravel/installer
            
        Step 2: Configure the path to access Laravel globally
    
            For Windows
            
                setx /M path “%path%;%appdata%Composer\vendor\bin”
    
                set PATH=%PATH%;%USERPROFILE%AppDataRoamingComposer\vendor\bin
    
                Note: USERPROFILE is the Windows user name
                
            For Unix/Linux
            
                export PATH="~/.config/composer/vendor/bin:$PATH"
    

## Installation

### Install Dependencies

1. Install dependencies for Laravel backend

    -   composer install
    
2. Install dependencies for Vue frontend

    -   npm install
    
### Configure 

To configure this app, you have to first perform some steps to generate the configuration parameters.

#### Step 1. PubNub Signup - [Signup](https://dashboard.pubnub.com/signup) for PubNub service and get your PubNub keys (Publish key, subscribe key and secret key)

Note: One the new keys are generated, you also have to enable "Storage & Playback" and "Access manager" features for them.  

#### Step 2. Start servers - Open the XAMPP control panel and start the Apache server and MySQL server. 

#### Step 3. Database setup -  Open PhPMyAdmin web console and import the [sql file](chatapp.sql) to create a new database (named chatapp) for the application. 

#### Step 4. Clone the repo - Clone this repositpry under the web root folder of XAMPP Apache web server. 


#### Step 5. Update configuration - In the cloned repository, update the following files with the configuration parameters as follows.

    
   1. Open the file [PubnubConfig.php](/app/PubnubConfig.php) and update the following

        -   Line 19: Replace the placeholder <PUBNUB_PUBLISH_KEY> with your PubNub publish key
        -   Line 20: Replace the placeholder <PUBNUB_SUBSCRIBE_KEY> with your PubNub subscribe key
        -   Line 21: Replace the placeholder <PUBNUB_SECRET_KEY> with your PubNub secret key

   2. Open the [domainconfig.js](resources/js/domainconfig.js) file and update the following

        -   Line 1: Replace the placeholder <HOST_OR_IP> with your web servers root address. If you are running the XAMPP locally then "localhost" is the root address.
    
   3. Open the [pubnubconfig.js](resources/js/pubnubconfig.js) file and update the following

        -   Line 3: Replace the placeholder <PUBNUB_PUBLISH_KEY> with your PubNub publish key
        -   Line 4: Replace the placeholder <PUBNUB_SUBSCRIBE_KEY> with your PubNub subscribe key
        -   Line 5: Replace the placeholder <PUBNUB_SECRET_KEY> with your PubNub secret key

   4. OPTIONAL- In case you are changing the default configuration for Apache and MySQL or testing on a different server instead on the local computer then open the .ENV file and update the following

        -   Line 10: Set the DB_HOST value to the IP address of the database host server
        -   Line 11: Set the DB_PORT value to the port number of the database
        -   Line 13: Set the DB_USERNAME value to the database username. Default user name is "root"
        -   Line 14: Set the DB_PASSWORD value to the database password.  Default password is none so the value is left blank.
    
    
## Run

1. Generate autoload.php to aggregate all vendor dependencies

        composer dump-autoload
    
2. Compile the run Vue application 

        npm run watch
    
3. Launch the chat app via your web browser by pointing to the URL 

        http://<HOST_OR_IP>/LaravelBasicChatApp/public
    
            where <HOST_OR_IP> is your web server's root address
            
            Note: Make sure to check the XAMPP control panel and ensure that the Apache and MySQL servers are running. 
    
    
