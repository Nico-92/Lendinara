module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: ['js/app.js', 'js/services/*.js', 'js/gara.js', 'js/moduloController.js', 'js/riassuntoController.js', 'js/tesseraController.js'],
                dest: 'js/lib.js'
            },
            distVendor: {
                src: ['js/vendor/jquery/jquery.js', 'js/vendor/angular/angular.js', 'js/vendor/angular/angular-lib/*.js', 'js/vendor/bootstrap/*.js', 'js/vendor/*.js'],
                dest: 'js/vendor.js'
            },
            css: {
                src: ['!css/stilistampa.css', 'css/*.css', 'css/vendor/*css'],
                dest: 'css/index.css'
            }
        },
        uglify: {
            dist: {
                files: {
                    'js/vendor.min.js': ['js/vendor.js']
                }
            }
        },
        cssmin: {
            minify: {
                files: [{
                    // expand: true,
                    // cwd: '/css',
                    src: ['css/index.css'],
                    dest: 'css/index.min.css',
                    // ext: '.min.css'
                }]
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('vendor', ['concat:distVendor', 'uglify']);
    grunt.registerTask('css', ['concat:css', 'cssmin:minify']);
    grunt.registerTask('default', ['concat:dist']);
};