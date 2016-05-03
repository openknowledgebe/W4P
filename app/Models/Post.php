<?php

namespace W4P\Models;

use Illuminate\Database\Eloquent\Model;
use Markdown;

class Post extends Model
{
    protected $table = "post";
    public $timestamps = true;

    protected $fillable = ['title', 'content', 'summary'];

    public function markdownBrief()
    {
        $markdown = Markdown::convertToHtml($this->content);
        $lines = explode("\n", $markdown);
        // Character length < 300; continue
        $content = "";
        $totalChars = 0;
        $lineCount = 0;
        foreach ($lines as $line) {
            $totalChars += strlen($line);
            $lineCount++;
            // If the total characters exceed 200 or 3 lines (whichever is first) stop outputting text
            if ($totalChars < 500 && $lineCount < 4) {
                $content .= "\n" . $line;
            }
        }
        return $content;
    }
}
