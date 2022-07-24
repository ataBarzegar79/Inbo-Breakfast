<?php

namespace App\Dtos;

use App\Http\Requests\storeUserRequest;

class UserCreateDtoFactory{
    public function fromRequest(storeUserRequest $request): UserCreateDto
    {

        if($request->avatar !== null) {
            $avatar_extension = '.' . $request->avatar->extension();
            $email_path = $request->email;
            $avatar_path = $email_path.$avatar_extension ;
            $Avatar_saving = $request->file('avatar')->storeAs(
                'avatars', $avatar_path, 'public'
            );
        }
        else{
            $avatar_path = "default.svg" ;
        }

        return new UserCreateDto(
            $request->name,
            $request->email,
            $request->password,
            $avatar_path,
            $request->is_admin,
        );

    }
}
