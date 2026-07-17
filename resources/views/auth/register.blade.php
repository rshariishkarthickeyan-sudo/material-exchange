<x-guest-layout>

<h1 class="text-2xl font-bold text-center text-blue-700 mb-6">
    Registration Form
</h1>
    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="'Username'" />
            <x-text-input
                id="username"
                type="text"
                name="username"
                autocomplete="off"
                class="block mt-1 w-full"
            />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="'Name'" />
            <x-text-input id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Designation -->
        <div class="mt-4">
            <x-input-label for="desig" :value="'Designation'" />
            <x-text-input id="desig"
                class="block mt-1 w-full"
                type="text"
                name="desig"
                :value="old('desig')"
                required />
            <x-input-error :messages="$errors->get('desig')" class="mt-2" />
        </div>

        <!-- Unit -->
        <div class="mt-4">
            <x-input-label for="unit" :value="'Unit'" />
            <x-text-input id="unit"
                class="block mt-1 w-full"
                type="text"
                name="unit"
                :value="old('unit')"
                required />
            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
        </div>

        <!-- Section -->
        <div class="mt-4">
            <x-input-label for="sec" :value="'Section'" />
            <x-text-input id="sec"
                class="block mt-1 w-full"
                type="text"
                name="sec"
                :value="old('sec')"
                required />
            <x-input-error :messages="$errors->get('sec')" class="mt-2" />
        </div>

        <!-- Division -->
        <div class="mt-4">
            <x-input-label for="div" :value="'Division'" />
            <x-text-input id="div"
                class="block mt-1 w-full"
                type="text"
                name="div"
                :value="old('div')"
                required />
            <x-input-error :messages="$errors->get('div')" class="mt-2" />
        </div>

        <!-- Group -->
        <div class="mt-4">
            <x-input-label for="group" :value="'Group'" />
            <x-text-input id="group"
                class="block mt-1 w-full"
                type="text"
                name="group"
                :value="old('group')"
                required />
            <x-input-error :messages="$errors->get('group')" class="mt-2" />
        </div>

        <!-- Sub Group -->
        <div class="mt-4">
            <x-input-label for="subgroup" :value="'Sub Group'" />
            <x-text-input id="subgroup"
                class="block mt-1 w-full"
                type="text"
                name="subgroup"
                :value="old('subgroup')"
                required />
            <x-input-error :messages="$errors->get('subgroup')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="'Role'" />

            <select name="role"
                id="role"
                class="block mt-1 w-full border rounded-md"
                required>

                <option value="" selected disabled>
                    Select Role
                </option>

                <option value="employee">Employee</option>
                <option value="authority">Approving Authority</option>
                <option value="security">Security</option>
                <option value="admin">Admin</option>

            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />

            <x-text-input
                id="password"
                type="password"
                name="password"
                autocomplete="new-password"
                class="block mt-1 w-full"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirm Password'" />

            <x-text-input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                class="block mt-1 w-full"
            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">

            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ url('/') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>