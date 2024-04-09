<template>
    <div>
        <h2>My Posts</h2>
        <div v-if="posts.length">
            <div class="post" v-for="post in posts" :key="post.id">
                <div v-if="editingPostId === post.id">
                    <input v-model="editedBody" type="text"/>
                    <PrimaryButton  @click="savePost(post.id)">Save</PrimaryButton>
                    <SecondaryButton @click="cancel()" >Cancel</SecondaryButton>
                </div>
                <div v-else>
                    <p>{{ post.body }}</p>
                    <div class="post-actions" @click.stop="toggleDropdown(post.id)" tabindex="0">
                        Actions
                        <div class="dropdown-content" v-if="showDropdown === post.id">
                            <button @click.stop="startEdit(post)">Update</button>
                            <button @click.stop="deletePost(post.id)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <p>You have not created any posts yet.</p>
        </div>
    </div>
</template>


<script>


import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
export default {
    components: {PrimaryButton, SecondaryButton},
    data() {
        return {
            posts: [],
            showDropdown: null,
            editingPostId: null
        };
    },
    created() {
        this.fetchPosts();
    },
    methods: {
        startEdit(post) {
            this.editingPostId = post.id;
            this.editedBody = post.body;
        },
        toggleDropdown(id) {
            this.showDropdown = this.showDropdown === id ? null : id;
        },
        fetchPosts() {
            axios.get('/my-posts')
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.error('Error fetching posts:', error);
                });
        },

        deletePost(id) {
            if (confirm('Are you sure you want to delete this post?')) {
                axios.delete('/posts/' + id)
                    .then(() => {
                        this.fetchPosts();
                    })
                    .catch(error => {
                        console.error('Error deleting post:', error.response.data);
                    });
            }
        },
        savePost(postId) {
            axios.put('/posts/' + postId, {body: this.editedBody})
                .then(() => {
                    this.fetchPosts();
                    this.editingPostId = null;
                    this.editedBody = '';
                })
                .catch(error => {
                    console.error('Error updating post:', error.response.data);
                });
        },
        cancel() {
            this.editingPostId = null;
            this.editedBody = '';

        },
    }
}
</script>

<style scoped>
.post {
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
    margin-bottom: 20px;
    position: relative;
}

.post:last-child {
    border-bottom: none;
}

.post-actions {
    cursor: pointer;
    user-select: none;
    position: absolute;
    top: 0;
    right: 0;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 5px;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 100px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content button {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.post-actions:focus .dropdown-content,
.post-actions:focus-within .dropdown-content {
    display: block;
}

input[type="text"] {
    width: 100%;
    padding: 0.5em;
    margin-bottom: 0.5em;
}

button {
    cursor: pointer;
}
</style>
