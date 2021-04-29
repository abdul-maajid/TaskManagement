<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>
    <TransitionRoot as="template" :show="isOpen">
      <Dialog
        as="div"
        static
        class="fixed z-10 inset-0 overflow-y-auto"
        @close="closeModal()"
        :open="isOpen"
      >
        <div
          class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in duration-200"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay
              class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            />
          </TransitionChild>

          <!-- This element is to trick the browser into centering the modal contents. -->
          <span
            class="hidden sm:inline-block sm:align-middle sm:h-screen"
            aria-hidden="true"
            >&#8203;</span
          >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <div
              class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                  >
                    <PlusIcon
                      class="h-6 w-6 text-blue-600"
                      aria-hidden="true"
                    />
                  </div>
                  <div
                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                    style="flex: 1"
                  >
                    <DialogTitle
                      as="h3"
                      class="text-lg leading-6 font-medium text-gray-900"
                    >
                      Add New List
                    </DialogTitle>
                    <div class="mt-2">
                      <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                        >Title</label
                      >
                      <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                          type="text"
                          name="title"
                          id="title"
                          class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                          placeholder="XYZ Title"
                          v-model="listForm.title"
                        />
                        <div v-if="$page.errors" class="text-red-500">
                          {{ $page.errors.title[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
              >
                <button
                  type="button"
                  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                  @click="save(listForm)"
                >
                  Save
                </button>
                <button
                  type="button"
                  class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                  @click="closeModal()"
                  ref="cancelButtonRef"
                >
                  Cancel
                </button>
              </div>
            </div>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Task Modal -->
    <TransitionRoot as="template" :show="isOpenTaskModal">
      <Dialog
        as="div"
        static
        class="fixed z-10 inset-0 overflow-y-auto"
        @close="closeTaskModal()"
        :open="isOpenTaskModal"
      >
        <div
          class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in duration-200"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay
              class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            />
          </TransitionChild>

          <!-- This element is to trick the browser into centering the modal contents. -->
          <span
            class="hidden sm:inline-block sm:align-middle sm:h-screen"
            aria-hidden="true"
            >&#8203;</span
          >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <div
              class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                  >
                    <PlusIcon
                      class="h-6 w-6 text-blue-600"
                      aria-hidden="true"
                    />
                  </div>
                  <div
                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                    style="flex: 1"
                  >
                    <DialogTitle
                      as="h3"
                      class="text-lg leading-6 font-medium text-gray-900"
                    >
                      <span v-if="editMode">Update</span>
                      <span v-else>New</span> Task
                    </DialogTitle>
                    <div class="mt-2">
                      <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                        >Title</label
                      >
                      <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                          type="text"
                          name="title"
                          id="title"
                          class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                          placeholder="Task Title"
                          v-model="taskForm.title"
                        />
                        <div v-if="$page.errors" class="text-red-500">
                          {{ $page.errors.title[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="mt-2">
                      <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                        >Description</label
                      >
                      <div class="mt-1 relative rounded-md shadow-sm">
                        <textarea
                          name="description"
                          id="description"
                          rows="3"
                          class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                          placeholder="Task Description"
                          v-model="taskForm.description"
                        ></textarea>
                        <div v-if="$page.errors" class="text-red-500">
                          {{ $page.errors.description[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
              >
                <button
                  type="button"
                  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                  @click="storeTask(taskForm)"
                >
                  Save
                </button>
                <button
                  type="button"
                  class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                  @click="closeTaskModal()"
                  ref="cancelButtonRef"
                >
                  Cancel
                </button>
              </div>
            </div>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <div class="py-12 pt-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div
            class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
            role="alert"
          >
            <!-- <div class="flex">
              <div class="py-1">
                <svg
                  class="fill-current h-6 w-6 text-teal-500 mr-4"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                  />
                </svg>
              </div>
              <div>
                <p class="font-bold">Info</p>
                <p class="text-sm">
                  {{ $page.flash.message }}
                </p>
              </div>
            </div> -->
          </div>

          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between">
              <span class="h3 font-bold font-medium"> Task List </span>
              <breeze-button class="ml-4" @click="openModal()">
                + New List
              </breeze-button>
            </div>
          </div>

          <div
            class="relative p-2 flex overflow-x-auto h-full"
            v-show="lists.length > 0"
          >
            <!-- Columns (Statuses) -->
            <div
              v-for="(list, index) in lists"
              :key="index"
              class="mr-6 w-4/5 max-w-xs flex-1 flex-shrink-0"
            >
              <div class="rounded-md shadow-md overflow-hidden">
                <div
                  class="p-3 flex justify-between items-baseline bg-blue-800"
                >
                  <h4 class="font-medium text-white">
                    {{ list.title }}
                    <span class="flex mt-2 font-normal font-thin"
                      ><span
                        class="mr-1"
                        v-text="getCompletedTaskPer(list.tasks)"
                      ></span>
                      Completed</span
                    >
                  </h4>
                  <button
                    class="py-1 px-2 text-sm text-gray-200 hover:underline"
                    @click="openTaskModal(list.id)"
                  >
                    Add Task
                  </button>
                </div>
                <div
                  class="p-2 flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto bg-blue-100"
                >
                  <!-- Tasks -->
                  <div
                    v-for="task in list.tasks"
                    :key="task.id"
                    class="mb-3 p-3 flex flex-col bg-white rounded-md shadow transform hover:shadow-md cursor-pointer"
                    :class="{ 'opacity-60': task.is_completed == '1' }"
                  >
                    <span class="block mb-2 text-xl text-gray-900">
                      {{ task.title }}
                    </span>
                    <p class="text-gray-700 truncate">
                      {{ task.description }}
                    </p>
                    <div class="flex justify-between align-center mt-3">
                      <button
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                        @click="openTaskModal(list.id, true, task)"
                      >
                        <PencilIcon
                          class="h-4 w-4 text-blue-600"
                          aria-hidden="true"
                        />
                      </button>
                      <button
                        class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
                        @click="deleteTask(task.id)"
                      >
                        <TrashIcon
                          class="h-4 w-4 text-red-600 hover:text-white"
                          aria-hidden="true"
                        />
                      </button>
                    </div>
                    <hr class="border-0 bg-gray-500 text-gray-500 h-px mt-2" />
                    <div class="flex flex-col">
                      <label class="inline-flex items-center mt-3">
                        <input
                          type="checkbox"
                          :value="task.is_completed"
                          class="form-checkbox h-5 w-5 text-gray-600"
                          :checked="task.is_completed"
                          @change="updateTaskStatus($event, task.id)"
                        /><span class="ml-2 text-gray-700">Is Completed</span>
                      </label>
                    </div>
                  </div>
                  <!-- ./Tasks -->

                  <!-- No Tasks -->
                  <div
                    v-show="!list.tasks.length"
                    class="flex-1 p-4 flex flex-col items-center justify-center"
                  >
                    <span class="text-gray-600">No tasks yet</span>
                    <button
                      class="mt-1 text-sm text-orange-600 hover:underline"
                      @click="openTaskModal(list.id)"
                    >
                      Add one
                    </button>
                  </div>
                  <!-- ./No Tasks -->
                </div>
              </div>
            </div>
            <!-- ./Columns -->
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeButton from "@/Components/Button";
import {
  Dialog,
  DialogOverlay,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { PlusIcon, PencilIcon, TrashIcon } from "@heroicons/vue/outline";

export default {
  components: {
    BreezeButton,
    BreezeAuthenticatedLayout,
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    PlusIcon,
    PencilIcon,
    TrashIcon,
  },

  props: {
    auth: Object,
    errors: Object,
    lists: Array,
  },

  data() {
    return {
      editMode: false,
      isOpen: false,
      isOpenTaskModal: false,
      taskId: null,
      is_completed: 0,
      listForm: {
        title: null,
      },
      taskForm: {
        list_id: null,
        title: null,
        description: null,
      },
    };
  },

  methods: {
    openModal: function () {
      this.isOpen = true;
    },
    closeModal: function () {
      this.isOpen = false;
      this.reset();
      this.editMode = false;
    },
    reset: function () {
      this.listForm = {
        title: null,
      };
    },

    openTaskModal: function (listId, isUpdating = false, task = {}) {
      console.log(listId);
      this.isOpenTaskModal = true;
      this.taskForm.list_id = listId;
      if (isUpdating) {
        this.editMode = true;
        this.taskId = task.id;
        this.taskForm.title = task.title;
        this.taskForm.description = task.description;
      }
    },
    closeTaskModal: function () {
      this.isOpenTaskModal = false;
      this.resetTask();
      this.editMode = false;
    },

    resetTask: function () {
      this.taskForm = {
        title: null,
        description: null,
        list_id: null,
      };
    },
    save: function (data) {
      this.$inertia.post("/list", data);
      this.reset();
      this.closeModal();
      this.editMode = false;
    },
    storeTask: function (data) {
      if (this.editMode && this.taskId) {
        this.updateTask(data);
      } else {
        this.saveTask(data);
      }
    },
    saveTask: function (data) {
      this.$inertia.post("/task", data);
      this.resetTask();
      this.closeTaskModal();
      this.editMode = false;
    },
    updateTask: function (data) {
      data._method = "PUT";
      this.$inertia.post(`/task/${this.taskId}`, data);
      this.resetTask();
      this.closeTaskModal();
      this.editMode = false;
      this.taskId = null;
    },
    updateTaskStatus: function (e, taskId) {
      let data = {
        _method: "PUT",
        is_completed: e.target.checked ? "1" : "0",
      };
      this.$inertia.post(`/task/update-status/${taskId}`, data);
      this.editMode = false;
      this.taskId = null;
    },
    getCompletedTaskPer(tasks) {
      if (tasks.length === 0) return "0%";
      let totalCompl = 0;
      tasks.forEach((elem) => {
        totalCompl += elem.is_completed == "0" ? 0 : 1;
      });
      return (totalCompl / tasks.length) * 100 + "%";
    },
    deleteTask: function (taskId) {
      if (!confirm("Are you sure to remove this task?")) return;
      this.$inertia.post(`/task/${taskId}`, { _method: "DELETE" });
      this.resetTask();
      this.editMode = false;
      this.taskId = null;
    },
  },

  mounted() {
    console.log(this.lists);
  },
};
</script>
