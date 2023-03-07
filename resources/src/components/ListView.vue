<template>
    <h2>List view</h2>
    <hr />
    List Item
    <ul>
        <ListItem
            :item="item"
            v-on:itemchanged="$emit('reloaddata')"
            v-for="item in items"
            :key="item.id"
        />
    </ul>
</template>
<script>
import ListItem from "./ListItem.vue";
export default {
    name: "ListView",
    components: { ListItem },
    props: {
        items: Array,
    },
};
</script>
<style></style>
