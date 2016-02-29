module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: ['js/app.js', 'js/services/*.js', 'js/gara.js', 'js/moduloController.js', 'js/riassuntoController.js', 'js/tesseraController.js' ],
        dest: 'js/lib.js'
      },
      distVendor: {
        src: ['js/vendor/jquery/jquery.js', 'js/vendor/angular/angular.js', 'js/vendor/angular/angular-lib/*.js', 'js/vendor/*.js'],
        dest: 'js/vendor.js'
      }
    },
    uglify: {
      dist: {
        files: {
          'js/vendor.min.js': ['js/vendor.js']
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('vendor', ['concat:distVendor', 'uglify']);
  grunt.registerTask('default', ['concat:dist']);

};