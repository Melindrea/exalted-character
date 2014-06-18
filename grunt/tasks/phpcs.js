module.exports = function(grunt) {
    'use strict';

    grunt.config('phpcs', {
        application: {
            dir: [
                '<%= directories.source %>',
                '<%= directories.test %>'
            ]
        },
        options: {
            bin: '<%= composer.config["bin-dir"] %>/phpcs',
            standard: 'PSR2',
            extensions: 'php'
        }
    });
};
