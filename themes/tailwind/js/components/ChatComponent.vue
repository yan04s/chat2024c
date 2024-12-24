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
    <div>
        <div class="flex flex-col justify-end h-80">
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
                        class="relative flex items-center ml-auto"
                    >
                        <div class="relative mr-2">
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
                        <div class="p-2 text-white bg-blue-500 rounded-lg">
                            {{ message.text }}
                        </div>
                    </div>
                    <div v-else class="p-2 mr-auto bg-gray-200 rounded-lg">
                        {{ message.text }}
                    </div>
                </div>

            </div>
        </div>
        <div class="flex items-center">
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
        <small v-if="isFriendTyping" class="text-gray-700">
            {{ friend.name }} is typing...
        </small>
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

const sendMessage = () => {
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
};

const sendTypingEvent = () => {
    Echo.private(`chat.${props.friend.id}`).whisper("typing", {
        userID: props.currentUser.id,
    });
};

onMounted(() => {
    axios.get(`/messages/${props.friend.id}`).then((response) => {
        console.log(response.data);
        messages.value = response.data;
    });

    Echo.private(`chat.${props.currentUser.id}`)
        .listen("MessageSent", (response) => {
            messages.value.push(response.message);
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