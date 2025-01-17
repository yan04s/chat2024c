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

@media (max-width: 450px) {
    .threeDotsED {
        margin-left: -5.8vw !important;
    }
}

</style>

<template>
    <!--Schedule Message-->
    <TransitionRoot as="template" :show="openSchedule">
        <Dialog class="relative z-10" @close="openSchedule = false">
        <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in duration-200"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to="opacity-100 translate-y-0 sm:scale-100"
                leave="ease-in duration-200"
                leave-from="opacity-100 translate-y-0 sm:scale-100"
                leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="text-center">
                    <DialogTitle as="h3" class="text-base font-semibold text-gray-900">
                        Schedule a Message
                    </DialogTitle>
                    <div class="mt-4">
                        <!-- Date Time Picker -->
                        <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
                        <input
                        id="date"
                        v-model="scheduleDateTime"
                        type="text"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        ref="datePicker"
                        @focus="initializeDatePicker"
                        />

                        <!-- Time Picker -->
                        <!-- <label for="time" class="block mt-4 text-sm font-medium text-gray-700">Select Time</label>
                        <input
                        id="time"
                        v-model="scheduleTime"
                        type="time"
                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        /> -->
                    </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button
                    type="button"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto"
                    @click="scheduleMessage"
                    >
                    Schedule
                    </button>
                    <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                    @click="openSchedule = false"
                    >
                    Cancel
                    </button>
                </div>
                </DialogPanel>
            </TransitionChild>
            </div>
        </div>
        </Dialog>
    </TransitionRoot>

    <!--Edit Message-->
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                        <ExclamationTriangleIcon class="size-6 text-red-600" aria-hidden="true" />
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Edit Message</DialogTitle><!--Deactivate account-->
                        <div class="mt-2">
                        <!-- <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p> -->
                        <textarea
                        v-model="newText"
                        class="w-full border p-2 rounded-lg"
                        rows="4" cols="50" 
                        ></textarea>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto" @click="saveEditedMessage">Save</button><!--Deactivate-->
                    <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="open = false" ref="cancelButtonRef">Cancel</button>
                </div>
                </DialogPanel>
            </TransitionChild>
            </div>
        </div>
        </Dialog>
    </TransitionRoot>
    <div class="row">
        <div class="col-12">
            <div class="row flex flex-col justify-end h-80">
                <div ref="messagesContainer" class="p-4 overflow-y-auto max-h-fit col-12">
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
                        v-for="(messageGroup, index) in groupedMessages"
                        :key="index"
                        class="mb-4"
                    >
                        <!-- Date Separator -->
                        <div class="text-center text-gray-500 text-sm my-2">
                            {{ formatDate(messageGroup.date) }}
                        </div>
                        <div
                            v-for="message in messageGroup.messages"
                            :key="message.id"
                            class="flex items-center mb-2 row"
                        > <!--v-for="message in messages"-->
                            <div
                                v-if="message.sender_id === currentUser.id"
                                class="relative flex flex-col items-center ml-auto col-12" style="float: right;"
                            >
                                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 threeDotsED" style="margin-left: -2.8vw;">
                                    <button
                                        @click="toggleDropdown(message.id, $event)"
                                        class="px-2 py-1 text-sm text-white bg-gray-700 rounded-lg"
                                        id="dropdownED"
                                    >
                                        ⋮
                                    </button>
                                    <div
                                        v-if="dropdownOpen === message.id"
                                        class="absolute z-10 w-24 mt-1 bg-white border rounded-lg shadow" 
                                        id="dropdownEDMenu" 
                                        style="bottom: 5vh;right: 0;" 
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
                                <!-- Display images if available -->
                                <div v-if="message.images && message.images.length" class="flex justify-center flex-wrap row" style="width: 12rem;">
                                    <div v-for="image in message.images" :key="image" class="mt-2">
                                        <img :src="`/storage/${image}`" alt="Message Image" class="w-24 h-24 object-cover rounded-lg" @click="openImage(`/storage/${image}`)">
                                    </div>
                                </div>
                                <div class="ml-2 p-2 text-white bg-blue-500 rounded-lg row mobile:w-1/3" style="width: 15rem;"
                                :class="message.scheduleAt ? 'bg-gray-500' : 'bg-blue-500'" >
                                    <p>{{ message.text }}</p>
                                    <span style="float: right;font-size: small;">
                                        {{ formatDateTime(message.scheduleAt || message.created_at) }}
                                    </span>
                                </div>
                            </div>
                            <div v-else class="p-2 mr-auto bg-gray-200 rounded-lg row" style="width: 15rem;float: left;">
                                {{ message.text }}
                                <!-- Display images if available -->
                                <div v-if="message.images && message.images.length" class="flex justify-center flex-wrap row">
                                    <div v-for="image in message.images" :key="image" class="mt-2 col-2">
                                        <img :src="`/storage/${image}`" alt="Message Image" class="w-24 h-24 object-cover rounded-lg image" @click="openImage(`/storage/${image}`)">
                                    </div>
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
                            id="toggleButton" 
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
                    
                        <!-- Input Field -->
                        <input
                        type="text"
                        v-model="newMessage"
                        @keydown="sendTypingEvent"
                        @keyup.enter="sendMessage"
                        placeholder="Type a message..."
                        class="flex-1 px-2 py-1 border rounded-lg ml-2"
                        />

                        <!-- Send Button -->
                        <button
                        @click="sendMessage"
                        @contextmenu.prevent="openDropdownSend" 
                        class="px-4 py-1 ml-2 text-white bg-blue-500 rounded-lg" id="openDropdownSend"
                        >
                        Send
                        </button>
                        <!-- Dropdown Menu -->
                        <div
                        v-if="dropdownOpenSend"
                        class="absolute mt-2 right-0 w-40 bg-white border rounded-lg shadow-lg" id="dropdownOpenSend" 
                        style="right: 3rem;bottom: 9rem;"
                        >
                        <ul class="py-2 text-sm text-gray-700">
                            <li @click="openSchedule=true" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Schedule</li>
                        </ul>
                        </div>



                        <!-- <Menu as="div" class="relative inline-block text-left">
                            <div>
                            <MenuButton @click.right.prevent="openDropdownSend" @click.left.prevent="sendMessage" class="px-4 py-1 ml-2 rounded-lg inline-flex w-full justify-center gap-x-1.5 rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-blue-300 hover:bg-blue-550">
                                Send
                                <ChevronDownIcon class="-mr-1 size-5 text-white" aria-hidden="true" />
                            </MenuButton>
                            </div>

                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="-top-full absolute right-0 z-10 w-56 origin-bottom-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none" style="margin-top:-0.75rem;right:-0.5rem;" v-show="dropdownOpenSend">
                                <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">Account settings</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">Support</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">License</a>
                                </MenuItem>
                                <form method="POST" action="#">
                                    <MenuItem v-slot="{ active }">
                                    <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">Sign out</button>
                                    </MenuItem>
                                </form>
                                </div>
                            </MenuItems>
                            </transition>
                        </Menu> -->
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
import { nextTick, onMounted, ref, watch, computed } from "vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'
//import { ChevronDownIcon } from '@heroicons/vue/20/solid'

