<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Button } from '@/components/ui/button'
import { Loader2 } from 'lucide-vue-next'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div>
                <Label>
                    Name
                    <Input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                </Label>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <Label>
                    Email
                    <Input
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autocomplete="username"
                    />
                </Label>
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <Label>
                    Password
                    <Input
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                </Label>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <Label>
                    Confirm Password
                    <Input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                </Label>
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <div>
                    <div class="flex items-center">
                        <Label>
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />
                            <span class="ms-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                            </span>
                        </Label>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </div>
            </div>

            <div class="flex items-center justify-center mt-4">
                <span class="mr-2 ml-2">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Already registered?
                    </Link>
                </span>         
            </div>

            <div class="flex items-center justify-end m-4">
                <Button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <Loader2 v-show="form.processing" class="w-4 h-4 mr-2 animate-spin" />
                    Register
                </Button>
            </div>
        </form>
    </AuthenticationCard>
</template>
