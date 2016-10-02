<?php

namespace Innova\MetronomeBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2015/06/29 03:30:25
 */
class Version20150629153024 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE innova_metronome (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                published TINYINT(1) NOT NULL, 
                modified TINYINT(1) NOT NULL, 
                resourceNode_id INT DEFAULT NULL, 
                UNIQUE INDEX UNIQ_DE4A0C23B87FAB32 (resourceNode_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE innova_metronome 
            ADD CONSTRAINT FK_DE4A0C23B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE innova_metronome
        ");
    }
}