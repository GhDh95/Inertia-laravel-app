<template>
    <!-- header -->

    <Head>
        <title> my app - {{ $page.component }} </title>
    </Head>



    <section class="p-3">

        <header class="flex items-center justify-between bg-gray-100 rounded md:px-10">
            <h1 class="text-2xl md:text-3xl flex-shrink-0">My App</h1>
            <p>welcome, back
                <span v-if="auth.user">{{ auth.user.name??= 'user' }}</span>
            </p>
            <Nav />
        </header>
        <slot></slot>

    </section>
</template>

<script setup>

import Nav from './Nav.vue';

const props = defineProps({
    auth: Object
});

</script>

