<template>
    <div class="text-xs post-rate-wrapper">
        <button
            class="text-blue-500 hover:text-blue-600 transition duration-150 ease-in-out mr-2"
            @click="toggleLike('like')">Like</button>
        <button
            class="text-red-500 hover:text-red-600 transition duration-150 ease-in-out size"
            @click="toggleLike('dislike')">Dislike</button>
    </div>
</template>

<script>
export default {
    props: {
        post: Object,
    },
    methods: {
        toggleLike(type) {
            axios.post(`/posts/${this.post.id}/likes`, {type})
                .then(response => {
                    console.log(response);
                })
                .catch(error => console.error('Error toggling like:', error));
        }
    }
}
</script>
