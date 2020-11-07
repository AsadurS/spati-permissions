<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait UsesUuid
 *
 * @package App\Helpers\Traits
 */
trait UsesUuid
{
    /** @var string */
    private $uuidColumn = "uuid";

    /**
     * Boot the trait, adding a creating observer.
     * When persisting a new model instance, we resolve the UUID field, then set
     * a fresh UUID, taking into account if we need to cast to binary or not.
     *
     * @return void
     */
    public static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if ($model->usesUuid() === false) {
                return;
            }

            $model->attributes[$model->uuidColumn] = Str::orderedUuid()->toString();
        });
    }

    /**
     * Scope queries to find by UUID(s).
     *
     * @param Builder      $query
     * @param string|array $uuid
     * @return Builder
     */
    public function scopeWhereUuid($query, $uuid)
    {
        return (!is_array($uuid)
            ? $query->where($this->uuidColumn, $uuid)
            : $query->whereIn($this->uuidColumn, $uuid)
        );
    }

    /**
     * Determine whether an UUID attribute should be inserted.
     *
     * @return bool
     */
    protected function usesUuid()
    {
        return true;
    }
}
