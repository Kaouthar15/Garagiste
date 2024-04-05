<?php
  
namespace App\Imports;
  
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
  
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row); 
        return new User([ 
            'username'    => $row['username'], 
            'firstName'    => $row['firstname'], 
            'lastName'    => $row['lastname'], 
            'address'    => $row['address'], 
            'phoneNumber'    => $row['phonenumber'], 
            'isClient'    => $row['isclient'], 
            'isMechanic'    => $row['ismechanic'], 
            'email'    => $row['email'], 
            'password' => Hash::make($row['password']), 
        ]);
    }
}