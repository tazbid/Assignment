<?php

namespace App\Traits;


trait UserTrait
{
    //superadmin seeding information
    private $superadminSeedEmail = "superadmin@office.com";
    private $superadminSeedName = "Superadmin";

    //user status boolean
    private $userActive = 1;
    private $userDeactive = 0;

    private $active = 1;
    private $deactive = 0;

    //roles
    private $superAdminRole = 'super-admin';
    private $adminRole = 'admin';
    private $doctorRole = 'doctor';

    //user image collection
    private $userProfileImageCollection = 'user-profile';

    //doctor
    private $doctorCodePrefix = "DR-";
}
