/// <reference path="../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var OfferListController = (function () {
        function OfferListController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.actions = function (item) {
                var gettext = _this.gettext;
                var actions = [
                    { 'text': gettext('Edit..'), 'icon': 'fa-edit', 'hint': gettext('Edit offer'), 'href': '/admin/offers/edit/' + item.offer_id },
                    { 'text': gettext('Clone'), 'icon': 'fa-copy', 'hint': gettext('Clone offer'), 'click': 'ctrl.clone(item)' },
                    { 'text': gettext('Remove'), 'icon': 'fa-trash', 'hint': gettext('Delete this offer'), 'click': 'item.removeConfirm("Removed")' },
                ];
                _this.$ui.bottomSheet(actions, gettext('Actions for: ') + item.name, _this.$scope, { item: item, ctrl: _this });
            };
            this.clone = function (offer) {
                var gettext = _this.gettext;
                _this.$ui.prompt(gettext('Enter new name'), gettext('new-name')).then(function (name) {
                    offer.clone().attr('name', name).save(gettext('Offer duplicated'));
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
        }
        return OfferListController;
    }());
    App.OfferListController = OfferListController;
    angular.module('offerListApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('offerListController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', OfferListController]);
})(App || (App = {}));
