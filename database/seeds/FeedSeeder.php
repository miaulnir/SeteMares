<?php

use App\Models\Feed;
use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/feed.json");
        $feeds = json_decode($json);

        foreach ($feeds as $feed) {
            $feedId = Feed::create([
                'title' => $feed->title,
                'slug' => $feed->slug,
                'content' => json_encode($feed->content),
                'categories' => Collection::make($feed->categories),
                'status' => $feed->properties->status,
                'published' => $feed->properties->published,
                'modified' => $feed->properties->modified,
            ])->id;
            foreach ($feed->media as $media) {
                Media::create(
                    [
                        'type' => $media->type,
                        'media' => Collection::make($media->media),
                        'feed_id' => $feedId
                    ]
                );
            }
        }
    }
}
