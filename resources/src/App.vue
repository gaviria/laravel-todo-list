<template lang="">
    <h1>{{ title }}</h1>
    <AddItemForm v-on:reloaddata="getItems()" />
    <ListView :items="items" v-on:reloaddata="getItems" />
</template>
<script>
import ListView from "./components/ListView.vue";
import AddItemForm from "./components/AddItemForm.vue";
export default {
    name: "App",
    components: { ListView, AddItemForm },
    data() {
        return {
            items: [],
            title: "TO-DO EXAMPLE!",
        };
    },
    methods: {
        getItems() {
            axios
                .get("api/items")
                .then((res) => {
                    this.items = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
        this.getItems();
    },
};
</script>
<style scoped></style>
