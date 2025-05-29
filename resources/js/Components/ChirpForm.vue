<script setup>

import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import ChirpItem from '@/Components/ChirpItem.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const { chirp } = defineProps({
    chirp:{
        type: Object,
        required: false,
    }



})

const form = useForm({

    
    message: chirp?.message,
});

function update(chirp){
    form.patch(route('chirps.update', chirp), {
        onSuccess: () => form.reset(),
        preserveState: false      
    });

}

function submit() {

    if (chirp?.id){
        update(chirp.id)
        return
    }

    form.post(route('chirps.store'), {
        onSuccess: () => form.reset(),
        preserveState: false      
    });
}
</script>

<template>

    <form @submit.prevent="submit">
        <textarea v-model="form.message"
            class="w-full h-32 p-4 border-2 border-gray-300 rounded-lg text-lg focus:border-blue-500"
            placeholder="What's up bro">
                            </textarea>
        <InputError :message="form.errors.message" />
        <PrimaryButton :disabled="form.processing" class="mt-2">
            {{ form.processing ? 'Enviando...' : 'Chirp' }}
        </PrimaryButton>
        <SecondaryButton v-if="chirp?.id" @click="$emit('cancel')">Cancelar</SecondaryButton>
    </form>


</template>