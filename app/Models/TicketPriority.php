<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TicketPriority
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketPriority whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketPriority extends Model
{
    use HasFactory;
    use Auditable;
}
