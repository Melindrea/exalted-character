module.exports = function(grunt) {
    'use strict';

    grunt.registerTask('commit', [
        'lint',
        'test'
    ]);

    grunt.registerTask('default', [
        'commit'
    ]);
};
