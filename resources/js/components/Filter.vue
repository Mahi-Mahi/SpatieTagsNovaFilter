<template>
    <div>
        <h3 class="p-3 text-sm tracking-wide uppercase text-80 bg-30">{{ filter.name }}</h3>

        <div class="p-2">
            <multiselect :clear-on-select="true" :close-on-select="true" :dusk="filter.name + '-filter-select'"
                :internal-search="false" :limit-text="limitText" :limit="3" :loading="isLoading" :max-height="600"
                :multiple="true" :options-limit="300" :options="filter.options" :preserve-search="true"
                :searchable="true" :show-no-results="false" :hide-selected="true" @input="handleChange"
                @search-change="asyncFind" @select="select" label="name" open-direction="bottom"
                :placeholder="placeholder" :noOptions="noOptions" track-by="name" v-model="value"></multiselect>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    components: { Multiselect },
    props: {
        resourceName: {
            type: String,
            required: true,
        },
        filterKey: {
            type: String,
            required: true,
        },
    },
    data() {

        /*
        placeholder: {
                    type: String,
                    default: "Pick some",
                },
                noOptions: {
                    type: String,
                    default: "No options",
                },
                */

        return {
            isLoading: false
        }
    },
    mounted: function () {
        console.log("mounted");
        this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been rendered
            if (!this.isLoading)
                this.asyncFind('');
        })
    },
    methods: {
        handleChange(value, id) {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: value,
            })

            this.$emit('change')
        },
        asyncFind(query) {
            this.isLoading = true
            Nova.request().post('/nova-vendor/spatie-tags-nova-filter/tags', { q: query, tag_type: this.filter.tag_type }).then(response => {
                this.filter.options = response.data;
                this.isLoading = false
            })
        }
    },

    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](
                this.filterKey
            )
        },

        value() {
            return this.filter ? this.filter.currentValue : null
        },
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>
