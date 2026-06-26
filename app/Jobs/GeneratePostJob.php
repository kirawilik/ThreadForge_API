<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GeneratePostJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Post $post)
    {
    }

    public function handle(): void
    {
        // Ici tu appelleras Laravel AI + Grok

        $this->post->update([
            'hook_propose' => 'Exemple de hook généré',
            'body_points' => [
                'Point 1',
                'Point 2',
                'Point 3',
            ],
            'technical_readability_score' => 90,
            'suggested_hashtags' => [
                'Laravel',
                'PHP',
            ],
            'tone_compliance_justification' => 'Respecte les règles du Blueprint.',
            'status' => 'draft',
        ]);
    }
}