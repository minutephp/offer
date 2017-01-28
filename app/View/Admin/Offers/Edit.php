<div class="content-wrapper ng-cloak" ng-app="offerEditApp" ng-controller="offerEditController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1>
                <span translate="" ng-show="!offer.offer_id">Create new</span>
                <span translate="" ng-show="!!offer.offer_id">Edit</span>
                <span translate="">offer</span>
            </h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li><a href="" ng-href="/admin/offers"><i class="fa fa-offer"></i> <span translate="">Offers</span></a></li>
                <li class="active"><i class="fa fa-edit"></i> <span translate="">Edit offer</span></li>
            </ol>
        </section>

        <section class="content">
            <form class="form-horizontal" name="offerForm" ng-submit="mainCtrl.save()">
                <div class="box box-{{offerForm.$valid && 'success' || 'danger'}}">
                    <div class="box-header with-border">
                        <span translate="" ng-show="!offer.offer_id">New offer</span>
                        <span ng-show="!!offer.offer_id"><span translate="">Edit</span> {{offer.name}}</span>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"><span translate="">Name:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Enter Offer Name" ng-model="offer.name" ng-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="description"><span translate="">Description:</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" placeholder="Enter Offer Description" ng-model="offer.description" ng-required="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="offer_url"><span translate="">Offer page:</span></label>
                            <div class="col-sm-9">
                                <p class="help-block">
                                    <button type="button" class="btn btn-xs btn-flat btn-default" ng-click="mainCtrl.selectPage()">
                                        <i class="fa fa-envelope"></i>
                                        <span ng-show="!!offer.opages[0].page_id">{{offer.opages[0].name}} (change)</span>
                                        <span translate="" ng-show="!offer.opages[0].page_id">Select offer page..</span>
                                    </button>
                                </p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="broadcast"><span translate="">Email campaign:</span></label>
                            <div class="col-sm-9">
                                <p class="help-block">
                                    <button type="button" class="btn btn-xs btn-flat btn-default" ng-click="mainCtrl.selectArCampaign()">
                                        <i class="fa fa-envelope"></i>
                                        <span ng-show="!!offer.broadcast.name">{{offer.broadcast.name}} (change)</span>
                                        <span translate="" ng-show="!offer.broadcast.name">Select offer broadcast e-mail..</span>
                                    </button>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="start_at"><span translate="">Offer start date:</span></label>
                            <div class="col-sm-9 col-md-4">
                                <p class="help-block">
                                    <input type="date" class="form-control" id="start_at" placeholder="Offer start on" ng-model="offer.start_at" ng-required="true">
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span translate="">Repeat:</span></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" ng-model="offer.repeat" ng-value="'never'"> Never
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="offer.repeat" ng-value="'monthly'"> Every month {{mainCtrl.getDate('month')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="offer.repeat" ng-value="'yearly'"> Every year {{mainCtrl.getDate('year')}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="duration"><span translate="">Offer expires in:</span></label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Enter offer duration" ng-model="offer.duration">
                                    <div class="input-group-addon">hours</div>
                                </div>
                                <p class="help-block"><span translate="">(offer duration)</span></p>
                            </div>
                            <div class="col-sm-1">
                                <p class="help-block">+</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Enter grace period" ng-model="offer.grace_period">
                                    <div class="input-group-addon">hours</div>
                                </div>
                                <p class="help-block"><span translate="">(grace period)</span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="banner">
                                <span translate="">Alert html:</span>
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="2" placeholder="Enter Banner HTML" ng-model="offer.banner_json.html" ng-required="false"></textarea>
                            </div>
                        </div>

                        <div ng-show="!!offer.banner_json.html">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span translate="">Alert placement:</span></label>
                                <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" ng-model="offer.banner_json.placement.website"> All website pages (excluding homepage)
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" ng-model="offer.banner_json.placement.members"> Member's area
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" ng-model="offer.banner_json.placement.admin"> Admin area
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" ng-model="offer.banner_json.placement.homepage"> Homepage
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="banner_visibility"><span translate="">Alert visibility:</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="banner_visibility" placeholder="trial, power, etc" ng-model="offer.banner_json.visibility" ng-required="false">
                                    <p class="help-block"><span translate="">(leave blank to show to everyone)</span></p>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><span translate="">Enabled:</span></label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" ng-model="offer.enabled" ng-value="true"> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="offer.enabled" ng-value="false"> No
                                </label>
                            </div>
                        </div>


                    </div>

                    <div class="box-footer with-border">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-flat btn-primary" ng-disabled="!offer.ar_campaign_id">
                                    <span translate="" ng-show="!offer.offer_id">Create</span>
                                    <span translate="" ng-show="!!offer.offer_id">Update</span>
                                    <span translate="">offer</span>
                                    <i class="fa fa-fw fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <script type="text/ng-template" id="/broadcasts-popup.html">
        <div class="box">
            <div class="box-header with-border">
                <b class="pull-left"><span translate="">All broadcasts</span></b>
                <a class="pull-right close-button" href=""><i class="fa fa-times"></i></a>
                <div class="clearfix"></div>
            </div>

            <div class="box-body">
                <div class="list-group-item list-group-item-bar" ng-repeat="broadcast in broadcasts">
                    <div class="pull-left">
                        <h4 class="list-group-item-heading">{{broadcast.name | ucfirst}}</h4>
                        <p class="list-group-item-text hidden-xs">
                            {{broadcast.description}}
                        </p>
                    </div>
                    <div class="pull-right" ng-show="broadcast.ar_campaign_id !== item.ar_campaign_id">
                        <a class="btn btn-default btn-flat close-button" ng-click="ctrl.setBroadcast(broadcast)">
                            <span translate="">Pick</span>
                        </a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="box-footer with-border">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-push-6">
                        <minute-pager class="pull-right" on="broadcasts" no-results="{{'No broadcasts found' | translate}}"></minute-pager>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-pull-6">
                        <minute-search-bar on="broadcasts" columns="name, description" label="{{'Search broadcasts..' | translate}}"></minute-search-bar>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/ng-template" id="/pages-popup.html">
        <div class="box">
            <div class="box-header with-border">
                <b class="pull-left"><span translate="">All pages</span></b>
                <a class="pull-right close-button" href=""><i class="fa fa-times"></i></a>
                <div class="clearfix"></div>
            </div>

            <div class="box-body">
                <div class="list-group-item list-group-item-bar" ng-repeat="page in pages">
                    <div class="pull-left">
                        <h4 class="list-group-item-heading">{{page.name | ucfirst}}</h4>
                        <p class="list-group-item-text hidden-xs">
                            {{page.slug}}
                        </p>
                    </div>
                    <div class="pull-right" ng-show="page.page_id !== item.page_id">
                        <a class="btn btn-default btn-flat close-button" ng-click="ctrl.setPage(page)">
                            <span translate="">Pick</span>
                        </a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="box-footer with-border">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-push-6">
                        <minute-pager class="pull-right" on="pages" no-results="{{'No pages found' | translate}}"></minute-pager>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-pull-6">
                        <minute-search-bar on="pages" columns="name, slug, keywords" label="{{'Search pages..' | translate}}"></minute-search-bar>
                    </div>
                </div>
            </div>
        </div>
    </script>
</div>
