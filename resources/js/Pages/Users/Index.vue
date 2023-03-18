<script setup>
import Pagination from '../../shared/Pagination.vue';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/core';
import { debounce } from 'lodash';


const props = defineProps({
    users: Object,
    filters: Object,
    can: Object
});

let search = ref(props.filters.search);

watch(search, debounce(
    value => {
        router.get('/users', { search: value }, { preserveState: true, replace: true })
    }, 250
));

</script>




<template>
    <section class="max-w-xl mx-auto flex flex-col space-y-3 justify-center mt-20 ">

        <div class="flex justify-between">
            <div class="flex items-center space-x-3">

                <h1 class="text-2xl font-semibold">Users</h1>
                <Link v-if="can.createUser" class="hover:underline text-blue-600 font-semibold" href="/users/create">New
                user

                </Link>
            </div>

            <input v-model="search" class="rounded-xl border border-gray-200" type="text" name="" id=""
                placeholder="search..">
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">

                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-50">
                        <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">

                            <div class="text-sm">
                                <div class="font-medium text-gray-700">{{ user.name }}</div>
                            </div>
                        </th>


                        <td class="">
                            <div class="">

                                <Link x-data="{ tooltip: 'Edite' }" :href="`/users/${user.id}/edit`">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                </Link>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- Paginator -->
        <Pagination :links="users.links" />
    </section>
</template>





