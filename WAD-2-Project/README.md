# WAD2 Group Project: ___ 

## What is ___ About? 

---

## Setup/Notes to Devs 

Run `git clone <repo-URL>` to retrieve this repo. Place the repo in the `htdocs` or `www` directory of MAMP/WAMP respectively and run MAMP/WAMP. 

We would mostly be working in the `public/` folder for both front-end and back-end, the other files are config files, code library files and deployment files. `public/` would be our main directory. 

The JS files are downloaded locally so that we wouldn't have to worry about CDN dependencies, so you can choose to use it or the CDN link, both will still work. There is a file, `public/template.html`, that shows how to import the local JS files. 

2 PHP files are added under `src/` that will simplify the creation of APIs (`APICreate`) and calling of external APIs (`APICall`) by pre-writing the boilerplate codes needed. The use of it is documented under `src/APICreate.php` and `src/APICall.php` and an example PHP file is shown in `public/api/testAPI.php` and `public/api/testCall.php`. 

<br />
<strong>File Structure</strong>   
<dl>
    <dt><code>bin</code></dt>
    <dd>
        <ul>
            <li>
            Contains the executable PHP Composer file
            </li>
        </ul>
    </dd>
    <dt><code>public</code></dt>
    <dd>
        <ul>
            <li>
            Contains the folders:&nbsp; <code>api</code>,&nbsp; <code>assets</code>,&nbsp; <code>images</code>
            </li>
            <li>
            Web Root folder when deploying to Heroku for security purposes
            </li>
            <li>
            All the front-end HTML files for the website should be kept here, referencing the JS and CSS files in the assets folder
            </li>
            <li>
                <dl>
                    <dt><code>api</code></dt>
                    <dd>
                        <ul>
                            <li>
                            Contains the back-end PHP files that would communicate with the front-end files through REST API and Axios
                            </li>
                            <li>
                            The back-end files here would also communicate with the MySQL DB
                            </li>
                        </ul>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt><code>assets</code></dt>
                    <dd>
                        <ul>
                            <li>
                            Contains the JS (including Vue), CSS and font files
                            </li>
                            <li>
                            Axios, Vue (development version), Bootstrap (Both CSS and JS files), Inter font and Overpass font are included currently
                        </ul>
                    </dd>
                </dl>
            </li>
            <li>
                <dl>
                    <dt><code>images</code></dt>
                    <dd>
                        <ul>
                            <li>
                            Contains images that would be used in the application
                            </li>
                        </ul>
                    </dd>
                </dl>
            </li>
        </ul>
    </dd>
    <dt><code>src</code></dt>
    <dd>
        <ul>
            <li>
            Contains self-written PHP code to aid in the backend development, such as the Connection Manager taught in WAD1
            </li>
            <li>
            All the PHP code is auto-loaded by common.php as taught in WAD1 
            </li>
            <li>
            Currently includes ConnectionManager for interfacing with SQL, APICreate for creating APIs and APICall for calling external APIs
            </li>
        </ul>
    </dd>
    <dt><code>vendor</code></dt>
    <dd>
        <ul>
            <li>
            Contains all installed PHP Composer packages;
            </li>
            <li>
            Managed automatically by Composer (See below on usage)
            </li>
        </ul>
    </dd>
    <dt><code>.gitignore</code></dt>
    <dd>
        <ul>
            <li>
            Specifying files that Git should not track and commit
            </li>
        </ul>
    </dd>
    <dt><code>.htaccess</code></dt>
    <dd>
        <ul>
            <li>
            For configuring the Apache Web Server during Heroku deployment
            </li>
        </ul>
    </dd>
    <dt><code>composer.json</code> and <code>composer.lock</code></dt>
    <dd>
        <ul>
            <li>
            Recording PHP packages installed by Composer
            </li>
            <li>
            Automatically managed by Composer
            </li>
        </ul>
    </dd>
    <dt><code>config.ini</code></dt>
    <dd>
        <ul>
            <li>
            For private key and configuration of confidential data
            </li>
        </ul>
    </dd>
    <dt><code>Procfile</code></dt>
    <dd>
        <ul>
            <li>
            For configuring Heroku deployment
            </li>
        </ul>
    </dd>
</dl>
<br />

**Package & External Library Management** 

The Composer packages are included with every commit for the ease of the project, so that there wouldn't be a need to run extra commands to get the packages specified in `composer.json` which governs the PHP packages, as per the usual practice.   
<br />
<br />
If, however, there are packages for JS or PHP that you want to install, you may use the following commands:   

<br />

### _For PHP external library_ 

For Mac, run the command `php bin/composer require <package name>` or `<path to PHP executable> bin/composer require <package name>` if the PHP executable is not in your PATH environment variable. The path to the PHP executable should be `/Applications/MAMP/bin/php/php<version number>/bin/php`.   

For Windows, run the command `php bin\composer require <package name>` or `<path to PHP executable> bin\composer require <package name>` if the PHP executable is not in your PATH environment variable. The path to the PHP executable should be `C:\wamp64\bin\php\php<version number>\php.exe`.   

<br />

### _For JavaScript external library_ 
For JS, download the JS files, preferably the minified (ending with `.min.js`) version, from the official CDN websites and place it in the `public/assets/js/` folder.   

<br />