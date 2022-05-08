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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserPrivacy
 *
 * @property int $id
 * @property int $user_id
 * @property int $show_achievement
 * @property int $show_bon
 * @property int $show_comment
 * @property int $show_download
 * @property int $show_follower
 * @property int $show_online
 * @property int $show_peer
 * @property int $show_post
 * @property int $show_profile
 * @property int $show_profile_about
 * @property int $show_profile_achievement
 * @property int $show_profile_badge
 * @property int $show_profile_follower
 * @property int $show_profile_title
 * @property int $show_profile_bon_extra
 * @property int $show_profile_comment_extra
 * @property int $show_profile_forum_extra
 * @property int $show_profile_request_extra
 * @property int $show_profile_torrent_count
 * @property int $show_profile_torrent_extra
 * @property int $show_profile_torrent_ratio
 * @property int $show_profile_torrent_seed
 * @property int $show_profile_warning
 * @property int $show_rank
 * @property int $show_requested
 * @property int $show_topic
 * @property int $show_upload
 * @property int $show_wishlist
 * @property array $json_profile_groups
 * @property array $json_torrent_groups
 * @property array $json_forum_groups
 * @property array $json_bon_groups
 * @property array $json_comment_groups
 * @property array $json_wishlist_groups
 * @property array $json_follower_groups
 * @property array $json_achievement_groups
 * @property array $json_rank_groups
 * @property array $json_request_groups
 * @property array $json_other_groups
 * @property-read array $expected_fields
 * @property-read array $expected_groups
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserPrivacyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonAchievementGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonBonGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonCommentGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonFollowerGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonForumGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonOtherGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonProfileGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonRankGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonRequestGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonTorrentGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereJsonWishlistGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowAchievement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowBon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowDownload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowPeer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileAchievement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileBadge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileBonExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileCommentExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileForumExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileRequestExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileTorrentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileTorrentExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileTorrentRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileTorrentSeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowProfileWarning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowRequested($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereShowWishlist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPrivacy whereUserId($value)
 * @mixin \Eloquent
 */
class UserPrivacy extends Model
{
    use HasFactory;

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'user_privacy';

    /**
     * The Attributes That Should Be Cast To Native Values.
     *
     * @var array
     */
    protected $casts = [
        'json_profile_groups'     => 'array',
        'json_torrent_groups'     => 'array',
        'json_forum_groups'       => 'array',
        'json_bon_groups'         => 'array',
        'json_comment_groups'     => 'array',
        'json_wishlist_groups'    => 'array',
        'json_follower_groups'    => 'array',
        'json_achievement_groups' => 'array',
        'json_rank_groups'        => 'array',
        'json_request_groups'     => 'array',
        'json_other_groups'       => 'array',
    ];

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Get the Expected groups for form validation.
     */
    public function getExpectedGroupsAttribute(): array
    {
        return ['default_groups' => ['1' => 0]];
    }

    /**
     * Get the Expected fields for form validation.
     */
    public function getExpectedFieldsAttribute(): array
    {
        return [];
    }

    /**
     * Set the base vars on object creation without touching boot.
     */
    public function setDefaultValues(string $type = 'default'): void
    {
        foreach ($this->casts as $k => $v) {
            if ($v == 'array') {
                $this->$k = $this->expected_groups;
            }
        }
    }
}
