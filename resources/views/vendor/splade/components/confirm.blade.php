<SpladeConfirm
    default-title="{{ __('Are you sure you want to continue?') }}"
    default-text=""
    default-password-text="{{ __('Please confirm your password before continuing') }}"
    default-confirm-button="{{ __('Confirm') }}"
    default-cancel-button="{{ __('Cancel') }}"
    confirm-password-route="{{ $confirmPasswordRoute ?? "" }}"
>
    <template #default="confirm">
        <x-splade-component is="transition" show="confirm.isOpen">
            <x-splade-component is="dialog" class="relative z-30" close="confirm.setIsOpen(false)">
                <x-splade-component
                    is="transition"
                    child
                    animation="opacity"
                    class="fixed inset-0 z-30 bg-black/75"
                />

                <div class="fixed inset-0 z-40 overflow-y-auto">
                    <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                        <x-splade-component is="transition" child animation="fade" after-leave="confirm.emitClose">
                            <x-splade-component is="dialog" panel class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:max-w-lg sm:w-full sm:p-6">
                                {{-- Icono Warning --}}
                                <div class="flex flex-col items-center justify-center py-2 mb-2 text-4xl text-yellow-400 border-b border-gray-200">
                                    <i class="fi fi-br-engine-warning"></i>
                                </div>
                                {{-- Icono Warning --}}
                                <div class="sm:flex sm:items-start">
                                    <div class="text-center sm:mt-0 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900" v-text="confirm.title" />
                                        <div class="mt-2" v-if="confirm.text">
                                            <p class="text-sm text-gray-500" v-text="confirm.text" />
                                        </div>

                                        <div class="flex mt-2 border border-gray-300 rounded-md shadow-sm" v-if="confirm.confirmPassword">
                                            <input
                                                type="password"
                                                name="password"
                                                placeholder="Password"
                                                v-on:change="confirm.setPassword($event.target.value)"
                                                class="block w-full border-0 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                                @keyup.enter="confirm.confirm"
                                                :disabled="confirm.submitting"
                                            />
                                        </div>

                                        <p v-if="confirm.passwordError" v-text="confirm.passwordError" class="mt-2 font-sans text-sm text-red-600" />
                                    </div>
                                </div>

                                <div class="mt-5 sm:mt-4 sm:flex">
                                    <button
                                        dusk="splade-confirm-confirm"
                                        type="button"
                                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm"
                                        @click.prevent="confirm.confirm"
                                        :disabled="confirm.submitting"
                                        v-text="confirm.confirmButton"
                                    />
                                    <button
                                        dusk="splade-confirm-cancel"
                                        type="button"
                                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        @click.prevent="confirm.cancel"
                                        :disabled="confirm.submitting"
                                        v-text="confirm.cancelButton"
                                    />
                                </div>
                            </x-splade-component>
                        </x-splade-component>
                    </div>
                </div>
            </x-splade-component>
        </x-splade-component>
    </template>
</SpladeConfirm>
