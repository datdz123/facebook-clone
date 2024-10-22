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
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg">
            <h2 class="text-lg font-bold mb-4">Add Bio123</h2>
            <textarea v-model="bio" class="w-full p-2 border rounded-lg" rows="4"></textarea>
            <div class="mt-4 flex justify-end">
                <button @click="submitBio" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg">Save</button>
                <button @click="closeModal" class="ml-2 bg-gray-300 hover:bg-gray-400 p-2 rounded-lg">Cancel</button>
            </div>
        </div>
    </div>
</template>
