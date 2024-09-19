<x-app-layout>

    <p class="flex justify-center text-gray-700 mt-12 p-5">P R O F I L E</p>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            
            <hr class="py-4" />
            
            <p class="flex justify-center text-gray-700 mt-12 p-5">P A S S W O R D</p>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <hr class="py-4" />
            
            <p class="flex justify-center text-gray-700 mt-12 p-5">A C C O U N T</p>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
