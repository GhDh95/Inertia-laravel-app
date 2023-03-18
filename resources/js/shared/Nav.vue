
<script setup>

import NavLink from './NavLink.vue';

</script>

<template>
    <nav class="">
        <ul class="flex space-x-3">
            <li>

                <NavLink class="hover:underline" href="/" :active="$page.component === 'Homepage'">Home</NavLink>
            </li>

            <li class="hover:underline">
                <NavLink class="hover:underline" href="/users" :active="$page.component === 'Users'">Users</NavLink>
            </li>
            <li class="hover:underline">
                <NavLink class="hover:underline" href="/settings" :active="$page.component === 'Settings'">Settings
                </NavLink>
            </li>
            <li>
                <Link class="hover:underline" href="/logout" method="post" as="button">Logout
                </Link>
            </li>

        </ul>
    </nav>
</template>

