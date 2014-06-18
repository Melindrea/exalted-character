module.exports = function(grunt) {
    'use strict';

    grunt.registerTask('test', function(target) {
        if (target === 'phpunit') {
            return grunt.task.run([
                'phpunit'
            ]);
        }

        grunt.task.run([
            'test:phpunit'
        ]);
    });
};
