<?php

/** @var Binding $binding */
use Minute\Event\AdminEvent;
use Minute\Event\Binding;
use Minute\Event\ResponseEvent;
use Minute\Event\TodoEvent;
use Minute\Menu\OfferMenu;
use Minute\Offer\InsertOffer;
use Minute\Todo\OfferTodo;

$binding->addMultiple([
    //debug
    ['event' => AdminEvent::IMPORT_ADMIN_MENU_LINKS, 'handler' => [OfferMenu::class, 'adminLinks']],

    ['event' => ResponseEvent::RESPONSE_RENDER, 'handler' => [InsertOffer::class, 'insert']],

    //tasks
    ['event' => TodoEvent::IMPORT_TODO_ADMIN, 'handler' => [OfferTodo::class, 'getTodoList']],
]);