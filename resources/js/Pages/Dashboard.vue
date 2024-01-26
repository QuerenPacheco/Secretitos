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
const secrets = ref();
const showModalSecret = ref(false);
const secretSelected = ref();

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
        onFinish: () => {
            form.title = "";
            form.content = "";
            closeModal(); 
            charge();
            },
    });
};

const showSecret = (id) => {
    fetch('/showSecret/'+id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            secrets.value = secrets.value.map(sec => {
                if(sec.id == id){
                    return {...sec, content:data}
                }
                return sec
            });
        }).then(data => {
            setTimeout(() => {
                destructSecret(id);
            }, 5000);
        })
        .catch(error => {
            console.error('Error al realizar la solicitud:', error);
        });
};

const destructSecret = (id) => {
    fetch('/deleteSecret/'+id, {
    method: 'DELETE',
    headers: {
        'Content-Type': 'application/json',
    },
})
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud');
        }
        return response.json();
    })
    .then(data => {
        charge()
        var successModal = document.querySelector("#successModal")
        var message = document.createElement('p')
        message.textContent=data
        successModal.append(message)
        successModal.style.display="block"
        setTimeout(() => {
            successModal.textContent = ''
            successModal.style.display="none"
        }, 4000);
    })
    .catch(error => {
        console.error('Error en la solicitud DELETE:', error);
    });
}

const charge = ()=>{
    fetch('/index', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
    })
    .then(response => response.json())
    .then(data => {
        secrets.value = data.map((obj)=>({...obj, content:'*****'}))
    })
    .catch(error => {
        console.error('Error al realizar la solicitud:', error);
    });
}
onMounted(charge)

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="successModal" class ="text-xl text-gray-700 uppercase text-center bg-gray-50 dark:bg-red-500 dark:text-white mb-4 sm:rounded-lg"></div>

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
                                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title"
                                            required />
                                        <InputLabel for="title" value="Titulo del secreto" />

                                        <TextareaInput id="content" type="text" class="mt-1 block w-full"
                                            v-model="form.content" required />
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
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-blue-700 dark:text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Título
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Contenido
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Mostrar</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="sec in secrets" :key="sec.id"
                                        class="bg-white border-b dark:hover:bg-blue-100">
                                        <td class="px-6 py-4">
                                            {{ sec.title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ sec.content }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                @click="showSecret(sec.id)">Mostrar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
#successModal{
    display:none
}
</style>