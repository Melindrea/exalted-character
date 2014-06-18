'use strict';

// # Globbing
// for performance reasons we're only matching one level down:
// 'test/spec/{,*/}*.js'
// use this if you want to recursively match all subfolders:
// 'test/spec/**/*.js'

module.exports = function(grunt) {

    grunt.initConfig({
        pkg: require('./package'),
        // watson: require('./watson'),
        composer: require('./composer'),
        directories: {
            test: 'test',
            source: 'src'
        },
        files: {
            js: [
                'Gruntfile.js',
                'grunt/{,*/}*.js'

            ],
            php: [
                '<%= directories.source %>/**/*.php',
            ],
            json: [
                '*.json',
                'grunt/hooks/data/*.json'
            ],
            packages: ['package.json', 'composer.json']
        }
    });

    // show elapsed time at the end
    require('time-grunt')(grunt);
    // load grunt tasks "just in time"
    require('jit-grunt')(grunt);
    grunt.loadTasks('grunt/tasks');
};
