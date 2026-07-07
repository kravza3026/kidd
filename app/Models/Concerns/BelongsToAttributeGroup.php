<?php

namespace App\Models\Concerns;

use App\Models\AttributeGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Adds an optional, reorderable group to a taxonomy model (e.g. a Size belongs to the
 * "Clothing" group). The grouping is editable per attribute via AttributeGroup.
 */
trait BelongsToAttributeGroup
{
    public function initializeBelongsToAttributeGroup(): void
    {
        $this->mergeFillable(['attribute_group_id']);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id');
    }
}
