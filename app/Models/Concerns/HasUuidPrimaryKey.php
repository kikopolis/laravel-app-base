<?php
declare(strict_types = 1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuidPrimaryKey {
    /**
     * @SuppressWarnings(PHPMD)
     */
    protected static function bootHasUuidPrimaryKey(): void {
        static::creating(static function (Model $model) {
            if ($model->getKey() === null || $model->getKey() !== '') {
                // @SuppressWarnings(PHPMD)
                $model->{$model->getKeyName()} = (string) Uuid::uuid7(); // @phpstan-ignore property.dynamicName
            }
        });
    }
    
    public function getKeyName(): string {
        return 'id';
    }
    
    public function getIncrementing(): bool {
        return false;
    }
    
    public function getKeyType(): string {
        return 'string';
    }
}
