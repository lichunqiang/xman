module.exports = function (grunt) {
    grunt.initConfig({
        pkg : grunt.file.readJSON("package.json"),

        copy: {
        	js: {
	            expand: true,
	            cwd: 'js/',
	            src: '*.js',
	            dest: 'js/src',
	            filter: 'isFile'
           }
        },
        uglify : {
			options: {
				banner: '/*<%= grunt.template.today() %> */'
			},
            app1 : {
                files: [
                    {
                        expand: true,
                        cwd: 'app/test',
                        src: ['*.js', '!*-debug.js'],
                        dest: 'app/test',
                        ext: '.js'
                    }
                ]
            },
			single: {
				options: {
					banner: '/*<%= grunt.template.today() %> */'
				},
				files: {
					'single/<%= test %>.min.js': ['single/*.js', '!*.min.js']
				}
			}
        },
		cssmin: {
			options: {
				banner: '/* build on <%= grunt.template.today() %> */'
			},
			main: {
				expand: true,
				cwd: 'css/',
				src: ['main.css'],
				dest: 'css/',
				ext: '.min.css'
			},
			combine: {
				files: {
					'css/all.min.css': ['css/ie7.css', 'css/ie8.css']
				}
			},
			pmall: {
				files: {
                    'css/pc.ui.min.css' : ['css/pc.ui.css'],
                    'css/pc.ui.point.min.css' : ['css/pc.ui.point.css']
                }
			}
		},
        clean : {
            //dist: ['js/dist/*']
        }
    });


    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-jshint');

    grunt.registerTask('pmall-css', ['cssmin:pmall']);

    grunt.registerTask('css', ['cssmin:combine']);
    grunt.registerTask('main-css', ['cssmin:main'])
    grunt.registerTask('default', ['copy', 'clean']); //this will do all work under cssmin option

};