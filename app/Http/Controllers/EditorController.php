<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditorController extends Controller
{
    public static function filterImage($oldContent, $newContent)
    {
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $oldContent, $oldMatches);
        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $newContent, $newMatches);

        $oldImages = $oldMatches[1] ?? [];
        $newImages = $newMatches[1] ?? [];
        $deletedImages = array_diff($oldImages, $newImages);

        foreach ($deletedImages as $url) {
            if (!str_contains($url, asset('storage'))) {
                continue;
            }

            $path = str_replace(asset('storage') . '/', '', $url);
            $fullPath = storage_path('app/public/' . $path);

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    public static function deleteImage($content)
    {
        preg_match_all('/<img[^>]+src="([^"]+)"[^>]*>/i', $content, $matches);
        $urls = $matches[1] ?? [];
        foreach ($urls as $url) {
            $path = str_replace(asset('storage') . '/', '', 'storage/' . $url);
            if (file_exists(public_path($path)) && is_file(public_path($path))) {
                unlink(public_path($path));
            }
        }
    }

    public static function convertImage($imageName, $content)
    {
        preg_match_all(
            '/<img[^>]+src=["\']([^"\']+)["\']/i',
            $content,
            $matches,
            PREG_SET_ORDER
        );

        if (empty($matches)) {
            return $content;
        }

        foreach ($matches as $match) {
            $src = $match[1];
            if (!str_starts_with($src, 'data:image')) {
                continue;
            }
            if (!preg_match('/data:image\/(.*?);base64,(.*)/', $src, $data)) {
                continue;
            }
            $imageType = $data[1];
            $base64Data = $data[2];
            $imageData = base64_decode($base64Data);
            if ($imageData === false) {
                continue;
            }
            $fileName = Str::slug($imageName) . '-' . uniqid() . '.' . $imageType;
            $storagePath = 'text-editor-content/' . $fileName;
            Storage::disk('public')->makeDirectory('text-editor-content');
            Storage::disk('public')->put($storagePath, $imageData);
            $url = asset('storage/' . $storagePath);
            $content = str_replace(
                $match[0],
                '<img src="' . $url . '" /',
                $content
            );
        }

        return $content;
    }

}
