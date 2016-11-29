module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		/*
		 * Concatinate the JavaScript files into one
		 */
		concat: {
			js: {
				src: ['wizMarkdown/src/libs/markdowndeep/MarkdownDeep.js',
				      'wizMarkdown/src/libs/markdowndeep/MarkdownDeepEditor.js',
							'wizMarkdown/src/libs/highlight/highlight.min.js',
				      'wizMarkdown/src/*.mod.js',
				      'wizMarkdown/src/*.svc.js',
							'wizMarkdown/src/*.fltr.js',
							'wizMarkdown/src/*.dir.*.js'],
				dest: 'wizMarkdown/wizMarkdown.js'
			}
		},
		/*
		 * Minify the concatinated files
		 */
		uglify: {
			js: {
				files: {
					'wizMarkdown/wizMarkdown.min.js': ['<%= concat.js.src %>']
				}
			}
		},
		/*
		 * Copy files into website
		 */
		copy: {
			main: {
				files: [
					{
						expand: true,
						src: ['wizMarkdown/wizMarkdown*.js'],
						dest: 'demo/app/libs/',
						filter: 'isFile'
					}
				]
			}
		},
		/*
		 * Watch for changes. If any concatinate and minify
		 */
		watch: {
			dev: {
				options: {
					livereload: true
				},
				files: ['demo/index.html', '<%= concat.js.src %>'],
				tasks: ['build']
			}
		},
		/*
		 * Start a new server
		 */
		connect: {
			options: {
				hostname: 'localhost',
				port: 9001
			},
			test: {

			},
			open: {
				options: {
					open: true,
					livereload: true
				}
			}
		}
	});
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-connect');

	grunt.registerTask('build', 'Build site', ['concat', 'uglify', 'copy']);
	grunt.registerTask('run', 'Build and run site', ['build', 'connect:open', 'watch']);
	grunt.registerTask('default', 'Build and run site', ['run']);
};