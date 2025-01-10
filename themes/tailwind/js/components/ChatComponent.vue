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
                                    <img :src="`/storage/${image}`" alt="Message Image" class="w-24 h-24 object-cover rounded-lg" @click="openImage(`/storage/${image}`)">
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
                                    class="absolute right-0 z-10 w-24 mt-1 bg-white border rounded-lg shadow" style="top:-4.5rem;"
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
                                    <img :src="`/storage/${image}`" alt="Message Image" class="w-24 h-24 object-cover rounded-lg image" @click="openImage(`/storage/${image}`)">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row"><!--flex items-center-->
                <div class="row flex items-center pb-2">
                    <div class="relative inline-block">
                        <div
                            class="px-2 py-1 text-sm text-white rounded-lg" 
                            @click="toggleDropdownPlusButton(event)"
                        >
                            <svg class="x1lliihq x1tzjh5l x1k90msu x11xpdln x1qfuztq xsrhx6k x7p49u4" height="20px" viewBox="0 0 24 24" width="20px"><g fill-rule="evenodd"><polygon fill="none" points="-6,30 30,30 30,-6 -6,-6 "></polygon><path d="m18,11l-5,0l0,-5c0,-0.552 -0.448,-1 -1,-1c-0.5525,0 -1,0.448 -1,1l0,5l-5,0c-0.5525,0 -1,0.448 -1,1c0,0.552 0.4475,1 1,1l5,0l0,5c0,0.552 0.4475,1 1,1c0.552,0 1,-0.448 1,-1l0,-5l5,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1m-6,13c-6.6275,0 -12,-5.3725 -12,-12c0,-6.6275 5.3725,-12 12,-12c6.627,0 12,5.3725 12,12c0,6.6275 -5.373,12 -12,12" fill="#3982F7"></path></g></svg>
                        </div>
                        <div
                            class="absolute z-10 bg-white border rounded-lg shadow hidden"
                            id="dropdownMenu"
                            style="width: 10rem;top: -2.5rem;" 
                        ><!-- Adjust the value based on the dropdown height -->
                            <label 
                                for="fileUpload" class="flex w-full px-2 py-1 text-left text-black hover:bg-gray-100"
                            >
                                <svg viewBox="0 0 12 13" width="20" height="20" fill="currentColor" class="xfx01vb x1lliihq x1tzjh5l x1k90msu x2h7rmj x1qfuztq" style="color: #3982F7;"><g fill-rule="evenodd" transform="translate(-450 -1073)"><g><path d="M99.825 918.322a2.55 2.55 0 0 1 .18-.712l-.489.043a1.601 1.601 0 0 0-.892.345 1.535 1.535 0 0 0-.557 1.321l.636 7.275c.01.12.186.123.199.003l.923-8.275zm4.67 1.591a1 1 0 1 1-1.991.175 1 1 0 0 1 1.991-.175m3.099 1.9a.422.422 0 0 0-.597-.05l-1.975 1.69a.288.288 0 0 0-.032.404l.442.526a.397.397 0 0 1-.606.51l-1.323-1.576a.421.421 0 0 0-.58-.063l-1.856 1.41-.265 2.246c-.031.357.173 1.16.53 1.19l6.345.397c.171.014.395-.02.529-.132.132-.111.38-.49.396-.661l.405-4.239-1.413-1.652z" transform="translate(352 156.5)"></path><path fill-rule="nonzero" d="m107.589 928.97-6.092-.532a1.56 1.56 0 0 1-1.415-1.687l.728-8.328a1.56 1.56 0 0 1 1.687-1.416l6.091.533a1.56 1.56 0 0 1 1.416 1.687l-.728 8.328a1.56 1.56 0 0 1-1.687 1.415zm.087-.996.06.002a.561.561 0 0 0 .544-.508l.728-8.328a.56.56 0 0 0-.507-.604l-6.09-.533a.56.56 0 0 0-.605.507l-.728 8.328a.56.56 0 0 0 .506.604l6.092.532z" transform="translate(352 156.5)"></path></g></g></svg>
                                &nbsp; Upload Files 
                            </label>
                            <!--<button
                                class="w-full px-2 py-1 text-left text-red-700 hover:bg-red-100"
                            >
                                Voice Message
                            </button>-->
                        </div>
                    </div>
                    <input
                        type="text"
                        v-model="newMessage"
                        @keydown="sendTypingEvent"
                        @keyup.enter="sendMessage"
                        placeholder="Type a message..."
                        class="flex-1 px-2 py-1 border rounded-lg ml-2"
                    />
                    <button
                        @click="sendMessage"
                        class="px-4 py-1 ml-2 text-white bg-blue-500 rounded-lg"
                    >
                        Send
                    </button>
                </div>
                <div class="row" hidden>
                    <input id="fileUpload" type="file" @change="handleImageUpload" multiple accept="image/*" class="ml-2 attachment" />
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

const toggleDropdownPlusButton = (event) => {
    const dropdown = document.getElementById("dropdownMenu");
    dropdown.classList.toggle("hidden");
}

const openImage = (imagePath) => {
    const windowProperties =
        "toolbar=yes,location=yes,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=900,height=600";
    window.open(imagePath, "targetwindow", windowProperties);
};

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