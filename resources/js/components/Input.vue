<template>
    <label v-bind:for=component.name>{{ component.label }}</label>
    <input type="text" class="form-control" v-bind:name=component.name v-bind:id=component.name v-bind:placeholder="component.placeholder" :required="component.required" v-bind:value="this.value">
    <div v-if="error !== null" v-bind:id="component.name + '_error'" class="text-danger">
        {{ error }}
    </div>
</template>
<script>
export default {
    emits: ["selected"],
    props: {
        component: {
            componentType: String,
            label: String,
            logic: Array,
            messages: Array,
            name: String,
            placeholder: String,
            required: Boolean,
            validation: String,
        },
        value : {
            type: String,
            default: '',
        },
        error : {
            type: String,
            default: null,
        },
    },
}
</script>
