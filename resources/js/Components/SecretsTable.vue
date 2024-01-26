<script setup>

const props = defineProps(['secrets', 'onShow']);


</script>

<template>
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
                <tr v-for="secret in secrets" :key="secret.id" class="bg-white border-b dark:hover:bg-blue-100">
                    <td class="px-6 py-4">
                        {{ secret.title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ secret.content }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            @click="onShow(secret.id)">Mostrar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
