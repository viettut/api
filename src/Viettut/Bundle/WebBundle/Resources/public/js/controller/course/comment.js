angular
    .module('viettut')
    .controller('CommentController', function CommentController($scope, RouteService, CommentService) {
        $scope.comments = [];
        $scope.numberComments = 0;
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.error = '';
        $scope.showError = false;
        $scope.commentToggle = false;
        $scope.currentCourse = false;

        $scope.showReplyForm = function() {

        };

        $scope.reloadComment = function() {
            CommentService.getCommentForCourse($scope.currentCourse, 
                function (response) {
                    $scope.comments = response.data;
                    $scope.numberComments = $scope.comments.length;
                }, function (response) {
                }
            );
        };

        $scope.$watch('currentCourse', function(newVal, oldVal){
            if (typeof newVal == "number") {
                $scope.currentCourse = newVal;
            }
        });

        $scope.addComment = function() {
            var data = {
                content: $scope.content,
                course: $scope.currentCourse
            };
            
            // start progress
            $scope.laddaLoading = true;
            
            CommentService.createComment(data, function(response){
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.reloadComment();
                        $scope.commentToggle = true;
                        $scope.content = '';
                    }
                },
                function(response){
                    if(response.status == 401) {
                        RouteService.login();
                    }

                    $scope.laddaLoading = false;
                    $scope.error = response.data;
                    $scope.showError = true;
                }
            );
        };
    });


