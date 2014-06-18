module.exports = function(grunt) {
    'use strict';

    grunt.registerTask('lint', function(target) {
        if (target === 'scripts') {
            return grunt.task.run([
                'newer:jsvalidate',
                'newer:jshint',
            ]);
        } else if (target === 'json') {
            return grunt.task.run([
                'newer:jsonlint'
            ]);
        } else if (target === 'php') {
            return grunt.task.run([
                'newer:phplint',
                'phpcs'
            ]);
        }

        grunt.task.run([
            'lint:scripts',
            'lint:json',
            'lint:php'
        ]);
    });
};
