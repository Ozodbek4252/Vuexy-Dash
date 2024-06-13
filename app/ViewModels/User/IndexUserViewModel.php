<?php

declare(strict_types=1);

namespace App\ViewModels\User;

use App\Models\Role;
use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class IndexUserViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public string $email;
    public ?string $email_verified_at;
    public string $password;
    public ?string $remember_token;
    public int $role_id;
    public Role $role;
    public ?string $image;
    public $created_at;
    public $updated_at;

    protected function populate(): void
    {
        $this->id = $this->_data->id;
        $this->name = $this->_data->name;
        $this->email = $this->_data->email;
        $this->email_verified_at = $this->_data->email_verified_at;
        $this->password = $this->_data->password;
        $this->remember_token = $this->_data->remember_token;
        $this->role_id = $this->_data->role_id;
        $this->image = $this->_data->getImage();
        $this->created_at = $this->_data->created_at;
        $this->updated_at = $this->_data->updated_at;
        $this->role = $this->_data->role;

        $this->role->translations = $this->getTranslations($this->_data->role->translations);
    }

    private function getTranslations(Collection $collection): array
    {
        $collection = $collection->filter(function ($item) {
            return $item->lang->code == env('LOCALE', app()->getLocale());
        });

        $collection = $collection->groupBy('column_name');

        $collection = $collection->map(function ($item) {
            return $item[0];
        });

        return $collection->toArray();
    }
}
