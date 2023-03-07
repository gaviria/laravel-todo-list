<template>
    <div>
        <h2>Add Item Form</h2>
        <div>
            <input type="text" v-model="item.task" placeholder="Add Item" />
            <button v-on:click="addItem()">Add</button>
        </div>
    </div>
</template>
<script>
export default {
    name: "AddItemForm",
    data() {
        return {
            item: {
                task: "",
            },
        };
    },
    methods: {
        addItem() {
            if (!this.item.task || this.item.task == "") {
                return;
            }

            axios
                .post("/api/items/store", {
                    item: this.item,
                })
                .then((res) => {
                    if (res.status == 201) {
                        this.item.task = "";
                        this.$emit("reloaddata");
                    }
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>
<style></style>
