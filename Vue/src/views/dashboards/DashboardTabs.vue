<template>
    <div class="card rounded-lg mb-8">
        <Tabs value="0" class="">
            <TabList>
                <Tab value="0">آمریت P.D.C</Tab>
                <Tab value="1">آمریت استادان</Tab>
                <Tab value="2">آمریت برنامه ها فوق لیسانس</Tab>
                <Tab value="3">آمریت تحقیقات </Tab>
                <Tab value="4">آمریت ازتقاع کیفیت </Tab>

            </TabList>
            <TabPanels>
                <TabPanel value="0">
                    <PDCDashboard />
                    <br>
                    <PDCchart />
                    <br>
                    <PdcTableview />
                </TabPanel>
                <TabPanel value="1">
                    <TeacherDashboard />
                </TabPanel>
                <TabPanel value="2">
                    <PostDashboard />
                </TabPanel>
                <TabPanel value="3">
                    <ResearchDashboard />
                </TabPanel>
                <TabPanel value="4">
                    <QualityInhancment />
                </TabPanel>
            </TabPanels>
        </Tabs>
    </div>
</template>

<script setup>
import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";

import { ref } from "vue";
import PDCDashboard from "./PDCDashboard.vue";
import PDCchart from "./chart.vue";
import PdcTableview from "./table.vue";
import TeacherDashboard from "./TeacherDashboard.vue";
import PostDashboard from "./PostGraduatedDashboard.vue";
import ResearchDashboard from "./ResearchDepartmentDashboard.vue";
import QualityInhancment from "./QualityInhancment.vue";

</script>
<style scoped>
.p-tabpanels {
    @apply bg-gray-200;
}

.p-tablist-content {
    @apply bg-slate-800  rounded-lg;
}
/* Customize the background color of the tab headers */
</style>
