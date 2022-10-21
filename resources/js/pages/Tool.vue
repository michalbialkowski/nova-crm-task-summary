<template>
    <div>
        <Head title="Podsumowanie" />
        <Heading class="mb-6">{{ __('Summary') }}</Heading>
        <div v-for="item in data.tasks">
            <Heading class="h3 mb-3" :level="3">{{ item.title }}</Heading>
            <card class="overflow-hidden mb-6">
                <div
                    class="relative"
                    v-if="item.data.length"
                >
                    <div class="overflow-hidden overflow-x-auto relative">
                        <table class="w-full table-default">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th :class="class_th">{{ __('Name') }}</th>
                                <th :class="class_th">{{ __('Project') }}</th>
                                <th :class="class_th">{{ __('Priority') }}</th>
                                <th :class="class_th">{{ __('Planned At') }}</th>
                                <th :class="class_th">{{ __('Status') }}</th>
                                <th class="text-right" :class="class_th">{{ __('Subtasks') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                class="group"
                                v-for="task in item.data"
                                @click.stop.prevent="navigateToDetail(task.id)"
                            >
                                <td :class="class_td">
                                    <div class="text-left fw-bold">
                                        <span class="font-bold text-90 whitespace-nowrap">{{ task.name }}</span>
                                    </div>
                                </td>
                                <td :class="class_td">
                                    <div class="text-left">
                                        <span class="font-bold text-90 whitespace-nowrap">
                                            <a
                                                class="link-default"
                                                :href="$url(`/resources/projects/${task.project.id}`)"
                                            >{{ task.project.name }}</a>
                                        </span>
                                    </div>
                                </td>
                                <td :class="class_td">
                                    <div class="text-left">
                                        <span class="text-90 whitespace-nowrap">{{ data.schemes.priorities[task.priority] }}</span>
                                    </div>
                                </td>
                                <td :class="class_td">
                                    <div class="text-left">
                                        <span class="text-90 whitespace-nowrap">{{ data.schemes.scheludes[task.schelude] }}</span>
                                    </div>
                                </td>
                                <td :class="class_td">
                                    <div class="text-left">
                                        <span class="text-90 whitespace-nowrap">{{ data.schemes.statuses[task.status] }}</span>
                                    </div>
                                </td>
                                <td :class="class_td">
                                    <div class="text-right">
                                        <span class="text-90 whitespace-nowrap">{{ task.subtasks.length }}</span>
                                    </div>
                                </td>
                                <td :class="class_td">
                                    <div :class="class_btn_group">
                                        <Link
                                            v-tooltip.click="__('View')"
                                            :aria-label="__('View')"
                                            :href="$url(`/resources/tasks/${task.id}`)"
                                            :class="class_btn"
                                            @click.stop
                                        >
                                            <Icon type="eye" />
                                        </Link>
                                        <Link
                                            v-tooltip.click="__('Edit')"
                                            :aria-label="__('Edit')"
                                            :href="$url(`/resources/tasks/${task.id}/edit`)"
                                            :class="class_btn"
                                            @click.stop
                                        >
                                            <Icon type="pencil-alt" />
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    :class="class_info"
                    v-else
                >
                    <h3 :class="class_info_text">
                        {{ __('No Tasks') }}
                    </h3>
                </div>
            </card>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
    props: ['data'],
    setup (props) {
        const data = ref(props.data)

        function navigateToDetail(id) {
            this.$inertia.visit(`/admin/resources/tasks/${id}`)
        }

        const class_th = ref('text-left pl-5 pr-5 whitespace-nowrap uppercase text-gray-500 text-xxs tracking-wide py-2');
        const class_td = ref('py-2 border-t border-gray-100 dark:border-gray-700 px-2 cursor-pointer td-fit pl-5 pr-5 dark:bg-gray-800 group-hover:bg-gray-50 dark:group-hover:bg-gray-900');
        const class_btn_group = ref('flex items-center justify-end space-x-0 text-gray-400');
        const class_btn = ref('toolbar-button hover:text-primary-500 px-2');
        const class_info = ref('flex flex-col justify-center items-center px-6 py-8');
        const class_info_text = ref('text-base font-normal mt-3');

        return {
            data,
            navigateToDetail,
            class_th, class_td, class_btn_group, class_btn, class_info,
        }
    }
});
</script>

<style>
/* Scoped Styles */
</style>
