<div
    x-data="{
        notifications: [],
        add(e) {
            this.notifications.push({
                id: e.timeStamp,
                type: e.detail.type,
                content: e.detail.content,
            })
        },
        remove(notification) {
            this.notifications = this.notifications.filter(i => i.id !== notification.id)
        },
    }"
    @notify.window="add($event);"
    class="z-50 fixed top-14 right-0 flex w-full max-w-xs flex-col space-y-4 pr-2 sm:justify-start"
    role="status"
    aria-live="polite"
    >
    <!-- Notification -->
    <template x-for="notification in notifications" :key="notification.id">
        <div
            x-data="{
                show: false,
                init() {
                    this.$nextTick(() => this.show = true)
                    if(notification.type == 'success'){
                        setTimeout(() => this.transitionOut(), 5000)
                    } else {
                        setTimeout(() => this.transitionOut(), 10000)
                    }
                },
                transitionOut() {
                    this.show = false
                    setTimeout(() => this.remove(this.notification), 500)
                },
            }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            class="z-50 pointer-events-auto relative w-full max-w-sm rounded-md py-5 pl-6 pr-4 shadow-lg bg-light-variant/50 dark:bg-dark-variant/50 border border-light-variant dark:border-dark-variant backdrop-blur-md">
            <div class="flex items-start">
                <!-- Icons -->
                <div x-show="notification.type === 'info'" class="flex-shrink-0">
                    <div class="h-6 w-6 rounded-full border-2 border-blue-500 flex items-center justify-center">
                        <svg aria-hidden class="h-4 w-4 fill-blue-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="sr-only">Information:</span>
                </div>

                <div x-show="notification.type === 'warning'" class="flex-shrink-0">
                    <div class="h-6 w-6 rounded-full border-2 border-yellow-500 flex items-center justify-center">
                        <svg aria-hidden class="h-4 w-4 fill-yellow-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.981-1.742 2.981H4.42c-1.53 0-2.493-1.647-1.743-2.982l5.58-9.92zM11 13a1 1 0 10-2 0v2a1 1 0 102 0v-2zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="sr-only">Warning:</span>
                </div>

                <div x-show="notification.type === 'success'" class="flex-shrink-0">
                    <div class="h-6 w-6 rounded-full border-2 border-emerald-500 flex items-center justify-center">
                        <svg aria-hidden class="h-4 w-4 fill-emerald-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="sr-only">Success:</span>
                </div>

                <div x-show="notification.type === 'error'" class="flex-shrink-0">
                    <div class="h-6 w-6 rounded-full border-2 border-red-500 flex items-center justify-center">
                        <svg aria-hidden class="h-4 w-4 fill-red-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                    <span class="sr-only">Error:</span>
                </div>

                <!-- Text -->
                <div class="ml-3 w-0 flex-1">
                    <p x-text="notification.content" class="text-xs leading-5 opacity-80"></p>
                </div>

                <!-- Remove button -->
                <div class="ml-4 flex flex-shrink-0">
                    <button @click="transitionOut()" type="button" class="inline-flex text-gray-400 hover:text-gray-600">
                        <svg aria-hidden class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close notification</span>
                    </button>
                </div>

                <div
                    class="absolute top-0 right-0 bottom-0 w-1 h-auto rounded-r-full"
                     x-bind:class="{ 'bg-blue-500': notification.type == 'info', 'bg-emerald-500': notification.type == 'success', 'bg-red-500': notification.type == 'error', 'bg-yellow-500': notification.type == 'warning' }">
                </div>
            </div>
        </div>
    </template>
</div>
