<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Init extends AbstractMigration
{
    public function change()
    {
        $this->execute("ALTER DATABASE CHARACTER SET 'latin1';");
        $this->execute("ALTER DATABASE COLLATE='latin1_swedish_ci';");
        $table = $this->table("events", ['engine' => "InnoDB", 'encoding' => "utf8", 'collation' => "utf8_unicode_ci", 'comment' => ""]);
        $table->save();
        if ($this->table('events')->hasColumn('id')) {
            $this->table("events")->changeColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'identity' => 'enable'])->update();
        } else {
            $this->table("events")->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 10, 'identity' => 'enable'])->update();
        }
        $table->addColumn('name', 'string', ['null' => false, 'limit' => 45, 'collation' => "utf8_unicode_ci", 'encoding' => "utf8", 'after' => 'id'])->update();
        $table->addColumn('date', 'datetime', ['null' => true, 'after' => 'name'])->update();
        $table->addColumn('location', 'string', ['null' => true, 'limit' => 45, 'collation' => "utf8_unicode_ci", 'encoding' => "utf8", 'after' => 'date'])->update();
        $table->save();
    }
}
