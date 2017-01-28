<div ng-app="OffersApp" ng-controller="OffersController as mainCtrl" ng-init="init()" ng-cloak="">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-2">
                <div class="padded">
                    <h3><span translate="">Sorry, but this offer is no longer valid.</span></h3>

                    <p><span translate="">Our offers are time-sensitive and very limited in quantity. So stay tuned for our next deal / discount and make sure to grab it as soon as possible!</span>
                    </p>

                    <p>&nbsp;</p>

                    <div class="row">
                        <div class="col-xs-12">
                            <ng-switch on="!!waitlist.offer_waitlist_id">
                                <div class="panel panel-default" ng-switch-when="false">
                                    <div class="panel-heading">
                                        <b><span translate="">Would you like to join the waiting list?</span></b>
                                    </div>

                                    <div class="panel-body">
                                        <form class="form-horizontal" ng-submit="mainCtrl.save()">
                                            <fieldset>
                                                <p><span translate="">Get notified first about our upcoming deals and discounts. Also in rare cases if a new spot opens up due to a refund or
                                                        cancellation,
                                                        you may get a second chance to avail this offer.</span></p>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="name"><span translate="">Name:</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name" placeholder="Enter Name" ng-model="waitlist.name" ng-required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="email"><span translate="">Email:</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" id="email" placeholder="Enter Email" ng-model="waitlist.email" ng-required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button type="submit" class="btn btn-flat btn-primary"><span translate>Join waiting list</span> <i class="fa fa-fw fa-angle-right"></i></button>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </form>
                                    </div>
                                </div>

                                <div ng-switch-when="true">
                                    <div class="alert alert-warning" role="alert">
                                        <span translate="">Thank you, you are now on the waiting list.</span>
                                    </div>
                                </div>
                            </ng-switch>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>