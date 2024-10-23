<script setup>
import { ref, watch } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    show: Boolean
});
const emit = defineEmits(['close']);

const bio = ref('');
const form = useForm({
    bio: bio.value
});

const submitBio = () => {
    form.bio = bio.value;
    form.post(route('profile.addBio'), {
        onSuccess: () => {
            emit('close');
            bio.value = '';
        },
    });
};

const closeModal = () => {
    emit('close');
    bio.value = '';
};

watch(() => props.show, (newVal) => {
    if (!newVal) {
        bio.value = '';
    }
});
</script>

<template>
    <div v-if="show" class="fixed z-10 inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 inline mr-2 text-blue-500">
                    <path d="M12 20h9M16.707 3.293a1 1 0 011.414 1.414L5.414 17.414a1 1 0 01-.707.293H3v-1.707a1 1 0 01.293-.707l12.414-12.414z" />
                </svg>
                Add Bio
            </h2>            <textarea
                v-model="bio"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                rows="4"
                placeholder="Write something about yourself..."></textarea>
            <div class="mt-6 flex justify-end space-x-4">
                <button
                    @click="closeModal"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 p-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button
                    @click="submitBio"
                    class="bg-blue-600 hover:bg-blue-700 text-white p-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

