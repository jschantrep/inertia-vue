<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ChirpItem from '@/Components/ChirpItem.vue';
import InputError from '@/Components/InputError.vue';
import ChirpForm from '@/Components/ChirpForm.vue';

const { chirps } = defineProps(['chirps']);

const form = useForm({
    message: '',
});

function submit() {
    form.post(route('chirps.store'), {
        onSuccess: () => form.reset(),
        preserveState: false      
    });
}

console.log('chirps:', chirps);
</script>

<template>
    <Head title="Chirps" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Chirps
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ChirpForm>
                            
                        </ChirpForm>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <template v-if="chirps && chirps.length">
                        <ChirpItem
                            v-for="chirp in chirps"
                            :key="chirp.id"
                            :chirp="chirp"
                        />
                    </template>
                    <template v-else>
                        <p class="text-gray-400 text-center">No hay chirps todavía.</p>
                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
