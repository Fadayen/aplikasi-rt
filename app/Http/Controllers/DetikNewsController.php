<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DetikNewsController extends Controller
{
    public function index()
    {
        $rssUrl = 'https://news.detik.com/rss';

        $response = Http::get($rssUrl);

        if (! $response->ok()) {
            abort(500, 'Gagal mengambil RSS Detik');
        }

        $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);

        $news = [];

        foreach ($xml->channel->item as $item) {

            // ✅ DEFAULT PLACEHOLDER
            $image = 'https://via.placeholder.com/400x250?text=Detik+News';

            /** 
             * ✅ 1. MEDIA:CONTENT
             */
            $namespaces = $item->getNamespaces(true);

            if (isset($namespaces['media'])) {
                $media = $item->children($namespaces['media']);
                if (isset($media->content)) {
                    $attrs = $media->content->attributes();
                    if (isset($attrs['url'])) {
                        $image = (string) $attrs['url'];
                    }
                }
            }

            /**
             * ✅ 2. ENCLOSURE
             */
            if ($image === 'https://via.placeholder.com/400x250?text=Detik+News' && isset($item->enclosure)) {
                $attrs = $item->enclosure->attributes();
                if (isset($attrs['url'])) {
                    $image = (string) $attrs['url'];
                }
            }

            /**
             * ✅ 3. IMAGE FROM DESCRIPTION
             */
            if ($image === 'https://via.placeholder.com/400x250?text=Detik+News') {
                if (preg_match('/<img.+src=["\'](.+?)["\']/', (string)$item->description, $matches)) {
                    $image = $matches[1];
                }
            }

            $news[] = [
                'title' => (string) $item->title,
                'link'  => (string) $item->link,
                'image' => $image,
            ];
        }

        return view('detik-news', compact('news'));
    }
}
