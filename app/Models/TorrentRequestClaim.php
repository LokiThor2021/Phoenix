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
 * App\Models\TorrentRequestClaim
 *
 * @property int $id
 * @property int $request_id
 * @property string|null $username
 * @property int $anon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TorrentRequestClaimFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim whereAnon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TorrentRequestClaim whereUsername($value)
 * @mixin \Eloquent
 */
class TorrentRequestClaim extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'request_claims';
}
