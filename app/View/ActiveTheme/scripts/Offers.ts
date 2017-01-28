/// <reference path="E:/var/Dropbox/projects/minutephp/public/static/bower_components/minute/_all.d.ts" />

module App {
    export class OffersController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');

            let user = $scope.session.user || {};
            $scope.offer = $scope.offers[0];
            console.log("$scope.offer: ", $scope.offer);
            $scope.waitlist = $scope.offer.waitlists[0] || $scope.offer.waitlists.create().attr('user_id', 0);
        }

        save = () => {
            this.$scope.waitlist.save(this.gettext('Thanks!'));
        };
    }

    angular.module('OffersApp', ['MinuteFramework', 'gettext'])
        .controller('OffersController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', OffersController]);
}
