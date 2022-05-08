<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property int $forum_id
 * @property int $group_id
 * @property int $show_forum
 * @property int $read_topic
 * @property int $reply_topic
 * @property int $start_topic
 * @property-read \App\Models\Forum|null $forum
 * @property-read \App\Models\Group|null $group
 * @method static \Database\Factories\PermissionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereForumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereReadTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereReplyTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereShowForum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereStartTopic($value)
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Tells Laravel To Not Maintain The Timestamp Columns.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Belongs To A Group.
     */
    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Belongs To A Forum.
     */
    public function forum(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }
}
