<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { Loader2 } from 'lucide-vue-next'

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            Delete Account
        </template>

        <template #description>
            Permanently delete your account.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </div>

            <div class="mt-5">
                <Button variant='destructive' @click="confirmUserDeletion">
                    Delete Account
                </Button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Delete Account
                </template>

                <template #content>
                    <div class="mt-4 mb-4">
                        <Label>
                            Are you sure you want to delete your account?
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                            Please enter your password to confirm you would like to permanently delete your account.
                            <Input
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                class="w-full"
                                placeholder="Password"
                                autocomplete="current-password"
                                @keyup.enter="deleteUser"
                            />
                        </Label>
                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <Button variant='outline' @click="closeModal" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <Loader2 v-show="form.processing" class="w-4 h-4 mr-2 animate-spin" />
                        Cancel
                    </Button>

                    <Button
                        variant='destructive'
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </Button>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
