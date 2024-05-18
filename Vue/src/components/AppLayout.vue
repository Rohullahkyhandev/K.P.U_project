<template>
    <div class="flex min-h-screen" dir="rtl">
        <!-- navbar  -->
        <Sidebar />
        <div class="flex items-center bg-gray-300 flex-grow flex-col">
            <Navbar />
            <div class="mb-auto" style="width: 90% !important">
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
