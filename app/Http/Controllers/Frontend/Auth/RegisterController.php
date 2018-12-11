<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use Illuminate\Http\Request;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller {

    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath() {
        return route(home_route());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($type) {
        abort_unless(config('access.registration'), 404);

        if ($type != 'employer' && $type != 'jobseeker') {
            return abort(404);
        }
        return view('frontend.auth.register')
                        ->withSocialiteLinks((new Socialite)->getSocialLinks())->with('type', $type);
        ;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function register(RegisterRequest $request) {
        $type = $request->input('type');
        if ($type != 'employer' && $type != 'jobseeker') {
            return abort(404);
        }

        if ($type === 'employer') {
            $user = $this->userRepository->create($request->all());
        } else {
            $user = $this->userRepository->create($request->only('name', 'email', 'phone', 'password', 'mailing_subscription'));
        }

        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            return redirect($this->redirectPath())->withFlashSuccess(
                            config('access.users.requires_approval') ?
                            __('exceptions.frontend.auth.confirmation.created_pending') :
                            __('exceptions.frontend.auth.confirmation.created_confirm')
            );
        } else {
            auth()->login($user);

            event(new UserRegistered($user));

            return redirect($this->redirectPath());
        }
    }

}
