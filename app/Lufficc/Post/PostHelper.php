<?php
namespace Lufficc\Post;

use App\Model\Post;

/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 1/23/2017
 * Time: 12:58 PM
 */
trait PostHelper
{
    /**
     * onPostShowing, clear this post's unread notifications.
     *
     * @param Post $post
     */
    public function onPostShowing(Post $post)
    {
        $user = auth()->user();
        if (!isAdmin($user)) {
            $post->increment('view_count');
        }
        if (auth()->check()) {
            $unreadNotifications = $user->unreadNotifications;
            foreach ($unreadNotifications as $notifications) {
                $comment = $notifications->data;
                if ($comment['commentable_type'] == 'App\Model\Post' && $comment['commentable_id'] == $post->id) {
                    $notifications->markAsRead();
                }
            }
        }
    }
}