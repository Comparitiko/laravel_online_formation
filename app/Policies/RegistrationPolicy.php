<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RegistrationPolicy
{
   public function before(User $user): ?bool
   {
       if ($user->role === UserRole::ADMIN) {
           return true;
       }

       return null;
   }

   public function createRegistration(User $user, Registration $registration): bool
   {
       return $user->id === $registration->student_id;
   }
}
