<?php

namespace App\Services\Doctor;

use App\Models\Prescription\PrescriptionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Traits\UserTrait;
use App\Traits\ResponseTrait;


class DoctorService
{

    use UserTrait;

    /**
     * Add leading zeros to a number, if necessary
     *
     * @var int $value The number to add leading zeros
     * @var int $threshold Threshold for adding leading zeros (number of digits
     *                     that will prevent the adding of additional zeros)
     * @return string
     */
    public function addLeadingZero($value, $threshold = 2)
    {
        return sprintf('%0' . $threshold . 's', $value);
    }


    /**
     * @name generateDoctorCode
     * @role generate a unique prefix based doctor code
     * @param App\Models\User $doctor
     * @return string $doctorCode
     *
     */
    public function generateDoctorCode(User $doctor)
    {
        $leadingValue = $this->addLeadingZero($doctor->id, 5);
        return $this->doctorCodePrefix . $leadingValue;
    }




    /**
     * Validate the doctor insert request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function validateDoctorInsertRequest(Request $request)
    {
        $request->validate(User::$doctorInsertRules);
    }


    /**
     * @name mapDoctorInsertAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapDoctorInsertAttributes(Request $request)
    {
        return [
            'name'                      => $request->name,
            'email'                     => $request->email,
            'contact_number'            => $request->contact_number,
            'designation'               => $request->designation,
            'address'                   => $request->address,
            'password'                  => Hash::make($request->password),
            'status'                    => $request->status
        ];
    }


    /**
     * @name uploadProfileImg
     * @role upload profile images
     * @param \Illuminate\Http\Request $request , App\Models\User $user
     * @return void
     *
     */

    public function uploadProfileImg(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $user->addMedia($request->image)->toMediaCollection($this->userProfileImageCollection);
        }
    }


    /**
     * @name insertdoctor
     * @role insert a new doctor into database
     * @param \Illuminate\Http\Request $request
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function insertDoctor(Request $request)
    {
        DB::beginTransaction();
        try {

            $attributes = $this->mapDoctorInsertAttributes($request);
            // dd($attributes);
            $doctor = User::create($attributes);

            $code = $this->generateDoctorCode($doctor);

            $doctor->doctor_code = $code;
            $doctor->save();

            //assign role
            $doctor->assignRole($this->doctorRole);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }



    /************************* Update ******************************* */


    /**
     * Validate the doctor update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function validateDoctorUpdateRequest(Request $request)
    {
        $request->validate(user::doctorUpdateRules($request->id));
    }



    /**
     * @name mapDoctorUpdateAttributes
     * @role map request into custom attribute array
     * @param \Illuminate\Http\Request $request
     * @return Array $attributes
     *
     */
    public function mapDoctorUpdateAttributes(Request $request)
    {
        $attributes = [
            'name'                      => $request->name,
            'email'                     => $request->email,
            'contact_number'            => $request->contact_number,
            'designation'               => $request->designation,
            'address'                   => $request->address,
            'status'                    => $request->status
        ];

        if ($request->filled('password')) {

            $attributes['password'] = Hash::make($request->password);
        }
        return $attributes;
    }


    /**
     * @name updatedoctor
     * @role  update doctor record into database
     * @param \Illuminate\Http\Request $request,App\Models\doctor\doctorModel $doctor
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function updateDoctor(Request $request, User $doctor)
    {
        DB::beginTransaction();
        try {


            $attributes = $this->mapDoctorUpdateAttributes($request);
            $this->uploadProfileImg($request, $doctor);
            $response = $doctor->update($attributes);

            DB::commit();

            return $response;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    /************************** Delete ************************* */

    /**
     * Validate the doctor update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function validateDoctorDeleteRequest(Request $request)
    {
        $request->validate(User::$doctorDeleteRules);
    }


    /**
     * @name deleteDoctor
     * @role  delete doctor record into database
     * @param App\Models\User $doctor
     * @return boolean
     *
     *@throws 500 internal server error
     */
    public function deleteDoctor(User $doctor)
    {
        DB::beginTransaction();
        try {

            PrescriptionModel::where('doctor_id',$doctor->id)->delete();

            $doctor->clearMediaCollection($this->userProfileImageCollection);
            $response = $doctor->delete();


            DB::commit();

            return $response;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
