module.exports = function( grunt ) {

	// Load all tasks
	require( 'load-grunt-tasks' )( grunt );

	// Show elapsed time
	require( 'time-grunt' )( grunt );

	var jsFileList = [
		'src/theme/assets/js/plugins/*.js',
		'src/theme/assets/js/main.js'
	];

	grunt.initConfig({

		pkg: grunt.file.readJSON( 'package.json' ),

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'src/theme/assets/js/main.js',
				'!src/theme/assets/js/scripts.js',
				'!src/theme/assets/**/*.min.*'
			]
		},
		// less: {
		// 	dev: {
		// 		files: {
		// 			'assets/css/main.css': [
		// 			'assets/less/main.less'
		// 			]
		// 		},
		// 		options: {
		// 			compress: false,
		// 			// LESS source map
		// 			// To enable, set sourceMap to true and update sourceMapRootpath based on your install
		// 			sourceMap: false,
		// 			sourceMapFilename: 'assets/css/main.less.css.map',
		// 			sourceMapRootpath: '/themes/mk-genesis-starter/'
		// 		}
		// 	},
		// 	build: {
		// 		files: {
		// 			'assets/css/main.css': [
		// 				'assets/less/main.less'
		// 			]
		// 		},
		// 		options: {
		// 			compress: true
		// 		}
		// 	}
		// },
		sass: {
			dev: {
				files: {
					'src/theme/assets/css/main.css':'src/theme/assets/scss/main.scss',
					'src/theme/assets/css/editor.css':'src/theme/assets/scss/editor.scss',
					'src/theme/assets/css/styletile.css':'src/theme/assets/scss/styletile.scss',
				},
				options: {
					style: 'extended',
					precision: 7,
					sourceMap: false,
					sourceMapEmbed: false
				}
			},
			build: {
				files: {
					'src/theme/assets/css/main.css':'src/theme/assets/scss/main.scss',
					'src/theme/assets/css/editor.css':'src/theme/assets/scss/editor.scss',
					'src/theme/assets/css/styletile.css':'src/theme/assets/scss/styletile.scss',
				},
				options: {
					style: 'compressed',
					precision: 7,
					sourceMap: false,
					sourceMapEmbed: false
				}
			}
		},
		concat: {
			options: {
				separator: ';',
			},
			dist: {
				src: [jsFileList],
				dest: 'src/theme/assets/js/scripts.js',
			},
		},
		uglify: {
			dist: {
				files: {
					'src/theme/assets/js/scripts.min.js': 'src/theme/assets/js/scripts.js'
				}
			}
		},
		sync: {
			main: {
				files: [{
				  cwd: 'src/theme',
				  src: [
				    '**', /* Include everything */
				    '!**/*.scss', /* but exclude scss files */
				    '!**/assets/scss' /* but exclude scss files */
				  ],
				  dest: 'htdocs/wp-content/themes/<%= pkg.theme_name %>',
				}],
				pretend: false, // Don't do any IO. Before you run the task with `updateAndDelete` PLEASE MAKE SURE it doesn't remove too much. 
				verbose: true // Display log messages when copying files 
			}
		},
		postcss: {
			options: {
				map: false,
				processors: [
					require('autoprefixer')({
						browsers: ['last 2 versions', 'ie 9', 'ie 10', 'android 4.3', 'android 4.4', 'firefox 34', 'firefox 35', 'opera 27', 'opera 26']
					})
				]
			},
			dev: {
				options: {
					map: false,
				},
				src: ['src/theme/assets/css/main.css','src/theme/assets/css/editor.css','src/theme/assets/css/styletile.css']
			},
			build: {
				src: ['src/theme/assets/css/main.css','src/theme/assets/css/editor.css','src/theme/assets/css/styletile.css']
			}
		},
		modernizr: {
			build: {
				devFile		: 'bower_components/modernizr/modernizr.js',
				outputFile	: 'src/theme/assets/js/vendor/modernizr.min.js',
				files 		: {
					'src': [
						['src/theme/assets/js/scripts.min.js'],
						['src/theme/assets/css/main.css']
					]
				},
				extra		: {
					shiv		: false,
					printshiv	: false,
					load		: true,
					mq			: false,
					cssclasses	: true
				},
				uglify		: true,
				parseFiles	: true
			}
		},
		simple_include: {

			options: {

				stripPrefix: '_',

			},

			dev: {

				src: ['src/theme/assets/js/_main.js'],
      			dest: 'src/theme/assets/js/'

			},

		},
		watch: {
			// less: {
			// 	files: [
			// 		'assets/less/*.less',
			// 		'assets/less/**/*.less'
			// 	],
			// 	tasks: ['less:dev', 'postcss:dev']
			// },
			sass: {
				files: [
					'src/*.scss',
					'src/**/*.scss'
				],
				tasks: ['sass:dev', 'postcss:dev']
			},
			php: {
				files: [
					'src/*.php',
					'src/**/*.php'
				],
				tasks: ['sync']
			},
			js: {
				files: [
					jsFileList,
					'<%= jshint.all %>'
				],
				tasks: ['sync', 'jshint', 'concat', 'uglify']
			},
			css: {
				files: [
					'src/*.css',
					'src/**/*.css'
				],
				tasks: ['sync']
			},
		},
		browserSync: {
		    dev: {
		        bsFiles: {

		            src : [
                        'htdocs/wp-content/themes/<%= pkg.theme_name %>/assets/css/*.css',
                        'htdocs/wp-content/themes/<%= pkg.theme_name %>/assets/js/*.js',
                        'htdocs/wp-content/themes/<%= pkg.theme_name %>/*.php',
                        'htdocs/wp-content/themes/<%= pkg.theme_name %>/**/*.php',
                    ],

		        },
		        options: {
		            proxy: "client-wp-<%= pkg.client_code %>.localhost",
		            watchTask: true,
		        }
		    }
		},
	});

	// Register tasks
	grunt.registerTask('default', [
		'dev'
	]);
	grunt.registerTask('dev', [
		// 'less:dev',
		'sass:dev',
		'postcss:dev',
		'simple_include',
		'jshint',
		'concat',
		'sync',
		'browserSync',
		'watch',
	]);
	grunt.registerTask('build', [
		// 'less:build',
		'sass:build',
		'postcss:build',
		'simple_include',
		'jshint',
		'concat',
		'uglify',
		'sync',
		'modernizr',
	]);
};