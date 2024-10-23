<script setup>
import { ref, watch } from 'vue';
import { useForm } from "@inertiajs/vue3";
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    show: Boolean,
    bio: String
});
const emit = defineEmits(['close']);

const bio = ref(props.bio || '');
const form = useForm({
    bio: bio.value
});

const editBio = () => {
    form.bio = bio.value;
    form.post(route('profile.editBio'), {
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
    <div v-if="show" class="fixed z-10 inset-0 flex items-center justify-center bg-black bg-opacity-60">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-lg w-full transition-transform transform scale-95">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 inline mr-2 text-blue-500">
                    <path d="M16.707 3.293a1 1 0 011.414 1.414L5.414 17.414a1 1 0 01-.707.293H3v-1.707a1 1 0 01.293-.707l12.414-12.414z" />
                    <path d="M12 20h9" />
                </svg>
                Edit Bio
            </h2>
            <textarea
                v-model="bio"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all ease-in-out duration-200 resize-none"
                rows="5"
                placeholder="Tell us something interesting about you..."></textarea>
            <div class="mt-6 flex justify-end space-x-4">
                <button
                    @click="closeModal"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all ease-in-out duration-200">
                    Cancel
                </button>
                <button
                    @click="editBio"
                    class="bg-blue-600 hover:bg-blue-700 text-white p-2 px-4 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all ease-in-out duration-200">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

