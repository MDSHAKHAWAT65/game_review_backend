<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Rating;
use ipinfo\ipinfo\IPinfo;

class ApiController extends Controller
{
    public function gameRatingAdd(Request $request) {

        $data = $this->validate($request, [
            'game_id' => 'required|exists:games,id',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'required|string|max:2000',
        ]);


        $ratingDisabled = Rating::where([
            'game_id' => $data['game_id'],
            'user_id' => auth()->user()->id,
        ])->count();
        if ($ratingDisabled) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'failed',
                    'message' => 'Multiple rating is not allowed!',
                ],
                'data' => []
                ]
            );
        }


        $access_token = '21963b8af66677';
        $client = new IPinfo($access_token);
        $ip_address = $request->ip();
        $details = $client->getDetails($ip_address);

        $data['user_id'] = auth()->user()->id;
        $data['coordinate'] = $details->loc;

        $game = Game::findOrFail($request->game_id);
        $game->ratings()->create($data);

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Rating added',
            ],
            'data' => []
            ]
        );
    }

    public function games() {
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'All Games',
            ],
            'data' => [
                'games' => Game::where('status', 1)->get()->map(function ($game) {
                    return [
                        'id' => $game->id,
                        'title' => $game->title,
                        'img_url' => asset($game->img_url),
                        'avg' => $game->avg(),
                        'ratings' => $game->ratings->map(function($rating) use($game) {
                            return [
                                'user' => [
                                    "id" => $rating->user->id,
                                    "name" => $rating->user->name,
                                    "username" => $rating->user->username,
                                    "email" => $rating->user->email,
                                ],
                                'rating' => $rating->rating,
                                'comment' => $rating->comment,
                                'coordinate' => $rating->coordinate,
                            ];
                        }),
                    ];
                })
            ],
        ]);
    }
}
