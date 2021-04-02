<?php

namespace denis909\yii;

class Migration extends \yii\db\Migration
{

    public $tableName;

    public $foreignKeyPrefix;

    public $foreignKeySuffix;

    public $indexPrefix;

    public $indexSuffix;

    public $defaultMysqlOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function created()
    {
        return $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP');
    }

    public function updated($currentTimestamp = false)
    {
        $return = $this->timestamp()->notNull()->append('ON UPDATE CURRENT_TIMESTAMP');

        if ($currentTimestamp)
        {
            return $return->defaultExpression('CURRENT_TIMESTAMP');
        }
    
        return $return->defaultValue(null);
    }

    public function boolean($defaultValue = 0)
    {
        return $this->tinyInteger()->unsigned()->notNull()->defaultValue($defaultValue);
    }

    public function foreignKeyName($name)
    {
        return $this->foreignKeyPrefix . $name . $this->foreignKeySuffix;
    }

    public function indexName($name)
    {
        return $this->indexPrefix . $name . $this->indexSuffix;
    }

    public function createTable($table, $columns, $options = null)
    {
        if ($options === null)
        {
            if ($this->db->driverName === 'mysql')
            {
                $options = $this->defaultMysqlOptions;
            }
        }

        return parent::createTable($table, $columns, $options);
    }

    public function createIndex($name, $table, $columns, $unique = false, bool $prepareName = false)
    {
        if ($prepareName)
        {
            $name = $this->indexName($name);
        }

        return parent::createIndex($name, $table, $columns, $unique);
    }

    public function addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete = null, $update = null, bool $prepareName = false)
    {
        if ($prepareName)
        {
            $name = $this->foreignKeyName($name);
        }

        return parent::addForeignKey($name, $table, $column, $refTable, $refColumns, $delete, $update);
    }

    public function dropForeignKey($name, $table, bool $prepareName = false)
    {
        if ($prepareName)
        {
            $name = $this->foreignKeyName($name);
        }

        return parent::dropForeignKey($name, $table);
    }

    public function dropIndex($name, $table, bool $prepareName = false)
    {
        if ($prepareName)
        {
            $name = $this->indexName($name);
        }
        
        return parent::dropIndex($name, $table);
    }

}