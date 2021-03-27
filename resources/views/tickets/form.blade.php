<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <form method="POST" action="{{ route('addTickets') }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('ФИО') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="fio" :value="old('fio')" required autofocus autocomplete="fio" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Продовец') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="text" name="seller" required autocomplete="Seller" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Сколько билетов: (выбор чисел)') }}" />
                        <select id="password_confirmation" class="block mt-1 w-full" name="count" required autocomplete="count">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="price" value="{{ __('Стоимость') }}" />
                        <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price" required autocomplete="price" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Продать') }}
                        </x-jet-button>
                    </div>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                </form>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
