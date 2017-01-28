<div class="content-wrapper ng-cloak" ng-app="offerListApp" ng-controller="offerListController as mainCtrl" ng-init="init()">
    <div class="admin-content">
        <section class="content-header">
            <h1><span translate="">List of offers</span> <small><span translate="">info</span></small></h1>

            <ol class="breadcrumb">
                <li><a href="" ng-href="/admin"><i class="fa fa-dashboard"></i> <span translate="">Admin</span></a></li>
                <li class="active"><i class="fa fa-offer"></i> <span translate="">Offer list</span></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span translate="">All offers</span>
                    </h3>

                    <div class="box-tools">
                        <a class="btn btn-sm btn-primary btn-flat" ng-href="/admin/offers/edit">
                            <i class="fa fa-plus-circle"></i> <span translate="">Create new offer</span>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-bar list-group-item-bar-{{offer.enabled && 'success' || 'danger'}}"
                             ng-repeat="offer in offers" ng-click-container="mainCtrl.actions(offer)">
                            <div class="pull-left">
                                <h4 class="list-group-item-heading">{{offer.name | ucfirst}}</h4>
                                <p class="list-group-item-text hidden-xs">
                                    <span translate="">Created:</span> {{offer.created_at | timeAgo}}.
                                    <span translate="">Description:</span> {{offer.description}}.
                                </p>
                            </div>
                            <div class="md-actions pull-right">
                                <a class="btn btn-default btn-flat btn-sm" ng-href="/admin/offers/edit/{{offer.offer_id}}">
                                    <i class="fa fa-pencil-square-o"></i> <span translate="">Edit..</span>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-push-6">
                            <minute-pager class="pull-right" on="offers" no-results="{{'No offers found' | translate}}"></minute-pager>
                        </div>
                        <div class="col-xs-12 col-md-6 col-md-pull-6">
                            <minute-search-bar on="offers" columns="name, description" label="{{'Search offers..' | translate}}"></minute-search-bar>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
