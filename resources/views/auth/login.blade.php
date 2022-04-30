@extends('layout.auth')

@section('title')
    <title>{{ \__('auth.login') }} | {{ \config('other.title') }}</title>
@endsection
@section('content')
    <main class="m-auto max-w-lg leading-loose p-6 auth__main">
        <div id="logo" class="my-4">
            {{-- TODO Add different sizes of the logo --}}
            <picture>
                <img src="{{asset('/img/logo.png')}}" alt="logo" loading="lazy">
            </picture>
        </div>
        <form role="form" action="{{ \route('login') }}" method="POST">
            <fieldset>
                <div class="flex flex-col">
                    <div class="flex relative">
                         <span class=" inline-flex items-center px-3 border-t bg-gray-200 border-l border-b  border-gray-300 text-gray-500 shadow-sm text-sm">
                            <svg width="15"
                                 height="15"
                                 fill="currentColor"
                                 viewBox="0 0 1792 1792"
                                 xmlns="http://www.w3.org/2000/svg">
                               <path d="M1792 710v794q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-794q44 49 101 87 362 246 497 345 57 42 92.5 65.5t94.5 48 110 24.5h2q51 0 110-24.5t94.5-48 92.5-65.5q170-123 498-345 57-39 100-87zm0-294q0 79-49 151t-122 123q-376 261-468 325-10 7-42.5 30.5t-54 38-52 32.5-57.5 27-50 9h-2q-23 0-50-9t-57.5-27-52-32.5-54-38-42.5-30.5q-91-64-262-182.5t-205-142.5q-62-42-117-115.5t-55-136.5q0-78 41.5-130t118.5-52h1472q65 0 112.5 47t47.5 113z">
                               </path>
                            </svg>
                         </span>
                        <input type="text"
                               name="username"
                               id="username"
                               class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-gray-200 text-gray-700 placeholder-gray-700 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-desi-gold focus:border-transparent"
                               value="{{old('username')}}"
                               placeholder="Username"
                               required
                               autofocus>
                    </div>
                </div>
                <div class="flex flex-col mt-4 mb-1">
                    <div class="flex relative">
                         <span class=" inline-flex items-center px-3 border-t bg-gray-200 border-l border-b  border-gray-300 text-gray-700 shadow-sm text-sm">
                            <svg width="15"
                                 height="15"
                                 fill="currentColor"
                                 viewBox="0 0 1792 1792"
                                 xmlns="http://www.w3.org/2000/svg">
                               <path d="M1376 768q40 0 68 28t28 68v576q0 40-28 68t-68 28h-960q-40 0-68-28t-28-68v-576q0-40 28-68t68-28h32v-320q0-185 131.5-316.5t316.5-131.5 316.5 131.5 131.5 316.5q0 26-19 45t-45 19h-64q-26 0-45-19t-19-45q0-106-75-181t-181-75-181 75-75 181v320h736z">
                               </path>
                            </svg>
                         </span>
                        <input type="password"
                               name="password"
                               id="password"
                               class="flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-gray-200 text-gray-700 placeholder-gray-700 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-desi-gold focus:border-transparent"
                               placeholder="Password"
                               required>
                    </div>
                </div>
                <div class="flex flex-col pt-1 mb-1">
                    <div class="flex relative">
                        <input class="mr-3" type="checkbox" name="remember" {{ \old('remember') ? 'checked' : '' }}>
                        <label class="text-white" for="remember"> {{ \__('auth.remember-me') }}</label>
                    </div>
                </div>
                @csrf
                @if (\config('captcha.enabled') === true)
                    @hiddencaptcha
                @endif
            </fieldset>
            <button type="submit"
                    id="login-button"
                    class="w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-desi-gold hover:text-black hover:bg-yellow-700 focus:outline-none focus:ring-2">
                   <span class="w-full">
                   {{ __('auth.login') }}
                   </span>
            </button>
        </form>
        <div class="flex justify-center mt-2">
            <a class="w-full px-4  py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-zinc-800 hover:text-white hover:bg-zinc-900 focus:outline-none focus:ring-2"
               href="{{ route('registrationForm', ['code' => 'null']) }}">
                {{ __('auth.signup') }}
            </a>
        </div>
        @if(\config('Phoenix.discord-link'))
            <div class="flex items-center text-center mt-4">
                <a type="button" href="{{\env('DISCORD_LINK','#')}}"
                   class="w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-discord hover:text-black hover:bg-blue-400 focus:outline-none focus:ring-2">
                    <svg class="w-full h-6 mx-2 fill-current"
                         viewBox="0 0 292 80"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#a)">
                            <g clip-path="url(#b)" fill="#fff">
                                <path d="M61.796 16.494a59.415 59.415 0 0 0-15.05-4.73 44.128 44.128 0 0 0-1.928 4.003c-5.612-.844-11.172-.844-16.68 0a42.783 42.783 0 0 0-1.95-4.002 59.218 59.218 0 0 0-15.062 4.74C1.6 30.9-.981 44.936.31 58.772c6.317 4.717 12.44 7.583 18.458 9.458a45.906 45.906 0 0 0 3.953-6.51 38.872 38.872 0 0 1-6.225-3.03 30.957 30.957 0 0 0 1.526-1.208c12.004 5.615 25.046 5.615 36.906 0 .499.416 1.01.82 1.526 1.208a38.775 38.775 0 0 1-6.237 3.035 45.704 45.704 0 0 0 3.953 6.511c6.025-1.875 12.153-4.74 18.47-9.464 1.515-16.04-2.588-29.947-10.844-42.277Zm-37.44 33.767c-3.603 0-6.558-3.363-6.558-7.46 0-4.096 2.892-7.466 6.559-7.466 3.666 0 6.621 3.364 6.558 7.466.006 4.097-2.892 7.46-6.558 7.46Zm24.237 0c-3.603 0-6.558-3.363-6.558-7.46 0-4.096 2.892-7.466 6.558-7.466 3.667 0 6.622 3.364 6.558 7.466 0 4.097-2.891 7.46-6.558 7.46ZM98.03 26.17h15.663c3.776 0 6.966.604 9.583 1.806 2.61 1.201 4.567 2.877 5.864 5.022 1.296 2.145 1.95 4.6 1.95 7.367 0 2.707-.677 5.163-2.031 7.36-1.354 2.204-3.414 3.944-6.185 5.228-2.771 1.283-6.203 1.928-10.305 1.928h-14.54V26.17Zm14.378 21.414c2.542 0 4.499-.65 5.864-1.945 1.366-1.301 2.049-3.071 2.049-5.316 0-2.08-.609-3.739-1.825-4.98-1.216-1.243-3.058-1.87-5.52-1.87h-4.9v14.111h4.332ZM154.541 54.846c-2.169-.575-4.126-1.407-5.864-2.503v-6.81c1.314 1.038 3.075 1.893 5.284 2.567 2.209.668 4.344 1.002 6.409 1.002.964 0 1.693-.128 2.186-.386.494-.258.741-.569.741-.926 0-.41-.132-.75-.402-1.026-.27-.275-.792-.504-1.566-.697l-4.82-1.108c-2.76-.656-4.717-1.565-5.881-2.73-1.165-1.161-1.745-2.685-1.745-4.572 0-1.588.505-2.965 1.527-4.143 1.015-1.178 2.461-2.087 4.337-2.725 1.877-.645 4.068-.967 6.587-.967 2.249 0 4.309.246 6.186.738 1.876.492 3.425 1.12 4.659 1.887v6.44c-1.263-.767-2.709-1.37-4.361-1.828a19.138 19.138 0 0 0-5.084-.674c-2.519 0-3.775.44-3.775 1.313 0 .41.195.715.585.92.39.205 1.107.416 2.146.639l4.016.738c2.623.463 4.579 1.278 5.864 2.438 1.286 1.16 1.928 2.878 1.928 5.152 0 2.49-1.061 4.465-3.19 5.93-2.129 1.465-5.147 2.198-9.06 2.198a26.36 26.36 0 0 1-6.707-.867ZM182.978 53.984c-2.3-1.149-4.039-2.708-5.198-4.677-1.159-1.969-1.744-4.184-1.744-6.645 0-2.462.602-4.665 1.807-6.605 1.205-1.94 2.972-3.464 5.302-4.571 2.329-1.108 5.112-1.659 8.354-1.659 4.016 0 7.35.862 10.001 2.585v7.507c-.935-.656-2.026-1.19-3.271-1.6-1.245-.41-2.576-.615-3.999-.615-2.49 0-4.435.463-5.841 1.395-1.406.931-2.111 2.144-2.111 3.65 0 1.477.682 2.685 2.048 3.634 1.366.944 3.345 1.418 5.944 1.418 1.337 0 2.657-.2 3.959-.592 1.297-.398 2.416-.885 3.351-1.459v7.261c-2.943 1.805-6.357 2.707-10.242 2.707-3.27-.011-6.059-.586-8.36-1.734ZM211.518 53.984c-2.318-1.148-4.085-2.72-5.302-4.718-1.216-1.998-1.83-4.225-1.83-6.686 0-2.462.608-4.66 1.83-6.587 1.222-1.928 2.978-3.44 5.285-4.536 2.3-1.096 5.049-1.641 8.233-1.641 3.185 0 5.933.545 8.234 1.64 2.301 1.097 4.057 2.597 5.262 4.513 1.205 1.917 1.807 4.114 1.807 6.605 0 2.461-.602 4.688-1.807 6.687-1.205 1.998-2.967 3.569-5.285 4.717-2.318 1.149-5.055 1.723-8.216 1.723-3.162 0-5.899-.568-8.211-1.717Zm12.204-7.279c.976-.996 1.469-2.314 1.469-3.955s-.488-2.948-1.469-3.915c-.975-.973-2.307-1.46-3.993-1.46-1.716 0-3.059.487-4.04 1.46-.975.973-1.463 2.274-1.463 3.915 0 1.64.488 2.96 1.463 3.956.976.996 2.324 1.5 4.04 1.5 1.686-.006 3.018-.504 3.993-1.5ZM259.17 31.34v8.86c-1.021-.685-2.341-1.025-3.976-1.025-2.141 0-3.793.662-4.941 1.986-1.153 1.325-1.727 3.388-1.727 6.177v7.548h-9.84V30.888h9.64v7.63c.533-2.79 1.4-4.846 2.593-6.176 1.188-1.325 2.725-1.987 4.596-1.987 1.417 0 2.634.328 3.655.985ZM291.864 25.35v29.537h-9.841v-5.374c-.832 2.022-2.094 3.563-3.792 4.618-1.699 1.049-3.799 1.576-6.289 1.576-2.226 0-4.165-.55-5.824-1.658-1.658-1.108-2.937-2.626-3.838-4.554-.895-1.928-1.349-4.108-1.349-6.546-.028-2.514.448-4.77 1.429-6.769.976-1.998 2.358-3.557 4.137-4.676 1.779-1.12 3.81-1.682 6.088-1.682 4.688 0 7.832 2.08 9.438 6.235V25.35h9.841Zm-11.309 21.191c1.004-.996 1.503-2.29 1.503-3.873 0-1.53-.488-2.778-1.463-3.733-.976-.956-2.313-1.436-3.994-1.436-1.658 0-2.983.486-3.976 1.46-.993.972-1.486 2.232-1.486 3.79 0 1.56.493 2.831 1.486 3.816.993.984 2.301 1.477 3.936 1.477 1.658-.006 2.989-.504 3.994-1.5ZM139.382 33.443c2.709 0 4.906-2.015 4.906-4.5 0-2.486-2.197-4.501-4.906-4.501-2.71 0-4.906 2.015-4.906 4.5 0 2.486 2.196 4.501 4.906 4.501ZM134.472 36.544c3.006 1.324 6.736 1.383 9.811 0v18.471h-9.811V36.544Z"/>
                            </g>
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path fill="#fff" transform="translate(0 11.765)" d="M0 0h292v56.471H0z"/>
                            </clipPath>
                            <clipPath id="b">
                                <path fill="#fff" transform="translate(0 11.765)" d="M0 0h292v56.471H0z"/>
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        @endif
        <div class="flex justify-center mt-4">
            <a class="hover:underline" href="{{\route('password.request')}}">{{ __('auth.lost-password') }}</a>
            <span class="mx-1">|</span>
            <a class="hover:underline" href="{{\route('username.request')}}">{{ __('auth.lost-username') }}</a>
        </div>
    </main>
@endsection