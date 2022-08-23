<?php

namespace App\Http\Controllers;

use App\Helpers\CommonResponse;
use App\Helpers\HandleException;
use App\Services\UserService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Factory|View|Application
    {
        return view('auth.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
//        $token_user = Auth::guard('user')->attempt($credentials);
//        $token_admin = Auth::guard('admin')->attempt($credentials);
        if (Auth::guard()->attempt($credentials)) {
            $user = Auth::guard()->user();
//            return response()->json([
//                'status' => 'success',
//                'user' => $user,
//                'authorisation' => [
//                    'token' => $token_user,
//                    'type' => 'bearer',
//                ]
//            ]);
            if($user['email_verified'] == 0) {
                redirect('/')->with('Error','Please verified email');
            }
            return redirect()->intended('dashboard')->with('Success','Signed in');
        }
//        else if ($token_admin) {
//            return redirect()->intended('manage')
//                ->withSuccess('Signed in');
//        }

        return redirect('/')->with('Error','Login details are not valid');
    }



    public function registration(): Factory|View|Application
    {
        return view('auth.registration');
    }


    public function checkRegistration(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|required_with:confirm_password',
            'confirm-password' => 'required|min:6|required_with:password|same:password',
        ]);
        try {
            DB::beginTransaction();
            $data = [
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ];
            $this->userService->create($data);
            DB::commit();
//            Mail::to($request['email'])->send(new SignupEmail($mailData));
//            $credentials = $request->only('email', 'password');
//            if (Auth::guard()->attempt($credentials)) {
//                return redirect()->intended('dashboard')
//                    ->withSuccess('Signed in');
//            }

            return redirect('/')->with('Success','Account created! Please verified email');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e);
            return redirect('/')->with('Error','QueryException');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect('/')->with('Error','Exception');
        }
    }

    public function dashboard()
    {
        if(Auth::guard()->check()){
            return view('layouts.dashboard');
        }

        return redirect('/')->withSuccess('are not allowed to access');
    }

//    public function manage(): View|Factory|Application
//    {
//        if(Auth::guard('admin')->check()){
//            return view('manage');
//        }
//
//        return redirect('/')->withSuccess('are not allowed to access');
//    }

    public function logout(): Redirector|Application|RedirectResponse
    {
        auth()->logout();

        return Redirect('/');
    }
}
