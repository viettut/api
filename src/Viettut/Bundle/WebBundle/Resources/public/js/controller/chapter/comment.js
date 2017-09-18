angular
    .module('viettut')
    .controller('CommentController', function CommentController($scope, RouteService, CommentService, AlertService) {
        $scope.comments = [];
        $scope.numberComments = 0;
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.commentToggle = false;
        $scope.currentChapter = -1;

        $scope.showReplyForm = function() {

        };

        $scope.reloadComment = function() {
            CommentService.getCommentForChapter($scope.currentChapter,
                function (response) {
                    $scope.comments = response.data;
                    $scope.numberComments = $scope.comments.length;
                },
                function (response) {
                }
            );
        };

        $scope.$watch('currentChapter', function(newVal, oldVal){
            $scope.currentChapter = newVal;
            $scope.reloadComment();
        });

        $scope.addComment = function() {
            // start progress
            $scope.laddaLoading = true;

            var data = {
                content: $scope.content,
                chapter: $scope.currentChapter
            };

            CommentService.createComment(data, function (response) {
                $scope.laddaLoading = false;
                if(response.status == 201) {
                    $scope.reloadComment();
                    $scope.content = '';
                    $scope.commentToggle = true;
                }
            }, function (response) {
                if(response.status == 401) {
                    // re-login
                    RouteService.login();
                }

                $scope.laddaLoading = false;
                AlertService.error('div.post-block', response.data);
            });
        };
    });


