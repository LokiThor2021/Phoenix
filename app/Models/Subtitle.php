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

use App\Helpers\StringHelper;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subtitle
 *
 * @property int $id
 * @property string $title
 * @property string $file_name
 * @property int $file_size
 * @property int $language_id
 * @property string $extension
 * @property string|null $note
 * @property int|null $downloads
 * @property int $verified
 * @property int $user_id
 * @property int $torrent_id
 * @property int $anon
 * @property int $status
 * @property string|null $moderated_at
 * @property int|null $moderated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MediaLanguage|null $language
 * @property-read \App\Models\Torrent $torrent
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereAnon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereModeratedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereModeratedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereTorrentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subtitle whereVerified($value)
 * @mixin \Eloquent
 */
class Subtitle extends Model
{
    use Auditable;

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }

    /**
     * Belongs To A Media Language.
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MediaLanguage::class);
    }

    /**
     * Returns The Size In Human Format.
     */
    public function getSize(): string
    {
        $bytes = $this->file_size;

        return StringHelper::formatBytes($bytes, 2);
    }
}
