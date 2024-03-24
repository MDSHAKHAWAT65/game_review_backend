<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
class AdminController extends Controller
{
    public function loginScreen() {
        return view('moderator/login');
    }
    
    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|max:255',
        ]);
        
        $data['type'] = 'MODERATOR';
        if (auth()->guard('moderator')->attempt($data)) {
            return redirect('/')->with('success', 'Login success');
        }
        
        return redirect()->back()->with('failed', 'Invalid credentials');
    }
    
    public function dashboardScreen() {
        if (!auth()->guard('moderator')->check()) {
            return redirect('/')->with('failed', 'Please login');
        }

        return view('moderator/dashboard');
    }
    
    public function gameListScreen() {
        $games = Game::paginate(10);
        return view('moderator/games', compact('games'));
    }
    
    public function gameAddScreen() {
        return view('moderator/game_add_form');
    }
    
    public function gameAdd(Request $request) {
        // form validation (validate user inputted data)
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);

        // store image in public folder
        $data['img_url'] = $request->image->store('public');
        $data['img_url'] = $this->toAccessibleLink($data['img_url']);
        
        // create record in database
        Game::create($data);

        // return success msg
        return redirect()->back()->with('success', 'Games added');
    }

    private function toAccessibleLink($path) {
        return str_replace('public', 'storage', $path);
    }
    
    public function gameEdit() {
        
    }
    
    public function gameDelete() {
        
    }

    public function logout() {
        auth()->guard('moderator')->logout();
        return redirect('/login')->with('success', 'You have logged out.');
    }
    
}
