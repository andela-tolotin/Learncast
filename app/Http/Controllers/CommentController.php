<?php

namespace LearnCast\Http\Controllers;

use Illuminate\Http\Request;
use LearnCast\Comment;

class CommentController extends Controller
{
    /**
     * This method add video comments.
     *
     * @param $request
     *
     * @return array
     */
    public function addComment(Request $request)
    {
        $findComment = $this->findComment($request);

        if (!is_null($findComment)) {
            return [
               'statuscode' => 202,
               'message'    => 'Comment has been added earlier!',
            ];
        }

        $comment = $this->createComment($request);

        if (!is_null($comment)) {
            return [
                'statuscode' => 201,
                'message'    => 'Comment added successfully!',
                'id'         => $comment->id,
            ];
        }

        return [
            'statuscode' => 400,
            'message'    => 'Comment failed to add!',
        ];
    }

    /**
     * This method finds duplicate comments made by a user.
     *
     * @param $request
     *
     * @return Comment
     */
    public function findComment($request)
    {
        return Comment::where('comment', strtolower($request->input('comment')))
        ->where('user_id', $request->input('user'))
        ->first();
    }

    /**
     * This method creates comments on video.
     *
     * @param $request
     *
     * @return Comment
     */
    public function createComment($request)
    {
        return Comment::create([
            'comment'  => strtolower($request->input('comment')),
            'video_id' => $request->input('video'),
            'user_id'  => $request->input('user'),
        ]);
    }

    /**
     * This method softDelete Comment.
     *
     * @param $request
     *
     * @return array
     */
    public function softDeleteComment($id)
    {
        $deletedComment = Comment::removeComment($id)->delete();

        if ($deletedComment) {
            return [
                'statuscode' => 200,
                'message'    => 'Comment deleted successfully!',
            ];
        }

        return [
            'statuscode' => 400,
            'message'    => 'Comment failed to delete!',
        ];
    }

    /**
     * This method updates the user comment.
     *
     * @param $request
     *
     * @return array
     */
    public function updateComment(Request $request, $id)
    {
        $comment = Comment::where('id', $id)
        ->update([
            'comment' => $request->input('comment'),
        ]);

        if ($comment) {
            return [
                'statuscode' => 200,
                'message'    => 'Comment updated successfully!',
            ];
        }

        return [
            'statuscode' => 400,
            'message'    => 'Comment failed to update!',
        ];
    }
}
