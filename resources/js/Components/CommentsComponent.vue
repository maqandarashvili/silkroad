<template>
    <div v-for="comment in comments" :key="comment.id" class="mb-6 last:mb-0">
        <div v-if="editingCommentId === comment.id" class="space-y-4">
            <textarea class="w-full p-3 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" v-model="editingBody"></textarea>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-150 ease-in-out" @click="saveComment(comment.id)">
                    Save
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-150 ease-in-out" @click="cancelEdit()">
                    Cancel
                </button>
            </div>
        </div>
        <div v-else>
            <p class="mb-2 text-gray-800 text-sm">{{ comment.body }}</p>
            <div class="flex justify-between items-center text-xs">
                <small class="text-gray-600">By: {{ comment.user.name }}</small>
                <div v-if="comment.user.id === userId">
                    <button class="text-blue-500 hover:text-blue-600 transition duration-150 ease-in-out mr-2" @click="editComment(comment)">Edit</button>
                    <button class="text-red-500 hover:text-red-600 transition duration-150 ease-in-out" @click="deleteComment(comment.id)">Delete</button>
                </div>
            </div>
        </div>
        <RateCommentComponent :comment="comment" class="mt-4"></RateCommentComponent>
    </div>
</template>

<script>
import RateCommentComponent from "@/Components/RateCommentComponent.vue";

export default {
    components: {RateCommentComponent},
    emits: ['commentUpdated', 'commentDeleted'],
    props: {
        comments: {
            type: Array,
            default: () => []
        },
        userId: null,
    },
    data() {
        return {
            editingCommentId: null,
            editingBody: '',
        };
    },
    methods: {
        editComment(comment) {
            this.editingCommentId = comment.id;
            this.editingBody = comment.body;
        },
        saveComment(commentId) {
            axios.put(`/comments/${commentId}`, {
                body: this.editingBody
            })
                .then(response => {
                    this.$emit('commentUpdated', response.data);
                    this.cancelEdit();
                })
                .catch(error => {
                    console.error('Error updating comment:', error);
                });
        },
        deleteComment(commentId) {
            axios.delete(`/comments/${commentId}`)
                .then(response => {
                    this.$emit('commentDeleted', response.data);
                })
                .catch(error => {
                    console.error('Error deleting comment:', error);
                });
        },
        cancelEdit() {
            this.editingCommentId = null;
            this.editingBody = '';
        },
    },

}
</script>

<style scoped>
.comments-section {
    margin-top: 20px;
}

.comment {
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}
</style>
