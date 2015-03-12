module.exports = function(grunt) {

    var path = 'src/Esgi/BlogBundle/Resources/';

    // Project configuration.
    grunt.initConfig({
        uglify: {
            options: {
                banner: '/*! app.min.js <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            my_target: {
              files: {
                'web/build/js/app.min.js': ['app/Resources/lib/jquery/dist/jquery.min.js', path + '*/*.js']
              }
            }
        },
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "web/build/css/app.css" : path + "less/app.less"
                }
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: path + 'images/',
                    src: ['**/*.{png,jpg,gif,tiff}'],
                    dest: 'web/build/images/'
                }]
            }
        },
        watch: {
            all: {
                files: [
                        path + '**/*.js',
                        path + '**/*.css',
                        path + '**/*.less',
                       ],
                tasks: ['uglify', 'less', 'imagemin'],

                options: { nospawn : true }
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    // Updating prefixes database : npm update caniuse-db
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('install', ['uglify', 'less', 'imagemin']);
    grunt.registerTask('default', ['uglify', 'less', 'imagemin']);


};