/// <reference path="E:/var/Dropbox/projects/minutephp/public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var OffersController = (function () {
        function OffersController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.save = function () {
                _this.$scope.waitlist.save(_this.gettext('Thanks!'));
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            var user = $scope.session.user || {};
            $scope.offer = $scope.offers[0];
            console.log("$scope.offer: ", $scope.offer);
            $scope.waitlist = $scope.offer.waitlists[0] || $scope.offer.waitlists.create().attr('user_id', 0);
        }
        return OffersController;
    }());
    App.OffersController = OffersController;
    angular.module('OffersApp', ['MinuteFramework', 'gettext'])
        .controller('OffersController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', OffersController]);
})(App || (App = {}));
