<template>
    <div class="create-post-container">
        <h2>Create New Post</h2>
        <form @submit.prevent="submit" class="create-post-form">
            <div class="form-group">
                <textarea v-model="form.body" id="body" placeholder="Write your post content here"></textarea>
            </div>
            <button type="submit" class="submit-btn">Create Post</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                body: ''
            }
        }
    },
    methods: {
        submit() {
            axios.post('/posts', this.form)
                .then(response => {
                    this.form.body = '';
                    window.location.replace('/posts');
                })
                .catch(error => {
                    console.error(error.response.data);
                });
        }
    }
}
</script>

<style scoped>
.create-post-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.create-post-form > .form-group {
    margin-bottom: 20px;
}

.create-post-form > .form-group > label {
    display: block;
    margin-bottom: 5px;
}

.create-post-form > .form-group > textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.create-post-form > .form-group > textarea:focus {
    border-color: #90cdf4;
    outline: none;
}

.create-post-form > .submit-btn {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.create-post-form > .submit-btn:hover {
    background-color: #45a049;
}
</style>
