<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $searchName = '';
    public $searchEmail = '';
    public $searchRole = '';
    public $name, $email;
    public $userForUpdate = null;
    public $showModal = false;
    public $confirmingDelete = false;
    public $userToDelete = null;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email|unique:users,email',
    ];

    protected $messages = [
        'name.required' => 'Поле Имени должно быть заполнено!',
        'name.min' => 'Имя должно содержать минимум 2 символа!',
        'email.required' => 'Поле Почты должно быть заполнено!',
        'email.email' => 'Введите почту в правильном формате!',
        'email.unique' => 'Почта должна быть уникальной!',
    ];

//    public function render()
//    {
//        $users = $this->filterUsers();
//        return view('livewire.users', compact('users'));
//    }
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.users', [
            'users' => $users
        ]);

    }

    // Перенаправление на страницу пользователя
    public function showUser($userId)
    {
        return redirect()->route('users.show', $userId);
    }

    // Удаление пользователя
    public function deleteUser()
    {
        if ($this->userToDelete) {
            $user = User::find($this->userToDelete);

            // Нельзя удалить себя
            if ($user && $user->id !== auth()->id()) {
                $user->delete();
                session()->flash('message', 'Пользователь успешно удален!');
            } else {
                session()->flash('error', 'Нельзя удалить собственный аккаунт!');
            }
        }

        $this->confirmingDelete = false;
        $this->userToDelete = null;
    }

    public function confirmDelete($userId)
    {
        $this->confirmingDelete = true;
        $this->userToDelete = $userId;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->userToDelete = null;
    }

    // Создание пользователя
    public function storeUser()
    {
        $data = $this->validate();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt('password123'),
            'token' => \Illuminate\Support\Str::random(60),
        ]);

        $user->assignRole('user');

        $this->resetModal();
        session()->flash('message', 'Пользователь успешно создан!');
    }

    // Редактирование пользователя
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userForUpdate = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->showModal = true;
    }

    public function updateUser()
    {
        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $this->userForUpdate->id,
        ];

        $data = $this->validate($rules);

        $this->userForUpdate->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        $this->resetModal();
        session()->flash('message', 'Пользователь успешно обновлен!');
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function resetModal()
    {
        $this->showModal = false;
        $this->name = '';
        $this->email = '';
        $this->userForUpdate = null;
        $this->resetErrorBag();
    }

    // Фильтрация
    protected function filterUsers()
    {
        $query = User::query()
            ->with('roles')
            ->select('id', 'name', 'email', 'created_at');

        if ($this->searchName) {
            $query->where('name', 'like', '%' . $this->searchName . '%');
        }

        if ($this->searchEmail) {
            $query->where('email', 'like', '%' . $this->searchEmail . '%');
        }

        if ($this->searchRole) {
            $query->whereHas('roles', function($q) {
                $q->where('name', $this->searchRole);
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function resetFilters()
    {
        $this->searchName = '';
        $this->searchEmail = '';
        $this->searchRole = '';
        $this->resetPage();
    }
}
