<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { useForm } from '@inertiajs/vue3';

const props = defineProps(['isOpen', 'onSubmit', 'onClose']);

const form = useForm({
    title: '',
    content: '',
});

const submit = () => {
    form.post(route('createSecret'), {
        onFinish: () => {
            form.title = "";
            form.content = "";
            props.onClose();
            props.onSubmit()
        },
    });
};
</script>

<template>
    <div v-if="this.isOpen" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" @click="onClose()">&times;</span>
                <h2>Crear un nuevo secreto</h2>
            </div>

            <form @submit.prevent="submit">
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required />
                <InputLabel for="title" value="Titulo del secreto" />

                <TextareaInput id="content" type="text" class="mt-1 block w-full" v-model="form.content" required />
                <InputLabel for="content" value="Contenido secreto" />


                <div class="col-md-12 bg-light text-right">
                    <PrimaryButton class="mt-5">
                        Crear secreto
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
