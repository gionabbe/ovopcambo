<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * A migration class. It either upgrades the databases schema (moves it to new state)
 * or downgrades it to the previous state.
 */
class Version20170720090630 extends AbstractMigration
{
    /**
     * Returns the description of this migration.
     */
    public function getDescription()
    {
        $description = 'A migration which creates the `news`, `event`, `product` and `industry` tables.';
        return $description;
    }

    /**
     * Upgrades the schema to its newer state.
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Create 'news' table
        $table = $schema->createTable('news');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('title', 'string', ['notnull'=>true, 'length'=>512]);
        $table->addColumn('content', 'string', ['notnull'=>true]);
        $table->addColumn('status', 'integer', ['notnull'=>true]);
        $table->addColumn('date_created', 'datetime', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');

        // Create 'event' table
        $table = $schema->createTable('event');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('title', 'string', ['notnull'=>true, 'length'=>512]);
        $table->addColumn('description', 'string', ['notnull'=>true, 'length'=>1024]);
        $table->addColumn('status', 'integer', ['notnull'=>true]);
        $table->addColumn('date_created', 'datetime', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['title'], 'title_indx');
        $table->addOption('engine' , 'InnoDB');

        // Create 'product' table
        $table = $schema->createTable('product');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('name', 'string', ['notnull'=>true, 'length'=>256]);
        $table->addColumn('image', 'string', ['notnull'=>false]);
        $table->addColumn('img_name', 'blob', ['notnull'=>false]);
        $table->addColumn('type', 'integer', ['notnull'=>true]);
        $table->addColumn('description', 'string', ['notnull'=>true, 'length'=>1024]);
        $table->addColumn('status', 'integer', ['notnull'=>true]);
        $table->addColumn('date_created', 'datetime', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'name_indx');
        $table->addOption('engine' , 'InnoDB');

        // Create 'industry' table
        $table = $schema->createTable('industry');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);
        $table->addColumn('name', 'string', ['notnull'=>true, 'length'=>256]);
        $table->addColumn('logo', 'string', ['notnull'=>false]);
        $table->addColumn('logo_name', 'blob', ['notnull'=>false]);
        $table->addColumn('address', 'string', ['notnull'=>true]);
        $table->addColumn('type', 'string', ['notnull'=>true]);
        $table->addColumn('status', 'integer', ['notnull'=>true]);
        $table->addColumn('created_date', 'datetime', ['notnull'=>false]);
        $table->addColumn('registered_date', 'datetime', ['notnull'=>false]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'name_indx');
        $table->addOption('engine' , 'InnoDB');
    }

    /**
     * Reverts the schema changes.
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('industry');
        $schema->dropTable('product');
        $schema->dropTable('event');
        $schema->dropTable('news');

    }
}

