<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-indigo-700">
            <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8 relative">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Having a hard time finding a vaccine appointment?</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-indigo-200">Create an account to be notified when vaccine appointments become available near you. This service is and always will be free.</p>
                <inertia-link :href="route('register')" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                    Sign up for free
                </inertia-link>
                <div v-if="canLogin" class="hidden  sm:block">
                    <p class="text-white pt-8">Already have an account?</p>
                    <p><inertia-link :href="route('login')" class="text-sm text-white hover:underline font-bold">
                        Log in
                    </inertia-link></p>
                </div>
                <div class="sm:block text-gray-200 flex flex-row justify-content-around mt-8">
                    <inertia-link :href="route('policy.show')" class="text-sm text-white hover:underline font-bold">
                       Privacy Policy
                    </inertia-link>
                    <span> | </span>
                    <inertia-link :href="route('terms.show')" class="text-sm text-white hover:underline font-bold">
                        Terms of Use
                    </inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
