/// <reference path="../../../../../../../../public/static/bower_components/minute/_all.d.ts" />

module App {
    export class OfferEditController {
        constructor(public $scope: any, public $minute: any, public $ui: any, public $timeout: ng.ITimeoutService,
                    public gettext: angular.gettext.gettextFunction, public gettextCatalog: angular.gettext.gettextCatalog) {

            gettextCatalog.setCurrentLanguage($scope.session.lang || 'en');

            $scope.offer = $scope.offers[0] || $scope.offers.create().attr('duration', 24).attr('repeat', 'never').attr('grace_period', 0).attr('start_at', new Date()).attr('running', false).attr('enabled', true);
            $scope.newPage = null;
        }

        getDate = (type) => {
            let date: any = new Date(this.$scope.offer.start_at);

            if (!isNaN(date)) {
                return 'on ' + (type === 'month' ? this.ordinal(date.getDate()) : ((date.getMonth() + 1) + '/' + date.getDate()));
            }

            return '';
        };

        ordinal = (date) => {
            return date + (date > 10 && date < 20 ? 'th' : {1: 'st', 2: 'nd', 3: 'rd'}[date % 10] || 'th');
        };

        selectArCampaign = () => {
            this.$ui.popupUrl('/broadcasts-popup.html', false, null, {item: this.$scope.offer, broadcasts: this.$scope.broadcasts, ctrl: this});
        };

        setBroadcast = (broadcast) => {
            this.$scope.offer.attr('ar_campaign_id', broadcast.ar_campaign_id);
            this.$scope.offer.broadcast = broadcast;
            this.$ui.closePopup();
        };

        selectPage = () => {
            this.$ui.popupUrl('/pages-popup.html', false, null, {item: this.$scope.offer, pages: this.$scope.pages, ctrl: this});
        };

        setPage = (page) => {
            this.$ui.confirm(this.gettext('This page will only be accessible when this offer is active. Is that OK?')).then(() => {
                this.$scope.newPage = page;
                this.$ui.closePopup();
            });
        };

        save = () => {
            let page = this.$scope.newPage;

            if (page) {
                this.$scope.offer.attr('page_id', page.page_id);
            }

            this.$scope.offer.save(this.gettext('Offer saved successfully')).then(() => {
                if (page) {
                    if (this.$scope.offer.opages[0]) {
                        this.$scope.offer.opages[0].attr('redirect', null).save();
                    }

                    page.attr('redirect', '/offers/' + this.$scope.offer.offer_id).save();
                }
            });
        };
    }

    angular.module('offerEditApp', ['MinuteFramework', 'AdminApp', 'gettext'])
        .controller('offerEditController', ['$scope', '$minute', '$ui', '$timeout', 'gettext', 'gettextCatalog', OfferEditController]);
}
