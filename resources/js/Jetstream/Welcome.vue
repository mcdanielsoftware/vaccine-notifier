<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>Vaccine Notifier</div>

            <div class="mt-8 text-2xl">Current notifications</div>

            <div class="mt-6 text-gray-500">
                Below are a list of notifications you've signed up for.
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                >
                    <div
                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                    >
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Number
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Zip Code
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                    >
                                        555-555-5555
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        12345
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <a
                                            href="#"
                                            class="text-indigo-600 hover:text-indigo-900"
                                            >Delete</a
                                        >
                                    </td>
                                </tr>

                                <!-- More items... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";

export default {
  components: {
    JetApplicationLogo,
  },
};
</script>
