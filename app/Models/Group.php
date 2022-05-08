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
 * App\Models\Group
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $position
 * @property int $level
 * @property int|null $download_slots
 * @property string $color
 * @property string $icon
 * @property string $effect
 * @property int $is_internal
 * @property int $is_owner
 * @property int $is_admin
 * @property int $is_modo
 * @property int $is_trusted
 * @property int $is_immune
 * @property int $is_freeleech
 * @property int $is_double_upload
 * @property int $can_upload
 * @property int $is_incognito
 * @property int $autogroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\GroupFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereAutogroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCanUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDownloadSlots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereEffect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsDoubleUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsFreeleech($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsImmune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsIncognito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsModo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereIsTrusted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereSlug($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Attributes That Aren't Mass Assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Has Many Users.
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Has Many Permissions.
     */
    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Returns The Requested Row From The Permissions Table.
     */
    public function getPermissionsByForum($forum): ?object
    {
        return Permission::where('forum_id', '=', $forum->id)
            ->where('group_id', '=', $this->id)
            ->first();
    }

    /**
     * Get the Group allowed answer as bool.
     */
    public function isAllowed($object, int $groupId): bool
    {
        if (\is_array($object) && \is_array($object['default_groups']) && \array_key_exists($groupId, $object['default_groups'])) {
            return $object['default_groups'][$groupId] == 1;
        }

        return true;
    }
}
