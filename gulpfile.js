/**
 * Created by giang on 12/26/15.
 */
var gulp = require('gulp');
var concat = require('gulp-concat');
var minifyCss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var streamqueue  = require('streamqueue');

var config = {
    SCRIPT_DEST : 'web/js/',
    SCRIPT_FILE : 'app.min.js'
};
gulp.task('default', ['styles', 'scripts', 'copyfont', 'copyimage'], function(){
    console.log('i am GULP');
});

gulp.task('scripts', function(){
    return gulp.src([
        'web/bundles/viettutweb/bower_components/jquery/dist/jquery.min.js',
        'web/bundles/viettutweb/bower_components/angular/angular.min.js',
        'web/bundles/viettutweb/bower_components/angular-ui-router/release/angular-ui-router.min.js',
        'web/bundles/viettutweb/bower_components/ng-tags-input/ng-tags-input.min.js',
        'web/bundles/viettutweb/bower_components/angular-bootstrap/ui-bootstrap.min.js',
        'web/bundles/viettutweb/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
        'web/bundles/viettutweb/bower_components/angular-animate/angular-animate.min.js',
        'web/bundles/viettutweb/bower_components/marked/lib/marked.js',
        'web/bundles/viettutweb/bower_components/angular-marked/dist/angular-marked.min.js',
        'web/bundles/viettutweb/bower_components/bootstrap-markdown/js/bootstrap-markdown.js',
        'web/bundles/viettutweb/bower_components/angular-highlightjs/src/angular-highlightjs.js',
        'web/bundles/viettutweb/bower_components/angular-markdown-editor-ghiscoding/src/angular-markdown-editor.js',
        'web/bundles/viettutweb/bower_components/angular-sanitize/angular-sanitize.min.js',
        'web/bundles/viettutweb/bower_components/ng-file-upload/ng-file-upload.min.js',
        'web/bundles/viettutweb/bower_components/ng-file-upload-shim/ng-file-upload-shim.min.js',
        'web/bundles/viettutweb/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'web/bundles/viettutweb/bower_components/satellizer/satellizer.min.js',
        'web/bundles/viettutweb/bower_components/highlightjs/highlight.pack.min.js',
        'web/bundles/viettutweb/bower_components/ngstorage/ngStorage.min.js',
        'web/bundles/viettutweb/bower_components/ladda/dist/spin.min.js',
        'web/bundles/viettutweb/bower_components/ladda/dist/ladda.min.js',
        'web/bundles/viettutweb/bower_components/ladda-angular/dist/ladda-angular.min.js',
        'web/bundles/viettutweb/bower_components/codemirror/lib/codemirror.js',
        'web/bundles/viettutweb/bower_components/isteven-angular-multiselect/isteven-multi-select.js',
        'web/bundles/viettutweb/bower_components/angular-ui-codemirror/ui-codemirror.js',

        'web/bundles/viettutweb/js/app.js',
        'web/bundles/viettutweb/js/sticky_sidebar.js',
        'web/bundles/viettutweb/js/controller/login.js',
        'web/bundles/viettutweb/js/controller/footer.js',
        'web/bundles/viettutweb/js/controller/register.js',
        'web/bundles/viettutweb/js/controller/navbar.js',
        'web/bundles/viettutweb/js/services/authen.js',
        'web/bundles/viettutweb/js/services/chapter.js',
        'web/bundles/viettutweb/js/services/course.js',
        'web/bundles/viettutweb/js/services/tag.js',
        'web/bundles/viettutweb/js/services/tutorial.js',
        'web/bundles/viettutweb/js/services/upload.js',
        'web/bundles/viettutweb/js/services/comment.js',
        'web/bundles/viettutweb/js/services/alert.js',
        'web/bundles/viettutweb/js/services/route.js',
        'web/bundles/viettutweb/js/services/challenge.js',
        'web/bundles/viettutweb/js/services/test.js',

        'web/bundles/viettutweb/vendor/jquery.appear/jquery.appear.js',
        'web/bundles/viettutweb/vendor/jquery.easing/jquery.easing.js',
        'web/bundles/viettutweb/vendor/common/common.js',
        'web/bundles/viettutweb/vendor/isotope/jquery.isotope.js',

        'web/bundles/viettutweb/js/theme.js',
        'web/bundles/viettutweb/js/theme.init.js',
        'web/bundles/viettutweb/js/custom.js'
    ])
        .pipe(concat(config.SCRIPT_FILE))
        //.pipe(uglify('app.min.js'))
        .pipe(gulp.dest(config.SCRIPT_DEST))
});

gulp.task('styles', function(){
   gulp.src([
       'web/bundles/viettutweb/vendor/bootstrap/bootstrap.css',
       'web/bundles/viettutweb/bower_components/ladda/dist/ladda.min.css',
       'web/bundles/viettutweb/bower_components/highlightjs/styles/github.css',
       'web/bundles/viettutweb/bower_components/angular-bootstrap/ui-bootstrap-csp.css',
       'web/bundles/viettutweb/bower_components/ng-tags-input/ng-tags-input.min.css',
       'web/bundles/viettutweb/bower_components/angular-markdown-editor/styles/angular-markdown-editor.css',
       'web/bundles/viettutweb/vendor/fontawesome/css/font-awesome.css',
       'web/bundles/viettutweb/vendor/magnific-popup/magnific-popup.css',
       'web/bundles/viettutweb/css/theme.css',
       'web/bundles/viettutweb/css/theme-elements.css',
       'web/bundles/viettutweb/css/theme-blog.css',
       'web/bundles/viettutweb/css/theme-animate.css',
       'web/bundles/viettutweb/vendor/rs-plugin/css/settings.css',
       'web/bundles/viettutweb/css/skins/default.css',
       'web/bundles/viettutweb/css/custom.css',
       'web/bundles/viettutweb/css/sidebar.css',
       'web/bundles/viettutweb/bower_components/codemirror/lib/codemirror.css'
       'web/bundles/viettutweb/bower_components/isteven-angular-multiselect/isteven-multi-select.css'
   ]).pipe(concat('main.css')).pipe(minifyCss()).pipe(gulp.dest('web/css/'))
});

gulp.task('copyfont', function(){
   return gulp.src([
       'web/bundles/viettutweb/bower_components/font-awesome/fonts/*',
       'web/bundles/viettutweb/css/fonts/*'
   ]).pipe(gulp.dest('web/fonts'))
});

gulp.task('copyimage', function(){
   return gulp.src([
       'web/bundles/viettutweb/img/**/*'
   ]).pipe(gulp.dest('web/img'))
});