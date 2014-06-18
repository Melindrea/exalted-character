module.exports = function(grunt) {
    'use strict';

    grunt.config('phpunit', {
        classes: {
            dir: '<%= directories.test %>/tests'
        },
        options: {
            bin: '<%= composer.config["bin-dir"] %>/phpunit',
            bootstrap: '<%= composer.config["vendor-dir"] %>/autoload.php',
            staticBackup: false,
            colors: true,
            noGlobalsBackup: false
        }
    });
};
