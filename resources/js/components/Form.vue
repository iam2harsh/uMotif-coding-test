<template>
    <form v-bind:action="form.actions[0].route" v-bind:method="form.actions[0].method" enctype='multipart/form-data'>
        <input type="hidden" name="_token" v-bind:value="csrf" />
        <template v-for="component in form.content">
            <div class="form-group" v-if="visibility(component.logic)">
                <component :component=component :is="component.componentType + '-component'" @selected="handleSelected" :value="getValue(component.name)" :error="getError(component.name)"/><br/>
            </div>
        </template>
        <template v-for="action in form.actions">
            <button type="submit" class="btn btn-primary float-end">{{ action.label }}</button>
        </template>
    </form>
</template>
<script>
export default {
    props: {
        form: {
            type: Object,
            required: true
        },
        csrf: {
            type: String,
            required: true
        },
        errors: {
            type: Object,
        },
        old: {
            type: Object,
        }
    },
    data() {
        return {
            event: null
        }
    },
    methods: {
        handleSelected: function (event) {
            this.event = event;
        },
        visibility: function(logic) {
            if (!!logic?.showIf && this.event === null ) {
                return false;
            }

            if (this.event && !!logic?.showIf) {
                return this.event.field === logic.showIf.field && this.event.value === logic.showIf.value;
            }

            return true;
        },
        getValue: function(component) {
            if (!!this.old[component]) {
                return this.old[component];
            }

            return null;
        },
        getError: function(component) {
            if (!!this.errors[component]) {
                return this.errors[component][0];
            }

            return null;
        },
    },
}
</script>
