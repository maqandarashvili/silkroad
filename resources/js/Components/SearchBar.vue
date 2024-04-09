<template>
    <div class="flex items-start gap-6 lg:flex-col"
         style="width: 100%">
        <input
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            style="width: 100%"
            type="text" v-model="query" @input="search" placeholder="Search...">
    </div>
</template>

<script>
export default {
    emits: ['searchResponse'],
    data() {
        return {
            query: '',
            results: null,
        };
    },
    methods: {
        search() {
            if (this.query.length > 2) {
                axios.get(`/search?query=${this.query}`)
                    .then(response => {
                        this.$emit('searchResponse', response.data);
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            }
        }
    }
}
</script>
