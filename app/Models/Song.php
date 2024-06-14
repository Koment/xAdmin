<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Song extends Model
{
    use HasFactory;

    protected static function booted (){

        static::creating(function($song){
            $song->artist_id = Auth::user()->id;
            
        });
    }

    protected $casts = [
        'relise' => 'date',
        'jenre' => 'array'
    ];

    protected $fillable = [
        'cover', 'artist_id', 'track', 'artist', 'feat', 'name', 'description', 'relise', 'obscense', 'jenre', 'languge', 'mus_author', 'text_author', 'song_text'
    ];

    protected $hidden = [
        'artist_id'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
    
}
