<nav x-data="{ open: false }" class="bg-header-dark">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 items-center flex sm:hidden md:flex">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px md:ml-10 sm:flex sm:items-center">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    <div class="ml-3 relative">
                        @include('partials.navigation.dropdowns.clients')
                    </div>

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                {{-- @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        @include('partials.navigation.dropdowns.teams')
                    </div>
                @endif --}}

                <div class="ml-3 relative">
                    @include('partials.navigation.dropdowns.mail')
                </div>
                <!-- Admin Dropdown -->
                <div class="ml-3 relative">
                    @include('partials.navigation.dropdowns.admin')
                </div>

                @can('is-super')
                 <!-- Super Dropdown -->
                <div class="ml-3 relative">
                    @include('partials.navigation.dropdowns.super')
                </div>
                @endcan

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @include('partials.navigation.dropdowns.profile')
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('clients') }}" :active="request()->routeIs('clients')">
                {{ __('Clients') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-yellow">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-yellow">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                    :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                {{-- @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="nav-headers">
                        {{ __('Manage Team') }}
            </div>

            <!-- Team Settings -->
            <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                :active="request()->routeIs('teams.show')">
                {{ __('Team Settings') }}
            </x-jet-responsive-nav-link>

            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                {{ __('Create New Team') }}
            </x-jet-responsive-nav-link>
            @endcan

            <div class="border-t border-gray-200"></div>

            <!-- Team Switcher -->
            <div class="nav-headers">
                {{ __('Switch Teams') }}
            </div>

            @foreach (Auth::user()->allTeams() as $team)
            <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
            @endforeach
            @endif
            --}}
        </div>
    </div>
    </div>
</nav>
