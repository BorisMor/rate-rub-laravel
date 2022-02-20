<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель с описанием таблицы для хранения курса
 */
class Rate extends Model
{
    public const ATTR_DATE_AT  = 'date_at';
    public const ATTR_CURRENCY = 'currency';
    public const ATTR_VALUE    = 'value';

    protected $table      = 'rate';
    protected $primaryKey = 'id';
}
