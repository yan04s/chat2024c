<!-- <template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script> -->

<style scoped>
.dropdown {
    position: absolute;
    right: 0;
    z-index: 10;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.dropdown button {
    width: 100%;
    padding: 0.5rem;
    text-align: left;
    cursor: pointer;
}
.dropdown button:hover {
    background-color: #f1f1f1;
}
</style>

<template>
    <div class="row">
        <div class="col-12">
            <div class="row flex flex-col justify-end h-80">
                <div ref="messagesContainer" class="p-4 overflow-y-auto max-h-fit">
                    <!-- <div
                        v-for="message in messages"
                        :key="message.id"
                        class="flex items-center mb-2"
                    >
                        <div
                            v-if="message.sender_id === currentUser.id"
                            class="p-2 ml-auto text-white bg-blue-500 rounded-lg"
                        >
                            {{ message.text }}
                        </div>
                        <div v-else class="p-2 mr-auto bg-gray-200 rounded-lg">
                            {{ message.text }}
                        </div>
                    </div> -->

                    <div
                        v-for="message in messages"
                        :key="message.id"
                        class="flex items-center mb-2"
                    >
                        <div
                            v-if="message.sender_id === currentUser.id"
                            class="relative flex flex-col items-center ml-auto"
                        >
                            <!-- Display images if available -->
                            <div v-if="message.images && message.images.length" class="flex justify-center flex-wrap">
                                <div v-for="image in message.images" :key="image" class="mt-2">
                                    <img :src="`/storage/${image}`" alt="Message Image" class="w-24 h-24 object-cover rounded-lg">
                                </div>
                            </div>

                            <div class="relative top-7 mr-2" style="right: 52%;">
                                <button
                                    @click="toggleDropdown(message.id)"
                                    class="px-2 py-1 text-sm text-white bg-gray-700 rounded-lg"
                                >
                                    ⋮
                                </button>
                                <div
                                    v-if="dropdownOpen === message.id"
                                    class="absolute right-0 z-10 w-24 mt-1 bg-white border rounded-lg shadow"
                                >
                                    <button
                                        @click="editMessage(message)"
                                        class="w-full px-2 py-1 text-left text-gray-700 hover:bg-gray-100"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        @click="deleteMessage(message.id)"
                                        class="w-full px-2 py-1 text-left text-red-700 hover:bg-red-100"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <div class="ml-2 p-2 text-white bg-blue-500 rounded-lg" style="width: 15rem;">
                                <p>{{ message.text }}</p>
                            </div>
                        </div>
                        <div v-else class="p-2 mr-auto bg-gray-200 rounded-lg" style="width: 15rem;">
                            {{ message.text }}
                            <!-- Display images if available -->
                            <div v-if="message.images && message.images.length" class="flex justify-center flex-wrap">
                                <div v-for="image in message.images" :key="image" class="mt-2">
                                    <img :src="`/storage/${image}`" alt="Message Image" class="w-24 h-24 object-cover rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row"><!--flex items-center-->
                <div class="row flex items-center pb-2">
                    <input
                        type="text"
                        v-model="newMessage"
                        @keydown="sendTypingEvent"
                        @keyup.enter="sendMessage"
                        placeholder="Type a message..."
                        class="flex-1 px-2 py-1 border rounded-lg"
                    />
                    <button
                        @click="sendMessage"
                        class="px-4 py-1 ml-2 text-white bg-blue-500 rounded-lg"
                    >
                        Send
                    </button>
                </div>
                <div class="row">
                    <input type="file" @change="handleImageUpload" multiple accept="image/*" class="ml-2 attachment" />
                </div>
            </div>
            <div v-if="imagesPreview.length" class="mt-2">
                <p>Images Preview:</p>
                <div class="flex">
                    <div v-for="(image, index) in imagesPreview" :key="index" class="relative mr-2">
                        <img :src="image" class="w-24 h-24 object-cover rounded-lg" />
                        <button @click="removeImagePreview(index)" class="absolute top-0 right-0 text-white bg-red-500 rounded-full p-1">x</button>
                    </div>
                </div>
            </div>
            <small v-if="isFriendTyping" class="text-gray-700">
                {{ friend.name }} is typing...
            </small>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { nextTick, onMounted, ref, watch } from "vue";

const props = defineProps({
    friend: {
        type: Object,
        required: true,
    },
    currentUser: {
        type: Object,
        required: true,
    },
});

const messages = ref([]);
const newMessage = ref("");
const messagesContainer = ref(null);
const isFriendTyping = ref(false);
const isFriendTypingTimer = ref(null);

const imagesPreview = ref([]);
const imagesToUpload = ref([]);
const dropdownOpen = ref(null);

const toggleDropdown = (messageId) => {
    dropdownOpen.value = dropdownOpen.value === messageId ? null : messageId;
};

const editMessage = (message) => {
    const newText = prompt("Edit your message:", message.text);
    if (newText !== null && newText.trim() !== "") {
        axios
            .post(`/messages/edit/${message.id}`, { text: newText })
            .then((response) => {
                message.text = response.data.text;
            });
    }
};

const deleteMessage = (messageId) => {
    if (confirm("Are you sure you want to delete this message?")) {
        axios.delete(`/messages/delete/${messageId}`).then(() => {
            messages.value = messages.value.filter(
                (message) => message.id !== messageId
            );
        });
    }
};

watch(
    messages,
    () => {
        nextTick(() => {
            messagesContainer.value.scrollTo({
                top: messagesContainer.value.scrollHeight,
                behavior: "smooth",
            });
        });
    },
    { deep: true }
);

/*const sendMessage = () => {
    if (newMessage.value.trim() !== "") {
        axios
            .post(`/messages/${props.friend.id}`, {
                message: newMessage.value,
            })
            .then((response) => {
                messages.value.push(response.data);
                newMessage.value = "";
            });
    }
};*/
const sendMessage = () => {
    if (newMessage.value.trim() !== "" || imagesToUpload.value.length > 0) {
        const formData = new FormData();
        formData.append("message", newMessage.value);
        formData.append("receiver_id", props.friend.id);

        imagesToUpload.value.forEach((image, index) => {
            formData.append("images[]", image);
        });

        axios
            .post(`/messages/${props.friend.id}`, formData)
            .then((response) => {
                messages.value.push(response.data);
                newMessage.value = "";
                imagesPreview.value = [];
                imagesToUpload.value = [];
                document.getElementsByClassName("attachment")[0].value = "";
            });
    }
};

const handleImageUpload = (event) => {
    const files = event.target.files;
    imagesPreview.value = [];
    imagesToUpload.value = [];

    Array.from(files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagesPreview.value.push(e.target.result); // Preview the image
        };
        imagesToUpload.value.push(file); // Store the image for upload
        reader.readAsDataURL(file);
    });
};

