# eslint-auto-config

Automated creation of the eslint config file, according to your current coding style.

* Rules used for eslint v1.6.0
* Possible errors rules are all on (ERROR)
* Best practices are all on (WARN)
* All other rules will be tested against your own code

Also usefull to start with a config file with all rules.

# Installation

You can install ESLint using npm:
```
npm install -g eslint-auto-config
```
# Usage

Goto to the root directory of your project 
```
cd path/to/your/project/
```
and run eslint-auto-config
```
eslint-auto-config
```
You have to answer a few question before the auto config starts.

```
File(s) to scan?
```
Give a path to a single js file eg ./src/js/index.js
or a glob to multiple js files for better results eg ./src/js/**/*.js
```
Do you use es2015 features?(y/N)
```
Answer y or n. Default is No.
```
Global variables for browser? (y/N)
Global variables for node? (y/N)
Global variables for commonjs? (y/N)
...
```
Some questions about global variables you use for environments and used frameworks. Defaults all to No.

After the configuration finishes there will be a file called .eslintrc in your root directory for eslint to use.