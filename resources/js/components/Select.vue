<template>
    <label v-bind:for=component.name>{{ component.label }}</label>
    <select @change="$emit('selected', {field: this.component.name, value: $event.target.value})" class="form-select" v-bind:name="component.name" v-bind:id=component.name :required="component.required">
        <option v-for="option in component.options" v-bind:value="option.value">{{ option.label }}</option>
    </select>
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
            options: Array,
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
