<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ipinfo\ipinfo\IPinfo;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WebsiteController extends Controller
{
    public function index() {
        $games = Game::paginate(10);
        return view('index', compact('games'));
    }

    public function gameRatingView($id) {
        $game = Game::findOrFail($id);
        $ratingDisabled = auth()->user()->ratings->count(fn($rating) => $rating->game_id == $game->id && auth()->user()->id == $rating->user_id);
        return view('game_rating_view', compact('game', 'ratingDisabled'));
    }

    public function gameRatingAdd(Request $request) {

        $data = $request->validate([
            'game_id' => 'required|exists:games,id',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'required|string|max:2000',
        ]);


        $ratingDisabled = Rating::where([
            'game_id' => $data['game_id'],
            'user_id' => auth()->user()->id,
        ])->count();
        if ($ratingDisabled) {
            return redirect()->back()->with('failed', 'Multiple rating is not allowed!');
        }


        // $access_token = '21963b8af66677';
        // $client = new IPinfo($access_token);
        // $ip_address = '27.125.244.114'; // $request->ip();
        // $details = $client->getDetails($ip_address);

        $data['user_id'] = auth()->guard('web')->user()->id;
        $data['coordinate'] = '123,123';
        // $data['coordinate'] = $details->loc;

        $game = Game::findOrFail($request->game_id);
        $game->ratings()->create($data);

        return redirect()->back()->with('success', 'Rating added');
    }

    public function loginScreen() {
        return view('login');
    }
    
    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|max:255',
        ]);
        
        if (auth()->guard('web')->attempt($data)) {
            return redirect('/')->with('success', 'Login success');
        }
        
        return redirect()->back()->with('failed', 'Invalid credentials');
    }

    public function registerScreen() {
        return view('register');
    }

        
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255',
        ]);
        
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        
        return redirect()->back()->with('success', 'Registration success');
    }

    public function logout() {
        auth()->guard('web')->logout();
        return redirect('/login')->with('success', 'You have logout');
    }
}
