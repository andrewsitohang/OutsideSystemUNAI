<?php

namespace App\Http\Controllers;

use App\Models\Penjamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('penjamin.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'min:3', 'max:255', 'unique:penjamins'],
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'repassword' => 'required|same:password',
            'nama' => 'required|max:255',
            'nomor_telp' => 'required|numeric|digits_between:10,14', 'unique:penjamins',
        ], [
            'password.regex' => 'The password format is invalid. Password must be at least 8 characters with a combination of numbers and letters.',
        ]);
                
                
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        // Get validated data from the validator instance
        $validatedData = $validator->validated();
        
        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        $validatedData['otp'] = mt_rand(100000, 999999);
        
        $otpKey = 'otp_' . $validatedData['username'];
        Cache::put($otpKey, $validatedData['otp'], now()->addMinutes(1)); // Adjust the expiration time as needed

        //store OTP in session
        $request->session()->put('username', $validatedData['username']);
        $request->session()->put('password', $validatedData['password']);
        $request->session()->put('nama', $validatedData['nama']);
        $request->session()->put('nomor_telp', $validatedData ['nomor_telp']);
        $request->session()->put('otp', $validatedData['otp']);

        //send OTP to user's WhatsApp
        $this->sendOtpWhatsApp($request->nomor_telp, $validatedData['otp']);        
        // $request->session()->flash('success', 'Registration successfull! Please login');
        
        // return redirect('penjamin/verify-otp');
        // return redirect('penjamin/register')->withErrors($validatedData);

        // return response()->json(["success" => "success"]);
    }

    private function sendOtpWhatsApp($nomor_telp, $otp) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => getenv("FONNTE_LINK"),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => $nomor_telp,
        'message' => 'Your OTP : '.$otp , 
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: '.getenv("FONNTE_TOKEN") //change TOKEN to your actual token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function showVerifyOtpForm(Request $request)
    {
        return view('penjamin.verify-otp');
    }

    public function verifyOtp(Request $request) {
        $username = $request->session()->get('username');
        $password = $request->session()->get('password');
        $nama = $request->session()->get('nama');
        $nomor_telp = $request->session()->get('nomor_telp');
        // $otp = $request->session()->get('otp');

        $otpKey = 'otp_' . $username;
        $cachedOtp = Cache::get($otpKey);

        $otpDigit1 = $request->input1;
        $otpDigit2 = $request->input2;
        $otpDigit3 = $request->input3;
        $otpDigit4 = $request->input4;
        $otpDigit5 = $request->input5;
        $otpDigit6 = $request->input6;

        $otp = $otpDigit1 . $otpDigit2 . $otpDigit3 . $otpDigit4 . $otpDigit5 . $otpDigit6;

        // dd($otp);

        if($otp == $cachedOtp) {
            // OTP verification successful, proceed with user registration
            Penjamin::create([
                'username' => $username,
                'password' => $password,
                'nama' => $nama,
                'nomor_telp' => $nomor_telp,
            ]);
            Cache::forget($otpKey);

            return response()->json(['success' => 'Registration successful! Please login']);
            // return redirect('/penjamin/login')->with('success', 'Registration successfull! Please login');
        } else {
            return response()->json(['error' => 'OTP tidak valid']);
            // return redirect('/penjamin/register')->with('error', 'OTP tidak valid');
        }
    }
}