<?php

namespace App\Observers;

use App\Models\Song;

class songObserver
{
    /**
     * Handle the Song "created" event.
     *
     * @param  \App\Models\Song  $song
     * @return void
     */
    public function created(Song $song)
    {
        // echo ('somr tecxt');
        // dd($song);
    }

    /**
     * Handle the Song "updated" event.
     *
     * @param  \App\Models\Song  $song
     * @return void
     */
    public function updated(Song $song)
    {
        //
    }

    /**
     * Handle the Song "deleted" event.
     *
     * @param  \App\Models\Song  $song
     * @return void
     */
    public function deleted(Song $song)
    {
        //
    }

    /**
     * Handle the Song "restored" event.
     *
     * @param  \App\Models\Song  $song
     * @return void
     */
    public function restored(Song $song)
    {
        //
    }

    /**
     * Handle the Song "force deleted" event.
     *
     * @param  \App\Models\Song  $song
     * @return void
     */
    public function forceDeleted(Song $song)
    {
        //
    }
}
