{{--<div class="container mx-auto p-6 bg-blue-50">--}}

{{--    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Список пользователей</h1>--}}
{{--    @can('create users')--}}
{{--        <button wire:click="openModal" type="button" class="mb-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">--}}
{{--            Создать пользователя--}}
{{--        </button>--}}
{{--    @endcan--}}
{{--    <div class="my-4">--}}
{{--        <input type="text" wire:model.live="searchName" placeholder="Поиск по имени" class="border rounded px-3 py-2 mx-2">--}}
{{--        <input type="text" wire:model.live="searchEmail" placeholder="Поиск по почте" class="border rounded px-3 py-2 mx-2">--}}
{{--        <button class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition" wire:click="searchUsers">Поиск</button>--}}
{{--        <button class="bg-gray-500 text-white px-4 py-2 mr-2 rounded-md hover:bg-gray-600 transition" wire:click="resetFilters">Сбросить фильтры</button>--}}
{{--    </div>--}}

{{--    <div class="my-4">{{ $users->links() }}</div>--}}

{{--    <div class="overflow-hidden rounded-lg shadow-lg bg-white">--}}
{{--        <table class="w-full text-left border-collapse">--}}
{{--            <thead>--}}
{{--            <tr class="bg-gray-100">--}}
{{--                <th class="p-4 border-b text-gray-600">Имя</th>--}}
{{--                <th class="p-4 border-b text-gray-600">Почта</th>--}}
{{--                <th class="p-4 border-b text-gray-600">Роль</th>--}}
{{--                <th class="p-4 border-b text-gray-600">Действия</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($users as $user)--}}
{{--                <tr class="border-b hover:bg-gray-50">--}}
{{--                    <td class="p-4">{{ $user->name }}</td>--}}
{{--                    <td class="p-4">{{ $user->email }}</td>--}}
{{--                    <td class="p-4">--}}
{{--                        @foreach($user->roles as $role)--}}
{{--                            {{ $role->name }}--}}
{{--                        @endforeach--}}
{{--                    </td>--}}
{{--                    <td class="p-4 flex space-x-2">--}}

{{--                        @can('delete users')--}}
{{--                            <button wire:click="confirmDelete({{ $user->id }})"--}}
{{--                                    class="text-gray-500 hover:text-red-600 transition-colors"--}}
{{--                                    title="Удалить">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />--}}
{{--                                </svg>--}}
{{--                            </button>--}}
{{--                        @endcan--}}
{{--                        @can('edit users')--}}
{{--                            <button--}}
{{--                                wire:click="getUserForUpdate({{ $user->id }})"--}}
{{--                                class="bg-yellow-400 text-gray-900 font-semibold px-3 py-1 rounded-md hover:bg-yellow-500 transition"--}}
{{--                            >--}}
{{--                                Редактировать--}}
{{--                            </button>--}}
{{--                        @endcan--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}

{{--    @if($showModal)--}}
{{--        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">--}}
{{--            <div class="bg-white p-6 rounded-lg shadow-lg" style="width: 50vw; max-width: 800px; overflow-y: auto;">--}}
{{--                <h2 class="text-xl font-semibold mb-4">{{ $userForUpdate ? 'Редактировать пользователя' : 'Создать пользователя' }}</h2>--}}
{{--                <form class="max-w-sm mx-auto">--}}
{{--                    <div class="mb-5">--}}
{{--                        <label for="user_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваше имя</label>--}}
{{--                        @error('name')--}}
{{--                        <p>{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                        <input wire:model="name" type="text" id="user_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />--}}
{{--                    </div>--}}
{{--                    <div class="mb-5">--}}
{{--                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваша почта</label>--}}
{{--                        @error('email')--}}
{{--                        <p>{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                        <input wire:model.live="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                @if($userForUpdate)--}}
{{--                    <button wire:click="updateUser" type="button" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">--}}
{{--                        Обновить--}}
{{--                    </button>--}}
{{--                @else--}}
{{--                    <button wire:click="storeUser" type="button" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">--}}
{{--                        Создать--}}
{{--                    </button>--}}
{{--                @endif--}}
{{--                <button wire:click="closeModal" type="button" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">--}}
{{--                    Отмена--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @if($confirmingDelete)--}}
{{--        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">--}}
{{--            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">--}}
{{--                <h2 class="text-xl font-semibold mb-4">Подтверждение удаления</h2>--}}
{{--                <p class="mb-6">Вы уверены, что хотите удалить этого пользователя? Это действие нельзя отменить.</p>--}}

{{--                <div class="flex justify-end space-x-3">--}}
{{--                    <button wire:click="deleteUser"--}}
{{--                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">--}}
{{--                        Удалить--}}
{{--                    </button>--}}
{{--                    <button wire:click="cancelDelete"--}}
{{--                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">--}}
{{--                        Отмена--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</div>--}}


<div class="container mx-auto p-6 bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Управление пользователями</h1>

    <!-- Кнопка создания и фильтры -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex justify-between items-center mb-4">
            @can('create users')
                <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Создать пользователя
                </button>
            @endcan

            <div class="flex gap-4 items-center">
                <input type="text" wire:model.live="searchName" placeholder="Поиск по имени"
                       class="border rounded px-3 py-2 w-48 text-sm">
                <input type="text" wire:model.live="searchEmail" placeholder="Поиск по почте"
                       class="border rounded px-3 py-2 w-48 text-sm">
                <select wire:model.live="searchRole" class="border rounded px-3 py-2 text-sm">
                    <option value="">Все роли</option>
                    <option value="user">Пользователь</option>
                    <option value="manager">Менеджер</option>
                    <option value="admin">Админ</option>
                </select>
                <button wire:click="resetFilters" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-sm">
                    Сбросить
                </button>
            </div>
        </div>
    </div>

    <!-- Таблица пользователей -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
            <tr>
                <th class="p-4 text-left font-semibold text-sm">Имя</th>
                <th class="p-4 text-left font-semibold text-sm">Почта</th>
                <th class="p-4 text-left font-semibold text-sm">Роль</th>
                <th class="p-4 text-left font-semibold text-sm">Дата регистрации</th>
                <th class="p-4 text-left font-semibold text-sm">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 text-sm">{{ $user->name }}</td>
                    <td class="p-4 text-sm">{{ $user->email }}</td>
                    <td class="p-4">
                        @foreach($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td class="p-4 text-sm text-gray-600">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                    <td class="p-4">
                        <div class="flex gap-2 justify-start">
                            <!-- Просмотр -->
                            <button wire:click="showUser({{ $user->id }})"
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded transition"
                                    title="Просмотреть">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>

                            <!-- Редактирование -->
                            @can('edit users')
                                <button wire:click="editUser({{ $user->id }})"
                                        class="p-2 text-yellow-600 hover:bg-yellow-50 rounded transition"
                                        title="Редактировать">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                            @endcan

                            <!-- Удаление -->
                            @can('delete users')
                                @if($user->id !== auth()->id())
                                    <button wire:click="confirmDelete({{ $user->id }})"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded transition"
                                            title="Удалить">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                @else
                                    <span class="p-2 text-gray-400 cursor-not-allowed" title="Нельзя удалить себя">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </span>
                                @endif
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Пагинация -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- Модальное окно создания/редактирования -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">
                        {{ $userForUpdate ? 'Редактировать пользователя' : 'Создать пользователя' }}
                    </h2>

                    <form>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Имя</label>
                            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2">Почта</label>
                            <input type="email" wire:model="email" class="w-full border rounded px-3 py-2">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-2 justify-end mt-6">
                            <button type="button" wire:click="resetModal" class="px-4 py-2 border rounded text-sm">Отмена</button>
                            <button type="button"
                                    wire:click="{{ $userForUpdate ? 'updateUser' : 'storeUser' }}"
                                    class="px-4 py-2 bg-blue-500 text-white rounded text-sm">
                                {{ $userForUpdate ? 'Обновить' : 'Создать' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Модальное окно подтверждения удаления -->
    @if($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">Подтверждение удаления</h2>
                    <p class="text-gray-600 mb-4 text-sm">Вы уверены, что хотите удалить этого пользователя? Это действие нельзя отменить.</p>

                    <div class="flex gap-2 justify-end">
                        <button wire:click="cancelDelete" class="px-4 py-2 border rounded text-sm">Отмена</button>
                        <button wire:click="deleteUser" class="px-4 py-2 bg-red-500 text-white rounded text-sm">
                            Удалить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Всплывающие сообщения -->
    @if (session()->has('message'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg text-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg text-sm">
            {{ session('error') }}
        </div>
    @endif
</div>

