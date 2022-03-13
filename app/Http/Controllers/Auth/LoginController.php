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

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Upon Successful Login
    protected string $redirectTo = '/';

    // Max Attempts Until Lockout
    public int $maxAttempts = 3;

    // Minutes Lockout
    public int $decayMinutes = 60;

    /**
     * LoginController Constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username(): string
    {
        return 'username';
    }

    /**
     * Validate The User Login Request.
     *
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request): void
    {
        if (\config('captcha.enabled') == true) {
            $this->validate($request, [
                $this->username()      => 'required|string',
                'password'             => 'required|string',
                'captcha'              => 'hiddencaptcha',
            ]);
        } else {
            $this->validate($request, [
                $this->username() => 'required|string',
                'password'        => 'required|string',
            ]);
        }
    }

    protected function authenticated(Request $request, $user): \Illuminate\Http\RedirectResponse
    {
        $bannedRole = \cache()->rememberForever('banned_role', fn () => Role::where('slug', '=', 'banned')->pluck('id'));
        $disabledRole = \cache()->rememberForever('disabled_role', fn () => Role::where('slug', '=', 'disabled')->pluck('id'));
        $memberRole = \cache()->rememberForever('member_role', fn () => Role::where('slug', '=', 'user')->pluck('id'));

        if (! $user->hasPrivilegeTo('active_user')) {
            $this->guard()->logout();
            $request->session()->invalidate();

            return \to_route('login')
                ->withErrors(\trans('auth.not-activated'));
        }

        if ($user->role_id === $bannedRole[0]) {
            $this->guard()->logout();
            $request->session()->invalidate();

            return \to_route('login')
                ->withErrors(\trans('auth.banned'));
        }

        if ($user->role_id === $disabledRole[0]) {
            $user->role_id = $memberRole[0];
            $user->disabled_at = null;
            $user->save();

            return \to_route('home.index')
                ->withSuccess(\trans('auth.welcome-restore'));
        }

        if (\auth()->viaRemember() && $user->role_id === $disabledRole[0]) {
            $user->role_id = $memberRole[0];
            $user->disabled_at = null;
            $user->save();

            return \to_route('home.index')
                ->withSuccess(\trans('auth.welcome-restore'));
        }

        if ($user->read_rules == 0) {
            return \redirect()->to(\config('other.rules_url'))
                ->withWarning(\trans('auth.require-rules'));
        }

        return \redirect()->intended()
            ->withSuccess(\trans('auth.welcome'));
    }
}