const open = ref(false);
const editMessageData = ref(null);
const newText = ref(null);

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

import flatpickr from 'flatpickr'
import 'flatpickr/dist/flatpickr.css'

// Reactive states for the dialog and scheduling data
const openSchedule = ref(false)
const scheduleDateTime = ref('')
const datePicker = ref(null)
// Initialize the Flatpickr calendar
const initializeDatePicker = () => {
  const now = new Date();
  const currentTime = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
  if (datePicker.value) {
    flatpickr(datePicker.value, {
      enableTime: true,
      dateFormat: 'Y-m-d H:i',
      minDate: 'today', // Disable past dates
      minTime: currentTime, // Disable times before 9:00 AM
    });
  }
};
onMounted(() => {
  nextTick(() => {
    initializeDatePicker();
  });
});
// Function to handle message scheduling
const scheduleMessage = () => {
    //datePicker.value = scheduleDateTime.value;
  if (!scheduleDateTime.value ){//|| !scheduleTime.value) {
    //alert('Please select both date and time.')
    alert('Please select date and time.')
    return
  }
  //const scheduledDateTime = `${scheduleDateTime.value} ${scheduleTime.value}`
  console.log('Message scheduled for:', scheduleDateTime)
  sendMessage();
  scheduleDateTime.value = ''
  openSchedule.value = false
}

