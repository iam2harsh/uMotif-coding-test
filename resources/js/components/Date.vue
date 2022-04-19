<template>
    <label v-bind:for=component.name>{{ component.label }}</label>
    <date-picker v-bind:name="component.name" v-model=picked inputFormat="dd/MM/yyyy" class="form-control" v-bind:id=component.name v-bind:placeholder="component.placeholder" :required="component.required"/>
    <div v-if="error !== null" v-bind:id="component.name + '_error'" class="text-danger">
        {{ error }}
    </div>
</template>
<script>
import moment from 'moment';
export default {
    emits: ["selected"],
    data() {
        return { picked: this.value ? moment(this.value, 'DD-MM-YYYY').toDate() : null }
    },
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
            default: null,
        },
        error : {
            // type: String,
            default: null,
        },
    },
}
</script>
