<template>
    <li>
        <input
            type="checkbox"
            @click="updateCheck()"
            :checked="item.completed"
        />
        <span :class="item.completed ? 'itemCompleted' : ''">{{
            item.task
        }}</span>
        <button @click="removeItem()">X</button>
    </li>
</template>
<script>
export default {
    name: "ListItem",
    props: {
        item: Object,
    },
    methods: {
        updateCheck() {
            this.item.completed = !this.item.completed;
            axios
                .put(`api/items/${this.item.id}`, {
                    item: this.item,
                })
                .then((res) => {
                    if (res.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch((error) => {
                    console.log("error from axios put", error);
                });
        },
        removeItem() {
            axios
                .delete(`api/items/${this.item.id}`)
                .then((res) => {
                    if (res.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch((error) => {
                    console.log("error from axios delete ", error);
                });
        },
    },
};
</script>
<style>
.itemCompleted {
    color: green;
}
</style>
