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

}