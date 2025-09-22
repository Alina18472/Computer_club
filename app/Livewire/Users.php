<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

use Livewire\WithPagination;
use Illuminate\Support\Str;
class Users extends Component
{

    use WithPagination;

    public $searchName = '';
    public $searchEmail = '';
    public $name, $email;
    public $userForUpdate = null;
    public $showModal = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
    ];

    protected $messages = [
        'name.required' => 'Поле Имени должно быть заполнено! ',
        'email.required' => 'Поле Почты должно быть заполнено! ',
        'email.email' => 'Введите почту в правильном формате! ',
        'email.unique' => 'Почта должна быть уникальной! ',
    ];
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.users', [
            'users' => $users
        ]);

    }


    protected $listeners = ['delete-user' => 'deleteUser'];
    public $confirmingDelete = false;
    public $userToDelete = null;
    public function deleteUser()
    {

    }



    public function confirmDelete($requestId)
    {
        $this->confirmingDelete = true;

    }
    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->userToDelete = null;
    }



    public function storeUser()
    {
        $data = $this->validate();
        $data['email_verified_at'] = now();
        $data['password'] = bcrypt('12345678');
        $data['remember_token'] = Str::random(10);


        $user = User::create($data);
        $user->assignRole('user');

        $this->name = '';
        $this->email = '';

        $this->closeModal();


    }

    public function getUserForUpdate($id)
    {
        $user = User::query()->find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->userForUpdate = $user;
        $this->openModal();
    }

    public function updateUser()
    {
        $data = $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->userForUpdate->id,
            'name' => 'required',
        ]);

        $this->userForUpdate->update($data);

        $this->closeModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->name = '';
        $this->email = '';
        $this->userForUpdate = null;
        $this->resetErrorBag();

    }


    public function searchUsers()
    {

        $this->resetPage();
    }

    protected function filterUsers()
    {
        $query = User::query();


        if ($this->searchName) {
            $query->where('name', 'like', '%' . $this->searchName . '%');
        }


        if ($this->searchEmail) {
            $query->where('email', 'like', '%' . $this->searchEmail . '%');
        }

        return $query->paginate(10);
    }
    public function resetFilters()
    {
        $this->searchName = '';
        $this->searchEmail = '';
        $this->resetPage();
    }

}
