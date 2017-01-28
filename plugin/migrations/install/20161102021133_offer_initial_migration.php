<?php
use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class OfferInitialMigration extends AbstractMigration
{
    public function change()
    {
        // Automatically created phinx migration commands for tables from database minute

        // Migration for table m_offer_waitlist
        $table = $this->table('m_offer_waitlist', array('id' => 'offer_waitlist_id'));
        $table
            ->addColumn('offer_id', 'integer', array('limit' => 11))
            ->addColumn('user_id', 'integer', array('null' => true, 'limit' => 11))
            ->addColumn('created_at', 'datetime', array('null' => true))
            ->addColumn('name', 'string', array('null' => true, 'limit' => 255))
            ->addColumn('email', 'string', array('null' => true, 'limit' => 255))
            ->addIndex(array('offer_id', 'email'), array('unique' => true))
            ->addIndex(array('offer_id', 'user_id'), array('unique' => true))
            ->create();


        // Migration for table m_offers
        $table = $this->table('m_offers', array('id' => 'offer_id'));
        $table
            ->addColumn('name', 'string', array('limit' => 50))
            ->addColumn('description', 'string', array('limit' => 255))
            ->addColumn('created_at', 'datetime', array())
            ->addColumn('updated_at', 'datetime', array())
            ->addColumn('page_id', 'integer', array('limit' => 11))
            ->addColumn('ar_campaign_id', 'integer', array('limit' => 11))
            ->addColumn('start_at', 'date', array('null' => true))
            ->addColumn('duration', 'integer', array('limit' => 11))
            ->addColumn('repeat', 'enum', array('default' => 'never', 'values' => array('never','monthly','yearly')))
            ->addColumn('grace_period', 'integer', array('default' => '6', 'limit' => 11))
            ->addColumn('banner_json', 'text', array('null' => true, 'limit' => MysqlAdapter::TEXT_LONG))
            ->addColumn('enabled', 'enum', array('default' => 'true', 'values' => array('true','false')))
            ->addColumn('running', 'enum', array('default' => 'false', 'values' => array('true','false')))
            ->addIndex(array('name'), array('unique' => true))
            ->addIndex(array('enabled', 'running'), array())
            ->create();


    }
}