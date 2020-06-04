<?php

namespace denis909\yii;

class Migration extends \yii\db\Migration
{

    public $tableName;

    public $keyPrefix;

    public $keySuffix;

    public $indexPrefix;

    public $indexSuffix;

    public $defaultMysqlOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function getCreatedColumn()
    {
        return $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP');
    }

    public function getBooleanColumn($defaultValue = 0)
    {
        return $this->tinyInteger()->unsigned()->notNull()->defaultValue($defaultValue);
    }

    public function getKeyName($name)
    {
        return $this->keyPrefix . $name . $this->keySuffix;
    }

    public function getIndexName($name)
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