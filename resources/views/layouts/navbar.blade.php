<nav class="navbar navbar-expand-lg bg-light-subtle">
    <div class="container-fluid">
        <x-application-logo class="navbar-brand mb-0"/>
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>
        </ul>
        <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="btn dropdown-toggle border-0 py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                </x-slot>

                <x-slot name="content">
                    <li><x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link></li>

                    <!-- Authentication -->
                    <li><form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form></li>
                </x-slot>
            </x-dropdown>

            <x-secondary-button href="/create">
                {{ __('Make quiz') }}
            </x-secondary-button>
            
    </div>


</nav>