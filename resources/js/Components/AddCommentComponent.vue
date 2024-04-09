<template>
    <div class="add-comment-container">
        <form @submit.prevent="submitComment" class="flex flex-col gap-3">
            <textarea v-model="commentBody" placeholder="Write your comment here..." required class="p-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 transition duration-150 ease-in-out"></textarea>
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                Submit Comment
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        postId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            commentBody: '',
        };
    },
    methods: {
        submitComment() {
            const payload = {
                body: this.commentBody,
            };

            axios.post(`/posts/${this.postId}/comments`, payload)
                .then(response => {
                    this.commentBody = '';
                    this.$emit('commentAdded', response.data);
                })
                .catch(error => {
                    console.error('Error adding comment:', error.response.data);
                });
        },
    },
}
</script>

<style scoped>
.add-comment-container form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.add-comment-container textarea {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    min-height: 100px;
}

.add-comment-container button {
    cursor: pointer;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 4px;
}

.add-comment-container button:hover {
    background-color: #0056b3;
}
</style>
