<?php

namespace App\Http\Controllers;

use App\Utilities\IsActiveUserX86;
use App\Http\Controllers\Controller;
use App\Models\RegisterModel;
use App\Models\BillingDetail;
use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;




use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return redirect()->route('service');
    }
    public function service()
    {
        // $data['title'] = 'Pilih Paket';
        // $data[];
        $data_available = null;
        $register_id = Str::random(10);
        if (session()->has('register_id')) {
            $register_id = session()->get('register_id');
            if ($register_id) {
                $check = RegisterModel::where('register_id', $register_id)->first();
                if ($check) {
                    $data_available = RegisterModel::with('service')->find($register_id);
                }
            }
        } else {
            session()->put('register_id', $register_id);
        }
        $title = 'Pilih Paket';
        $data = DB::table('services')
            ->where('is_visible', '1')
            ->get();
        return view('registration.service', compact('data', 'title', 'register_id', 'data_available'));
    }

    public function service_store(Request $request)
    {
        // dd($request->all());

        $credentials = $request->validate([
            // 'register_id' => 'required',
            // 'register_id' => 'required',
            'service' => 'required',
        ]);

        $check = RegisterModel::where('register_id', $request->register_id)->first();
        if ($check) {
            // $request->register_id = Str::random(10);
            // session()->put('register_id', $request->register_id);
            $register_id = $request->register_id;
            try {
                $customer = RegisterModel::where('register_id', $register_id)->first();
                $customer->serv_id = $credentials['service'];
                $customer->updated_at = Carbon::now();
                $customer->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            // dd($check);
            // dd($credentials->all());
            // $customer->updated_at = Carbon::now();
            // dd()
            // $new_id = Str::random(10);
            try {
                $customer = new RegisterModel();
                $customer->register_id = $request->register_id;
                $customer->serv_id = $credentials['service'];
                // dd($customer);
                $customer->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        return redirect()->route('registration.register')->with('success', 'Silahkan Membuat Akun');
    }
    public function register()
    {
        $title = 'Buat Akun';

        if (session()->has('register_id')) {

            $register_id = session()->get('register_id');


            $data = RegisterModel::with('service')->find($register_id);
            // dd($data);
            if (!$data) {
                return redirect()->route('service')->with('error', 'Silahkan Mengulangi Proses Registrasi');
            }

            // $selected_package = $data->service->service_name;
            return view('registration.register', compact('title', 'register_id', 'data'));
        } else {
            return redirect()->route('service');
        }
    }

    public function register_store(Request $request)
    {
        if (session()->has('register_id')) {
            // dd($request->all());
            $credentials = $request->validate([
                // 'register_id' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:4',
                'repeat_password' => 'required|same:password'
            ]);
            // dd($credentials->all());
            // $customer->updated_at = Carbon::now();
            // dd()
            try {
                $register_id = session()->get('register_id');
                $customer = RegisterModel::where('register_id', $register_id)->first();
                if (!$customer) {
                    return redirect()->route('service')->with('error', 'Silahkan Mengulangi Proses Registrasi');
                }
                $customer->name = $credentials['name'];
                $customer->email = $credentials['email'];

                $customer->password = $credentials['password'];
                // $customer->sssss = $credentials['password'];
                // dd($customer);
                $customer->updated_at = Carbon::now();

                // dd($customer);
                $customer->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            return redirect()->route('profile')->with('success', 'Registrasi berhasil, silahkan lengkapi data diri');
        } else {
            return redirect()->route('service');
        }
    }
    public function profile()
    {
        $title = 'Input Data Diri';

        if (session()->has('register_id')) {

            $register_id = session()->get('register_id');


            $data = RegisterModel::with('service')->find($register_id);
            if ($data->location) {
                $location = explode(',', $data->location);
                $data->latitude = $location[0];
                $data->longitude = $location[1];
            }
            // dd($data);
            if (!$data) {
                return redirect()->route('service')->with('error', 'Silahkan Mengulangi Proses Registrasi');
            }

            // $selected_package = $data->service->service_name;
            return view('registration.profile', compact('title', 'register_id', 'data'));
        } else {
            return redirect()->route('service');
        }
    }

    public function profile_store(Request $request)
    {
        // dd($request);
        if (session()->has('register_id')) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'ktp_number' => 'required|numeric',
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ];

            if ($request->hasFile('ktp_file')) {
                $rules['ktp_file'] = 'image|mimes:jpeg,png,jpg|max:2048';
            }
            if ($request->hasFile('home_file')) {
                $rules['home_file'] = 'image|mimes:jpeg,png,jpg|max:2048';
            }

            $credentials = $request->validate($rules);

            //cek email dan nomor ktp
            $check_email = Customer::where('customer_email', $credentials['email'])->first();
            $check_ktp = Customer::where('customer_ktp_no', $credentials['ktp_number'])->first();
            if ($check_email) {
                return redirect()->back()->with('error', 'Email sudah terdaftar silahkan gunakan email lain');
            }
            if ($check_ktp) {
                return redirect()->back()->with('error', 'Nomor KTP sudah terdaftar');
            } else {
                try {
                    $register_id = session()->get('register_id');
                    $customer = RegisterModel::where('register_id', $register_id)->first();

                    if (!$customer) {
                        return redirect()->route('service')->with('error', 'Silahkan Mengulangi Proses Registrasi');
                    }

                    // Handle file upload to S3
                    if ($request->hasFile('ktp_file')) {
                        $file = $request->file('ktp_file');
                        $filename = $credentials['ktp_number'] . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $filepath = 'ktp/' . $filename;

                        // Delete old file if exists
                        if ($customer->ktp_file) {
                            Storage::disk(name: 's3')->delete('ktp/' . $customer->ktp_file);
                        }

                        // Upload to S3
                        Storage::disk('s3')->put($filepath, file_get_contents($file));

                        // Get the URL of the uploaded file
                        $s3_url = $filename; // Store only filename in database
                    } else {
                        $s3_url = $customer->ktp_file; // Use existing file if no new file is uploaded
                    }

                    //foto rumah
                    if ($request->hasFile('home_file')) {
                        $file = $request->file(key: 'home_file');
                        $filename = $register_id . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $filepath = 'sub_home_temp/' . $filename;

                        // Delete old file if exists
                        if ($customer->home_file) {
                            Storage::disk(name: 's3')->delete('sub_home_temp/' . $customer->home_file);
                        }

                        // Upload to S3
                        Storage::disk('s3')->put($filepath, file_get_contents($file));

                        // Get the URL of the uploaded file
                        $s3_url_home = $filename; // Store only filename in database
                    } else {
                        $s3_url_home = $customer->home_file; // Use existing file if no new file is uploaded
                    }

                    $customer->name = $credentials['name'];
                    $customer->email = $credentials['email'];
                    $customer->phone = $credentials['phone'];
                    $customer->ktp_number = $credentials['ktp_number'];
                    $customer->ktp_file = $s3_url; // Store the S3 URL instead of filename
                    $customer->home_file = $s3_url_home; // Store the S3 URL instead of filename
                    $customer->address = $credentials['address'];
                    if ($request->has('location') && empty($credentials['latitude'])) {
                        $customer->location = $request->location;
                    } else {
                        $customer->location = $credentials['latitude'] . ',' . $credentials['longitude'];
                    }
                    // $customer->location = $credentials['latitude'] . ',' . $credentials['longitude'];
                    $customer->group = 1;
                    $customer->updated_at = Carbon::now();

                    $customer->save();

                    return redirect()->route('confirmation')->with('success', 'Data diri berhasil disimpan');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
        } else {
            return redirect()->route('profile');
        }
    }
    public function confirmation()
    {
        $title = 'Konfirmasi Data';

        if (session()->has('register_id')) {

            $register_id = session()->get('register_id');

            // dump($register_id);
            $data = RegisterModel::with('service')->find($register_id);
            if ($data->location) {
                $location = explode(',', $data->location);
                $data->latitude = $location[0];
                $data->longitude = $location[1];
                $data->register_id = $register_id;
            }
            // dd($data);
            if (!$data) {
                return redirect()->route('service')->with('error', 'Silahkan Mengulangi Proses Registrasi');
            }

            // $selected_package = $data->service->service_name;
            return view('registration.confirmation', compact('title', 'register_id', 'data'));
        } else {
            return redirect()->route('service');
        }
    }

    public function confirmation_store($register_id)
    {
        if (session()->has('register_id')) {
            $register_id = session()->get('register_id');
            $registerData = RegisterModel::with('service')->find($register_id);

            if (!$registerData) {
                return redirect()->route('service')->with('error', 'Data registrasi tidak ditemukan');
            }

            $lastCustomer = Customer::orderBy('customer_id', 'desc')
                ->where('customer_id', 'like', Carbon::now()->format('ym') . '%')
                ->first();

            if ($lastCustomer) {
                // Mengambil 5 digit terakhir sebagai urutan
                $lastNumber = intval(substr($lastCustomer->customer_id, -5));
                $customer_id = Carbon::now()->format('ym') . sprintf('%05d', $lastNumber + 1);
            } else {
                // Jika tidak ada customer, urutan dimulai dari 00001
                $customer_id = Carbon::now()->format('ym') . '00001';
            }

            $lastSubscription = Subscription::orderBy('subscription_id', 'desc')
                ->where('subscription_id', 'like', Carbon::now()->format('ym') . $registerData->group . '%')
                ->first();

            if ($lastSubscription) {
                // Mengambil 4 digit terakhir sebagai urutan
                $lastNumber = intval(substr($lastSubscription->subscription_id, -5));
                $subscription_id = Carbon::now()->format('ym') . $registerData->group . sprintf('%05d', $lastNumber + 1);
            } else {
                // Jika tidak ada subscription, urutan dimulai dari 0001
                $subscription_id = Carbon::now()->format('ym') . $registerData->group . '00001';
            }


            try {
                // Move home photo from temp to final location if exists
                if ($registerData->home_file) {
                    try {
                        $oldPath = "sub_home_temp/{$registerData->home_file}";
                        $extension = pathinfo($registerData->home_file, PATHINFO_EXTENSION);
                        $newFileName = $subscription_id . '-home_photo-' . time() . '.' . $extension;
                        $newPath = "sub_home/{$newFileName}";

                        if (!Storage::disk('s3')->exists($oldPath)) {
                            throw new \Exception("Source file not found in S3: {$oldPath}");
                        }

                        $fileContents = Storage::disk('s3')->get($oldPath);
                        if (!Storage::disk('s3')->put($newPath, $fileContents)) {
                            throw new \Exception("Failed to upload file to new location");
                        }

                        Storage::disk('s3')->delete($oldPath);
                        $registerData->home_file = $newFileName;
                    } catch (\Exception $e) {
                        // \Log::error('S3 file movement failed: ' . $e->getMessage());
                        throw $e;
                    }
                }

                // Create new customer record
                $customer = new Customer();
                $customer->customer_id = $customer_id;
                $customer->customer_password = $registerData->password;
                $customer->customer_name = $registerData->name;
                $customer->customer_email = $registerData->email;
                $customer->customer_address = $registerData->address;
                $customer->customer_phone = "62{$registerData->phone}";
                $customer->customer_ktp_no = $registerData->ktp_number;
                $customer->customer_ktp_picture = $registerData->ktp_file;
                $customer->password_reset = 0;
                // dump($customer);
                $customer->save();

                $location = explode(',', $registerData->location);
                $registerData->latitude = $location[0];
                $registerData->longitude = $location[1];
                $new_location = $registerData->latitude . ', ' . $registerData->longitude;

                $subscription = new Subscription();
                $subscription->subscription_id = $subscription_id;
                $subscription->subscription_password = "62{$registerData->phone}";
                $subscription->customer_id = $customer_id;
                $subscription->serv_id = $registerData->serv_id;
                $subscription->group = $registerData->group;
                $subscription->created_by = 'TsFxAaV0dz';
                $subscription->subscription_address = $registerData->address;
                $subscription->subscription_status = 'NEW REQUEST';
                $subscription->subscription_maps = $new_location;
                $subscription->subscription_home_photo = $registerData->home_file;
                // dd($subscription);
                $subscription->save();
                // Delete the registration data after successful transfer
                $registerData->delete();

                // Clear the session
                session()->forget('register_id');

                return redirect(env('REDIRECT_LOGIN'))->with('success', 'Registrasi berhasil, silahkan login');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }

        return redirect(env('REDIRECT_LOGIN'));
    }
}
