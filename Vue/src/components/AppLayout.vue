<template>
    <div class="flex min-h-screen overflow-hidden max-w-full mx-auto" dir="rtl">
        <!-- navbar  -->
        <Sidebar />
        <div class="flex items-center bg-gray-200 flex-grow flex-col">
            <Navbar />
            <div class="mb-auto" style="width: 97%">
                <router-view></router-view>
            </div>
            <Footer />
        </div>
    </div>
</template>
<script setup>
import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";
import Sidebar from "./Sidebar.vue";
</script>
