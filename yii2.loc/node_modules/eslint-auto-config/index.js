#!/usr/bin/env node

var rules = require( './rules.json' ),
    inquirer = require( 'inquirer' ),
    fs = require( 'fs' ),
    CLIEngine = require( 'eslint' ).CLIEngine;


var rulesConfig = {};
var settings = {};

var save = function( obj ) {

    var str = JSON.stringify( obj );
    return fs.writeFileSync( '.eslintrc', str );

}

var addRule = function ( section, rule, val ) {
    
    if( !rulesConfig[section] ) rulesConfig[section] = {};

    if( rule ) rulesConfig[section][rule] = val;

    console.log( rule + ": " + val)

}

var getErrorCount = function ( rule, val ) {

    var ruleDef = {};
    ruleDef[rule] = val;

    var cli = new CLIEngine({
        envs: ["browser"],
        useEslintrc: false,
        rules: ruleDef
    });

    // lint all js files in settings.files glob
    var report = cli.executeOnFiles( [settings.files] );
    // console.log( rule + ' : ' + val + " gives " + report.errorCount + " warnings")
    return report.errorCount;

}

var startConfig = function ( answers ) {
    // settings = JSON.stringify(answers, null, "  ");
    settings = answers;
    //settings.path = jsPath;
    //console.log( settings );
    checkRules();
}


var checkRules = function () {

    for( var section in rules ) {

        switch ( section ) {
            case "rules":
                
                for( var rule in rules[section] ) {

                    var ruleOn = 1;
                    var ruleOff = 0;
                    if( Array.isArray( rules[section][rule] ) ) {
                        ruleOn = [2, rules[section][rule][0]];
                        ruleOff = [2, rules[section][rule][1]];
                    }

                    var noRuleCount = getErrorCount( rule, ruleOff );
                    var ruleCount = getErrorCount( rule, ruleOn );
                    

                    if( noRuleCount < ruleCount ) {

                        addRule( section, rule, ruleOff )

                    } else {

                        addRule( section, rule, ruleOn )

                    }

                }

            break;
            case "node":
                
                 for( var rule in rules[section] ) {

                    var ruleOn = 2;
                    var ruleOff = 0;
                    if( Array.isArray( rules[section][rule] ) ) {
                        ruleOn = [2, rules[section][rule][0]];
                        ruleOff = [2, rules[section][rule][1]];
                    }

                    if( !settings.node && !settings.commonjs ) {

                        addRule( 'rules', rule, 0 )

                    } else {



                        var noRuleCount = getErrorCount( rule, ruleOff );
                        var ruleCount = getErrorCount( rule, ruleOn );
                        

                        if( noRuleCount < ruleCount ) {

                            addRule( 'rules', rule, ruleOff )

                        } else {

                            addRule( 'rules', rule, ruleOn )

                        }

                    }
                   

                }


            break;
            case "ecmaFeatures":
                // add all environments with value from settings
                for ( var rule in rules[section] ) {

                    addRule( section, rule, settings.es6 )

                }


            break;
            case "errors":
                
                for ( var rule in rules[section] ) {

                    addRule( 'rules', rule, 2 )

                }


            break;
            case "best":
                
                for ( var rule in rules[section] ) {

                    addRule( 'rules', rule, 1 )

                }


            break;
            case "env":
                
                // add all environments with value false
                for ( var rule in rules[section] ) {

                    addRule( section, rule, settings[rule]  )

                }

            break;
            case "globals":

                // add empty section
                addRule( section, null, null )

            break;

        }

    }

    // save new config file    
    save( rulesConfig );

   // console.log(rulesConfig);

}

var init = function () {
    var questions = [
        
        {
            'type': 'input',
            'name': 'files',
            'message': 'File(s) to scan?'
        },
        {
            'type': 'confirm',
            'name': 'es2015',
            'message': 'Do you use es2015 features?',
            'default': false
        }
    ]

    // add environment questions
    for( var rule in rules['env'] ) {

        // console.log( rule )
        questions.push( {
            'type': 'confirm',
            'name': rule,
            'message': 'Global variables for ' + rule + '?',
            'default': false
        })
    }
   
    inquirer.prompt( questions, startConfig );
}

init();