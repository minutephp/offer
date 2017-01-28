/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class OfferListController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }

        actions = (item) => {
            let gettext = this.gettext;
            let actions = [
                {'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit offer'), 'href': '/admin/offers/edit/' + item.offer_id},
                {'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone offer'), 'click': 'ctrl.clone(item)'},
                {'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this offer'), 'click': 'item.removeConfirm("Removed")'},
            ];

            this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, this.$scope, {item: item, ctrl: this});
        };

        clone = (offer) => {
            let gettext = this.gettext;
            this.$ui.prompt(gettext('Enter new name'), gettext('new-name')).then(function (name) {
                offer.clone().attr('name', name).save(gettext('Offer duplicated'));
            });
        }
    }

    angular.module('offerListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('offerListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', OfferListController]);
}
