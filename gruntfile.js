module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    replace: {
      app_header: {
        src: ['public_html/includes/app_header.inc.php'],
        overwrite: true,
        replacements: [
          {
            from: /define\('PLATFORM_VERSION', '([0-9\.]+)'\);/,
            to: 'define(\'PLATFORM_VERSION\', \'<%= pkg.version %>\');'
          }
        ]
      },
      app_config: {
          src: ['public_html/includes/config.inc.php'],
          overwrite: true,
          replacements: [
            {
              from: /define\('PROJECT_NAME', '([0-9\.]+)'\);/,
              to: 'define(\'PROJECT_NAME\', \'<%= pkg.name %>\');'
            }
          ]
      },
      install: {
        src: [
          'public_html/install/index.php'
        ],
        overwrite: true,
        replacements: [
          {
            from: 'value="xp-default"',
            to: 'value="<%= pkg.name %>"'
          }
        ]
      },
      app: {
        src: [
          'public_html/index.php',
          'public_html/install/install.php',
          'public_html/install/upgrade.php'
        ],
        overwrite: true,
        replacements: [
          {
            from: /xMexpi Design® ([0-9\.]+)/,
            to: 'xMexpi Design® <%= pkg.version %>'
          }
        ]
      },
    },

    less: {
      litecart_admin_template_minified: {
        options: {
          compress: true,
          sourceMap: true,
          sourceMapBasepath: 'public_html/includes/templates/default.admin/less/',
          sourceMapRootpath: '../less/',
          sourceMapURL: function(path) { return path.replace(/.*\//, '') + '.map'; },
          relativeUrls: true
        },
        files: {
          'public_html/includes/templates/default.admin/css/app.min.css'       : 'public_html/includes/templates/default.admin/less/app.less',
          'public_html/includes/templates/default.admin/css/framework.min.css' : 'public_html/includes/templates/default.admin/less/framework.less',
          'public_html/includes/templates/default.admin/css/printable.min.css' : 'public_html/includes/templates/default.admin/less/printable.less',
        }
      },
      litecart_catalog_template: {
        options: {
          compress: false,
          sourceMap: false,
          relativeUrls: true
        },
        files: {
          'public_html/includes/templates/default.site/css/app.css'       : 'public_html/includes/templates/default.site/less/app.less',
          'public_html/includes/templates/default.site/css/checkout.css'  : 'public_html/includes/templates/default.site/less/checkout.less',
          'public_html/includes/templates/default.site/css/framework.css' : 'public_html/includes/templates/default.site/less/framework.less',
          'public_html/includes/templates/default.site/css/printable.css' : 'public_html/includes/templates/default.site/less/printable.less',
        }
      },
      litecart_catalog_template_minified: {
        options: {
          compress: true,
          sourceMap: true,
          sourceMapBasepath: 'public_html/includes/templates/default.site/less/',
          sourceMapRootpath: '../less/',
          sourceMapURL: function(path) { return path.replace(/.*\//, '') + '.map'; },
          relativeUrls: true
        },
        files: {
          'public_html/includes/templates/default.site/css/app.min.css'       : 'public_html/includes/templates/default.site/less/app.less',
          'public_html/includes/templates/default.site/css/checkout.min.css'  : 'public_html/includes/templates/default.site/less/checkout.less',
          'public_html/includes/templates/default.site/css/framework.min.css' : 'public_html/includes/templates/default.site/less/framework.less',
          'public_html/includes/templates/default.site/css/printable.min.css' : 'public_html/includes/templates/default.site/less/printable.less',
        }
      },
      featherlight_minified: {
        options: {
          compress: true,
          sourceMap: true,
          sourceMapBasepath: 'public_html/ext/featherlight/',
          sourceMapRootpath: './',
          sourceMapURL: function(path) { return path.replace(/.*\//, '') + '.map'; },
          relativeUrls: true
        },
        files: {
          'public_html/ext/featherlight/featherlight.min.css'       : 'public_html/ext/featherlight/featherlight.less',
        }
      },
    },

    sass: {
      trumbowyg_minified: {
        options: {
          implementation: require('node-sass'),
          sourceMap: true,
          outputStyle: 'compressed',
          compass: false
        },
        files: {
          'public_html/ext/trumbowyg/ui/trumbowyg.min.css': 'public_html/ext/trumbowyg/ui/trumbowyg.scss'
        }
      }
    },

    uglify: {
      featherlight: {
        options: {
          sourceMap: true,
        },
        files: {
          'public_html/ext/featherlight/featherlight.min.js'   : ['public_html/ext/featherlight/featherlight.js'],
        }
      },
      litecart: {
        options: {
          sourceMap: true,
        },
        files: {
          'public_html/includes/templates/default.admin/js/app.min.js'   : ['public_html/includes/templates/default.admin/js/app.js'],
          'public_html/includes/templates/live.catalog/js/app.min.js' : ['public_html/includes/templates/live.catalog/js/app.js'],
        }
      },
    },

    phplint: {
      options: {
        //phpCmd: 'C:/xampp/php/php.exe', // Defaults to php
        limit: 10,
        stdout: false
      },
      files: 'public_html/**/*.php'
    },

    watch: {
      replace: {
        files: [
          'package.json',
        ],
        tasks: ['replace']
      },
      less: {
        files: [
          'public_html/ext/featherlight/featherlight.less',
          'public_html/includes/templates/**/*.less',
        ],
        tasks: ['less']
      },
      javascripts: {
        files: [
          'public_html/ext/featherlight/featherlight.js',
          'public_html/includes/templates/**/js/*.js',
        ],
        tasks: ['uglify']
      },
      sass: {
        files: [
          'public_html/ext/trumbowyg/ui/trumbowyg.scss',
        ],
        tasks: ['sass']
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-text-replace');

  grunt.registerTask('default', ['replace', 'less', 'sass', 'uglify']);

  require('phplint').gruntPlugin(grunt);
  grunt.registerTask('test', ['phplint']);
};