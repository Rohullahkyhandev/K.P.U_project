<template>
    <div class="card">
        <Tabs value="0">
            <TabList>
                <Tab v-for="tab in tabs" :key="tab.title" :value="tab.value">{{
                    tab.title
                }}</Tab>
            </TabList>
            <TabPanels>
                <TabPanel
                    v-for="tab in tabs"
                    :key="tab.content"
                    :value="tab.value"
                >
                    <p class="m-0">{{ tab.content }}</p>
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

const tabs = ref([
    { title: "Tab 1", content: "Tab 1 Content", value: "0" },
    { title: "Tab 2", content: "Tab 2 Content", value: "1" },
    { title: "Tab 3", content: "Tab 3 Content", value: "2" },
]);
</script>
