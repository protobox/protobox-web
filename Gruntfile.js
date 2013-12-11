/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>\n' +
      '*/\n',
    app: {
      js: 'public/assets/js',
      css: 'public/assets/css',
      images: 'public/assets/img',
      assets: 'app/assets',
      components: '<%= app.assets %>/components'
    },
    // Task configuration.
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true
      },
      js: {
        src: [
          // Core
          //'<%= app.components %>/jquery/jquery.js', //included google cdn

          //Bootstrap
          '<%= app.components %>/bootstrap/js/transition.js',
          '<%= app.components %>/bootstrap/js/alert.js',
          '<%= app.components %>/bootstrap/js/button.js',
          //'<%= app.components %>/bootstrap/js/carousel.js',
          '<%= app.components %>/bootstrap/js/collapse.js',
          '<%= app.components %>/bootstrap/js/dropdown.js',
          '<%= app.components %>/bootstrap/js/modal.js',
          '<%= app.components %>/bootstrap/js/tooltip.js',
          '<%= app.components %>/bootstrap/js/popover.js',
          '<%= app.components %>/bootstrap/js/scrollspy.js',
          '<%= app.components %>/bootstrap/js/tab.js',
          '<%= app.components %>/bootstrap/js/affix.js',

          // Vendors
          '<%= app.components %>/selectize/dist/js/standalone/selectize.min.js',
          //'<%= app.components %>/eldarion-ajax/js/eldarion-ajax-core.js',
          //'<%= app.components %>/eldarion-ajax/js/eldarion-ajax-handlers.js',
          //'<%= app.components %>/dropzone/downloads/dropzone.js',

          // App
          '<%= app.assets %>/js/app.js'
        ],
        dest: '<%= app.js %>/scripts-all.js'
      },
      pastejs: {
        src: [
          // Vendors
          '<%= app.components %>/google-code-prettify/src/prettify.js',
          '<%= app.components %>/tabby/jquery.textarea.js'
        ],
        dest: '<%= app.js %>/pastes-all.js'
      },
      css: {
        options: {
          separator: ' '
        },
        src: [
          // Core
          //'<%= app.components %>/bootstrap/dist/css/bootstrap.css', // now compiled in app.css
          
          // App
          '<%= app.assets %>/css/app.css',

          // Vendors
          '<%= app.components %>/selectize/dist/css/selectize.bootstrap3.css'
        ],
        dest: '<%= app.css %>/styles-all.css'
      },
      pastecss: {
        options: {
          separator: ' '
        },
        src: [
          // App
          '<%= app.assets %>/css/pastes.css'
        ],
        dest: '<%= app.css %>/pastes-all.css'
      },
      dist: {}
    },
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      dist: {
        src: '<%= concat.js.dest %>',
        dest: '<%= app.js %>/scripts.v<%= pkg.version %>.min.js'
      }
    },
    less: {
      development: {
        options: {
          paths: ["<%= app.assets %>/css"],
        },
        files: {
          '<%= app.assets %>/css/app.css': '<%= app.assets %>/css/app.less'
        }
      },
      production: {
        options: {
          paths: ["<%= app.assets %>/css"],
          cleancss: true
        },
        files: {
          '<%= app.assets %>/css/app.css': '<%= app.assets %>/css/app.less'
        }
      }
    },
    cssmin: {
      combine: {
        files: {
          '<%= app.css %>/styles.v<%= pkg.version %>.min.css': ['<%= app.css %>/styles-all.css'],
          '<%= app.css %>/pastes.v<%= pkg.version %>.min.css': ['<%= app.css %>/pastes-all.css']
        }
      }
    },
    imagemin: {
      dist: {
        options: {
          optimizationLevel: 3
        },
        files: [
          {
            expand: true,
            cwd: '<%= app.images %>/',
            src: ['**/*.jpg'],
            dest: '<%= app.images %>/',
            ext: '.jpg'
          },
          {
            expand: true,
            cwd: '<%= app.images %>/',
            src: ['**/*.png'],
            dest: '<%= app.images %>/',
            ext: '.png'
          }
        ]
      }
    },
    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        immed: true,
        latedef: true,
        newcap: true,
        noarg: true,
        sub: true,
        undef: true,
        unused: true,
        boss: true,
        eqnull: true,
        browser: true,
        globals: {}
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      lib_test: {
        src: ['lib/**/*.js', 'test/**/*.js']
      }
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      },
      less: {
        files: ['<%= app.assets %>/css/*.less'],
        tasks: ['less:development']
      },
      css: {
        files: ['<%= app.assets %>/css/*.css'],
        tasks: ['concat:css', 'concat:pastecss']
      },
      js: {
        files: ['<%= app.assets %>/js/*.js'],
        tasks: ['concat:js', 'concat:pastejs']
      },
      lib_test: {
        files: '<%= jshint.lib_test.src %>',
        tasks: ['jshint:lib_test', 'qunit']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-watch');

  //Run grunt watch instead, 'watch'

  // Default task.
  grunt.registerTask('default', 'Development Build', [
    'jshint', 
    'concat:js', 
    'concat:pastejs', 
    'uglify', 
    'less:development', 
    'concat:css',
    'concat:pastecss'
  ]);

  // Production build
  grunt.registerTask('build', 'Production Build', [
    'jshint', 
    'concat:js', 
    'concat:pastejs', 
    'uglify', 
    'less:production', 
    'concat:css',
    'concat:pastecss', 
    'cssmin'
  ]);

  // Optimize build
  grunt.registerTask('optimize', 'Optimize Assets', [
    'imagemin'
  ]);

};
