<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandle;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{

    public function saving(Topic $topic)
    {
        //XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        //生成话题摘要
        $topic->excerpt = make_excerpt($topic->body);

        //如果 slug 没有内容，就用翻译器对 title 进行翻译
        if (!$topic->slug) {
            $topic->slug = app(SlugTranslateHandle::class)->translate($topic->title);
        }
    }

    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }
}