const removeImagePreview = (index) => {
    imagesPreview.value.splice(index, 1);
    imagesToUpload.value.splice(index, 1);
};

const sendTypingEvent = () => {
    Echo.private(`chat.${props.friend.id}`).whisper("typing", {
        userID: props.currentUser.id,
    });
};

onMounted(() => {//console.log(Echo);
    axios.get(`/messages/${props.friend.id}`).then((response) => {
        console.log(response.data);
        //console.log(props.currentUser.id);
        messages.value = response.data;
    });

    // Echo.private(`fetchMessage.${props.currentUser.id}`)
    //     .listen("FetchMessage", (response) => {
    //         console.log(response);
    //     });
    
    Echo.private(`chat.${props.currentUser.id}`)
        .listen("MessageSent", (response) => {
            // console.log(response);
            // messages.value.push(response.message);

            const existingMessageIndex = messages.value.findIndex(
                (message) => message.id === response.message.id
            );

            if (existingMessageIndex !== -1) {
                // If message exists, update it
                messages.value[existingMessageIndex] = {
                    ...messages.value[existingMessageIndex],
                    ...response.message, // Update with the new data from the response
                };
            } else {
                // If message doesn't exist, push it as a new message
                messages.value.push(response.message);
            }
        })
        .listen("MessageDeleted", (response) => {
            messages.value = messages.value.filter(
                (message) => message.id !== response.messageId
            );
        })
        .listenForWhisper("typing", (response) => {
            isFriendTyping.value = response.userID === props.friend.id;

            if (isFriendTypingTimer.value) {
                clearTimeout(isFriendTypingTimer.value);
            }

            isFriendTypingTimer.value = setTimeout(() => {
                isFriendTyping.value = false;
            }, 1000);
        });
});
</script>