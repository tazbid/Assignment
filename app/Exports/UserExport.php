<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithMapping, WithHeadings
{

    public function __construct($role = null)
    {
        $this->role = $role;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Last Login IP',
            'Last Login Browser',
            'Last Login Time',
            'Profile Picture',
            'status',
            'Roles',
            'First Name',
            'Last Name',
            'Phone',
            'Company',
            'City',
            'Country',
            'Address(1st)',
            'Address(2nd)',
            'Created At',
            'Updated At',
            'Deleted At',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        if ($this->role) {
            $users = User::role($this->role)->with('details')->get();
        } else {
            $users = User::with('details')->get();
        }

        return $users;
    }

    /**
     * @var log $log
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->last_login_ip,
            $user->last_login_browser,
            $user->last_login_at,
            asset($user->avatar_path),
            $user->status == 1 ? 'Active' : 'Deactive',
            $this->role == null ? json_encode($user->getRoleNames()) : json_encode([$this->role]),
            $user->details ? $user->details->first_name : null,
            $user->details ? $user->details->last_name : null,
            $user->details ? $user->details->phone : null,
            $user->details ? $user->details->company : null,
            $user->details ? $user->details->city : null,
            $user->details ? $user->details->country : null,
            $user->details ? $user->details->address_one : null,
            $user->details ? $user->details->address_two : null,
            $user->created_at,
            $user->updated_at,
            $user->deleted_at,

        ];
    }
}
