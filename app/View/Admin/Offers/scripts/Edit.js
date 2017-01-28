/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />
var App;
(function (App) {
    var OfferEditController = (function () {
        function OfferEditController($scope, $minute, $ui, $timeout, gettext, gettextCatalog) {
            var _this = this;
            this.$scope = $scope;
            this.$minute = $minute;
            this.$ui = $ui;
            this.$timeout = $timeout;
            this.gettext = gettext;
            this.gettextCatalog = gettextCatalog;
            this.getDate = function (type) {
                var date = new Date(_this.$scope.offer.start_at);
                if (!isNaN(date)) {
                    return 'on ' + (type === 'month' ? _this.ordinal(date.getDate()) : ((date.getMonth() + 1) + '/' + date.getDate()));
                }
                return '';
            };
            this.ordinal = function (date) {
                return date + (date > 10 && date < 20 ? 'th' : { 1: 'st', 2: 'nd', 3: 'rd' }[date % 10] || 'th');
            };
            this.selectArCampaign = function () {
                _this.$ui.popupUrl('/broadcasts-popup.html', false, null, { item: _this.$scope.offer, broadcasts: _this.$scope.broadcasts, ctrl: _this });
            };
            this.setBroadcast = function (broadcast) {
                _this.$scope.offer.attr('ar_campaign_id', broadcast.ar_campaign_id);
                _this.$scope.offer.broadcast = broadcast;
                _this.$ui.closePopup();
            };
            this.selectPage = function () {
                _this.$ui.popupUrl('/pages-popup.html', false, null, { item: _this.$scope.offer, pages: _this.$scope.pages, ctrl: _this });
            };
            this.setPage = function (page) {
                _this.$ui.confirm(_this.gettext('This page will only be accessible when this offer is active. Is that OK?')).then(function () {
                    _this.$scope.newPage = page;
                    _this.$ui.closePopup();
                });
            };
            this.save = function () {
                var page = _this.$scope.newPage;
                if (page) {
                    _this.$scope.offer.attr('page_id', page.page_id);
                }
                _this.$scope.offer.save(_this.gettext('Offer saved successfully')).then(function () {
                    if (page) {
                        if (_this.$scope.offer.opages[0]) {
                            _this.$scope.offer.opages[0].attr('redirect', null).save();
                        }
                        page.attr('redirect', '/offers/' + _this.$scope.offer.offer_id).save();
                    }
                });
            };
            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');
            $scope.offer = $scope.offers[0] || $scope.offers.create().attr('duration', 24).attr('repeat', 'never').attr('grace_period', 0).attr('start_at', new Date()).attr('running', false).attr('enabled', true);
            $scope.newPage = null;
        }
        return OfferEditController;
    }());
    App.OfferEditController = OfferEditController;
    angular.module('offerEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('offerEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', OfferEditController]);
})(App || (App = {}));
