<?php

/** @var Router $router */
use Minute\Model\Permission;
use Minute\Model\SpecialPermission;
use Minute\Routing\Router;

$router->get('/admin/offers', null, 'admin', 'm_offers[5] as offers')
       ->setReadPermission('offers', 'admin')->setDefault('offers', '*');
$router->post('/admin/offers', null, 'admin', 'm_offers as offers')
       ->setAllPermissions('offers', 'admin');

$router->get('/admin/offers/edit/{offer_id}', null, 'admin', 'm_offers[offer_id] as offers', 'm_ar_campaigns[offers.ar_campaign_id] as broadcast', 'm_pages[offers.page_id][1] as opages',
    'm_ar_campaigns[5] as broadcasts', 'm_pages[5] as pages')
       ->setReadPermission('offers', 'admin')->setReadPermission('broadcasts', 'admin')->setReadPermission('pages', 'admin')
       ->addConstraint('broadcasts', ['type', '=', 'broadcast'])->setDefault('offer_id', '0')
       ->setDefault('broadcasts', '*')->setDefault('pages', '*');

$router->post('/admin/offers/edit/{offer_id}', null, 'admin', 'm_offers as offers', 'm_pages as opages', 'm_pages as pages')
       ->setAllPermissions('offers', 'admin')->setAllPermissions('opages', 'admin')->setAllPermissions('pages', 'admin')
       ->setDefault('offer_id', '0');

$router->get('/offers/{offer_id}', 'Offers', false, 'm_offers[offer_id][1] as offers', 'm_offer_waitlist[offers.offer_id][1] as waitlists')
       ->setReadPermission('offers', Permission::EVERYONE)->setJoinPermission('waitlists', SpecialPermission::SAME_USER_OR_IGNORE)
       ->setDefault('_noView', true);

$router->post('/offers/{offer_id}', null, false, 'm_offer_waitlist as waitlists')
       ->setCreatePermission('waitlists', Permission::EVERYONE);