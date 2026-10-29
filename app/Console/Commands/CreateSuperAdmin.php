<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    protected $signature = 'school:create-super-admin';

    protected $description = 'Create the first FNPS Gusau Super Admin account';

    public function handle(): int
    {
        if (User::where('role', 'super_admin')->exists()) {
            $this->error('A Super Admin account already exists.');
            $this->line('For security, this command only creates the first Super Admin.');

            return self::FAILURE;
        }

        $name = trim((string) $this->ask('Super Admin full name'));
        $email = strtolower(trim((string) $this->ask('Super Admin email address')));

        if ($name === '') {
            $this->error('Name cannot be empty.');

            return self::FAILURE;
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Please enter a valid email address.');

            return self::FAILURE;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('That email address is already in use.');

            return self::FAILURE;
        }

        $password = (string) $this->secret('Create a strong password (at least 12 characters)');
        $confirmation = (string) $this->secret('Confirm the password');

        if (strlen($password) < 12) {
            $this->error('The password must contain at least 12 characters.');

            return self::FAILURE;
        }

        if (! hash_equals($password, $confirmation)) {
            $this->error('The passwords do not match.');

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'login_id' => null,
            'student_id' => null,
            'must_change_pin' => false,
            'role' => 'super_admin',
        ]);

        $this->newLine();
        $this->info('Super Admin account created successfully.');
        $this->line('You can now sign in through the staff login page.');

        return self::SUCCESS;
    }
}

