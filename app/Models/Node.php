<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Node extends Model
{
    protected $table = 'nodes';

    protected $fillable = [
        'title',
        'content'
    ];

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'node_tag');
    }
}
