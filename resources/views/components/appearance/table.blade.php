<div x-data="{
    searchQuery: '',
    currentPage: 1,
    itemsPerPage: 5,
    allUsers: [
        { id: 1, name: 'Alice Brown', email: 'alice.brown@gmail.com', status: 'active' },
        { id: 2, name: 'Bob Johnson', email: 'johnson.bob@outlook.com', status: 'inactive' },
        { id: 3, name: 'Sarah Adams', email: 's.adams@gmail.com', status: 'inactive' },
        { id: 4, name: 'Carlos Rodriguez', email: 'carlos.r@company.com', status: 'active' },
        { id: 5, name: 'Maria Garcia', email: 'm.garcia@email.com', status: 'active' },
        { id: 6, name: 'John Smith', email: 'john.smith@domain.com', status: 'inactive' },
        { id: 7, name: 'Ana Martinez', email: 'ana.martinez@test.com', status: 'active' },
        { id: 8, name: 'David Wilson', email: 'd.wilson@example.org', status: 'active' },
        { id: 9, name: 'Laura Chen', email: 'laura.chen@mail.com', status: 'inactive' },
        { id: 10, name: 'Miguel Torres', email: 'miguel.torres@site.net', status: 'active' },
        { id: 11, name: 'Sofia Lopez', email: 'sofia.lopez@business.co', status: 'active' },
        { id: 12, name: 'Pedro Sanchez', email: 'pedro.s@corporation.com', status: 'inactive' }
    ],

    get filteredUsers() {
        if (!this.searchQuery) return this.allUsers;

        return this.allUsers.filter(user =>
            user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            user.email.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
    },

    get totalPages() {
        return Math.ceil(this.filteredUsers.length / this.itemsPerPage);
    },

    get paginatedUsers() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.filteredUsers.slice(start, end);
    },

    get totalResults() {
        return this.filteredUsers.length;
    },

    nextPage() {
        if (this.currentPage < this.totalPages) {
            this.currentPage++;
        }
    },

    prevPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
        }
    },

    resetToFirstPage() {
        this.currentPage = 1;
    }
}" class="w-full flex flex-col gap-5">
    <div class="w-full lg:w-1/3">
        <flux:input
            icon="magnifying-glass"
            placeholder="{{ __('Buscar por nombre o email...') }}"
            x-model="searchQuery"
            x-on:input="resetToFirstPage()"
        />
    </div>

    <div class="overflow-hidden w-full overflow-x-auto rounded-lg border border-light-variant dark:border-dark-variant">
        <table class="w-full text-left text-sm">
            <thead class="border-b bg-light-variant dark:bg-dark-variant text-sm border-light-variant dark:border-dark-variant">
                <tr>
                    <th class="p-4">{{ __('Nombre') }}</th>
                    <th class="p-4">{{ __('Correo Electrónico') }}</th>
                    <th class="p-4">{{ __('Estatus') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-light-variant dark:divide-dark-variant">
                <template x-for="user in paginatedUsers" x-bind:key="user.id">
                    <tr>
                        <td class="p-4" x-text="user.name"></td>
                        <td class="p-4" x-text="user.email"></td>
                        <td class="p-4">
                            <div
                                x-bind:class="user.status === 'active' ?
                                    'border-2 border-green-500 text-green-500 rounded-full py-2 px-4 inline-block text-center text-xs' :
                                    'border-2 border-red-500 text-red-500 rounded-full py-2 px-4 inline-block text-center text-xs'"
                                x-text="user.status === 'active' ? '{{ __('Activo') }}' : '{{ __('Inactivo') }}'"
                            ></div>
                        </td>
                    </tr>
                </template>

                <!-- Mensaje cuando no hay resultados -->
                <tr x-show="paginatedUsers.length === 0" x-cloak>
                    <td colspan="3" class="p-8 text-center text-gray-500">
                        {{ __('No se encontraron resultados') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="w-full flex flex-col md:flex-row md:items-center justify-between">
        <flux:heading x-text="'{{ __('Resultados:') }} ' + totalResults"></flux:heading>
        <div class="flex items-center justify-between md:justify-around gap-5">
            <flux:text class="mt-2" x-text="'{{ __('Página') }} ' + currentPage + ' {{ __('de') }} ' + totalPages"></flux:text>
            <div class="flex items-center gap-2">
                <flux:button
                    variant="primary"
                    x-on:click="prevPage()"
                    x-bind:disabled="currentPage === 1"
                    x-bind:class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Anterior') }}
                </flux:button>
                <flux:button
                    variant="primary"
                    x-on:click="nextPage()"
                    x-bind:disabled="currentPage === totalPages"
                    x-bind:class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Siguiente') }}
                </flux:button>
            </div>
        </div>
    </div>
</div>
