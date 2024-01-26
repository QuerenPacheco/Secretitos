<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue'
// import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';


const showModal = ref(false);

const form = useForm({
    title: '',
    content: '',
});
const openModal = () => {
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const submit = () => {
    form.post(route('createSecret'), {
        onFinish: () => form.reset('title', 'content'),
    });
};


onMounted(() => {
    const response = fetch('/index', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
      // Puedes enviar datos en el cuerpo de la petición si es necesario
      // body: JSON.stringify({ key: 'value' }),
    });
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1>Lista de secretos</h1>
                        <div class="row">
                            <div class="col-md-12 bg-light text-right">
                                <PrimaryButton class="ms-4" @click="openModal">
                                    Crear secreto
                                </PrimaryButton>
                            </div>
                            <div v-if="showModal" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="close" @click="closeModal">&times;</span>
                                        <h2>Crear un nuevo secreto</h2>
                                    </div>
                                    
                                    <form @submit.prevent="submit">
                                        <TextInput
                                            id="title"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.title"
                                            required
                                        />
                                        <InputLabel for="title" value="Titulo del secreto" />

                                        <TextareaInput
                                            id="content"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.content"
                                            required
                                        />
                                        <InputLabel for="content" value="Contenido secreto" />


                                        <div class="col-md-12 bg-light text-right">
                                            <PrimaryButton class="mt-5">
                                                Crear secreto
                                            </PrimaryButton>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Título</th>
                            <th>Contenido</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in posts" :key="post.id">
                            <td>{{ post.title }}</td>
                            <td>{{ post.content }}</td>
                            <td>
                                <button @click="mostrar(post.id)" class="btn btn-info btn-sm">Mostrar</button>
                                <button @click="editar(post.id)" class="btn btn-warning btn-sm">Editar</button>
                                <button @click="borrar(post.id)" class="btn btn-danger btn-sm">Borrar</button>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* Agrega estilos para el modal según tus necesidades */
.modal {
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 1em;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>