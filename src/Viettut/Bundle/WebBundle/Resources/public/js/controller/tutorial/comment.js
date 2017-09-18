angular
    .module('viettut')
    .controller('CommentController', function ($scope, RouteService, CommentService, AlertService) {
        $scope.comments = [];
        $scope.numberComments = 0;
        $scope.content = '';
        $scope.laddaLoading = false;
        $scope.commentContent = '';
        $scope.currentTutorial = false;
        $scope.commentToggle = false;

        $scope.$watch('comments', function(newVal, odlVal) {
            $scope.numberComments = newVal.length;
        });

        $scope.reloadComment = function() {
            CommentService.getCommentForTutorial(
                $scope.currentTutorial,
                function (response) {
                    $scope.comments = response.data;
                },
                function (response) {
                    AlertService.error('div.post-block', response.data.message);
                }
            );
        };

        $scope.$watch('currentTutorial', function(newVal, oldVal){
            if (typeof newVal == "number") {
                $scope.currentTutorial = newVal;
            }
        });

        $scope.addComment = function() {
            // start progress
            $scope.laddaLoading = true;

            var data = {
                content: $scope.commentContent,
                tutorial: $scope.currentTutorial
            };

            CommentService.createComment(data,
                function(response) {
                    $scope.laddaLoading = false;
                    if(response.status == 201) {
                        $scope.reloadComment();
                        $scope.commentToggle = true;
                        $scope.commentContent = '';
                    }
                },
                function(response) {
                    if(response.status == 401) {
                        RouteService.login();
                    }

                    $scope.laddaLoading = false;
                    AlertService.error('div.post-block', response.data);
                }
            );
        };
    });