// Group messages by date
const groupedMessages = computed(() => {
    const groups = {}; 
    messages.value.forEach((message) => {
        // Use scheduleAt if it exists; otherwise, fallback to created_at
        let date = message.created_at.split('T')[0]; // Extract date (YYYY-MM-DD)
        if (message.scheduleAt !== null) {
            date = message.scheduleAt.split(' ')[0];
        };//console.log(date);
        if (!groups[date]) {
            groups[date] = { date, messages: [] };
        }
        groups[date].messages.push(message);
    });
    return Object.values(groups); // Convert groups object to an array
});
// Format date for the date separator
const formatDate = (isoString) => {
    if (!isoString) return '';
    const date = new Date(isoString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
};
// Function to format the datetime
const formatDateTime = (isoString) => {
  if (!isoString) return ''; // Return an empty string if the value is null or undefined
  
  const date = new Date(isoString);
  const options = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true,
  };
  return date.toLocaleString('en-US', options); // Adjust the locale as needed
};


const toggleDropdownPlusButton = (event) => {
    const dropdown = document.getElementById("dropdownMenu");
    dropdown.classList.toggle("hidden");
}
// Function to close dropdown if clicked outside
const closeDropdownOnOutsideClick = (event) => {
    const dropdown = document.getElementById("dropdownMenu");
    const toggleButton = document.getElementById("toggleButton");

    // Check if the click target is not the dropdown or toggle button
    if (!dropdown.contains(event.target) && !toggleButton.contains(event.target)) {
        dropdown.classList.add("hidden");
    }
};
// Add a click event listener to the document
document.addEventListener("click", closeDropdownOnOutsideClick);

const dropdownOpenSend = ref(false);
const openDropdownSend = () => {
    dropdownOpenSend.value = !dropdownOpenSend.value;
};
// Function to close dropdown if clicked outside
const closeOpenDropdownSend = (event) => {
  const dropdown = document.getElementById("dropdownOpenSend");
  const toggleButton = document.getElementById("openDropdownSend");

  // Ensure dropdown exists before checking
  if (dropdown && toggleButton) {
    // Check if the click target is not the dropdown or toggle button
    if (!dropdown.contains(event.target) && !toggleButton.contains(event.target)) {
      dropdownOpenSend.value = false; // Close the dropdown
    }
  }
};
document.addEventListener("click", closeOpenDropdownSend);

const openImage = (imagePath) => {
    const windowProperties =
        "toolbar=yes,location=yes,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=900,height=600";
    window.open(imagePath, "targetwindow", windowProperties);
};

const toggleDropdown = (messageId, event) => {
    event.stopPropagation(); // Prevent the click event from bubbling up
    dropdownOpen.value = dropdownOpen.value === messageId ? null : messageId;
};
// Close the dropdown if clicked outside
const closeDropdown = (event) => {
  const dropdown = document.getElementById('dropdownED');
  const menu = document.getElementById('dropdownEDMenu');
  
  // Check if the click was outside the dropdown button or menu
  if (dropdown && menu && !dropdown.contains(event.target) && !menu.contains(event.target)) {
    dropdownOpen.value = null;
  }
};
document.addEventListener('click', closeDropdown);

const editMessage = (message) => {
    editMessageData.value = message;
    newText.value = message.text; // Pre-fill the textarea with the current message text
    open.value = true; // Open the modal
};
const saveEditedMessage = () => {
    if (
    newText.value !== null &&
    newText.value.trim() !== ""
    ) {
    axios
        .post(`/messages/edit/${editMessageData.value.id}`, {
        text: newText.value,
        })
        .then((response) => {
            editMessageData.value.text = response.data.text; // Update the message text
        open.value = false; // Close the modal
        });
    }
};
// const editMessage = (message) => {
//     const newText = prompt("Edit your message:", message.text);
//     if (newText !== null && newText.trim() !== "") {
//         axios
//             .post(`/messages/edit/${message.id}`, { text: newText })
//             .then((response) => {
//                 message.text = response.data.text;
//             });
//     }
// };

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
    dropdownOpenSend.value = false;
    if (newMessage.value.trim() !== "" || imagesToUpload.value.length > 0) {
        const formData = new FormData();
        formData.append("message", newMessage.value);
        formData.append("receiver_id", props.friend.id);

        imagesToUpload.value.forEach((image, index) => {
            formData.append("images[]", image);
        });

        if (scheduleDateTime.value) {
            formData.append("scheduled_at", scheduleDateTime.value);
        }

        axios
            .post(`/messages/${props.friend.id}`, formData)
            .then((response) => {
                messages.value.push(response.data);
                newMessage.value = "";
                imagesPreview.value = [];
                imagesToUpload.value = [];
                document.getElementsByClassName("attachment")[0].value = "";
            });
    }else{
        alert('Please type a message or upload an image.');
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